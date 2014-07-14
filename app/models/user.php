<?php

class user extends CI_Model {

    private static $user_id;
    private static $user_group_id;
    private static $user_access;

    public function __construct() {
        parent::__construct();
    }

    public function hash_password($password) {
        $CI = & get_instance();
        $CI->load->helper('security');

        return do_hash($password);
    }

    public function match_password($user_id, $password) {
        $CI = & get_instance();

        $CI->db->where('id', $user_id);
        $CI->db->where('password', $this->hash_password($password));
        return $CI->db->get('users')->num_rows();
    }

    public function authenicate($username, $password) {
        $CI = & get_instance();

        $CI->db->where('username', $username);
        $CI->db->where('password', $this->hash_password($password));


        $CI->db->join('user_groups', 'users.gid = user_groups.id');
        $CI->db->join('user_access', 'user_groups.access = user_access.id');


        $user = $CI->db->select('users.id,users.gid,user_groups.access')->get('users')->row();

        if (count($user)) {
            $CI->db->where('id', $user->id);
            $CI->db->set('last_login', date("Y-m-d H:i:s"))->update('users');

            $CI->session->set_userdata('user_id', $user->id);
            $CI->session->set_userdata('user_group_id', $user->gid);
            $CI->session->set_userdata('user_access', $user->access);

            self::$user_id = $user->id;
            self::$user_group_id = $user->gid;
            self::$user_access = $user->access;

            return TRUE;
        } else {
            return FALSE;
        }
    }

    static public function id() {
        if (!isset(self::$user_id)) {

            $CI = & get_instance();


            if (!$user_id = $CI->session->userdata('user_id')) {
                return FALSE;
            }

            if (!$u = $CI->db->get_where('users', array('id' => $user_id))->row('id')) {
                return FALSE;
            }

            self::$user_id = $u;
        }

        return self::$user_id;
    }

    static public function group() {
        if (!isset(self::$user_group_id)) {

            $CI = & get_instance();


            if (!$user_group_id = $CI->session->userdata('user_group_id')) {
                return FALSE;
            }

            if (!self::id()) {
                return FALSE;
            }

            if (!$u = $CI->db->get_where('users', array(
                        'id' => self::id(),
                        'gid' => $user_group_id,
                    ))->row('gid')) {
                return FALSE;
            }

            self::$user_group_id = $u;
        }

        return self::$user_group_id;
    }

    static public function access_id() {
        if (!isset(self::$user_access)) {

            $CI = & get_instance();


            if (!$user_access = $CI->session->userdata('user_access')) {
                return 0;
            }
            if (!self::id()) {
                return 0;
            }
            if (!$u = $CI->db->get_where('user_groups', array(
                        'id' => self::group(),
                        'access' => $user_access
                    ))->row('access')) {
                return 0;
            }
            $CI->db->flush_cache();
            self::$user_access = $u;
        }

        return self::$user_access;
    }

    static public function flush() {
        $CI = & get_instance();

        $CI->session->unset_userdata('user_id');
        $CI->session->unset_userdata('username');
        $CI->session->unset_userdata('access');
    }

    static public function access() {
        $CI = & get_instance();

        $where = array(
            'controller' => $CI->router->class,
            'method' => $CI->router->method,
        );

        if (!$accessable = $CI->db->get_where('access', $where)->num_rows()) {
            return true;
        }

        $where = array(
            'access_id' => (!self::access_id()) ? 0 : self::access_id(),
            'controller' => $CI->router->class,
            'method' => $CI->router->method,
        );

        if ($accessable = $CI->db->get_where('access', $where)->num_rows()) {
            return true;
        }


        return FALSE;
    }

    static public function redirectUnauthorizedAccess($uri = 'administrator', $flashValue = 'Unauthorized Access', $loggedout = false) {

        if (!self::access()) {

            if ($loggedout) {
                self::flush();
            }

            AZ::redirectError($uri, $flashValue);
        }
    }

    static public function avatar($user_id = NULL) {
        $CI = & get_instance();

        $id = (empty($user_id)) ? self::id() : $user_id;

        if (!(int) $id) {
            return false;
        }
        $avatar = $CI->db->get_where('user_profiles', array('user_id' => $id))->row('avatar');

        if (!count($avatar) && is_array($avatar)) {
            $avatar = 'media/users/avatar.png';
        }
        return site_url($avatar);
    }

    static public function email($user_id = NULL) {
        $CI = & get_instance();

        $id = (empty($user_id)) ? self::id() : $user_id;
        if (!(int) $id) {
            return false;
        }
        $email = $CI->db->get_where('users', array('id' => $id))->row('email');
        if (!count($email) && is_array($email)) {
            $email = '';
        }
        return $email;
    }

    static public function username($user_id = NULL) {
        $CI = & get_instance();

        $id = (empty($user_id)) ? self::id() : $user_id;
        if (!(int) $id) {
            return false;
        }
        $username = $CI->db->get_where('users', array('id' => $id))->row('username');
        if (!count($username) && is_array($username)) {
            $username = '';
        }
        return $username;
    }

    static public function user_group() {
        $CI = & get_instance();


        if (!self::$user_group_id) {
            return false;
        }
        $name = $CI->db->get_where('user_groups', array('id' => self::$user_group_id))->row('name');
        if (!count($name) && is_array($name)) {
            $name = '';
        }
        return $name;
    }

    ////////////////////////////////// User Administration ---------------------

    public function getAccesses($select = '*', $where = array(), $order_by = 'id', $order = "ASC", $offset = 0, $limit = 25, $count = FALSE) {

        $c = ($count == FALSE) ? 'result' : 'num_rows';

        if (is_array($where) && count($where)) {
            $this->db->where($where);
        }

        if ($select != '*' && !empty($select)) {
            $this->db->select($select);
        }

        $this->db
                ->order_by($order_by, $order);
        $this->db
                ->offset($offset);

        if (!$count) {
            $this->db->limit($limit);
        }


        return $this->db->get('user_access')->{$c}();
    }

    public function getAccessById($id) {

        return $this->db->get_where('user_access', array('id' => $id))->row();
    }

    public function saveAccess($data) {

        if (!is_array($data) || !count($data)) {
            return false;
        }

        if (isset($data['id']) && $data['id'] > 0) {
            return $this->db->update('user_access', $data, array('id' => $data['id']));
        } else {
            return $this->db->insert('user_access', $data);
        }
    }

    public function getUserGroups($select = '*', $where = array(), $order_by = 'user_groups.id', $order = "ASC", $offset = 0, $limit = 25, $count = FALSE) {

        $c = ($count == FALSE) ? 'result' : 'num_rows';

        if (is_array($where) && count($where)) {
            $this->db->where($where);
        }

        if ($select != '*' && !empty($select)) {
            $this->db->select($select);
        }

        $this->db
                ->order_by($order_by, $order);
        $this->db
                ->offset($offset);

        if (!$count) {
            $this->db->limit($limit);
        }

        if (strchr($select, 'access')) {
            $this->db->join('user_access', 'user_access.id= user_groups.access');
        }
        return $this->db->get('user_groups')->{$c}();
    }

    public function getUserGroupById($id) {

        return $this->db->get_where('user_groups', array('id' => $id))->row();
    }

    public function saveGroup($data) {

        if (!is_array($data) || !count($data)) {
            return false;
        }

        if (isset($data['id']) && $data['id'] > 0) {
            return $this->db->update('user_groups', $data, array('id' => $data['id']));
        } else {
            return $this->db->insert('user_groups', $data);
        }
    }

    public function getUserOptions() {
        $this->db->where('status', 1);
        $rows = $this->db->select('id,name')->get('users')->result();
        $users = array();
        if ($rows && count($rows)) {
            foreach ($rows as $row) {
                $users[$row->id] = $row->name;
            }
        }
        return $users;
    }

    public function getUsers($select = '*', $where = array(), $offset = 0, $limit = 5, $count = FALSE, $order_by = 'users.id', $order = "DESC") {

        $c = ($count == FALSE) ? 'result' : 'num_rows';

        if (is_array($where) && count($where)) {
            $this->db->where($where);
        }

        if ($select != '*' && !empty($select)) {
            $this->db->select($select);
        }

        $this->db
                ->order_by($order_by, $order);
        $this->db
                ->offset($offset);

        if (!$count) {
            $this->db->limit($limit);
        }

        if (strchr($select, 'user_profiles')) {
            $this->db->join('user_profiles', 'user_profiles.user_id= users.id', 'left');
        }

        return $this->db->get('users')->{$c}();
    }

    public function getTotalUsers() {
        return $this->db->get_where('users', array('status' => 1))->num_rows();
    }

    public function getUserById($id) {
        $this->db->join('user_profiles', 'user_profiles.user_id= users.id', 'left');
        return $this->db->get_where('users', array('id' => $id))->row();
    }

    public function saveUser($data) {

        if (!is_array($data) || !count($data)) {
            return false;
        }
        $user = array(
            'username' => $data['username'],
            'email' => $data['email'],
            'name' => $data['name'],
            'status' => $data['status'],
            'gid' => $data['gid'],
            'registerd' => date("Y-m-d H:i:s")
        );

        if (isset($data['password']) && !empty($data['password'])) {
            $user['password'] = $this->hash_password($data['password']);
        }

        $profile = array(
            'address' => $data['address'],
            'city' => $data['city'],
            'pincode' => $data['pincode'],
            'state' => $data['state'],
            'country' => $data['country'],
            'phone' => $data['phone'],
        );
        if (isset($data['avatar']) && !empty($data['avatar'])) {
            $profile['avatar'] = $data['avatar'];
        }


        if (isset($data['id']) && $data['id'] > 0) {
            $this->db->update('users', $user, array('id' => $data['id']));
            return $this->saveUserProfile($data['id'], $profile);
        } else {

            $this->db->insert('users', $user);
            return $this->saveUserProfile($this->db->insert_id(), $profile);
        }
    }

    public function updateUserProfile($data) {

        if (!is_array($data) || !count($data)) {
            return false;
        }

        if (isset($data['name']) && !empty($data['name'])) {
            $this->db->update('users', array('name' => $data['name']), array('id' => $data['id']));
        }

        $profile = array(
            'address' => $data['address'],
            'city' => $data['city'],
            'state' => $data['state'],
            'country' => $data['country'],
            'phone' => $data['phone'],
        );

        if (isset($data['avatar']) && !empty($data['avatar'])) {
            $profile['avatar'] = $data['avatar'];
        }

        return $this->saveUserProfile($data['id'], $profile);
    }

    public function saveUserProfile($user_id, $data) {
        $exits = $this->db->get_where('user_profiles', array('user_id' => $user_id))->num_rows();
        if ($exits) {
            return $this->db->update('user_profiles', $data, array('user_id' => $user_id));
        } else {
            $data['user_id'] = $user_id;

            return $this->db->insert('user_profiles', $data);
        }
    }

    public function uploadUserAvatar($field = 'avatar', $dir = 'media/users') {

        $options['upload_path'] = './' . $dir;
        $options['allowed_types'] = 'gif|jpg|jpeg|png';
        $options['max_size'] = '51200';
        $options['encrypt_name'] = true;

        $this->load->library('upload');
        $this->upload->initialize($options);

        if (!$this->upload->do_upload($field)) {
            return array('error' => 1, 'error_string' => $this->upload->display_errors());
        }
        $data = $this->upload->data();

        if (!count($data)) {
            return false;
        }
        $data['avatar'] = $dir . '/' . $data['file_name'];
        $iconArray = $this->generateIcon($data);
        $data['icon'] = $iconArray;
        return $data;
    }

    public function generateIcon($options, $width = 48, $height = 48) {
        if (!isset($options['full_path']) || empty($options['full_path'])) {
            return false;
        }

        $config['create_thumb'] = TRUE;
        $config['maintain_ratio'] = TRUE;
        $config['source_image'] = $options['full_path'];
        $config['new_image'] = str_replace('users', 'users/icon', $options['full_path']);
        $config['width'] = $width;
        $config['height'] = $height;
        $config['quality'] = '90%';

        $this->load->library('image_lib');
        $this->image_lib->clear();

        $this->image_lib->initialize($config);

        if (!$this->image_lib->resize()) {
            return array('error' => 1, 'error_string' => $this->image_lib->display_errors());
        } else {
            return array('error' => 0, 'new_image' => $config['new_image']);
        }
    }

    public function getAdminMethods() {
        $controllers = array();

        $dir = APPPATH . 'controllers/admin/';
        $files = scandir($dir);

        $controller_files = array_filter($files, function($filename) {
            return (substr(strrchr($filename, '.'), 1) == 'php') ? true : false;
        });

        foreach ($controller_files as $filename) {

            $file = str_replace("models", "controllers" . DIRECTORY_SEPARATOR . "admin", dirname(__FILE__));
            require_once $file . DIRECTORY_SEPARATOR . $filename;

            $classname = ucfirst(substr($filename, 0, strrpos($filename, '.')));
            $methods = get_class_methods($classname);
            $tasks = array();
            foreach ($methods as $method) {
                if ($method[0] !== '_') {
                    if ($method !== 'get_instance') {
                        $tasks[$classname][] = $method;
                        
                    }
                }
            }
            return $tasks;
            
        }

        
    }

    public function getPermissions($select = '*', $where = array(), $order_by = 'id', $order = "ASC", $offset = 0, $limit = 0, $count = FALSE) {

        $c = ($count == FALSE) ? 'result' : 'num_rows';

        if (is_array($where) && count($where)) {
            $this->db->where($where);
        }

        if ($select != '*' && !empty($select)) {
            $this->db->select($select);
        }

        $this->db
                ->order_by($order_by, $order);
        $this->db
                ->offset($offset);

        if (!$count) {
            if ($limit) {
                $this->db->limit($limit);
            }
        }


        return $this->db->get('access')->{$c}();
    }

    public function resetPermissions($data) {
        if (!is_array($data) || !count($data)) {
            return false;
        }

        $this->db->delete('access', array('system' => 0));

        foreach ($data as $controller => $methods) {
            if (!empty($methods)) {
                foreach ($methods as $method => $roles) {
                    if (!empty($roles)) {
                        foreach ($roles as $access_id => $value) {
                            $this->db->insert('access', array(
                                'access_id' => $access_id,
                                'controller' => $controller,
                                'method' => $method,
                            ));
                        }
                    } else {
                        return FALSE;
                    }
                }
            } else {
                return FALSE;
            }
        }
        return TRUE;
    }

}

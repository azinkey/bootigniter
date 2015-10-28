<?php

/**
 * Bootigniter
 *
 * An Open Source CMS Boilerplate for PHP 5.1.6 or newer
 *
 * @package		Bootigniter
 * @author		AZinkey
 * @copyright   Copyright (c) 2015, AZinkey LLC.
 * @license		http://bootigniter.org/license
 * @link		http://bootigniter.org
 * @Version		Version 1.0
 */
// ------------------------------------------------------------------------

/**
 * Contents Controller
 *
 * @package		Admin
 * @subpackage  Controllers
 * @author		AZinkey
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users extends CI_Controller {

    public function __construct() {

        parent::__construct();
        // Check User Priviligies and Permissions
        user::redirectUnauthorizedAccess();
        // Load Form Helper
        AZ::helper('form');
    }

    /**
     * Index Page for this controller or List all Users.
     *
     * Primary View is views/admin/blocks/users/index
     * @param	integer $q User Group ID
     * @param	integer $offset
     */
    public function index($q = 4, $offset = 0) {

        $limit = AZ::setting('record_per_page');
        $total_users = $this->user->getUsers('*', array('gid' => $q), 0, 0, true);
        $pagination = AZ::pagination('admin/users/index/' . $q, 5, $limit, $total_users);

        $users = $this->user->getUsers('id,gid,username,name,email,status,last_login,user_profiles.avatar,user_profiles.country', array('gid' => $q), $offset, $limit);


        AZ::layout('left-content', array(
            'block' => 'users/index',
            'group_A' => user_groups_A(),
            'users' => $users,
            'total_users' => $total_users,
            'pagination' => $pagination,
            'q' => $q,
        ));
    }

    /**
     * Add New or Edit User page for this controller
     *
     * Primary View is views/admin/blocks/users/form
     * @param	integer $edit
     */
    public function edit($id = -1) {

        $user = $this->user->getUserById($id);

        AZ::layout('left-content', array(
            'block' => 'users/form',
            'user' => $user,
        ));
    }

    /**
     * Save User and his profile
     *
     * @return	Redirect
     */
    public function save() {

        $post = $this->input->post();
        
        if (!$post) {
            AZ::redirectError('admin/users', lang('Restricted'));
            return false;
        }

        extract($post);
        $id = (isset($id)) ? $id : -1;

        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', lang('Name'), 'trim|required');
        $this->form_validation->set_rules('pincode', lang('Pincode'), 'trim|min_length[4]|integer');

        if ($id == -1) {
            $this->form_validation->set_rules('username', lang('Username'), 'trim|required|min_length[5]|max_length[16]|is_unique[users.username]');
            $this->form_validation->set_rules('email', lang('Email'), 'trim|valid_email|required|is_unique[users.email]');
            $this->form_validation->set_rules('password', lang('Password'), 'trim|required|min_length[6]|max_length[16]');
            $this->form_validation->set_rules('cpassword', lang('Confirm Password'), 'trim|required|min_length[6]|max_length[16]|matches[password]');
        } else {
            $this->form_validation->set_rules('username', lang('Username'), 'trim|required|min_length[5]|max_length[16]');
            $this->form_validation->set_rules('email', lang('Email'), 'trim|valid_email|required');

            if (!empty($password)) {
                $this->form_validation->set_rules('password', lang('Password'), 'trim|required|min_length[6]|max_length[16]');
                $this->form_validation->set_rules('cpassword', lang('Confirm Password'), 'trim|required|min_length[6]|max_length[16]|matches[password]');
            }
        }

        if (!$this->form_validation->run()) {
            AZ::redirectError('admin/users/edit/' . $id, validation_errors());
        }

        if (isset($_FILES['avatar']['error']) && $_FILES['avatar']['error'] == 0) {
            $avatarData = $this->user->uploadUserAvatar();

            if (isset($avatarData['error']) && (int) $avatarData['error']) {
                AZ::redirectError('admin/users/edit/' . $id, $avatarData['error_string']);
            }
            if (isset($avatarData['avatar']) && !empty($avatarData['avatar'])) {
                $post['avatar'] = $avatarData['avatar'];
            }
        }
        if (!$this->user->saveUser($post)) {
            AZ::redirectError('admin/users/index/' . $gid, lang('Error occured'));
        } else {
            AZ::redirectSuccess('admin/users/index/' . $gid, lang('Saved'));
        }
    }

    /**
     * Remove User and Redirect Back to Users
     *
     * @param	integer $id
     * @param	integer $gid
     * @return	redirect
     */
    public function remove($id, $gid) {
        if ($this->db->delete('users', array('id' => (int) $id))) {
            AZ::redirectSuccess('admin/users/index/' . $gid, lang('Removed'));
        } else {
            AZ::redirectError('admin/users/index/' . $gid, lang('Error occured'));
        }
    }

    /**
     * Accesses Page for this controller.
     *
     * Primary View is views/admin/blocks/users/accesses
     */
    public function accesses() {

        $accesses = $this->user->getAccesses();

        AZ::layout('left-content', array(
            'block' => 'users/accesses',
            'accesses' => $accesses
        ));
    }

    /**
     * Add New or Edit Access page for this controller
     *
     * Primary View is views/admin/blocks/users/accesses-form
     * @param	integer $edit
     */
    public function edit_access($edit = -1) {

        $access = $this->user->getAccessById($edit);

        AZ::layout('block-only', array(
            'block' => 'users/accesses-form',
            'access' => $access
        ));
    }

    /**
     * Save Access
     *
     * @return	Redirect
     */
    public function save_access() {

        $post = $this->input->post();

        $this->load->library('form_validation');

        $this->form_validation->set_rules('name', lang('Name'), 'trim|required');

        if (!$this->form_validation->run()) {

            AZ::redirectError('admin/users/accesses', validation_errors());
        }
        if (!$this->user->saveAccess($post)) {

            AZ::redirectError('admin/users/accesses', lang('Error occured'));
        } else {

            AZ::redirectSuccess('admin/users/accesses', lang('Saved'));
        }
    }

    /**
     * Remove Access and Redirect Back to Accesses
     *
     * @param	integer $id
     * @return	redirect
     */
    public function remove_access($id) {

        if ($this->db->delete('user_access', array('id' => (int) $id))) {
            AZ::redirectSuccess('admin/users/accesses', lang('Removed'));
        } else {
            AZ::redirectError('admin/users/accesses', lang('Error occured'));
        }
    }

    /**
     * User Groups Page for this controller.
     *
     * Primary View is views/admin/blocks/users/groups
     */
    public function groups() {

        $groups = $this->user->getUserGroups('user_access.name as role,user_groups.*', array('user_groups.id >' => 0));

        AZ::layout('left-content', array(
            'block' => 'users/groups',
            'groups' => $groups
        ));
    }

    /**
     * Add New or Edit User Group page for this controller
     *
     * Primary View is views/admin/blocks/users/group-form
     * @param	integer $edit
     */
    public function edit_group($edit = -1) {

        $group = $this->user->getUserGroupById($edit);

        AZ::layout('left-content', array(
            'block' => 'users/group-form',
            'group' => $group
        ));
    }

    /**
     * Save User Group
     *
     * @return	Redirect
     */
    public function save_group() {

        $post = $this->input->post();
        $this->load->library('form_validation');

        $this->form_validation->set_rules('name', lang('Name'), 'trim|required');
        $this->form_validation->set_rules('access', lang('Access Role'), 'trim|required');

        if (!$this->form_validation->run()) {

            AZ::redirectError('admin/users/groups', validation_errors());
        }
        if (!$this->user->saveGroup($post)) {
            AZ::redirectError('admin/users/groups', lang('Error occured'));
        } else {
            AZ::redirectSuccess('admin/users/groups', lang('Saved'));
        }
    }

    /**
     * Remove User Group and Redirect Back to Groups
     *
     * @param	integer $id
     * @return	redirect
     */
    public function remove_group($id) {

        if ($this->db->delete('user_groups', array('id' => (int) $id))) {
            AZ::redirectSuccess('admin/users/groups', lang('Removed'));
        } else {
            AZ::redirectError('admin/users/groups', lang('Error occured'));
        }
    }

    /**
     * Show All Private methods for Access Role Permissions
     *
     */
    public function permissions() {

        if (user::access_id() != 1) {
            AZ::redirectError('admin/dashboard', lang('Unauthorized Access'));
        }
        $roles = $this->user->getAccesses('id,name', array('id >' => 1));
        $rows = $this->user->getPermissions('*', array('access_id' => 1));
        
        $tasks = array();

        if ($rows && count($rows)) {
            foreach ($rows as $row) {
                $tasks[$row->controller][] = $row->method;
            }
        }

        AZ::layout('left-content', array(
            'block' => 'users/permissions',
            'roles' => $roles,
            'tasks' => $tasks,
        ));
    }

    /**
     * Update Permissions
     *
     * @return	Redirect
     */
    public function permissions_reset() {
        
        if (user::access_id() != 1) {
            AZ::redirectError('admin/dashboard', lang('Unauthorized Access'));
        }

        $post = $this->input->post();
        
        if (empty($post)) {
            AZ::redirectError('admin/users/permissions', lang('no_option'));
            return FALSE;
        }
        if (!$this->user->resetPermissions($post)) {
            AZ::redirectError('admin/users/permissions', lang('Error occured'));
        } else {
            AZ::redirectSuccess('admin/users/permissions', lang('Saved'));
        }
    }

}

/* End of file users.php */
/* Location: ./app/controllers/admin/users.php */

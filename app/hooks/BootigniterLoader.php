<?php

class BootLoader {

    public function initialize() {

        $ci = & get_instance();

        if (empty($ci->db->hostname) || empty($ci->db->database) || empty($ci->db->username)) {

            show_error('Missing Database Configurations, Configured your <strong>config/database.php</strong>, <br />Please Set your database details and come back here & Refresh for Instant Boot Setup.', 500, "Setup Database Configuration");
        }
        
        if (!$ci->db->table_exists('access') ||
                !$ci->db->table_exists('users') ||
                !$ci->db->table_exists('languages') ||
                !$ci->db->table_exists('contents')) {
            if ($this->_install_dump()) {
                $ci->setting->setSetting('site_url', site_url());
                AZ::flashMSG('Your First Credential for login is <strong>admin/123456</strong>');
                AZ::redirectSuccess('administrator', 'BootIgniter Setup Successfully');
            }
        } else {
            return true;
        }
    }

    private function _setAdminUser() {

        $ci = & get_instance();

        AZ::model('user');

        $user = array(
            'name' => 'AZinkey',
            'username' => 'admin',
            'email' => 'azinkey@gmail.com',
            'password' => $ci->user->hash_password('123456'),
            'status' => 1,
            'gid' => 1
        );
        $ci->db->insert('users', $user);

        if (!$ci->db->insert_id()) {
            return FALSE;
        }

        $adminProfile = array(
            'user_id' => $ci->db->insert_id(),
            'avatar' => 'media/users/zz.jpg',
            'address' => 'Roop Mahal, Prem gali, Kholi no. 420',
            'city' => 'Excuse Me',
            'state' => 'Please',
            'country' => 'India',
            'phone' => '9876543210',
        );
        return $ci->db->insert('user_profiles', $adminProfile);
    }

    private function _install_dump() {

        $file = APPPATH . 'database/setup/install.sql';

        if (!file_exists($file)) {
            exit('Could not load sql file: ' . $file);
        }
        $ci = & get_instance();
        $queries = file_get_contents($file);
        $lines = explode(";", $queries);
        foreach ($lines as $query) {
            $query = trim($query);
            if (!empty($query)) {
                $ci->db->query("SET FOREIGN_KEY_CHECKS = 0");
                $query = str_replace("%PREFIX%", $ci->db->dbprefix, $query);
                if (!$ci->db->query($query)) {
                    show_error($query, 500, "SQL query Error");
                }
                $ci->db->query("SET FOREIGN_KEY_CHECKS = 1");
            }
        }

        return $this->_setAdminUser();
    }

}

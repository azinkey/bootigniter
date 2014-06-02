<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Administrator extends CI_Controller {

    public function __construct() {

        parent::__construct();
    }

    public function index() {

        if (user::id()) {
            AZ::redirect('admin/dashboard');
        }

        AZ::helper('form');
        AZ::layout('login', array('block' => 'login'));
    }

    public function login() {

        if (user::id()) {
            AZ::redirect('admin/dashboard');
        }

        $post = $this->input->post();

        if ($this->_validate() == FALSE) {
            $this->index();
            return false;
        }
        $user_id = $this->user->authenicate($post['username'], $post['password']);
        
        if ($user_id) {
            if (have_permission('dashboard/index')) {
                AZ::redirect('admin/dashboard');
            } else {
                user::flush();
                AZ::redirectError('administrator', __('Unauthorized Access', true));
            }
        } else {
            AZ::redirectError('administrator', 'Invalid');
        }
    }

    public function logout() {

        user::flush();

        AZ::redirectSuccess('administrator');
    }

    private function _validate() {

        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        return $this->form_validation->run();
    }

}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */
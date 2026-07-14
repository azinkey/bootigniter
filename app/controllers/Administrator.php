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
 * @package		Administrator
 * @subpackage  Controllers
 * @author		AZinkey
 */
defined('APPPATH') || exit('No direct script access allowed');

class Administrator extends BaseController {

    public function __construct() {

        parent::__construct();
    }

    /**
     * Index Page for this controller or Showing Login Box to enter Admin Area
     *
     * Primary View is views/admin/blocks/login
     * 
     */
    public function index() {

        if (user::id()) {
            AZ::redirect('admin/dashboard');
        }

        AZ::helper('form');
        AZ::layout('login', array('block' => 'login'));
    }

    /**
     * Match User details and Logged in Application
     * 
     * @return	Redirect
     */
    public function login() {

        if (user::id()) {
            AZ::redirect('admin/dashboard');
        }

        $post = $this->request->getPost();

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

    /**
     * Flush user session & logged out from application
     * 
     * @return	Redirect
     */
    public function logout() {

        user::flush();

        AZ::redirectSuccess('administrator');
    }

    /**
     * Verify User Credential
     * 
     * @return	boolen
     */
    private function _validate() {

        $this->validation = \Config\Services::validation();
        $this->validation->setRules(['username', 'Username', 'required');
        $this->validation->setRules(['password', 'Password', 'required');

        return $this->validation->run();
    }

}

/* End of file admin.php */
/* Location: ./app/controllers/admin.php */
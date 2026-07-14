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
 * @package		Front
 * @subpackage  Controllers
 * @author		AZinkey
 */
defined('APPPATH') || exit('No direct script access allowed');

class Account extends BaseController {

    public function __construct() {
        parent::__construct();

        // Load Form Helper
        AZ::helper('form');
    }

    /**
     * Index Page for this controller or take user to dashboard if he logged in
     *
     * Primary View is views/front/blocks/account/index
     * 
     */
    public function index() {

        if (user::id()) {
            AZ::layout('left-content', array('block' => 'account/dashboard'));
        } else {
            AZ::layout('left-content', array('block' => 'account/index'));
        }
    }

    /**
     * Edit User Profile Page for this controller
     *
     * Primary View is views/front/blocks/account/profile-form
     * 
     * @param	integer $id     
     */
    public function edit($id) {

        $user = $this->user->getUserById($id);

        AZ::layout('left-content', array(
            'block' => 'account/profile-form',
            'user' => $user,
        ));
    }

    /**
     * Showing User Login Modal Pop up box
     *
     * Primary View is views/front/blocks/account/login-box
     * 
     */
    public function login_box() {
        AZ::layout('block-only', array('block' => 'account/login-box'));
    }

    /**
     * Showing User Registration Modal Pop up box
     *
     * Primary View is views/front/blocks/account/register-box
     * 
     * @return	Layout
     */
    public function register_box() {
        AZ::layout('block-only', array('block' => 'account/register-box'));
    }

    /**
     * Showing Change Password Modal Pop up
     *
     * Primary View is views/front/blocks/account/password-box
     * 
     */
    public function change_password_box() {
        AZ::layout('block-only', array('block' => 'account/password-box'));
    }

    /**
     * Match User details and Logged in Application if verify
     * 
     * @return	Redirect
     */
    public function authenicate() {

        if (user::id()) {
            AZ::redirect('account');
        }

        $post = $this->request->getPost();

        if ($this->_validateLogin() == FALSE) {
            $this->index();
            return false;
        }

        if ($this->user->authenicate($post['username'], $post['password'])) {
            AZ::redirect('account');
        } else {
            AZ::redirectError('account', 'Invalid');
        }
    }

    /**
     * Register User (Save User)
     * 
     * @return	Redirect
     */
    public function register() {
        $post = $this->request->getPost();

        if ($this->_validateRegister() == FALSE) {
            AZ::redirectError('account', validation_errors());
            return false;
        }
        $user = array(
            'username' => $post['username'],
            'password' => $this->user->hash_password($post['password']),
            'email' => $post['email'],
            'name' => key_label($post['username']),
            'status' => 1,
            'gid' => 4,
            'registerd' => date("Y-m-d H:i:s")
        );

        if ($this->db->insert('users', $user)) {

            $this->user->authenicate($post['username'], $post['password']);

            AZ::redirectSuccess('account', __('Register Thanks', true));
        } else {
            AZ::redirectError('account', __('Error occured', true));
        }
    }

    /**
     * Update User Account or Profile
     * 
     * @return	Redirect
     */
    public function update() {
        $post = $this->request->getPost();

        if (!count($post)) {
            AZ::redirectError('account', __('Unauthorized Access', true));
        }

        if (isset($post['old_password']) && $this->user->match_password($post['id'], $post['old_password'])) {

            if ($this->_validateUpdate() == FALSE) {
                AZ::redirectError('account', validation_errors());
                return false;
            }

            $this->db->where('id', $post['id']);
            if ($this->db->update('users', array('password' => $this->user->hash_password($post['password'])))) {
                AZ::redirectSuccess('account', __('Password Changed', true));
                return TRUE;
            } else {
                AZ::redirectError('account', __('Error occured', true));
                return FALSE;
            }
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
        if (!$this->user->updateUserProfile($post)) {
            AZ::redirectError('account', __('Error occured', true));
        } else {
            AZ::redirectSuccess('account', __('Saved', true));
        }
    }

    /**
     * Flush user session & logged out from application
     * 
     * @return	Redirect
     */
    public function logout() {

        user::flush();
        AZ::redirectSuccess('account');
    }

    /**
     * Verify User Login
     * 
     * @return	boolen
     */
    private function _validateLogin() {

        $this->validation = \Config\Services::validation();
        $this->validation->setRules(['username', 'Username', 'required');
        $this->validation->setRules(['password', 'Password', 'required');

        return $this->validation->run();
    }

    /**
     * Verify User Registration
     * 
     * @return	boolen
     */
    private function _validateRegister() {

        $this->validation = \Config\Services::validation();
        $this->validation->setRules(['username', lang('Username'), 'trim|required|min_length[5]|max_length[16]|is_unique[users.username]');
        $this->validation->setRules(['email', lang('Email'), 'trim|valid_email|required|is_unique[users.email]');
        $this->validation->setRules(['password', lang('Password'), 'trim|required|min_length[6]|max_length[16]');
        $this->validation->setRules(['confirm_password', lang('Confirm Password'), 'trim|required|min_length[6]|max_length[16]|matches[password]');

        return $this->validation->run();
    }

    /**
     * Verify User Update
     * 
     * @return	boolen
     */
    private function _validateUpdate() {

        $this->validation = \Config\Services::validation();
        $this->validation->setRules(['password', lang('Password'), 'trim|required|min_length[6]|max_length[16]');
        $this->validation->setRules(['confirm_password', lang('Confirm Password'), 'trim|required|min_length[6]|max_length[16]|matches[password]');

        return $this->validation->run();
    }
}

/* End of file account.php */
/* Location: ./app/controllers/account.php */
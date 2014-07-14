<?php

/**
 * Bootigniter
 *
 * An Open Source CMS Boilerplate for PHP 5.1.6 or newer
 *
 * @package		Bootigniter
 * @author		AZinkey
 * @copyright           Copyright (c) 2014, AZinkey.
 * @license		http://bootigniter.org/license
 * @link		http://bootigniter.org
 * @Version		Version 1.0
 */
// ------------------------------------------------------------------------

/**
 * Contents Controller
 *
 * @package		Admin
 * @subpackage          Controllers
 * @author		AZinkey
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Settings extends CI_Controller {

    public function __construct() {

        parent::__construct();
        // Check User Priviligies and Permissions
        user::redirectUnauthorizedAccess();
        // Load Form Helper
        AZ::helper('form');
    }

    /**
     * Index Page for this controller or List Settings.
     *
     * Primary View is views/admin/blocks/settings/index
     * 
     * @param	integer $q Section ID
     * @return	Layout
     */
    public function index($q = 1) {

        $section = $this->setting->getSectionById($q);

        $section_A = $this->setting->getSection_A();
        $group_A = $this->setting->getGroup_A($q);
        
        AZ::layout('left-content', array(
            'block' => 'settings/index',
            'active_section' => $section,
            'section_A' => $section_A,
            'group_A' => $group_A,
            'q' => $q,
            'styles' => 'css/jquery-ui.min.css',
            'scripts' => 'scripts/jquery-ui-1.10.4.custom.min.js',
        ));
    }

    /**
     * Update Settings
     *
     * @return	Redirect
     */
    public function save() {

        $post = $this->input->post();

        if (!$this->setting->saveSettings($post)) {

            AZ::redirectError('admin/settings', lang('Error occured'));
        } else {

            AZ::redirectSuccess('admin/settings', lang('Settings updated'));
        }
    }

    /**
     * Add New or Edit Setting Group
     *
     * Primary View is views/admin/blocks/settings/group-form
     * 
     * @param	integer $group_id
     * @return	Layout
     */
    public function edit_group($group_id = -1) {

        $section_A = $this->setting->getSection_A();
        $group = $this->setting->getGroupById($group_id);

        AZ::layout('left-content', array(
            'block' => 'settings/group-form',
            'section_A' => $section_A,
            'group' => $group,
        ));
    }

    /**
     * Add New or Edit Setting Section (Tab)
     *
     * Primary View is views/admin/blocks/settings/section-form
     * 
     * @param	integer $section_id
     * @return	Layout
     */
    public function edit_section($section_id = -1) {

        $section = $this->setting->getSectionById($section_id);

        AZ::layout('left-content', array(
            'block' => 'settings/section-form',
            'section' => $section
        ));
    }

    /**
     * Save Section
     *
     * @return	Redirect
     */
    public function save_section() {

        $post = $this->input->post();


        $this->load->library('form_validation');

        $this->form_validation->set_rules('title', lang('Title'), 'trim|required');

        if (!$this->form_validation->run()) {

            AZ::redirectError('admin/settings', validation_errors());
        }


        if (!$this->setting->saveSection($post)) {

            AZ::redirectError('admin/settings', lang('Error occured'));
        } else {

            AZ::redirectSuccess('admin/settings', lang('Saved'));
        }
    }

    /**
     * Save Group
     *
     * @return	Redirect
     */
    public function save_group() {

        $post = $this->input->post();


        $this->load->library('form_validation');

        $this->form_validation->set_rules('title', lang('Title'), 'trim|required');

        if (!$this->form_validation->run()) {

            AZ::redirectError('admin/settings', validation_errors());
        }


        if (!$this->setting->saveGroup($post)) {

            AZ::redirectError('admin/settings', lang('Error occured'));
        } else {

            AZ::redirectSuccess('admin/settings', lang('Saved'));
        }
    }

    /**
     * Remove Section
     *
     * @param	integer $section_id
     * @return	redirect
     */
    public function remove_section($section_id) {

        if ($this->db->delete('setting_sections', array('id' => (int) $section_id))) {

            AZ::redirectSuccess('admin/settings', lang('Removed'));
        } else {
            AZ::redirectError('admin/settings', lang('Error occured'));
        }
    }

    /**
     * Remove Group
     *
     * @param	integer $section_id
     * @return	redirect
     */
    public function remove_group($group_id) {

        if ($this->db->delete('setting_groups', array('id' => (int) $group_id))) {

            AZ::redirectSuccess('admin/settings', lang('Removed'));
        } else {
            AZ::redirectError('admin/settings', lang('Error occured'));
        }
    }

    /**
     * Add New or Edit Setting
     *
     * @param	integer $setting_id
     * @return	redirect
     */
    public function edit_setting($setting_id = -1) {

        $group_A = $this->setting->getGroup_A();

        $setting = $this->setting->getSettingById($setting_id);

        AZ::layout('left-content', array(
            'block' => 'settings/field-form',
            'group_A' => $group_A,
            'setting' => $setting,
            'styles' => 'css/jquery-ui.min.css',
            'scripts' => 'scripts/jquery-ui-1.10.4.custom.min.js',
        ));
    }

    /**
     * Save Setting
     *
     * @return	redirect
     */
    public function save_setting() {

        $post = $this->input->post();

        $this->load->library('form_validation');
        if (isset($post['id']) && !empty($post['id'])) {
            $this->form_validation->set_rules('key', lang('Key Setting'), 'trim|required');
        } else {
            $this->form_validation->set_rules('key', lang('Key Setting'), 'trim|required|is_unique[settings.key]');
        }

        $this->form_validation->set_rules('value', lang('Value Setting'), 'trim|required');

        if (!$this->form_validation->run()) {

            AZ::redirectError('admin/settings', validation_errors());
        }


        if (!$this->setting->saveSetting($post)) {

            AZ::redirectError('admin/settings', lang('Error occured'));
        } else {

            AZ::redirectSuccess('admin/settings', lang('Saved'));
        }
    }

    /**
     * Remove Setting
     *
     * @param	integer $setting_id
     * @return	redirect
     */
    public function remove_setting($setting_id) {

        if ($this->db->delete('settings', array('id' => (int) $setting_id))) {

            AZ::redirectSuccess('admin/settings', lang('Removed'));
        } else {
            AZ::redirectError('admin/settings', lang('Error occured'));
        }
    }

    /**
     * Render Field option on select field type in Add Setting form
     *
     * @param	string $type
     * @param	integer $field_id
     * @param	boolen $setting
     * @return	string
     */
    public function field_type_options($type = 'text', $field_id = "", $setting = true) {
        echo field_options($type, $field_id, $setting);
    }

}

/* End of file settings.php */
/* Location: ./app/controllers/admin/settings.php */
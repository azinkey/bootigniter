<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Settings extends CI_Controller {

    public function __construct() {

        parent::__construct();

        user::redirectUnauthorizedAccess();

        AZ::helper('form');
    }

    public function index($q = 1) {

        $section = $this->setting->getSectionById($q);
        
        $section_A = $this->setting->getSection_A();
        $group_A = $this->setting->getGroup_A();
        
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

    public function save() {

        $post = $this->input->post();

        if (!$this->setting->saveSettings($post)) {

            AZ::redirectError('admin/settings', lang('Error occured'));
        } else {

            AZ::redirectSuccess('admin/settings', lang('Settings updated'));
        }
    }

    public function edit_group($group_id = -1) {

        $section_A = $this->setting->getSection_A();
        $group = $this->setting->getGroupById($group_id);

        AZ::layout('block-only', array(
            'block' => 'settings/group-form',
            'section_A' => $section_A,
            'group' => $group,
        ));
    }

    public function edit_section($section_id = -1) {

        $section = $this->setting->getSectionById($section_id);

        AZ::layout('block-only', array(
            'block' => 'settings/section-form',
            'section' => $section
        ));
    }

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

    public function remove_section($section_id) {

        if ($this->db->delete('setting_sections', array('id' => (int) $section_id))) {

            AZ::redirectSuccess('admin/settings', lang('Removed'));
        } else {
            AZ::redirectError('admin/settings', lang('Error occured'));
        }
    }

    public function remove_group($group_id) {

        if ($this->db->delete('setting_groups', array('id' => (int) $group_id))) {

            AZ::redirectSuccess('admin/settings', lang('Removed'));
        } else {
            AZ::redirectError('admin/settings', lang('Error occured'));
        }
    }

    public function edit_setting($setting_id = -1) {

        $group_A = $this->setting->getGroup_A();

        $setting = $this->setting->getSettingById($setting_id);

        AZ::layout('block-only', array(
            'block' => 'settings/field-form',
            'group_A' => $group_A,
            'setting' => $setting,
            'styles' => 'css/jquery-ui.min.css',
            'scripts' => 'scripts/jquery-ui-1.10.4.custom.min.js',
        ));
    }

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

    public function remove_setting($setting_id) {

        if ($this->db->delete('settings', array('id' => (int) $setting_id))) {

            AZ::redirectSuccess('admin/settings', lang('Removed'));
        } else {
            AZ::redirectError('admin/settings', lang('Error occured'));
        }
    }

    public function field_type_options($type = 'text', $field_id = "", $setting = true) {
        echo field_options($type, $field_id, $setting);
    }

}

/* End of file settings.php */
/* Location: ./app/controllers/admin/settings.php */
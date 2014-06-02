<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Contents extends CI_Controller {

    public function __construct() {

        parent::__construct();

        user::redirectUnauthorizedAccess();

        AZ::helper('form');
        AZ::helper('content');
        AZ::model('content');
    }

    public function index($type = 'pages', $offset = 0) {

        $limit = AZ::setting('record_per_page');
        $total_records = $this->content->getContents($type, 0, 0, true);

        $pagination = AZ::pagination('admin/contents/index/' . $type, 5, $limit, $total_records);
        $contents = $this->content->getContents($type, $offset, $limit);
        $contentType = $this->content->getTypeByAlias($type);
        $admin_list_fields = $this->content->getFieldsArrayByTypeId($contentType->id, 1);

        AZ::layout('left-content', array(
            'block' => 'contents/index',
            'contentType' => $contentType,
            'contents' => $contents,
            'pagination' => $pagination,
            'admin_list_fields' => $admin_list_fields,
        ));
    }

    public function edit($type, $content_id = -1) {

        AZ::helper('content');

        $content = $this->content->getContentById($content_id);

        $contentType = $this->content->getTypeByAlias($type);
        $fieldsets = $this->content->getFieldGroups($contentType->id);
        $groups = $this->content->groups_A($contentType->id);

        $languages = $this->content->getLanguages('id,name,code,is_default,is_admin', array('status' => 1));

        AZ::layout('left-content', array(
            'block' => 'contents/form',
            'type' => $type,
            'content_id' => $content_id,
            'contentType' => $contentType,
            'content' => $content,
            'fieldsets' => $fieldsets,
            'languages' => $languages,
            'groups' => $groups,
            'scripts' => array(
                'scripts/ckeditor/ckeditor.js',
                //'scripts/ckeditor/adapters/jquery.js', // jQuery interface for cKeditor. if Required
            )
        ));
    }

    public function save() {
        $post = $this->input->post();

        if (!$post || !count($post) || !isset($post['type'])) {
            return false;
        }
       
        $verify = $this->_validation($post['type_id']);
      
        if (!$verify) {
            AZ::redirectError('admin/contents/edit/' . $post['type'] . '/' . $post['id'], validation_errors());
            return false;
        }

        if (!$this->content->saveContent($post)) {
            AZ::redirectError('admin/contents/index/' . $post['type'], lang('Error occured'));
        } else {
            AZ::redirectSuccess('admin/contents/index/' . $post['type'], lang('Saved'));
        }
    }

    public function remove($type, $id) {

        if ($this->db->delete('contents', array('id' => (int) $id))) {
            $this->db->delete('content_field_values', array('content_id' => (int) $id));
            AZ::redirectSuccess('admin/contents/index/' . $type, lang('Removed'));
        } else {
            AZ::redirectError('admin/contents/index/' . $type, lang('Error occured'));
        }
    }

    public function languages() {
        $languages = $this->content->getLanguages();

        AZ::layout('left-content', array(
            'block' => 'contents/languages',
            'languages' => $languages
        ));
    }

    public function edit_language($edit = -1) {

        $language = $this->content->getLanguageById($edit);

        AZ::layout('block-only', array(
            'block' => 'contents/language-form',
            'language' => $language
        ));
    }

    public function save_language() {

        $post = $this->input->post();

        $this->load->library('form_validation');

        $this->form_validation->set_rules('name', lang('Name'), 'trim|required');
        $this->form_validation->set_rules('code', lang('Code'), 'trim|required');
        $this->form_validation->set_rules('directory', lang('Directory'), 'trim|required');

        if (!$this->form_validation->run()) {

            AZ::redirectError('admin/contents/languages', validation_errors());
        }
        if (!$this->content->saveLanguage($post)) {
            AZ::redirectError('admin/contents/languages', lang('Error occured'));
        } else {

            AZ::redirectSuccess('admin/contents/languages', lang('Saved'));
        }
    }

    public function remove_language($id) {

        if ($this->db->delete('languages', array('id' => (int) $id))) {
            AZ::redirectSuccess('admin/contents/languages', lang('Removed'));
        } else {
            AZ::redirectError('admin/contents/languages', lang('Error occured'));
        }
    }

    public function types($offset = 0) {

        $limit = AZ::setting('record_per_page');
        $total_types = $this->content->getTypes('*', array(), 0, 0, true);
        $pagination = AZ::pagination('admin/contents/types/', 4, $limit, $total_types);
        $types = $this->content->getTypes('id,name,description,enabled,system', array(), $offset, $limit);

        AZ::layout('left-content', array(
            'block' => 'contents/types',
            'total_types' => $total_types,
            'pagination' => $pagination,
            'types' => $types
        ));
    }

    public function edit_type($edit = -1) {

        $type = $this->content->getTypeById($edit);
        if (isset($type->fieldsets)) {
            $type->fieldsets = $this->content->getFieldsetsByTypeId($edit);
        }
        AZ::layout('block-only', array(
            'block' => 'contents/type-form',
            'type' => $type
        ));
    }

    public function save_type() {

        $post = $this->input->post();

        $this->load->library('form_validation');
        if (isset($post['id']) && $post['id'] > 0) {
            $this->form_validation->set_rules('name', lang('Name'), 'trim|required');
        } else {
            $this->form_validation->set_rules('name', lang('Name'), 'trim|required|is_unique[content_types.name]');
        }


        if (!$this->form_validation->run()) {
            AZ::redirectError('admin/contents/types', validation_errors());
        }
        if (!$this->content->saveType($post)) {
            AZ::redirectError('admin/contents/types', lang('Error occured'));
        } else {
            AZ::redirectSuccess('admin/contents/types', lang('Saved'));
        }
    }

    public function remove_type($id) {

        if ($this->db->delete('content_types', array('id' => (int) $id))) {
            AZ::redirectSuccess('admin/contents/types', lang('Removed'));
        } else {
            AZ::redirectError('admin/contents/types', lang('Error occured'));
        }
    }

    public function groups($q = 1, $offset = 0) {

        $types_A = $this->content->types_A(true);
        $limit = AZ::setting('record_per_page');
        $total_groups = $this->content->getGroups('*', array('type' => $q), 0, 0, true);
        $pagination = AZ::pagination('admin/contents/groups/', 4, $limit, $total_groups);
        $groups = $this->content->getGroups('id,name,description,enabled,system', array('type' => $q), $offset, $limit);

        AZ::layout('left-content', array(
            'block' => 'contents/groups',
            'total_groups' => $total_groups,
            'pagination' => $pagination,
            'groups' => $groups,
            'types_A' => $types_A,
            'q' => $q,
        ));
    }

    public function edit_group($edit = -1, $type = 1) {

        $group = $this->content->getGroupById($edit);

        $parentsOption = $this->content->getGroupsOptionTree($type, 0,(isset($group->parent)) ? $group->parent : 0);

        AZ::layout('block-only', array(
            'block' => 'contents/group-form',
            'parentsOption' => $parentsOption,
            'group' => $group,
            'type' => $type
        ));
    }

    public function save_group() {

        $post = $this->input->post();
        if (!count($post)) {
            return FALSE;
        }

        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', lang('Name'), 'trim|required');

        if (!$this->form_validation->run()) {
            AZ::redirectError('admin/contents/groups/' . $post['type'], validation_errors());
        }
        if (!$this->content->saveGroup($post)) {
            AZ::redirectError('admin/contents/groups/' . $post['type'], lang('Error occured'));
        } else {
            AZ::redirectSuccess('admin/contents/groups/' . $post['type'], lang('Saved'));
        }
    }

    public function remove_group($id, $type = 1) {

        if ($this->db->delete('content_groups', array('id' => (int) $id))) {
            AZ::redirectSuccess('admin/contents/groups/' . $type, lang('Removed'));
        } else {
            AZ::redirectError('admin/contents/groups/' . $type, lang('Error occured'));
        }
    }

    public function fieldsets() {
        $fieldsets = $this->content->getFieldSets();
        AZ::layout('left-content', array(
            'block' => 'contents/fieldset',
            'fieldsets' => $fieldsets
        ));
    }

    public function edit_fieldset($edit = -1) {

        $fieldset = $this->content->getFieldsetById($edit);

        AZ::layout('block-only', array(
            'block' => 'contents/fieldset-form',
            'fieldset' => $fieldset
        ));
    }

    public function save_fieldset() {

        $post = $this->input->post();

        $this->load->library('form_validation');

        $this->form_validation->set_rules('name', lang('Name'), 'trim|required');

        if (!$this->form_validation->run()) {
            AZ::redirectError('admin/contents/fieldsets', validation_errors());
        }
        if (!$this->content->saveFieldset($post)) {
            AZ::redirectError('admin/contents/fieldsets', lang('Error occured'));
        } else {

            AZ::redirectSuccess('admin/contents/fieldsets', lang('Saved'));
        }
    }

    public function remove_fieldset($id) {

        if ($this->db->delete('content_field_groups', array('id' => (int) $id))) {
            AZ::redirectSuccess('admin/contents/fieldsets', lang('Removed'));
        } else {
            AZ::redirectError('admin/contents/fieldsets', lang('Error occured'));
        }
    }

    public function fields($q = 1, $offset = 0) {

        $fieldset_A = $this->content->fieldset_A();
        $limit = AZ::setting('record_per_page');
        $total_fields = $this->content->getFields('*', array('group_id' => $q), 0, 0, true);
        $pagination = AZ::pagination('admin/contents/fields/' . $q, 5, $limit, $total_fields);
        $fields = $this->content->getFields('id,label,type,enabled,system,in_list,in_view', array('group_id' => $q), $offset, $limit);

        AZ::layout('left-content', array(
            'block' => 'contents/fields',
            'total_fields' => $total_fields,
            'pagination' => $pagination,
            'fields' => $fields,
            'fieldset_A' => $fieldset_A,
            'q' => $q,
        ));
    }

    public function edit_field($edit = -1, $fieldset = 1) {

        $field = $this->content->getFieldById($edit);
        AZ::layout('left-content', array(
            'block' => 'contents/field-form',
            'field' => $field,
            'edit_id' => $edit,
            'fieldset' => $fieldset,
            'styles' => 'css/jquery-ui.min.css',
            'scripts' => 'scripts/jquery-ui-1.10.4.custom.min.js',
        ));
    }

    public function save_field() {

        $post = $this->input->post();
        if (!count($post)) {
            return FALSE;
        }
        if (!isset($post['id'])) {
            AZ::redirect('admin/contents/fields');
        }
        $this->load->library('form_validation');
        $this->form_validation->set_rules('label', lang('Label'), 'trim|required');

        if ($post['id'] > 0) {
            $this->form_validation->set_rules('name', lang('Name'), 'trim|required');
        } else {
            $this->form_validation->set_rules('name', lang('Name'), 'trim|required|is_unique[content_fields.name]');
        }



        if (!$this->form_validation->run()) {
            AZ::redirectError('admin/contents/edit_field/' . $post['id'] . '/' . $post['group_id'], validation_errors());
            return false;
        }
        $field = $this->content->saveField($post);
        if (!$field) {
            AZ::redirectError('admin/contents/edit_field/' . $field . '/' . $post['group_id'], lang('Error occured'));
        } else {
            AZ::redirectSuccess('admin/contents/edit_field/' . $field . '/' . $post['group_id'], lang('Saved'));
        }
    }

    public function remove_field($id, $fieldset = 1) {

        if ($this->db->delete('content_fields', array('id' => (int) $id))) {
            AZ::redirectSuccess('admin/contents/fields/' . $fieldset, lang('Removed'));
        } else {
            AZ::redirectError('admin/contents/fields/' . $fieldset, lang('Error occured'));
        }
    }

    public function field_type_options($type = 'text', $field_id = "") {
        echo field_options($type, $field_id);
    }

    private function _validation($type_id) {

        $this->load->library('form_validation');

        $fieldsObj = $this->content->getFieldsRowsByType($type_id);

        if ($fieldsObj && count($fieldsObj)) {
            foreach ($fieldsObj as $field) {
                if ($field->required) {
                    $this->form_validation->set_rules("fields[$field->id]", $field->label, 'trim|required');
                }
            }
        } else {
            return TRUE;
        }

        return $this->form_validation->run();
    }

}

/* End of file dashboard.php */
    /* Location: ./application/controllers/dashboard.php */    
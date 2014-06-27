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

class Contents extends CI_Controller {

    public function __construct() {

        parent::__construct();
        // Check User Priviligies and Permissions
        user::redirectUnauthorizedAccess();

        // Load Content Model
        AZ::model('content');
        // Load Form Helper
        AZ::helper('form');
        // Load Content Helper
        AZ::helper('content');
    }

    /**
     * Index Page for this controller or List page for all types contents.
     *
     * Primary View is views/admin/blocks/contents/index
     * @param	string $type
     * @param	integer $offset
     * @return	Layout
     */
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

    /**
     * Add New or Edit content page for this controller
     *
     * Primary View is views/admin/blocks/contents/form
     * @param	string $type
     * @param	integer $content_id
     * @return	Layout
     */
    public function edit($type, $content_id = -1) {

        AZ::helper('content');

        $content = $this->content->getContentById($content_id);

        $contentType = $this->content->getTypeByAlias($type);
        $fieldsets = $this->content->getFieldGroups($contentType->id);
        $groupRows = $this->content->getGroupsTree($contentType->id);

        $groups = array();
        if ($groupRows && count($groupRows)) {
            foreach ($groupRows as $group) {
                $groups[$group['id']] = $group['name'];
            }
        }

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
            )
        ));
    }

    /**
     * Save Page or any other content
     *
     * @return	Redirect
     */
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
            $return = (isset($post['return'])) ? $post['return'] : 'admin/contents/index/' . $post['type'];
            AZ::redirectSuccess($return, lang('Saved'));
        }
    }

    /**
     * Remove Content and Redirect Back to Contents
     *
     * @param	integer $type
     * @param	integer $id
     * @return	redirect
     */
    public function remove($type, $id) {

        if ($this->db->delete('contents', array('id' => (int) $id))) {
            $this->db->delete('content_field_values', array('content_id' => (int) $id));
            AZ::redirectSuccess('admin/contents/index/' . $type, lang('Removed'));
        } else {
            AZ::redirectError('admin/contents/index/' . $type, lang('Error occured'));
        }
    }

    /**
     * Languages Page for this controller.
     *
     * Primary View is views/admin/blocks/contents/languages
     */
    public function languages() {
        $languages = $this->content->getLanguages();

        AZ::layout('left-content', array(
            'block' => 'contents/languages',
            'languages' => $languages
        ));
    }

    /**
     * Add New or Edit Language page for this controller
     *
     * Primary View is views/admin/blocks/contents/language-form
     * @param	integer $edit
     * @return	Layout
     */
    public function edit_language($edit = -1) {

        $language = $this->content->getLanguageById($edit);

        AZ::layout('left-content', array(
            'block' => 'contents/language-form',
            'language' => $language
        ));
    }

    /**
     * Save Language
     *
     * @return	Redirect
     */
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

    /**
     * Remove Language and Redirect Back to Languages
     *
     * @param	integer $id
     * @return	redirect
     */
    public function remove_language($id) {

        if ($this->db->delete('languages', array('id' => (int) $id))) {
            AZ::redirectSuccess('admin/contents/languages', lang('Removed'));
        } else {
            AZ::redirectError('admin/contents/languages', lang('Error occured'));
        }
    }

    /**
     * Content Types Page for this controller or List all content types.
     *
     * Primary View is views/admin/blocks/contents/types
     * @param	integer $offset
     * @return	Layout
     */
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

    /**
     * Add New or Edit Content Type page for this controller
     *
     * Primary View is views/admin/blocks/contents/type-form
     * @param	integer $edit
     * @return	Layout
     */
    public function edit_type($edit = -1) {

        $type = $this->content->getTypeById($edit);

        if (count($type) && !isset($type->fieldsets)) {
            $type->fieldsets = $this->content->getFieldsetsByTypeId($edit);
        }

        AZ::layout('left-content', array(
            'block' => 'contents/type-form',
            'type' => $type,
            'edit' => $edit
        ));
    }

    /**
     * Save Content Type
     *
     * @return	Redirect
     */
    public function save_type() {

        $post = $this->input->post();

        $this->load->library('form_validation');
        if (isset($post['id']) && $post['id'] > 0) {
            $this->form_validation->set_rules('name', lang('Name'), 'trim|required');
            $this->form_validation->set_rules('fieldset[]', lang('Fieldset'), 'trim|required');
        } else {
            $this->form_validation->set_rules('fieldset[]', lang('Fieldset'), 'trim|required');
            $this->form_validation->set_rules('name', lang('Name'), 'trim|required|is_unique[content_types.name]');
        }


        if (!$this->form_validation->run()) {
            AZ::redirectError('admin/contents/edit_type/' . $post['id'], validation_errors());
        }
        if (!$this->content->saveType($post)) {
            AZ::redirectError('admin/contents/types', lang('Error occured'));
        } else {

            AZ::redirectSuccess('admin/contents/types', lang('Saved'));
        }
    }

    /**
     * Remove Type and Redirect Back to Content Types
     *
     * @param	integer $id
     * @return	redirect
     */
    public function remove_type($id) {

        if ($this->db->delete('content_types', array('id' => (int) $id))) {
            AZ::redirectSuccess('admin/contents/types', lang('Removed'));
        } else {
            AZ::redirectError('admin/contents/types', lang('Error occured'));
        }
    }

    /**
     * Content Groups (Categories) Page for this controller.
     *
     * Primary View is views/admin/blocks/contents/types
     * @param	integer $q Content Type ID
     * @param	integer $offset
     * @return	Layout
     */
    public function groups($q = 1) {

        $types_A = $this->content->types_A(true);
        if (count($types_A) == 1) {
            $key = array_keys($types_A);
            $q = $key[0];
        }

        $groups = $this->content->getGroupsTree($q);

        AZ::layout('left-content', array(
            'block' => 'contents/groups',
            'groups' => $groups,
            'types_A' => $types_A,
            'q' => $q,
        ));
    }

    /**
     * Add New or Edit Content Group page for this controller
     *
     * Primary View is views/admin/blocks/contents/group-form
     * @param	integer $edit
     * @param	integer $type
     * @return	Layout
     */
    public function edit_group($edit = -1, $type = 1) {

        $group = $this->content->getGroupById($edit);

        $parentsOption = $this->content->getGroupsOptionTree($type, 0, (isset($group->parent)) ? $group->parent : 0);

        AZ::layout('left-content', array(
            'block' => 'contents/group-form',
            'parentsOption' => $parentsOption,
            'group' => $group,
            'type' => $type
        ));
    }

    /**
     * Save Content Group
     *
     * @return	Redirect
     */
    public function save_group() {

        $post = $this->input->post();
        if (!count($post)) {
            return FALSE;
        }

        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', lang('Name'), 'trim|required');

        if (!$this->form_validation->run()) {

            AZ::redirectError('admin/contents/edit_group/' . $post['id'] . '/' . $post['type'], validation_errors());
        }
        if (!$this->content->saveGroup($post)) {
            AZ::redirectError('admin/contents/groups/' . $post['type'], lang('Error occured'));
        } else {
            $return = (isset($post['return'])) ? $post['return'] : 'admin/contents/groups/' . $post['type'];
            AZ::redirectSuccess($return, lang('Saved'));
        }
    }

    /**
     * Remove Group and Redirect Back to Content Groups
     *
     * @param	integer $id
     * @param	integer $type
     * @return	redirect
     */
    public function remove_group($id, $type = 1) {

        if ($this->db->delete('content_groups', array('id' => (int) $id))) {
            AZ::redirectSuccess('admin/contents/groups/' . $type, lang('Removed'));
        } else {
            AZ::redirectError('admin/contents/groups/' . $type, lang('Error occured'));
        }
    }

    /**
     * Content Fields Group (Fieldset) Page for this controller.
     *
     * Primary View is views/admin/blocks/contents/fieldset
     * @return	Layout
     */
    public function fieldsets() {
        $fieldsets = $this->content->getFieldSets();
        AZ::layout('left-content', array(
            'block' => 'contents/fieldset',
            'fieldsets' => $fieldsets
        ));
    }

    /**
     * Add New or Edit Content Field Group (Fieldset) page for this controller
     *
     * Primary View is views/admin/blocks/contents/fieldset-form
     * @param	integer $edit
     * @return	Layout
     */
    public function edit_fieldset($edit = -1) {

        $fieldset = $this->content->getFieldsetById($edit);

        AZ::layout('left-content', array(
            'block' => 'contents/fieldset-form',
            'fieldset' => $fieldset
        ));
    }

    /**
     * Save Content Field Groups (Fieldset)
     *
     * @return	Redirect
     */
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

    /**
     * Remove Content Field Group (Fieldset) and Redirect Back to Fieldset
     *
     * @param	integer $id
     * @return	redirect
     */
    public function remove_fieldset($id) {

        if ($this->db->delete('content_field_groups', array('id' => (int) $id))) {
            AZ::redirectSuccess('admin/contents/fieldsets', lang('Removed'));
        } else {
            AZ::redirectError('admin/contents/fieldsets', lang('Error occured'));
        }
    }

    /**
     * Content Fields Page for this controller.
     *
     * Primary View is views/admin/blocks/contents/fields
     * @param	integer $q Content Field Group (Fieldset)
     * @param	integer $offset
     * @return	Layout
     */
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

    /**
     * Add New or Edit Content Field page for this controller
     *
     * Primary View is views/admin/blocks/contents/field-form
     * @param	integer $edit
     * @param	integer $fieldset
     * @return	Layout
     */
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

    /**
     * Save Content Field 
     *
     * @return	Redirect
     */
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

    /**
     * Remove Field and Redirect Back to Fields
     *
     * @param	integer $id
     * @param	integer $fieldset
     * @return	redirect
     */
    public function remove_field($id, $fieldset = 1) {

        if ($this->db->delete('content_fields', array('id' => (int) $id))) {
            AZ::redirectSuccess('admin/contents/fields/' . $fieldset, lang('Removed'));
        } else {
            AZ::redirectError('admin/contents/fields/' . $fieldset, lang('Error occured'));
        }
    }

    /**
     * Render Field option on select field type in Add Field form
     *
     * @param	string $type
     * @param	integer $field_id
     * @return	string
     */
    public function field_type_options($type = 'text', $field_id = "") {
        echo field_options($type, $field_id);
    }

    /**
     * Load All Fields Rules by Content Type and Check Field Validations
     *
     * @param	integer $type_id
     * @return	boolen
     */
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

/* End of file contents.php */
    /* Location: ./application/controllers/contents.php */    
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
 * Content Helper
 *
 * @package		Helper
 * @subpackage  Content
 * @author		AZinkey
 */
defined('APPPATH') || exit('No direct script access allowed');

/**
 * Get Fields from fieldset
 *
 *
 * @access	public
 * @param	fieldset_id
 * @return	array
 */
if (!function_exists('fields_from_fieldset')) {

    function fields_from_fieldset($fieldset_id) {
                $fields = content->getFieldsByGroup($fieldset_id);
        return ($fields && count($fields)) ? $fields : array();
    }

}

/**
 * Render Field's Html Tags
 *
 *
 * @access	public
 * @param	fieldObj
 * @param	content_id
 * @param	language_id
 * @return	string
 */
if (!function_exists('field_render')) {

    function field_render($fieldObj, $content_id, $language_id) {

        $default_value = $fieldObj->default_value;

                if ($content_id > 0) {

            $row = db_connect()->get_where('content_field_values', array('content_id' => $content_id, 'language_id' => $language_id, 'field_id' => $fieldObj->id))->row();
            if (!empty($row)) {
                if (is_null($row->option_id)) {
                    $default_value = $row->value;
                }
            }
        }

        $html = NULL;

        switch ($fieldObj->type) {

            case 'text':
                $html .= field_text('fields[' . $fieldObj->id . ']', $default_value);
                break;

            case 'textarea':
                $html .= field_textarea('fields[' . $fieldObj->id . ']', $default_value);
                break;

            case 'editor':
                $html .= field_editor('fields[' . $fieldObj->id . ']', $default_value);
                break;

            case 'date':
                $html .= field_date('fields[' . $fieldObj->id . ']', $default_value);
                break;

            case 'select':
                $options = content->getFieldOptions($fieldObj->id);
                $html .= field_select('fields[' . $fieldObj->id . ']', $options, $default_value, 'class="input-block-level form-control"');
                break;

            case 'boolen':
                $options = content->getFieldOptions($fieldObj->id);
                $html .= field_select('fields[' . $fieldObj->id . ']', $options, $default_value, 'class="input-block-level form-control"');
                break;

            case 'checkbox':
                $html .= field_checkbox($fieldObj->id);
                break;

            case 'radio':
                $html .= field_radio($fieldObj->id);
                break;

            case 'file':
                $html .= field_file('file_' . $fieldObj->id, $default_value);
                break;
        }


        return $html;
    }

}

/**
 * Get fieldset array
 *
 *
 * @access	public
 * @return	array
 */
if (!function_exists('fieldset_A')) {

    function fieldset_A() {
                $groups = db_connect()->get_where('content_field_groups', array('enabled' => 1))->result();
        $fieldsets = array();

        if ($groups && count($groups)) {
            foreach ($groups as $group) {
                $fieldsets[$group->id] = $group->name;
            }
        }
        return $fieldsets;
    }

}

/**
 * Get contents array
 *
 *
 * @access	public
 * @param	have_groups
 * @return	array
 */
if (!function_exists('contents_A')) {

    function contents_A($have_groups = false) {
                if($have_groups){
            db_connect()->where('have_groups',1);
        }
        $types = db_connect()->get_where('content_types', array('enabled' => 1))->result();
        
        $array = array(__('Select..',true));
        
        if(!empty($types) && count($types)) {
            foreach ($types as $type) {
                $array[$type->id] = $type->name;
            }
        }
        return $array;
    }

}

/**
 * Check alias registered for category
 *
 *
 * @access	public
 * @param	alias
 * @return	boolen
 */
if (!function_exists('is_group')) {

    function is_group($alias) {
                load->model('content');
        return (content->checkGroupAlias($alias)) ? true : false;
    }

}

/**
 * Get Group as link 
 *
 *
 * @access	public
 * @param	alias
 * @return	boolen
 */
if (!function_exists('child_group_links')) {

    function child_group_links($alias) {
                load->model('content');
        
        $group = content->getGroupByAlias($alias);
        
        $groups = content->getGroupsMenu($group->type,$group->id);
        echo $groups;
        
    }

}

/**
 * Get Latest Content
 *
 *
 * @access	public
 * @param	type
 * @param	limit
 * @return	array
 */
if (!function_exists('get_latest_content')) {

    function get_latest_content($type,$limit = 5) {
                load->model('content');
        
        return content->getLatestContents($type,$limit);
        
        
    }

}

/**
 * Get Latest Content by group
 *
 *
 * @access	public
 * @param	group
 * @param	contentType
 * @param	limit
 * @return	array
 */
if (!function_exists('get_latest_by_group')) {

    function get_latest_by_group($group, $contentType, $limit = 4) {
                load->model('content');
        $contents = content->getContentsByGroup($group, $contentType, 0, $limit);
        $latest = array();
        if (count($contents)) {
            foreach ($contents as $content) {
                $latest[] = anchor($content->alias, $content->title);
            }
        }
        return $latest;
    }

}


/* End of file content_helper.php */
/* Location: ./app/helpers/content_helper.php */
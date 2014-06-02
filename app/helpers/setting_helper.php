<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');




/**
 * Styles
 *
 * Generates Styles link.
 * @access    public
 * @param    string/array
 * @return    string
 */
if (!function_exists('get_setting_groups')) {

    function get_setting_groups($setting_section_id) {


        $CI = & get_instance();

        $rows = $CI->setting->getSettingGroups($setting_section_id);


        return $rows;
    }

}

if (!function_exists('get_settings')) {

    function get_settings($group_id) {

        $CI = & get_instance();

        $rows = $CI->setting->getSettings($group_id);


        return $rows;
    }

}

if (!function_exists('setting_field_render')) {

    function setting_field_render($setting_id) {
        $CI = & get_instance();
        $row = $CI->db->get_where('settings', array('id' => $setting_id))->row();

        if (!$row || empty($row)) {
            return FALSE;
        }

        $html = NULL;

        switch ($row->type) {

            case 'text':
                $html .= field_text($row->key, (empty($row->value)) ? $row->default_value : $row->value);
                break;

            case 'textarea':
                $html .= field_textarea($row->key, (empty($row->value)) ? $row->default_value : $row->value);
                break;

            case 'date':
                $html .= field_date($row->key, (empty($row->value)) ? $row->default_value : $row->value);
                break;

            case 'select':
                $options = array();
                if (!empty($row->options)) {
                    $rows = unserialize($row->options);
                    if (isset($rows['value']) && is_array($rows['value']) && count($rows['value'])) {
                        foreach ($rows['value'] as $key => $value) {
                            $options[$value] = (isset($rows['title'][$key])) ? $rows['title'][$key] : '';
                        }
                    }
                }

                $html .= field_select($row->key, $options, (empty($row->value)) ? $row->default_value : $row->value, 'class="input-block-level form-control"');
                break;

            case 'boolen':
                $options = array();
                if (!empty($row->options)) {
                    $rows = unserialize($row->options);
                    if (isset($rows['value']) && is_array($rows['value']) && count($rows['value'])) {
                        foreach ($rows['value'] as $key => $value) {
                            $options[$value] = (isset($rows['title'][$key])) ? $rows['title'][$key] : '';
                        }
                    }
                }

                $html .= field_select($row->key, $options, (empty($row->value)) ? $row->default_value : $row->value, 'class="input-block-level form-control"');
                break;
        }
        return $html;
    }

}
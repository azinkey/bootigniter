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
 * Form Helper
 *
 * @package		Helper
 * @subpackage  Form
 * @author		AZinkey
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Key To Label
 *
 * Creates Machine code (key) to human readable 
 *
 * @access	public
 * @param	string
 * @return	string
 */
if (!function_exists('key_label')) {

    function key_label($key) {
        if (!empty($key)) {
            $words = ucwords(str_replace('_', ' ', $key));
            return $words;
        }
    }

}

/**
 * Label To Key
 *
 * Creates Words (label) into Machine code (key)
 *
 * @access	public
 * @param	string
 * @return	string
 */
if (!function_exists('label_key')) {

    function label_key($label) {
        if (!empty($label)) {
            $words = preg_replace('/[^a-z0-9]/i', '_', strtolower($label));
            return $words;
        }
    }

}

/**
 * Find and Set $_POST value
 *
 *
 * @access	public
 * @param	string
 * @param	string
 * @return	string
 */
if (!function_exists('form_value')) {

    function form_value($label, $obj) {
        $value = NULL;
        if (isset($obj->{$label})) {
            $value = $obj->{$label};
        }

        $CI = & get_instance();
        $post = $CI->input->post();
        if (isset($post[$label])) {
            $value = $post[$label];
        }
        return $value;
    }

}

/**
 * Return Field Type Options
 *
 *
 * @access	public
 * @param	boolen
 * @return	array
 */
if (!function_exists('field_types')) {

    function field_types($base_field_opnly = false) {

        if ($base_field_opnly) {
            return array(
                'text' => 'Text',
                'textarea' => 'Textarea',
                'boolen' => 'Yes/No',
                'select' => 'Select',
                'date' => 'Date',
            );
        } else {
            return array(
                'text' => 'Text',
                'textarea' => 'Textarea',
                'editor' => 'Editor',
                'date' => 'Date',
                'boolen' => 'Yes/No',
                'select' => 'Select',
                'checkbox' => 'Checkbox',
                'radio' => 'Radio',
                'file' => 'File',
            );
        }
    }

}

/**
 * Return Field Options on Field Type Select
 *
 *
 * @access	public
 * @param	string
 * @param	integer
 * @param	boolen
 * @return	Callback
 */
if (!function_exists('field_options')) {

    function field_options($type, $field_id = '', $setting = false) {

        if (!empty($type)) {
            $callback = "field_" . $type . "_option";
            if (is_callable($callback)) {
                return call_user_func($callback, $field_id, $setting);
            } else {
                return "Filed option method not defined in form helper. Hints: $callback";
            }
        }
    }

}

/**
 * Return Text Field
 *
 * @access	public
 * @param	name
 * @param	values
 * @param	disabled
 * @param	attributes
 * @return	string
 */
if (!function_exists('field_text')) {

    function field_text($name, $values = NULL, $disabled = 0, $attributes = array()) {

        $attributes = array(
            'type' => 'text',
            'name' => $name
        );
        if ($disabled) {
            $attributes['disabled'] = 'disabled';
        }
        if (!key_exists('class', $attributes)) {
            $attributes['class'] = 'form-control';
        }

        if (!empty($values)) {
            $attributes['value'] = set_value($name, $values);
        }

        return form_input($attributes);
    }

}

/**
 * Return Textarea Field
 *
 * @access	public
 * @param	name
 * @param	values
 * @param	disabled
 * @param	attributes
 * @return	string
 */
if (!function_exists('field_textarea')) {

    function field_textarea($name, $values = NULL, $disabled = 0, $attributes = array()) {

        $attributes = array(
            'rows' => 3,
            'type' => 'textarea',
            'name' => $name,
        );
        if ($disabled) {
            $attributes['disabled'] = 'disabled';
        }
        if (!key_exists('class', $attributes)) {
            $attributes['class'] = 'form-control';
        }

        if (!empty($values)) {
            $attributes['value'] = set_value($name, $values);
        }

        return form_textarea($attributes);
    }

}

/**
 * Return Editor Field
 *
 * @access	public
 * @param	name
 * @param	values
 * @param	disabled
 * @param	attributes
 * @return	string
 */
if (!function_exists('field_editor')) {

    function field_editor($name, $values = NULL, $disabled = 0, $attributes = array()) {
        $timestamp_id = time();
        $attributes = array(
            'rows' => 3,
            'type' => 'textarea',
            'name' => $name,
            'id' => $timestamp_id,
            'contenteditable' => "true",
        );
        if ($disabled) {
            $attributes['disabled'] = 'disabled';
        }
        if (!key_exists('class', $attributes)) {
            $attributes['class'] = 'form-control ckeditor';
        }

        if (!empty($values)) {
            $attributes['value'] = set_value($name, $values);
        }
        $html = NULL;
        $html .= form_textarea($attributes);
        return $html;
    }

}

/**
 * Return Date Field
 *
 * @access	public
 * @param	name
 * @param	values
 * @param	disabled
 * @param	attributes
 * @return	string
 */
if (!function_exists('field_date')) {

    function field_date($name, $values = NULL, $disabled = 0, $attributes = array()) {

        $attributes = array(
            'type' => 'text',
            'name' => $name
        );
        if ($disabled) {
            $attributes['disabled'] = 'disabled';
        }
        if (!key_exists('class', $attributes)) {
            $attributes['class'] = 'form-control show-datepicker';
        }

        if (!empty($values)) {
            $attributes['value'] = set_value($name, $values);
        }
        $html = '<div class="input-group">' .
                form_input($attributes)
                . '<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span></div>';
        return $html;
    }

}

/**
 * Return Select Field
 *
 * @access	public
 * @param	name
 * @param	options
 * @param	selected
 * @param	attr
 * @param	disabled
 * @return	string
 */
if (!function_exists('field_select')) {

    function field_select($name, $options = array(), $selected = NULL, $attr = 'class="input-block-level"', $disabled = 0) {

        if ($disabled) {

            $attr .= ' disabled="disabled" ';
        }

        return form_dropdown($name, $options, $selected, $attr);
    }

}

/**
 * Return Yes/No Dropdown Field
 *
 * @access	public
 * @param	name
 * @param	value
 * @param	disabled
 * @param	attr
 * @return	string
 */
if (!function_exists('field_boolen')) {

    function field_boolen($name, $value, $disabled = 0, $attr = 'class="form-control input-block-level"') {
        if ($disabled) {
            $attr .= ' disabled="disabled" ';
        }
        return form_dropdown($name, array('0' => lang('No'), '1' => lang('Yes')), $value, $attr);
    }

}

/**
 * Return Checkbox Field
 *
 * @access	public
 * @param	field_id
 * @return	string
 */
if (!function_exists('field_checkbox')) {

    function field_checkbox($field_id) {
        $ci = & get_instance();
        $rows = $ci->db->get_where('content_field_options', array('field_id' => $field_id))->result();

        $html = NULL;

        if ($rows && count($rows)) {
            foreach ($rows as $row) {
                $html .= '<div class="checkbox">';
                $html .= '<label>';
                $html .= form_checkbox('fields[' . $field_id . '][' . $row->option_id . ']', $row->option_id, ($row->value) ? true : false );
                $html .= $row->title;
                $html .= '</label>';
                $html .= '</div>';
            }
        }

        return $html;
    }

}

/**
 * Return Radio Field
 *
 * @access	public
 * @param	field_id
 * @return	string
 */
if (!function_exists('field_radio')) {

    function field_radio($field_id) {
        $ci = & get_instance();
        $rows = $ci->db->get_where('content_field_options', array('field_id' => $field_id))->result();

        $html = NULL;

        if ($rows && count($rows)) {
            foreach ($rows as $row) {
                $html .= '<div class="radio">';
                $html .= '<label>';
                $html .= form_radio('fields[' . $field_id . ']', $row->option_id, ($row->value) ? true : false );
                $html .= $row->title;
                $html .= '</label>';
                $html .= '</div>';
            }
        }

        return $html;
    }

}

/**
 * Return File Field
 *
 * @access	public
 * @param	name
 * @param	values
 * @return	string
 */
if (!function_exists('field_file')) {

    function field_file($name, $values = NULL) {


        $attributes = array(
            'type' => 'text',
            'name' => $name
        );

        if (!empty($values)) {
            $attributes['value'] = set_value($name, $values);
        }

        $html = NULL;
        $html = '<span class="btn btn-file">';
        $html .= (file_exists($values)) ? '<i class="fa fa-file fa-2x pull-left"></i>' : '';
        $html .= form_upload($attributes);
        $html .= '</span>';

        return $html;
    }

}

/**
 * Return Text Field Options
 *
 * @access	public
 * @param	field_id
 * @param	setting
 * @return	string
 */
if (!function_exists('field_text_option')) {

    function field_text_option($field_id = "", $setting = false) {
        $default_value = NULL;
        if (!empty($field_id)) {
            $ci = & get_instance();

            if ($setting) {
                $default_value = $ci->db->get_where('settings', array('id' => (int) $field_id))->row('default_value');
            } else {
                $default_value = $ci->db->get_where('content_fields', array('id' => (int) $field_id, 'type' => 'text'))->row('default_value');
            }
            $default_value = (empty($default_value)) ? NULL : $default_value;
        }
        $lang_default_value = __('Default Value', true);
        $str = <<<STR
        <div class="field-row row-fluid">
            <div class="col-md-4">
                <label for="default_value" class="default_value_label">{$lang_default_value}</label>
            </div>
            <div class="col-md-8">
                <input type="text" name="default_value" value="{$default_value}" class="form-control" />
            </div>
        <div class="clearfix"></div>
        </div>        
STR;

        return $str;
    }

}

/**
 * Return Textarea Field Options
 *
 * @access	public
 * @param	field_id
 * @param	setting
 * @return	string
 */
if (!function_exists('field_textarea_option')) {

    function field_textarea_option($field_id = "", $setting = false) {
        $default_value = NULL;
        if (!empty($field_id)) {
            $ci = & get_instance();
            if ($setting) {
                $default_value = $ci->db->get_where('settings', array('id' => (int) $field_id))->row('default_value');
            } else {
                $default_value = $ci->db->get_where('content_fields', array('id' => (int) $field_id, 'type' => 'textarea'))->row('default_value');
            }
            $default_value = (empty($default_value)) ? NULL : $default_value;
        }
        $lang_default_value = __('Default Value', true);
        $str = <<<STR
        <div class="field-row row-fluid">
            <div class="col-md-4">
                <label for="default_value" class="default_value_label">{$lang_default_value}</label>
            </div>
            <div class="col-md-8">
                <textarea name="default_value" class="form-control input-sm">{$default_value}</textarea>
            </div>
        <div class="clearfix"></div>
        </div>        
STR;

        return $str;
    }

}

/**
 * Return Editor Field Options
 *
 * @access	public
 * @param	field_id
 * @param	setting
 * @return	string
 */
if (!function_exists('field_editor_option')) {

    function field_editor_option($field_id = "", $setting = false) {
        $default_value = NULL;
        if (!empty($field_id)) {
            $ci = & get_instance();
            if ($setting) {
                $default_value = $ci->db->get_where('settings', array('id' => (int) $field_id))->row('default_value');
            } else {
                $default_value = $ci->db->get_where('content_fields', array('id' => (int) $field_id, 'type' => 'editor'))->row('default_value');
            }
            $default_value = (empty($default_value)) ? NULL : $default_value;
        }
        $lang_default_value = __('Default Value', true);
        $str = <<<STR
        <div class="field-row row-fluid">
            <div class="col-md-4">
                <label for="default_value">{$lang_default_value}</label>
            </div>
            <div class="col-md-8">
                <textarea name="default_value" class="form-control input-sm">{$default_value}</textarea>
            </div>
        <div class="clearfix"></div>
        </div>        
STR;

        return $str;
    }

}

/**
 * Return Select Field Options
 *
 * @access	public
 * @param	field_id
 * @param	setting
 * @return	string
 */
if (!function_exists('field_select_option')) {

    function field_select_option($field_id = "", $setting = false) {

        $option_rows = NULL;
        $default_value = NULL;
        if (!empty($field_id)) {
            $ci = & get_instance();

            if ($setting) {
                $settingRow = $ci->db->get_where('settings', array('id' => (int) $field_id))->row();

                if (!empty($settingRow->options)) {
                    $settingOptions = unserialize($settingRow->options);
                }

                $default_value = (empty($settingRow->default_value)) ? $settingRow->value : $settingRow->default_value;
                $default_value = (empty($default_value)) ? NULL : $default_value;

                if (count($settingOptions) && isset($settingOptions['value']) && isset($settingOptions['title'])) {
                    $i = 0;
                    foreach ($settingOptions['value'] as $key => $value) {
                        if ($i) {
                            $action = "<a href='javascript:void(0);' class='remove-option'>
                                        <span class='glyphicon glyphicon-minus-sign'></span>    
                                    </a>
                                    <a href='javascript:void(0);' class='add-option' data-type='select'>
                                        <span class='glyphicon glyphicon-plus-sign'></span>
                                    </a>";
                        } else {
                            $action = "<a href='javascript:void(0);' class='add-option' data-type='select'>
                                        <span class='glyphicon glyphicon-plus-sign'></span>
                                    </a>";
                        }
                        $option_rows .= "<tr>
                                <td>
                                    <input type='text' name='options[value][{$key}]' class='form-control' value='{$value}' />
                                </td>
                                <td>
                                    <input type='text' name='options[title][{$key}]' class='form-control' value='{$settingOptions['title'][$key]}' />
                                </td>
                                <td>
                                {$action}
                                </td>
                            </tr>";

                        $i++;
                    }
                }
            } else {
                $rows = $ci->db->get_where('content_field_options', array('field_id' => (int) $field_id))->result();
                $default_value = $ci->db->get_where('content_fields', array('id' => (int) $field_id, 'type' => 'select'))->row('default_value');
                $default_value = (empty($default_value)) ? NULL : $default_value;
                if (count($rows)) {
                    $i = 0;
                    foreach ($rows as $row) {
                        if ($i) {
                            $action = "<a href='javascript:void(0);' class='remove-option'>
                                        <span class='glyphicon glyphicon-minus-sign'></span>    
                                    </a>
                                    <a href='javascript:void(0);' class='add-option' data-type='select'>
                                        <span class='glyphicon glyphicon-plus-sign'></span>
                                    </a>";
                        } else {
                            $action = "<a href='javascript:void(0);' class='add-option' data-type='select'>
                                        <span class='glyphicon glyphicon-plus-sign'></span>
                                    </a>";
                        }
                        $option_rows .= "<tr>
                                <td>
                                    <input type='text' name='options[value][{$row->option_id}]' class='form-control' value='{$row->value}' />
                                </td>
                                <td>
                                    <input type='text' name='options[title][{$row->option_id}]' class='form-control' value='{$row->title}' />
                                </td>
                                <td>
                                {$action}
                                </td>
                            </tr>";

                        $i++;
                    }
                }
            }
        } else {
            $option_rows .= "<tr>
                                <td>
                                    <input type='text' name='options[value][0]' class='form-control' value='' />
                                </td>
                                <td>
                                    <input type='text' name='options[title][0]' class='form-control' value='" . __('Select..', true) . "' />
                                </td>
                                <td>
                                    <a href='javascript:void(0);' class='add-option' data-type='select'>
                                        <span class='glyphicon glyphicon-plus-sign'></span>
                                    </a>
                                </td>
                            </tr>";
        }

        $lang_options = __('Options', true);
        $lang_values = __('Value', true);
        $lang_label = __('Label', true);
        $lang_default_value = __('Default Value', true);
        $str = <<<STR
        <div class="field-row row-fluid">
            <div class="col-md-4 hidden-xs">
                <label for="options">{$lang_options}</label>
            </div>
            <div class="col-md-8" id="optionList">
                <div class="table">
                    <table class="table table-condensed">
                        <thead>
                                <tr>
                                    <th>{$lang_values}</th>
                                    <th>{$lang_label}</th>
                                    <th></th>
                                </tr>
                        </thead>
                        <tbody>
                            {$option_rows}
                        </tbody>
                    </table>
                </div>
                <div class="row-fluid">
                    <div class="col-xs-5">
                        
                    </div>
                    <div class="col-xs-5">
                        
                    </div>
                    <div class="col-xs-2">
                        
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        <div class="clearfix"></div>
        </div>
        <div class="field-row row-fluid">
            <div class="col-md-4">
                <label for="options" class="default_value_label">{$lang_default_value}</label>
            </div>
            <div class="col-md-8">
                <input type="text" name="default_value" value="{$default_value}" class="form-control" />
            </div>
        <div class="clearfix"></div>
        </div>              
STR;

        return $str;
    }

}

/**
 * Return Yes/No Field Options
 *
 * @access	public
 * @param	field_id
 * @param	setting
 * @return	string
 */
if (!function_exists('field_boolen_option')) {

    function field_boolen_option($field_id = "", $setting = false) {

        $option_rows = NULL;
        $default_value = NULL;
        if (!empty($field_id)) {
            $ci = & get_instance();

            if ($setting) {
                $settingRow = $ci->db->get_where('settings', array('id' => (int) $field_id))->row();

                if (!empty($settingRow->options)) {
                    $settingOptions = unserialize($settingRow->options);
                }

                $default_value = (empty($settingRow->value)) ? $settingRow->default_value : $settingRow->value;
                $default_value = (empty($default_value)) ? NULL : $default_value;
                if (count($settingOptions) && isset($settingOptions['value']) && isset($settingOptions['title'])) {
                    $i = 0;
                    foreach ($settingOptions['value'] as $key => $value) {
                        $checked = ($value == 1) ? 'glyphicon-check' : 'glyphicon-unchecked';
                        $option_rows .= "
                            <tr>
                                <td>
                                    <input type='text' name='options[value][{$key}]' class='form-control' value='{$value}' readonly='readonly' />
                                </td>
                                <td>
                                <div class='input-group'>
                                        <span class='input-group-addon'><span class='glyphicon {$checked}'></span></span>
                                        <input type='text' name='options[title][{$key}]' class='form-control' value='{$settingOptions['title'][$key]}' />
                                    </div>
                                </td>
                               
                            </tr>";

                        $i++;
                    }
                }
            } else {
                $rows = $ci->db->get_where('content_field_options', array('field_id' => (int) $field_id))->result();
                $default_value = $ci->db->get_where('content_fields', array('id' => (int) $field_id, 'type' => 'boolen'))->row('default_value');

                $default_value = (empty($default_value) && $default_value != 0) ? NULL : $default_value;

                if (count($rows)) {
                    $i = 0;
                    foreach ($rows as $row) {
                        $checked = ($row->value == 1) ? 'glyphicon-check' : 'glyphicon-unchecked';
                        $option_rows .= "
                       
                            <tr>
                                <td>
                                    <input type='text' name='options[value][{$row->option_id}]' class='form-control' value='{$row->value}' readonly='readonly' />
                                </td>
                                <td>
                                <div class='input-group'>
                                        <span class='input-group-addon'><span class='glyphicon {$checked}'></span></span>
                                        <input type='text' name='options[title][{$row->option_id}]' class='form-control' value='{$row->title}' />
                                    </div>
                                </td>
                               
                            </tr>";

                        $i++;
                    }
                }
            }
        } else {
            $option_rows .= "<tr>
                                <td>
                                    <input type='text' name='options[value][0]' class='form-control' value='1' readonly='readonly' />
                                </td>
                                <td>
                                    <div class='input-group'>
                                        <span class='input-group-addon'><span class='glyphicon glyphicon-check'></span></span>
                                        <input type='text' name='options[title][0]' class='form-control' value='" . __('Yes', true) . "' />
                                    </div>
                                </td>
                               
                            </tr>
                            <tr>
                                <td>
                                    <input type='text' name='options[value][1]' class='form-control' value='0' readonly='readonly' />
                                </td>
                                <td>
                                <div class='input-group'>
                                        <span class='input-group-addon'><span class='glyphicon glyphicon-unchecked'></span></span>
                                        <input type='text' name='options[title][1]' class='form-control' value='" . __('No', true) . "' />
                                    </div>
                                </td>
                               
                            </tr>";
        }
        $lang_options = __('Options', true);
        $lang_values = __('Value', true);
        $lang_label = __('Label', true);
        $lang_default_value = __('Default Value', true);
        $str = <<<STR
        <div class="field-row row-fluid">
            <div class="col-md-4 hidden-xs">
                <label for="options" class="default_value_label">{$lang_options}</label>
            </div>
            <div class="col-md-8" id="optionList">
                <div class="table">
                    <table class="table table-condensed">
                        <thead>
                                <tr>
                                    <th>{$lang_values}</th>
                                    <th>{$lang_label}</th>
                                </tr>
                        </thead>
                        <tbody>
                            {$option_rows}
                        </tbody>
                    </table>
                </div>
                <div class="row-fluid">
                    <div class="col-xs-5">
                        
                    </div>
                    <div class="col-xs-5">
                        
                    </div>
                    <div class="col-xs-2">
                        
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        <div class="clearfix"></div>
        </div>
        <div class="field-row row-fluid">
            <div class="col-md-4">
                <label for="options" class="default_value_label">{$lang_default_value}</label>
            </div>
            <div class="col-md-8">
                <input type="text" name="default_value" value="{$default_value}" class="form-control input-sm" />
            </div>
        <div class="clearfix"></div>
        </div>              
STR;

        return $str;
    }

}

/**
 * Return Checkbox Field Options
 *
 * @access	public
 * @param	field_id
 * @return	string
 */
if (!function_exists('field_checkbox_option')) {

    function field_checkbox_option($field_id = "") {

        $option_rows = NULL;
        $default_value = NULL;
        if (!empty($field_id)) {
            $ci = & get_instance();
            $rows = $ci->db->get_where('content_field_options', array('field_id' => (int) $field_id))->result();
            $default_value = $ci->db->get_where('content_fields', array('id' => (int) $field_id, 'type' => 'checkbox'))->row('default_value');
            $default_value = (empty($default_value)) ? NULL : $default_value;
            if (count($rows)) {
                $i = 0;
                foreach ($rows as $row) {
                    if ($i) {
                        $action = "<a href='javascript:void(0);' class='remove-option'>
                                        <span class='glyphicon glyphicon-minus-sign'></span>    
                                    </a>
                                    <a href='javascript:void(0);' class='add-option' data-type='checkbox'>
                                        <span class='glyphicon glyphicon-plus-sign'></span>
                                    </a>";
                    } else {
                        $action = "<a href='javascript:void(0);' class='add-option' data-type='checkbox'>
                                        <span class='glyphicon glyphicon-plus-sign'></span>
                                    </a>";
                    }
                    $selected = ($row->value == 1) ? ' selected="selected"' : '';
                    $option_rows .= "<tr>
                                <td>
                                <select name='options[value][{$row->option_id}]' class='form-control'>
                                        <option value='0'>No</option>
                                        <option value='1' {$selected}>Yes</option>
                                    </select>
                                </td>
                                <td>
                                    <input type='text' name='options[title][{$row->option_id}]' class='form-control' value='{$row->title}' />
                                </td>
                                <td>
                                {$action}
                                </td>
                            </tr>";

                    $i++;
                }
            }
        } else {
            $option_rows .= "<tr>
                                <td>
                                     <select name='options[value][0]' class='form-control'>
                                        <option value='0'>" . __('No', true) . "</option>
                                        <option value='1'>" . __('Yes', true) . "</option>
                                    </select>
                                </td>
                                <td>
                                    <input type='text' name='options[title][0]' class='form-control' />
                                </td>
                                <td>
                                    <a href='javascript:void(0);' class='add-option' data-type='checkbox'>
                                        <span class='glyphicon glyphicon-plus-sign'></span>
                                    </a>
                                </td>
                            </tr>";
        }
        $lang_options = __('Options', true);
        $lang_checked = __('Checked', true);
        $lang_title = __('Title', true);
        $str = <<<STR
        <div class="field-row row-fluid">
            <div class="col-md-4 hidden-xs">
                <label for="options">{$lang_options}</label>
            </div>
            <div class="col-md-8" id="optionList">
                <div class="table">
                    <table class="table table-condensed">
                        <thead>
                                <tr>
                                    <th>{$lang_checked}</th>
                                    <th>{$lang_title}</th>
                                    <th></th>
                                </tr>
                        </thead>
                        <tbody>
                            {$option_rows}
                        </tbody>
                    </table>
                </div>
                <div class="row-fluid">
                    <div class="col-xs-5">
                        
                    </div>
                    <div class="col-xs-5">
                        
                    </div>
                    <div class="col-xs-2">
                        
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        <div class="clearfix"></div>
        </div>
               
STR;

        return $str;
    }

}

/**
 * Return Radio Field Options
 *
 * @access	public
 * @param	field_id
 * @return	string
 */
if (!function_exists('field_radio_option')) {

    function field_radio_option($field_id = "") {

        $option_rows = NULL;
        $default_value = NULL;
        if (!empty($field_id)) {
            $ci = & get_instance();
            $rows = $ci->db->get_where('content_field_options', array('field_id' => (int) $field_id))->result();
            $default_value = $ci->db->get_where('content_fields', array('id' => (int) $field_id, 'type' => 'radio'))->row('default_value');
            $default_value = (empty($default_value)) ? NULL : $default_value;
            if (count($rows)) {
                $i = 0;
                foreach ($rows as $row) {
                    if ($i) {
                        $action = "<a href='javascript:void(0);' class='remove-option'>
                                        <span class='glyphicon glyphicon-minus-sign'></span>    
                                    </a>
                                    <a href='javascript:void(0);' class='add-option' data-type='radio'>
                                        <span class='glyphicon glyphicon-plus-sign'></span>
                                    </a>";
                    } else {
                        $action = "<a href='javascript:void(0);' class='add-option' data-type='radio'>
                                        <span class='glyphicon glyphicon-plus-sign'></span>
                                    </a>";
                    }
                    $selected = ($row->value == 1) ? ' selected="selected"' : '';
                    $option_rows .= "<tr>
                                <td class='hidden'>
                                <select name='options[value][{$row->option_id}]' class='form-control input-sm'>
                                        <option value='0'>" . __('No', true) . "</option>
                                        <option value='1' {$selected}>" . __('Yes', true) . "</option>
                                    </select>
                                </td>
                                <td>
                                    <input type='text' name='options[title][{$row->option_id}]' class='form-control' value='{$row->title}' />
                                </td>
                                <td>
                                {$action}
                                </td>
                            </tr>";

                    $i++;
                }
            }
        } else {
            $option_rows .= "<tr>
                                <td class='hidden'>
                                    <select name='options[value][0]' class='form-control input-sm'>
                                        <option value='0'>" . __('No', true) . "</option>
                                        <option value='1'>" . __('Yes', true) . "</option>
                                    </select>
                                </td>
                                <td>
                                    <input type='text' name='options[title][0]' class='form-control' />
                                </td>
                                <td>
                                    <a href='javascript:void(0);' class='add-option' data-type='radio'>
                                        <span class='glyphicon glyphicon-plus-sign'></span>
                                    </a>
                                </td>
                            </tr>";
        }
        $lang_options = __('Options', true);
        $lang_label = __('Label', true);
        $str = <<<STR
        <div class="field-row row-fluid">
            <div class="col-md-4 hidden-xs">
                <label for="options">{$lang_options}</label>
            </div>
            <div class="col-md-8" id="optionList">
                <div class="table">
                    <table class="table table-condensed">
                        <thead>
                                <tr>
                                    <th>{$lang_label}</th>
                                    <th></th>
                                </tr>
                        </thead>
                        <tbody>
                            {$option_rows}
                        </tbody>
                    </table>
                </div>
                <div class="row-fluid">
                    <div class="col-xs-5">
                        
                    </div>
                    <div class="col-xs-5">
                        
                    </div>
                    <div class="col-xs-2">
                        
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        <div class="clearfix"></div>
        </div>
               
STR;

        return $str;
    }

}

/**
 * Return Date Field Options
 *
 * @access	public
 * @param	field_id
 * @param	setting
 * @return	string
 */
if (!function_exists('field_date_option')) {

    function field_date_option($field_id = "", $setting = false) {
        $default_value = NULL;
        if (!empty($field_id)) {
            $ci = & get_instance();
            if ($setting) {
                $default_value = $ci->db->get_where('settings', array('id' => (int) $field_id))->row('default_value');
            } else {
                $default_value = $ci->db->get_where('content_fields', array('id' => (int) $field_id, 'type' => 'text'))->row('default_value');
            }
            $default_value = (empty($default_value)) ? NULL : $default_value;
        }
        $lang_default_value = __('Default Value', true);
        $str = <<<STR
        <div class="field-row row-fluid">
            <div class="col-md-4 date_default_value_label">
                <label for="default_value">{$lang_default_value}</label>
            </div>
            <div class="col-md-8 date_default_value_field">
                    <div class='input-group'>
                        <input type="date" name="default_value" id="defaultValue"  value="{$default_value}" class="form-control show-datepicker" placeholder="mm/dd/yyyy" />
                        <span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span>
                    </div>            
            </div>
        <div class="clearfix"></div>
        </div>
   <script>
                        (function($){
                            $(document).ready(function(){
                                $(document).on('click', '.show-datepicker', function() {
                                    $(this).datepicker();
                                });
                            });
                        })(jQuery);
   </script>
STR;

        return $str;
    }

}

/**
 * Return File Field Options
 *
 * @access	public
 * @param	field_id
 * @param	setting
 * @return	string
 */
if (!function_exists('field_file_option')) {

    function field_file_option($field_id = "", $setting = false) {
        $str = $field_id . '.) Options Coming Soon... in hurry? you can write something here or just press Save';


        return $str;
    }

}

/* End of file form_helper.php */
/* Location: ./app/helpers/az_form_helper.php */

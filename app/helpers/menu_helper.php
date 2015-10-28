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
 * Menu Helper
 *
 * @package		Helper
 * @subpackage  Menu
 * @author		AZinkey
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');


/**
 * Get Menu array
 *
 *
 * @access	public
 * @return	array
 */
if (!function_exists('menu_A')) {

    function menu_A() {

        $array = array();
        $CI = & get_instance();
        $menuObj = $CI->menu->getMenus();

        krsort($menuObj);
        if (count($menuObj)) {
            foreach ($menuObj as $menu) {
                $array[$menu->id] = $menu->name;
            }
        }

        return $array;
    }

}

/**
 * Get Menu tree
 *
 *
 * @access	public
 * @param	menu
 * @param	level
 * @param	active
 * @param	prefix
 * @return	array
 */
if (!function_exists('menuOptionTree')) {

    function menuOptionTree($menu = 1, $level = 0, $active = 0, $prefix = '') {
        $CI = & get_instance();
        $rows = $CI->db
                ->select('id,parent,title')
                ->where('menu_id', $menu)
                ->where('parent', $level)
                ->order_by('title', 'asc')
                ->get('menu_items')
                ->result();

        $options = NULL;
        if (count($rows)) {
            foreach ($rows as $row) {
                $selected = ($row->id == $active) ? 'selected="selected"' : '';
                $options .= '<option value="' . $row->id . '" ' . $selected . '>';
                $options .= $prefix . $row->title . "\n";
                $options .= '</option>';
                $options .= menuOptionTree($menu, $row->id, $active, $prefix . '--');
            }
        }

        return $options;
    }

}

/**
 * Get URL Key array
 *
 *
 * @access	public
 * @param	type_id
 * @return	array
 */
if (!function_exists('url_key_A')) {

    function url_key_A($type_id = 1) {
        $options = array();
        $ci = & get_instance();
        $ci->load->model('content');
        $contents = $ci->content->getContentsKey($type_id);
        if ($contents && count($contents)) {
            foreach ($contents as $content) {
                $options[$content->alias] = $content->alias;
            }
        }
        return $options;
    }

}

/**
 * Get Group Alias array
 *
 *
 * @access	public
 * @param	type_id
 * @return	array
 */
if (!function_exists('group_alias_A')) {

    function group_alias_A($type_id = 1) {
        $options = array();
        $ci = & get_instance();
        $ci->load->model('content');
        $groups = $ci->content->getGroupsKey($type_id);
        
        if ($groups && count($groups)) {
            foreach ($groups as $group) {
                $options[$group['alias']] = $group['name'];
            }
        }
        return $options;
    }

}

/* End of file menu_helper.php */
/* Location: ./app/helpers/menu_helper.php */
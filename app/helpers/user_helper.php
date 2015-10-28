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
 * User Helper
 *
 * @package		Helper
 * @subpackage  USer
 * @author		AZinkey
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Get Current username
 *
 *
 * @access	public
 * @return	string
 */
if (!function_exists('current_username')) {

    function current_username() {

        if (!user::id()) {
            return false;
        }

        $CI = & get_instance();

        if (!$username = $CI->session->userdata('username')) {

            $username = $CI->db
                            ->select('username')
                            ->get_where('users', array('id' => user::id()))->row('username');
            if (!empty($username)) {
                $CI->session->set_userdata('username', $username);
            }
        }

        return $CI->session->userdata('username');
    }

}

/**
 * Get Current user name
 *
 *
 * @access	public
 * @return	string
 */
if (!function_exists('current_user_name')) {

    function current_user_name() {

        if (!user::id()) {
            return false;
        }

        $CI = & get_instance();

        $name = $CI->db
                        ->select('name')
                        ->get_where('users', array('id' => user::id()))->row('name');
        return $name;
    }

}

/**
 * Get Access Array
 *
 *
 * @access	public
 * @return	array
 */
if (!function_exists('access_A')) {

    function access_A($show_guest = false) {

        if (!user::id()) {
            return array();
        }
        $array = array();
        $CI = & get_instance();
        $accessObj = $CI->user->getAccesses();
        krsort($accessObj);
        if (count($accessObj)) {
            foreach ($accessObj as $access) {
                if ($show_guest) {
                    $array[0] = "Public";
                }
                $array[$access->id] = $access->name;
            }
        }
        if ($show_guest) {
            ksort($array);
        }
        return $array;
    }

}

/**
 * Get User Group Array
 *
 *
 * @access	public
 * @param	show_guest
 * @return	array
 */
if (!function_exists('user_groups_A')) {

    function user_groups_A($show_guest = false) {

        $array = array();
        $CI = & get_instance();
        $groupObj = $CI->user->getUserGroups();

        krsort($groupObj);
        if (count($groupObj)) {
            foreach ($groupObj as $group) {
                if (!$show_guest) {
                    if ($group->id > 0) {
                        $array[$group->id] = $group->name;
                    }
                } else {
                    $array[$group->id] = $group->name;
                }
            }
        }

        return $array;
    }

}

/**
 * Get User Status Array
 *
 *
 * @access	public
 * @return	array
 */
if (!function_exists('user_status_A')) {

    function user_status_A() {

        $array = array(
            0 => 'Pending',
            1 => 'Active',
            2 => 'Blocked',
        );
        return $array;
    }

}

/**
 * Check User Access Permission
 *
 *
 * @access	public
 * @param	controller
 * @param	method
 * @param	access_id
 * @return	integer
 */
if (!function_exists('check_permission')) {

    function check_permission($controller, $method = 'index', $access_id = NULL) {

        if (!user::id()) {
            return false;
        }

        if (is_null($access_id) || empty($access_id)) {
            $access_id = user::access_id();
        }

        $CI = & get_instance();

        $check = $CI->db
                        ->get_where('access', array(
                            'access_id' => $access_id,
                            'controller' => $controller,
                            'method' => $method,
                        ))->num_rows();
        return $check;
    }

}

/**
 * Check User Have Permission
 *
 *
 * @access	public
 * @param	controllerMethod
 * @param	access_id
 * @return	integer
 */
if (!function_exists('have_permission')) {

    function have_permission($controllerMethod, $access_id = NULL) {

        if (!user::id()) {
            return false;
        }

        if (is_null($access_id) || empty($access_id)) {
            $access_id = user::access_id();
        }

        $chunk = explode("/", $controllerMethod);
        $controller = $chunk[0];
        $method = $chunk[1];

        if (empty($controller) || empty($method)) {
            return FALSE;
        }

        $CI = & get_instance();

        $check = $CI->db
                        ->get_where('access', array(
                            'access_id' => $access_id,
                            'controller' => $controller,
                            'method' => $method,
                        ))->num_rows();
        return $check;
    }

}

/* End of file user_helper.php */
/* Location: ./app/helpers/user_helper.php */
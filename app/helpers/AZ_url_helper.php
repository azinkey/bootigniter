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
 * Url Helper
 *
 * @package		Helper
 * @subpackage  Url
 * @author		AZinkey
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Get skin / theme url
 *
 *
 * @access	public
 * @param	theme
 * @return	string
 */
if (!function_exists('skin_url')) {

    function skin_url($theme = 'default') {
        $uri = & load_class('URI', 'core');
        $admin = $uri->segment(1);
        $is_admin = ($admin == 'administrator' || $admin == 'admin') ? true : false;
        $dir = ($is_admin) ? 'skins/admin/' : 'skins/front/' . $theme . '/';
        return base_url() . $dir;
    }

}

/**
 * Get Media directory url
 *
 *
 * @access	public
 * @param	media
 * @return	string
 */
if (!function_exists('media_url')) {

    function media_url($media = 'media/') {
        return base_url() . $media;
    }

}

/**
 * Check segments
 *
 *
 * @access	public
 * @return	boolen
 */
if (!function_exists('is_front')) {

    function is_front() {
        $uri = & load_class('URI', 'core');
        if(count($uri->segments)){
            return false;
        } else {
            return true;
        }
    }

}

/**
 * Get segment 1
 *
 *
 * @access	public
 * @return	integer
 */
if (!function_exists('segment_1')) {

    function segment_1() {
        $uri = & load_class('URI', 'core');
        return $uri->segment(1);
    }

}

/**
 * Get segment 2
 *
 *
 * @access	public
 * @return	integer
 */
if (!function_exists('segment_2')) {

    function segment_2() {
        $uri = & load_class('URI', 'core');
        return $uri->segment(2);
    }

}


/* End of file url_helper.php */
/* Location: ./app/helpers/az_url_helper.php */
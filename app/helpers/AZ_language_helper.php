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
 * Language Helper
 *
 * @package		Helper
 * @subpackage  Language
 * @author		AZinkey
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Get Admin Language
 *
 *
 * @access	public
 * @return	string
 */
if (!function_exists('admin_language')) {

    function admin_language() {
        $CI = & get_instance();
        $CI->load->model('content');
        return $CI->content->getAdminLanguage();
    }

}

/**
 * Get Front Language
 *
 *
 * @access	public
 * @return	string
 */
if (!function_exists('site_language')) {

    function site_language() {
        $CI = & get_instance();
        $CI->load->model('content');
        return $CI->content->getSiteLanguage();
    }

}

/**
 * Get Active Language Code
 *
 *
 * @access	public
 * @return	string
 */
if (!function_exists('language_code')) {

    function language_code() {
        $CI = & get_instance();
        $CI->load->model('content');
        return $CI->content->getActiveLanguageCode();
    }

}

/**
 * Get Active Language Name
 *
 *
 * @access	public
 * @return	string
 */
if (!function_exists('language_name')) {

    function language_name() {
        $CI = & get_instance();
        $CI->load->model('content');
        return $CI->content->getActiveLanguageName();
    }

}

/**
 * Get Languages Flags
 *
 *
 * @access	public
 * @return	string
 */
if (!function_exists('language_flags')) {

    function language_flags() {
        $CI = & get_instance();
        $CI->load->model('content');
        $rows= $CI->content->getSiteLanguages();
        $list = NULL;
        if($rows && count($rows)){
            foreach($rows as $row){
                $list .= '<li><a href="'. current_url() . '?lang='. $row->directory  .'">'.$row->name.'</a></li>';
            }
        }
        return $list;
        
    }

}

/**
 * Get Active Language id
 *
 *
 * @access	public
 * @return	integer
 */
if (!function_exists('active_language_id')) {

    function active_language_id() {
        $CI = & get_instance();
        $CI->load->model('content');
        return $CI->content->getActiveLanguageId();
        
        
    }

}
// ------------------------------------------------------------------------
/* End of file language_helper.php */
/* Location: ./app/helpers/language_helper.php */
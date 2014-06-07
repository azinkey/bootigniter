<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */
if (!function_exists('admin_language')) {

    function admin_language() {
        $CI = & get_instance();
        $CI->load->model('content');
        return $CI->content->getAdminLanguage();
    }

}
if (!function_exists('site_language')) {

    function site_language() {
        $CI = & get_instance();
        $CI->load->model('content');
        return $CI->content->getSiteLanguage();
    }

}
if (!function_exists('language_code')) {

    function language_code() {
        $CI = & get_instance();
        $CI->load->model('content');
        return $CI->content->getActiveLanguageCode();
    }

}

if (!function_exists('language_name')) {

    function language_name() {
        $CI = & get_instance();
        $CI->load->model('content');
        return $CI->content->getActiveLanguageName();
    }

}

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

if (!function_exists('active_language_id')) {

    function active_language_id() {
        $CI = & get_instance();
        $CI->load->model('content');
        return $CI->content->getActiveLanguageId();
        
        
    }

}
// ------------------------------------------------------------------------
/* End of file language_helper.php */
/* Location: ./system/helpers/language_helper.php */
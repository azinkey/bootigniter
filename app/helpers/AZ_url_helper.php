<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');



if (!function_exists('skin_url')) {

    function skin_url($theme = 'default') {
        $uri = & load_class('URI', 'core');
        $admin = $uri->segment(1);
        $is_admin = ($admin == 'administrator' || $admin == 'admin') ? true : false;
        $dir = ($is_admin) ? 'skins/admin/' : 'skins/front/' . $theme . '/';
        return base_url() . $dir;
    }

}

if (!function_exists('media_url')) {

    function media_url($media = 'media/') {
        return base_url() . $media;
    }

}

if (!function_exists('segment_1')) {

    function segment_1() {
        $uri = & load_class('URI', 'core');
        return $uri->segment(1);
    }

}
if (!function_exists('segment_2')) {

    function segment_2() {
        $uri = & load_class('URI', 'core');
        return $uri->segment(2);
    }

}

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

/* End of file url_helper.php */
/* Location: ./application/helpers/az_url_helper.php */
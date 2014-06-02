<?php

class AZ extends CI_Model {

    static private $CI;

    public function __construct() {

        self::$CI = & get_instance();
        parent::__construct();
    }

    static public function helper($helper) {
        self::$CI->load->helper($helper);
    }

    static public function model($model, $object_name = NULL) {
        self::$CI->load->model($model, $object_name);
    }

    static public function layout($name, $vars, $theme = 'default', $return = false) {

        self::$CI->load->layout($name, $vars, $theme, $return);
    }

    static public function block($name = 'default', $vars = array(), $theme = 'default', $return = false) {
        if (empty($name)) {
            show_error('You forgot to add block name', 400, "Missing Block Name");
        }
        self::$CI->load->block($name, $vars, $theme, $return);
    }

    static public function head($name = 'head', $vars = array(), $theme = 'default', $return = false) {

        self::$CI->load->head($name, $theme, $vars, $return);
    }

    static public function header($name = 'header', $vars = array(), $theme = 'default', $return = false) {

        self::$CI->load->header($name, $theme, $vars, $return);
    }

    static public function footer($name = 'footer', $vars = array(), $theme = 'default', $return = false) {

        self::$CI->load->footer($name, $theme, $vars, $return);
    }

    static public function redirectMSG($uri, $flashValue = NULL, $flashKey = 'flash_info') {

        if (!is_null($flashKey) && !empty($flashValue)) {

            self::$CI->session->set_flashdata($flashKey, $flashValue);
        }
        if (!empty($uri)) {
            redirect($uri);
            return true;
        }
        return false;
    }

    static public function redirectWarning($uri, $flashValue = NULL, $flashKey = 'flash_warning') {
        return self::redirectMSG($uri, $flashValue, $flashKey);
    }

    static public function redirectError($uri, $flashValue = NULL, $flashKey = 'flash_error') {
        return self::redirectMSG($uri, $flashValue, $flashKey);
    }

    static public function redirectSuccess($uri, $flashValue = NULL, $flashKey = 'flash_success') {
        return self::redirectMSG($uri, $flashValue, $flashKey);
    }

    static public function flashMSG($msg, $flashKey = 'flash_info') {

        if (!isset($msg) || empty($msg)) {
            return false;
        } else {
            self::$CI->session->set_flashdata($flashKey, $msg);
            return true;
        }
    }

    static public function showFlashMSG($flashKey = 'flash_info', $class = "alert-info") {

        $msg = self::$CI->session->flashdata($flashKey);

        if (!empty($msg)) {
            return '<div class="alert ' . $class . '">
                <a class="close" data-dismiss="alert" href="#">&times;</a>' .
                    $msg .
                    '</div>';
        }
        return NULL;
    }

    static public function showFlashError($flashKey = 'flash_error', $class = "alert-danger") {

        return self::showFlashMSG($flashKey, $class);
    }

    static public function showFlashWarning($flashKey = 'flash_warning', $class = "alert-block") {
        return self::showFlashMSG($flashKey, $class);
    }

    static public function showFlashSuccess($flashKey = 'flash_success', $class = "alert-success") {
        return self::showFlashMSG($flashKey, $class);
    }

    static public function url($uri) {
        echo site_url($uri);
    }

    static public function redirect($uri) {

        if ($error = self::$CI->session->flashdata('flash_error')) {
            self::redirectError($uri, $error);
        }
        if ($warning = self::$CI->session->flashdata('flash_warning')) {
            self::redirectError($uri, $warning);
        }
        if ($success = self::$CI->session->flashdata('flash_success')) {
            self::redirectError($uri, $success);
        }
        if ($info = self::$CI->session->flashdata('flash_info')) {
            self::redirectError($uri, $info);
        }

        redirect($uri);
    }

    static public function setting($key) {

        return self::$CI->setting->getSetting($key);
    }

    static public function pagination($base_url, $uri_segment, $per_page, $total_rows, $bootstrap = true) {
        self::$CI->load->library('pagination');
        $config['base_url'] = site_url($base_url);
        $config['total_rows'] = $total_rows;
        $config['per_page'] = $per_page;
        $config['uri_segment'] = $uri_segment;

        if ($bootstrap) {
            $config['first_link'] = '&lsaquo; &lsaquo;';
            $config['last_link'] = '&rsaquo; &rsaquo;';
            $config['num_tag_open'] = '<li class="page_number">';
            $config['num_tag_close'] = '</li>';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';
            $config['prev_tag_open'] = '<li>';
            $config['prev_tag_close'] = '</li>';
            $config['full_tag_open'] = '<ul class="pagination pagination-sm pull-right">';
            $config['full_tag_close'] = '</ul>';
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="page_number active"><a>';
            $config['cur_tag_close'] = '</a></li>';
        }

        self::$CI->pagination->initialize($config);

        return self::$CI->pagination->create_links();
    }

}

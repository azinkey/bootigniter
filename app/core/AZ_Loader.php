<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class AZ_Loader extends CI_Loader {

    public $is_admin;

    public function __construct() {
        parent::__construct();
        $uri = & load_class('URI', 'core');
        $admin = $uri->segment(1);
        $this->is_admin = ($admin == 'administrator' || $admin == 'admin') ? true : false;
    }

    public function layout($name, $vars, $theme = 'default', $return = false) {

        $view = ($this->is_admin) ? 'admin/layouts/' . $name : 'front/' . $theme . '/layouts/' . $name;
        $this->view($view, $vars, $return);
    }

    public function block($name = 'default', $vars = array(), $theme = 'default', $return = false) {

        $view = ($this->is_admin) ? 'admin/blocks/' . $name : 'front/' . $theme . '/blocks/' . $name;
        $this->view($view, $vars, $return);
    }

    public function head($name = 'head', $theme = 'default', $vars = array(), $return = false) {

        $view = ($this->is_admin) ? 'admin/layouts/' . $name : 'front/' . $theme . '/layouts/' . $name;
        $this->view($view, $vars, $return);
    }

    public function header($name = 'header', $theme = 'default', $vars = array(), $return = false) {

        $view = ($this->is_admin) ? 'admin/layouts/' . $name : 'front/' . $theme . '/layouts/' . $name;
        $this->view($view, $vars, $return);
    }

    public function footer($name = 'footer', $theme = 'default', $vars = array(), $return = false) {

        $view = ($this->is_admin) ? 'admin/layouts/' . $name : 'front/' . $theme . '/layouts/' . $name;
        $this->view($view, $vars, $return);
    }

}

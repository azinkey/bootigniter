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
 * Contents Controller
 *
 * @package		Core
 * @subpackage  Loader
 * @author		AZinkey
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class AZ_Loader extends CI_Loader {

    public $is_admin;

    /**
     * Check & Set URI resource to determine the side of application
     *
     */
    public function __construct() {
        parent::__construct();
        $uri = & load_class('URI', 'core');
        $admin = $uri->segment(1);
        $this->is_admin = ($admin == 'administrator' || $admin == 'admin') ? true : false;
    }

    /**
     * Load Layout for controllers
     * 
     * @param	string $name
     * @param	array $vars
     * @param	string $theme
     * @param	boolen $return
     */
    public function layout($name, $vars, $theme = 'default', $return = false) {

        $view = ($this->is_admin) ? 'admin/layouts/' . $name : 'front/' . $theme . '/layouts/' . $name;
        $this->view($view, $vars, $return);
    }

    /**
     * Load Layout Block for Layout
     * 
     * @param	string $name
     * @param	array $vars
     * @param	string $theme
     * @param	boolen $return
     */
    public function block($name = 'default', $vars = array(), $theme = 'default', $return = false) {

        $view = ($this->is_admin) ? 'admin/blocks/' . $name : 'front/' . $theme . '/blocks/' . $name;
        $this->view($view, $vars, $return);
    }

    /**
     * Load Page Head Block for Layout
     * 
     * @param	string $name
     * @param	string $theme
     * @param	array $vars
     * @param	boolen $return
     */
    public function head($name = 'head', $theme = 'default', $vars = array(), $return = false) {

        $view = ($this->is_admin) ? 'admin/layouts/' . $name : 'front/' . $theme . '/layouts/' . $name;
        $this->view($view, $vars, $return);
    }

    /**
     * Load Page Header Block for Layout
     * 
     * @param	string $name
     * @param	string $theme
     * @param	array $vars
     * @param	boolen $return
     */
    public function header($name = 'header', $theme = 'default', $vars = array(), $return = false) {

        $view = ($this->is_admin) ? 'admin/layouts/' . $name : 'front/' . $theme . '/layouts/' . $name;
        $this->view($view, $vars, $return);
    }

    /**
     * Load Page Footer Block for Layout
     * 
     * @param	string $name
     * @param	string $theme
     * @param	array $vars
     * @param	boolen $return
     */
    public function footer($name = 'footer', $theme = 'default', $vars = array(), $return = false) {

        $view = ($this->is_admin) ? 'admin/layouts/' . $name : 'front/' . $theme . '/layouts/' . $name;
        $this->view($view, $vars, $return);
    }

}

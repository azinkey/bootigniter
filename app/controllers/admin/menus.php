<?php

/**
 * Bootigniter
 *
 * An Open Source CMS Boilerplate for PHP 5.1.6 or newer
 *
 * @package		Bootigniter
 * @author		AZinkey
 * @copyright           Copyright (c) 2014, AZinkey.
 * @license		http://bootigniter.org/license
 * @link		http://bootigniter.org
 * @Version		Version 1.0
 */
// ------------------------------------------------------------------------

/**
 * Contents Controller
 *
 * @package		Admin
 * @subpackage          Controllers
 * @author		AZinkey
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Menus extends CI_Controller {

    public function __construct() {

        parent::__construct();
        // Check User Priviligies and Permissions
        user::redirectUnauthorizedAccess();
        // Load Form Helper
        AZ::helper('form');
        // Load Menu Helper
        AZ::helper('menu');
        // Load Menu Model
        AZ::model('menu');
    }

    /**
     * Index Page for this controller or List all Users.
     *
     * Primary View is views/admin/blocks/menus/index
     * 
     * @param	integer $q Menu ID
     * @param	integer $offset
     * @return	Layout
     */
    public function index($q = 1, $offset = 0) {


        $total_items = $this->menu->getMenuItems('*', array('menu_id' => $q), 0, 0, true);
        $items = $this->menu->getMenuItemsTree($q);

        AZ::layout('left-content', array(
            'block' => 'menus/index',
            'menu_A' => menu_A(),
            'items' => $items,
            'total_items' => $total_items,
            'q' => $q,
        ));
    }

    /**
     * Add New or Edit Menu 
     *
     * Primary View is views/admin/blocks/menus/menu-form
     * 
     * @param	integer $menu_id
     * @return	Layout
     */
    public function edit_menu($menu_id = -1) {

        $menu = $this->menu->getMenuById($menu_id);

        AZ::layout('block-only', array(
            'block' => 'menus/menu-form',
            'menu' => $menu,
        ));
    }

    /**
     * Save Menu
     *
     * @return	Redirect
     */
    public function save_menu() {

        $post = $this->input->post();

        $this->load->library('form_validation');

        $this->form_validation->set_rules('name', lang('Name'), 'trim|required');

        if (!$this->form_validation->run()) {
            AZ::redirectError('admin/menus', validation_errors());
        }

        if (!$this->menu->saveMenu($post)) {
            AZ::redirectError('admin/menus', lang('Error occured'));
        } else {
            AZ::redirectSuccess('admin/menus', lang('Saved'));
        }
    }

    /**
     * Remove Menu
     *
     * @param	integer $menu_id
     * @return	redirect
     */
    public function remove_menu($menu_id) {

        if ($this->db->delete('menus', array('id' => (int) $menu_id))) {

            AZ::redirectSuccess('admin/menus', lang('Removed'));
        } else {
            AZ::redirectError('admin/menus', lang('Error occured'));
        }
    }

    /**
     * Add New or Edit Menu Item
     *
     * Primary View is views/admin/blocks/menus/item-form
     * 
     * @param	integer $menu_id
     * @param	integer $item_id
     * @return	Layout
     */
    public function edit_item($menu_id, $item_id = -1) {
        AZ::helper('content');
        $item = $this->menu->getMenuItemById($item_id);

        AZ::layout('block-only', array(
            'block' => 'menus/item-form',
            'item' => $item,
            'menu_id' => $menu_id,
        ));
    }

    /**
     * Save Menu Item
     *
     * @return	Redirect
     */
    public function save_item() {

        $post = $this->input->post();

        $this->load->library('form_validation');

        $this->form_validation->set_rules('title', lang('Title'), 'trim|required');

        if (!$this->form_validation->run()) {
            AZ::redirectError('admin/menus', validation_errors());
        }

        if (!$this->menu->saveMenuItem($post)) {
            AZ::redirectError('admin/menus', lang('Error occured'));
        } else {
            AZ::redirectSuccess('admin/menus', lang('Saved'));
        }
    }

    /**
     * Remove Menu Item
     *
     * @param	integer $item_id
     * @return	redirect
     */
    public function remove_item($item_id) {

        if ($this->db->delete('menu_items', array('id' => (int) $item_id))) {

            AZ::redirectSuccess('admin/menus', lang('Removed'));
        } else {
            AZ::redirectError('admin/menus', lang('Error occured'));
        }
    }

    /**
     * Update Content Options on Change Menu/Content Type
     *
     * @param	integer $type_id
     * @param	boolen $selected
     * @return	string
     */
    public function get_contents($type_id = 1, $selected = 0) {
        echo form_dropdown('content_id', url_key_A($type_id), $selected, 'class="form-control"');
    }

}

/* End of file menus.php */
/* Location: ./app/controllers/admin/menus.php */
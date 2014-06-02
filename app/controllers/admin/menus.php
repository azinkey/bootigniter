<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Menus extends CI_Controller {

    public function __construct() {

        parent::__construct();
        user::redirectUnauthorizedAccess();

        AZ::helper('form');
        AZ::helper('menu');
        AZ::model('menu');
    }

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

    public function edit_menu($menu_id = -1) {

        $menu = $this->menu->getMenuById($menu_id);

        AZ::layout('block-only', array(
            'block' => 'menus/menu-form',
            'menu' => $menu,
        ));
    }

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

    public function remove_menu($menu_id) {

        if ($this->db->delete('menus', array('id' => (int) $menu_id))) {

            AZ::redirectSuccess('admin/menus', lang('Removed'));
        } else {
            AZ::redirectError('admin/menus', lang('Error occured'));
        }
    }

    public function edit_item($menu_id, $item_id = -1) {
        AZ::helper('content');
        $item = $this->menu->getMenuItemById($item_id);

        AZ::layout('block-only', array(
            'block' => 'menus/item-form',
            'item' => $item,
            'menu_id' => $menu_id,
        ));
    }

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

    public function remove_item($item_id) {

        if ($this->db->delete('menu_items', array('id' => (int) $item_id))) {

            AZ::redirectSuccess('admin/menus', lang('Removed'));
        } else {
            AZ::redirectError('admin/menus', lang('Error occured'));
        }
    }

    public function get_contents($type_id = 1, $selected = 0) {
        echo form_dropdown('content_id', url_key_A($type_id), $selected, 'class="form-control"');
    }

}

/* End of file menus.php */
/* Location: ./app/controllers/admin/menus.php */
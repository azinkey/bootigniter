<?php

class Menu extends CI_Model {

    public function getMenus($select = '*', $where = array(), $offset = 0, $limit = 25, $count = FALSE) {

        $c = ($count == FALSE) ? 'result' : 'num_rows';

        if (is_array($where) && count($where)) {
            $this->db->where($where);
        }

        if ($select != '*' && !empty($select)) {
            $this->db->select($select);
        }

        $this->db
                ->offset($offset);

        if (!$count) {
            $this->db->limit($limit);
        }

        return $this->db->get('menus')->{$c}();
    }

    public function getMenuItems($select = '*', $where = array(), $offset = 0, $limit = 25, $count = FALSE) {

        $c = ($count == FALSE) ? 'result' : 'num_rows';

        if (is_array($where) && count($where)) {
            $this->db->where($where);
        }

        if ($select != '*' && !empty($select)) {
            $this->db->select($select);
        }

        $this->db
                ->offset($offset);

        if (!$count) {
            $this->db->limit($limit);
        }

        return $this->db->get('menu_items')->{$c}();
    }

    public function getMenuItemsTree($menu, $level = 0, $prefix = '') {


        $rows = $this->db
                ->select('id,parent,title,enabled')
                ->where('menu_id', $menu)
                ->where('parent', $level)
                ->order_by('parent', 'asc')
                ->get('menu_items')
                ->result();

        $array = array();
        if (count($rows)) {
            foreach ($rows as $row) {
                $array[] = array(
                    'id' => $row->id,
                    'parent' => $row->parent,
                    'title' => $prefix . $row->title,
                    'enabled' => $row->enabled,
                );
                $array = array_merge($array, $this->getMenuItemsTree($menu, $row->id, $prefix . '-'));
            }
        }
        return $array;
    }

    public function getMenuById($menu_id) {
        return $this->db->get_where('menus', array('id' => $menu_id))->row();
    }

    public function saveMenu($data) {

        if (!is_array($data) || !count($data)) {
            return false;
        }
        $data['access'] = implode(',', $data['access']);

        if (isset($data['id']) && $data['id'] > 0) {
            return $this->db->update('menus', $data, array('id' => $data['id']));
        } else {
            return $this->db->insert('menus', $data);
        }
    }

    public function getMenuItemById($item_id) {
        return $this->db->get_where('menu_items', array('id' => $item_id))->row();
    }

    public function saveMenuItem($data) {

        if (!is_array($data) || !count($data)) {
            return false;
        }

        $item = array(
            'id' => $data['id'],
            'menu_id' => $data['menu_id'],
            'parent' => $data['parent'],
            'menu_type' => $data['menu_type'],
            'title' => $data['title'],
            'link' => $data['link'],
            'path' => $data['path'],
            'content_type' => $data['content_type'],
            'content_id' => $data['content_id'],
            'content' => $data['content'],
            'enabled' => $data['enabled'],
            'access' => implode(',', $data['access'])
        );
        
        if (isset($data['id']) && $data['id'] > 0) {
            return $this->db->update('menu_items', $item, array('id' => $data['id']));
        } else {
            return $this->db->insert('menu_items', $item);
        }
    }

    private function haveChild($item_id) {
        return $this->db
                        ->get_where('menu_items', array('parent' => $item_id))
                        ->num_rows();
    }

    public function getItemsByName($name, $wrapper_class = '', $level = 0, $menu_id = NULL, $html = NULL) {


        if (!$menu_id) {

            $this->db->where("FIND_IN_SET('" . user::access_id() . "', access)");

            $menu_id = $this->db->get_where('menus', array('name' => $name))->row('id');
        }


        $this->db->where("FIND_IN_SET('" . user::access_id() . "', access)");
        $rows = $this->db
                ->where('menu_id', $menu_id)
                ->where('parent', $level)
                ->where('enabled', 1)
                ->order_by('parent', 'asc')
                ->get('menu_items')
                ->result();



        if ($rows && count($rows)) {

            $class = ($level) ? ' dropdown-menu ' : $wrapper_class;
            $html .= '<ul class="' . $class . '">';
            foreach ($rows as $row) {

                switch ($row->menu_type) {
                    case 1:
                        $link = site_url($row->path);
                        break;
                    case 2:
                        $link = site_url($row->content_id);
                        break;
                    case 3:
                        $link = site_url($row->content_id);
                        break;
                    default:
                        $link = $row->link;
                }


                $have_child = $this->haveChild($row->id);
                $title = ($have_child) ? $row->title . ' <b class="caret"></b> ' : $row->title;
                $active = ($link == current_url()) ? ' active ' : '';
                $attribute = ($have_child) ? ' class="' . $active . ' dropdown-toggle" data-toggle="dropdown" ' : 'class="' . $active . '"';

                $html .= '<li class="' . $active . '">';
                $html .= anchor($link, __($title, true), $attribute);
                $html .= $this->getItemsByName($name, $wrapper_class, $row->id, $menu_id);
                $html .= '</li>';
            }
            $html .= '</ul>';
        }

        return $html;
    }

}

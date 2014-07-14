<?php

class Setting extends CI_Model {

    public function getSettingSections() {
        $where = "FIND_IN_SET('" . user::access_id() . "', access)";
        $this->db->where($where);
        $rows = $this->db
                ->get('setting_sections')
                ->result();

        return (!count($rows)) ? array() : $rows;
    }

    public function getSettingGroups($setting_section_id) {

        $this->db->where('sid', $setting_section_id);
        $where = "FIND_IN_SET('" . user::access_id() . "', access)";
        $this->db->where($where);
        $rows = $this->db
                ->order_by('setting_groups.id', 'DESC')
                ->get('setting_groups')
                ->result();

        return (!count($rows)) ? array() : $rows;
    }

    public function getSettings($group_id) {

        $rows = $this->db
                ->get_where('settings', array(
                    'group_id' => $group_id
                ))
                ->result();
        
        return (!count($rows)) ? array() : $rows;
    }

    public function saveSettings($data) {

        if (!is_array($data) || !count($data)) {
            return false;
        }

        foreach ($data as $key => $value) {
            if (!$this->db->update('settings', array('value' => $value), array('key' => $key))) {
                return false;
            }
        }
        return true;
    }

    public function getSetting($key) {
        if (!empty($key)) {
            return $this->db->get_where('settings', array('key' => $key))->row('value');
        }
        return NULL;
    }

    public function setSetting($key, $value = NULL, $type = 'text', $group_id = 1, $default_value = NULL, $options = NULL) {
        if (!empty($key)) {

            $exit = $this->db->get_where('settings', array('key' => $key))->num_rows();
            if ($exit) {
                return $this->db->update('settings', array(
                            'value' => $value,
                            'type' => $type,
                            'group_id' => $group_id,
                            'default_value' => $default_value,
                            'options' => $options,
                                ), array('key' => $key));
            } else {
                return $this->db->insert('settings', array(
                            'key' => $key,
                            'value' => $value,
                            'type' => $type,
                            'group_id' => $group_id,
                            'default_value' => $default_value,
                            'options' => $options,
                ));
            }
        }
        return false;
    }

    public function saveSection($data) {

        if (!is_array($data) || !count($data)) {
            return false;
        }
        $data['access'] = implode(',', $data['access']);

        if (isset($data['id']) && $data['id'] > 0) {
            return $this->db->update('setting_sections', $data, array('id' => $data['id']));
        } else {
            return $this->db->insert('setting_sections', $data);
        }
    }

    public function getSection_A() {

        $rows = $this->getSettingSections();

        $array = array();

        if (count($rows)) {
            foreach ($rows as $row) {
                $array[$row->id] = $row->title;
            }
        }

        return $array;
    }

    public function saveGroup($data) {

        if (!is_array($data) || !count($data)) {
            return false;
        }
        $data['access'] = implode(',', $data['access']);

        if (isset($data['id']) && $data['id'] > 0) {
            return $this->db->update('setting_groups', $data, array('id' => $data['id']));
        } else {
            return $this->db->insert('setting_groups', $data);
        }
    }

    public function getGroup_A($section = NULL) {
        
        if((int) $section){
            $this->db->where('sid',$section);
        }
        
        $rows = $this->db
                ->select('setting_groups.id,setting_groups.title,setting_sections.title AS section', FALSE)
                ->join('setting_sections', 'setting_sections.id = setting_groups.sid')
                ->order_by('setting_sections.id', 'DESC')
                ->get('setting_groups')
                ->result();

        $array = array();

        if (count($rows)) {
            foreach ($rows as $row) {
                $array[$row->section][$row->id] = $row->title;
            }
        }

        return $array;
    }

    public function saveSetting($data) {

        if (!is_array($data) || !count($data)) {
            return false;
        }

        $data['key'] = label_key($data['key']);
        $data['options'] = serialize($data['options']);

        if (isset($data['id']) && $data['id'] > 0) {
            return $this->db->update('settings', $data, array('id' => $data['id']));
        } else {
            return $this->db->insert('settings', $data);
        }
    }

    public function getSectionById($section_id) {

        return $this->db->get_where('setting_sections', array('id' => $section_id))->row();
    }

    public function getGroupById($group_id) {

        return $this->db->get_where('setting_groups', array('id' => $group_id))->row();
    }

    public function getSettingById($setting_id) {

        return $this->db->get_where('settings', array('id' => $setting_id))->row();
    }

}

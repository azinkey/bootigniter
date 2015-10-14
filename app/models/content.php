<?php

class Content extends CI_Model {

    public function checkAlias($alias) {
        return $this->db->get_where('contents', array('alias' => $alias))->num_rows();
    }

    public function checkGroupAlias($alias) {
        return $this->db->get_where('content_groups', array('alias' => $alias))->num_rows();
    }

    public function getTotalContents($type_id = 1) {
        return $this->db->get_where('contents', array('status' => 1, 'type_id' => $type_id))->num_rows();
    }

    public function getFieldsRowsByType($type_id) {
        $this->db->where('content_type_x_fields.type_id', $type_id);

        $this->db->where('content_fields.enabled', 1);
        $this->db->where('content_fields.trash', 0);
        $this->db->select('content_fields.id,content_fields.name,content_fields.label,content_fields.required,content_fields.validations');
        $this->db->from('content_type_x_fields');
        $this->db->join('content_fields', 'content_fields.group_id = content_type_x_fields.group_id');
        $rows = $this->db->get()->result();

        return $rows;
    }

    public function getFieldsByTypeId($type_id, $in_admin_list = 0, $in_list = 0, $in_view = 0, $in_search = 0) {

        $this->db->where('content_type_x_fields.type_id', $type_id);
        if ($in_admin_list) {
            $this->db->where('content_fields.in_admin_list', (int) $in_admin_list);
        }
        if ($in_list) {
            $this->db->where('content_fields.in_list', (int) $in_list);
        }
        if ($in_view) {
            $this->db->where('content_fields.in_view', (int) $in_view);
        }
        if ($in_search) {
            $this->db->where('content_fields.in_search', (int) $in_search);
        }
        $this->db->where('content_fields.enabled', 1);
        $this->db->where('content_fields.trash', 0);
        $this->db->select('content_fields.id,content_fields.name');
        $this->db->from('content_type_x_fields');
        $this->db->join('content_fields', 'content_fields.group_id = content_type_x_fields.group_id');
        $rows = $this->db->get()->result();

        $fields = array();
        if (count($rows)) {
            foreach ($rows as $row) {
                $fields[$row->id] = $row->name;
            }
        }
        return $fields;
    }

    public function getFieldsArrayByTypeId($type_id, $in_admin_list = 0, $in_list = 0, $in_view = 0) {

        $this->db->where('content_type_x_fields.type_id', $type_id);
        if ($in_admin_list) {
            $this->db->where('content_fields.in_admin_list', (int) $in_admin_list);
        }
        if ($in_list) {
            $this->db->where('content_fields.in_list', (int) $in_list);
        }
        if ($in_view) {
            $this->db->where('content_fields.in_view', (int) $in_view);
        }
        $this->db->where('content_fields.enabled', 1);
        $this->db->where('content_fields.trash', 0);
        $this->db->select('content_fields.id,content_fields.name,content_fields.label');
        $this->db->from('content_type_x_fields');
        $this->db->join('content_fields', 'content_fields.group_id = content_type_x_fields.group_id');
        $rows = $this->db->get()->result();

        $fields = array();
        if (count($rows)) {
            foreach ($rows as $row) {
                $fields[$row->name] = $row->label;
            }
        }
        return $fields;
    }

    public function getFieldsByGroup($group_id, $in_admin_list = 0, $in_list = 0, $in_view = 0) {

        if ($in_admin_list) {
            $this->db->where('in_admin_list', (int) $in_admin_list);
        }
        if ($in_list) {
            $this->db->where('in_list', (int) $in_list);
        }
        if ($in_view) {
            $this->db->where('in_view', (int) $in_view);
        }
        $this->db->where('enabled', 1);
        $this->db->where('trash', 0);
        $rows = $this->db->get_where('content_fields', array('group_id' => $group_id))->result();

        return $rows;
    }

    public function getFieldOptions($field_id) {
        $rows = $this->db->get_where('content_field_options', array('field_id' => $field_id))->result();
        $options = array();
        if (!$rows || !count($rows)) {
            $options[''] = lang('Select..');
        } else {
            foreach ($rows as $row) {
                $options[$row->value] = $row->title;
            }
        }
        return $options;
    }

    public function getContentFieldsValue($content_id, $fields, $language_id = 1) {

        $this->db->select('content_field_values.id AS value_id, content_id, option_id, field_id, name, value');
        $this->db->from('content_field_values');
        $this->db->join('content_fields', 'content_fields.id = field_id', 'LEFT');
        $this->db->where('content_id', $content_id);
        $this->db->where('language_id', $language_id);
        $this->db->where_in('content_field_values.field_id', array_keys($fields));
        $result = $this->db->get()->result();

        return $result;
    }

    public function getContentsKey($type_id = 1) {

        $this->db->select('id,alias');
        $contents = $this->db->get_where('contents', array('status' => 1, 'type_id' => $type_id))->result();

        return $contents;
    }

    public function getGroupsKey($type = 1, $level = 0, $prefix = '') {
        $rows = $this->db
                ->select('id,parent,name,alias,enabled,system')
                ->where('type', $type)
                ->where('parent', $level)
                ->where('enabled', 1)
                ->order_by('id', 'asc')
                ->get('content_groups')
                ->result();

        $array = array();
        if (count($rows)) {
            foreach ($rows as $row) {
                $array[] = array(
                    'id' => $row->id,
                    'parent' => $row->parent,
                    'alias' => $row->alias,
                    'name' => $prefix . $row->name,
                    'enabled' => 1,
                    'system' => $row->system,
                );
                $array = array_merge($array, $this->getGroupsKey($type, $row->id, $prefix . '-'));
            }
        }
        return $array;
    }

    public function getContents($type = 'pages', $offset = 0, $limit = 25, $count = FALSE) {

        $contentType = $this->db->get_where('content_types', array('alias' => $type, 'enabled' => 1))->row();
        if (!$contentType) {
            return FALSE;
        }

        $fields = $this->getFieldsByTypeId($contentType->id, 1);

        if (!$fields) {
            return FALSE;
        }

        $this->db
                ->offset($offset);

        $this->db->order_by('id', 'DESC');

        if (!$count) {
            $this->db->limit($limit);
        }

        $contents = array();


        if ($count) {
            return $this->db->get_where('contents', array('type_id' => $contentType->id))->num_rows();
        } else {
            $this->db->select('contents.*,content_groups.name AS groups');
            $this->db->join('content_groups', 'content_groups.id = contents.group_id', 'LEFT');
            $contentRows = $this->db->get_where('contents', array('contents.type_id' => $contentType->id))->result();
        }
        $default_language_id = $this->db->get_where('languages', array('is_admin' => 1))->row('id');
        $default_language_id = (empty($default_language_id)) ? 1 : $default_language_id;

        if (isset($contentRows) && count($contentRows)) {
            $i = 0;
            foreach ($contentRows as $contentRow) {
                $contents[$i] = new stdClass();

                $contents[$i]->id = $contentRow->id;
                $contents[$i]->group_id = $contentRow->group_id;
                $contents[$i]->groups = $contentRow->groups;
                $contents[$i]->user_id = $contentRow->user_id;
                $contents[$i]->status = $contentRow->status;
                $contents[$i]->modified = $contentRow->modified;
                $contents[$i]->timestamp = $contentRow->timestamp;
                $contents[$i]->access = $contentRow->access;
                $contents[$i]->alias = $contentRow->alias;

                $valueRows = $this->getContentFieldsValue($contentRow->id, $fields, $default_language_id);

                if (count($valueRows)) {
                    foreach ($valueRows as $valueRow) {
                        $contents[$i]->{$valueRow->name} = $valueRow->value;
                    }
                }
                $i++;
            }
        }

        return $contents;
    }

    public function getContentById($content_id) {

        $content = $this->db->get_where('contents', array('id' => $content_id))->row();

        if (!$content || !isset($content->type_id)) {
            return FALSE;
        }

        return $content;
    }

    public function getContentByAlias($alias, $language_id = 1) {

        $this->db->select('contents.*,content_types.alias AS content_type');
        $this->db->join('content_types', 'content_types.id = contents.type_id', 'LEFT');
        $content = $this->db->get_where('contents', array('contents.alias' => $alias))->row();

        if (!$content || !isset($content->type_id)) {
            return FALSE;
        }

        $fields = $this->getFieldsByTypeId($content->type_id, 0, 0, 1);

        if (!$fields) {
            return FALSE;
        }

        $valueRows = $this->getContentFieldsValue($content->id, $fields, $language_id);
        if (count($valueRows)) {
            foreach ($valueRows as $valueRow) {
                $content->{$valueRow->name} = $valueRow->value;
            }
        }

        return $content;
    }

    public function getContentsByGroup($group, $contentType = 1, $offset = 0, $limit = 25, $count = FALSE) {

        $fields = $this->getFieldsByTypeId($contentType, 0, 1, 0);

        if (!$fields) {
            return FALSE;
        }

        $this->db->order_by('id', 'DESC');


        if (user::access_id() !== '1') {
            $this->db->where("FIND_IN_SET('" . user::access_id() . "', access)");
        }

        $childGroups = $this->getGroupChilds($contentType, $group);

        if (!empty($childGroups)) {
            $this->db->where_in('group_id', $group);
            $this->db->or_where_in('group_id', $childGroups);
        } else {
            $this->db->where_in('group_id', $group);
        }

        $contents = array();

        if ($count) {
            return $this->db->get_where('contents', array(
                        'type_id' => $contentType,
                        'status' => 1
                    ))->num_rows();
        } else {
            $this->db->select('contents.*,content_groups.name AS groups');
            $this->db->join('content_groups', 'content_groups.id = contents.group_id', 'LEFT');
            $this->db->offset($offset);
            $this->db->limit($limit);

            $contentRows = $this->db->get_where('contents', array(
                        'contents.type_id' => $contentType,
                        'contents.status' => 1
                    ))->result();
        }

        $default_language_id = $this->db->get_where('languages', array('is_admin' => 1))->row('id');
        $default_language_id = (empty($default_language_id)) ? 1 : $default_language_id;

        if (isset($contentRows) && count($contentRows)) {
            $i = 0;
            foreach ($contentRows as $contentRow) {
                $contents[$i] = new stdClass();

                $contents[$i]->id = $contentRow->id;
                $contents[$i]->group_id = $contentRow->group_id;
                $contents[$i]->groups = $contentRow->groups;
                $contents[$i]->user_id = $contentRow->user_id;
                $contents[$i]->status = $contentRow->status;
                $contents[$i]->modified = $contentRow->modified;
                $contents[$i]->timestamp = $contentRow->timestamp;
                $contents[$i]->access = $contentRow->access;
                $contents[$i]->alias = $contentRow->alias;

                $valueRows = $this->getContentFieldsValue($contentRow->id, $fields, $default_language_id);

                if (count($valueRows)) {
                    foreach ($valueRows as $valueRow) {
                        $contents[$i]->{$valueRow->name} = $valueRow->value;
                    }
                }
                $i++;
            }
        }
        return $contents;
    }

    public function getContentsByWords($words, $offset = 0, $limit = 25, $count = FALSE) {
        $activeLanguage = $this->getActiveLanguageId();
        $access_id = user::access_id();
        $rows = $this->db->select('id')->get_where('content_fields', array('enabled' => 1, 'in_search' => 1))->result();
        $searchableFieldIds = array();

        if ($rows && count($rows)) {
            foreach ($rows as $row) {
                $searchableFieldIds[] = $row->id;
            }
            $this->db->where_in('field_id', $searchableFieldIds);
        }


        $this->db->distinct('content_id')->select('content_id');
        $this->db->like('value', $this->db->escape_str($words));
        $this->db->where('language_id', $activeLanguage);

        $rows = $this->db->get('content_field_values')->result();
        $foundContents = array();
        if ($rows && count($rows)) {
            foreach ($rows as $row) {
                $foundContents[] = $row->content_id;
            }
            $this->db->where_in('id', $foundContents);
        }


        $this->db->where('status', 1);

        $this->db->order_by('id', 'DESC');

        $contents = array();

        if ($count) {
            if ($access_id != '1') {
                $this->db->where("FIND_IN_SET('" . user::access_id() . "', access)");
            }
            return $this->db->get('contents')->num_rows();
        } else {

            if ($access_id != '1') {
                $this->db->where("FIND_IN_SET('" . user::access_id() . "', {$this->db->dbprefix}contents.access)");
            }

            $this->db->offset($offset);
            $this->db->limit($limit);

            $contentRows = $this->db->get('contents')->result();
        }

        if (isset($contentRows) && count($contentRows)) {
            $i = 0;
            foreach ($contentRows as $contentRow) {
                $contents[$i] = new stdClass();

                $contents[$i]->id = $contentRow->id;
                $contents[$i]->group_id = $contentRow->group_id;
                $contents[$i]->user_id = $contentRow->user_id;
                $contents[$i]->status = $contentRow->status;
                $contents[$i]->modified = $contentRow->modified;
                $contents[$i]->timestamp = $contentRow->timestamp;
                $contents[$i]->access = $contentRow->access;
                $contents[$i]->alias = $contentRow->alias;

                $fields = $this->getFieldsByTypeId($contentRow->type_id, 0, 1, 0, 1);

                if (!$fields) {
                    return FALSE;
                }

                $valueRows = $this->getContentFieldsValue($contentRow->id, $fields, $activeLanguage);

                if (count($valueRows)) {
                    foreach ($valueRows as $valueRow) {
                        $contents[$i]->{$valueRow->name} = $valueRow->value;
                    }
                }
                $i++;
            }
        }

        return $contents;
    }

    public function getLatestContents($type = 'pages', $limit = 25) {

        $contentType = $this->db->get_where('content_types', array('alias' => $type, 'enabled' => 1))->row();
        if (!$contentType) {
            return FALSE;
        }
        $fields = $this->getFieldsByTypeId($contentType->id, 0, 1);

        if (!$fields) {
            return FALSE;
        }

        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit);

        $contents = array();

        $this->db->select('contents.*,content_groups.name AS groups');
        $this->db->join('content_groups', 'content_groups.id = contents.group_id', 'LEFT');
        $contentRows = $this->db->get_where('contents', array('contents.type_id' => $contentType->id))->result();

        $default_language_id = $this->db->get_where('languages', array('is_admin' => 1))->row('id');
        $default_language_id = (empty($default_language_id)) ? 1 : $default_language_id;

        if (isset($contentRows) && count($contentRows)) {
            $i = 0;
            foreach ($contentRows as $contentRow) {
                $contents[$i] = new stdClass();

                $contents[$i]->id = $contentRow->id;
                $contents[$i]->group_id = $contentRow->group_id;
                $contents[$i]->groups = $contentRow->groups;
                $contents[$i]->user_id = $contentRow->user_id;
                $contents[$i]->status = $contentRow->status;
                $contents[$i]->modified = $contentRow->modified;
                $contents[$i]->timestamp = $contentRow->timestamp;
                $contents[$i]->access = $contentRow->access;
                $contents[$i]->alias = $contentRow->alias;

                $valueRows = $this->getContentFieldsValue($contentRow->id, $fields, $default_language_id);

                if (count($valueRows)) {
                    foreach ($valueRows as $valueRow) {
                        $contents[$i]->{$valueRow->name} = $valueRow->value;
                    }
                }
                $i++;
            }
        }

        return $contents;
    }

    public function saveContent($data) {

        if (!is_array($data) || !count($data)) {
            return false;
        }

        if (isset($data['id']) && $data['id'] > 0) {

            if (count($data['fields'])) {
                $content_values = array();

                $data['access'] = implode(',', $data['access']);
                $this->db->where('id', $data['id']);
                $this->db->update('contents', array(
                    'alias' => $data['alias'],
                    'status' => $data['status'],
                    'group_id' => $data['group_id'],
                    'access' => $data['access'],
                    'modified' => date('Y-m-d H:i:s')
                ));


                foreach ($data['fields'] as $field_id => $value) {

                    $this->db->where('language_id', $data['language_id']);
                    $this->db->where('content_id', $data['id']);
                    $this->db->where('field_id', $field_id);

                    if (!$this->db->delete('content_field_values')) {
                        return FALSE;
                    }


                    if (!$this->db->insert('content_field_values', array(
                                'language_id' => $data['language_id'],
                                'content_id' => $data['id'],
                                'field_id' => $field_id,
                                'value' => $value,
                            ))) {
                        return FALSE;
                    }
                }
            }
            return true;
        } else {

            if (!empty($_FILES) && count($_FILES)) {
                $files = array();
                $this->load->library('upload');
                foreach ($_FILES as $key => $file) {
                    $breakKey = explode("_", $key);
                    $field_id = $breakKey[1];
                    $this->upload->initialize($this->_set_upload_options());
                    if (!$this->upload->do_upload($key)) {
                        $files[$field_id]['error'] = $this->upload->display_errors();
                    }
                    $uploadData = $this->upload->data();


                    $data['fields'][$field_id] = 'media/contents/files/' . $uploadData['file_name'];
                }
            }

            if (isset($data['fields']) && count($data['fields'])) {
                $content_values = array();
                $data['access'] = implode(',', $data['access']);
                $nextId = $this->db->query("SHOW TABLE STATUS LIKE '" . $this->db->dbprefix('contents') . "' ")->row('Auto_increment');
                $content = array(
                    'type_id' => $data['type_id'],
                    'alias' => (empty($data['alias'])) ? rtrim($data['type'], 's') . "-" . $nextId : $data['alias'],
                    'status' => 1,
                    'group_id' => (isset($data['group_id'])) ? $data['group_id'] : 0,
                    'user_id' => user::id(),
                    'access' => $data['access'],
                    'modified' => date('Y-m-d H:i:s')
                );
                $this->db->insert('contents', $content);
                $content_id = $this->db->insert_id();
                if (!$content_id) {
                    return FALSE;
                }
                foreach ($data['fields'] as $field_id => $value) {

                    if (!$this->db->insert('content_field_values', array(
                                'language_id' => $data['language_id'],
                                'content_id' => $content_id,
                                'field_id' => $field_id,
                                'value' => $value,
                            ))) {
                        return FALSE;
                    }
                }
            }
            return true;
        }
    }

    private function _set_upload_options() {

        $config = array();
        $config['upload_path'] = './media/contents/files';
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size'] = '51200';
        $config['encrypt_name'] = true;

        return $config;
    }

    public function getFieldGroups($type_id) {

        $this->db->order_by('content_field_groups.ordering');
        $this->db->where('content_field_groups.enabled', 1);
        $this->db->select('content_field_groups.id,content_field_groups.name');
        $this->db->join('content_field_groups', 'content_field_groups.id = content_type_x_fields.group_id');
        return $this->db->get_where('content_type_x_fields', array('content_type_x_fields.type_id' => $type_id))->result();
    }

    public function getLanguages($select = '*', $where = array(), $offset = 0, $limit = 25, $count = FALSE) {

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

        return $this->db->get('languages')->{$c}();
    }

    public function getLanguageById($language_id) {
        return $this->db->get_where('languages', array('id' => $language_id))->row();
    }

    public function getAdminLanguage() {
        $lang = $this->db->get_where('languages', array('is_admin' => 1))->row('directory');
        return empty($lang) ? 'english' : $lang;
    }

    public function getSiteLanguage() {

        $lang = $this->db->get_where('languages', array('is_default' => 1))->row('directory');
        return empty($lang) ? 'english' : $lang;
    }

    public function getSiteLanguages() {
        return $this->db->select('name,directory')->get_where('languages', array('status' => 1))->result();
    }

    public function getActiveLanguageCode() {

        $user_lang = $this->session->userdata('user_lang');
        if (isset($user_lang) && !empty($user_lang)) {
            $code = $this->db->get_where('languages', array('directory' => $user_lang))->row('code');
        } else {
            $uri = & load_class('URI', 'core');
            $admin = $uri->segment(1);
            $is_admin = ($admin == 'administrator' || $admin == 'admin') ? true : false;
            $state = ($is_admin) ? 'is_admin' : 'is_default';
            $code = $this->db->get_where('languages', array($state => 1))->row('code');
        }

        return empty($code) ? 'en' : $code;
    }

    public function getActiveLanguageName() {

        $user_lang = $this->session->userdata('user_lang');
        if (isset($user_lang) && !empty($user_lang)) {
            $name = $this->db->get_where('languages', array('directory' => $user_lang))->row('name');
        } else {
            $uri = & load_class('URI', 'core');
            $admin = $uri->segment(1);
            $is_admin = ($admin == 'administrator' || $admin == 'admin') ? true : false;
            $state = ($is_admin) ? 'is_admin' : 'is_default';
            $name = $this->db->get_where('languages', array($state => 1))->row('name');
        }

        return empty($name) ? 'English' : $name;
    }

    public function getActiveLanguageId() {

        $user_lang = $this->session->userdata('user_lang');
        if (isset($user_lang) && !empty($user_lang)) {
            $id = $this->db->get_where('languages', array('directory' => $user_lang))->row('id');
        } else {
            $uri = & load_class('URI', 'core');
            $admin = $uri->segment(1);
            $is_admin = ($admin == 'administrator' || $admin == 'admin') ? true : false;
            $state = ($is_admin) ? 'is_admin' : 'is_default';
            $id = $this->db->get_where('languages', array($state => 1))->row('id');
        }

        return empty($id) ? 1 : $id;
    }

    public function saveLanguage($data) {

        if (!is_array($data) || !count($data)) {
            return false;
        }
        if (isset($data['is_default']) && (int) $data['is_default']) {
            $this->db->update('languages', array('is_default' => 0));
        }
        if (isset($data['is_admin']) && $data['is_admin']) {
            $this->db->update('languages', array('is_admin' => 0));
        }

        if (isset($data['id']) && $data['id'] > 0) {
            return $this->db->update('languages', $data, array('id' => $data['id']));
        } else {
            return $this->db->insert('languages', $data);
        }
    }

    public function getTypes($select = '*', $where = array(), $offset = 0, $limit = 25, $count = FALSE) {

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

        return $this->db->get('content_types')->{$c}();
    }

    public function getTypeById($type_id) {
        return $this->db->get_where('content_types', array('id' => $type_id))->row();
    }

    public function getFieldsetsByTypeId($type_id) {
        $rows = $this->db->select('group_id')->get_where('content_type_x_fields', array('type_id' => $type_id))->result();
        $groups = array();
        if ($rows && count($rows)) {
            foreach ($rows as $row) {
                $groups[] = $row->group_id;
            }
        }
        return $groups;
    }

    public function getTypeByAlias($alias) {
        return $this->db->get_where('content_types', array('alias' => $alias))->row();
    }

    public function getTypeNameByAlias($alias) {
        $name = $this->db->select('name')->get_where('content_types', array('alias' => $alias))->row('name');
        return (empty($name)) ? 'Pages' : $name;
    }

    private function _getTypeUrlById($type_id) {
        $name = $this->db->select('alias')->get_where('content_types', array('id' => $type_id))->row('alias');
        $name = (empty($name)) ? 'pages' : strtolower($name);
        if (rtrim($name, 's')) {
            return rtrim($name, 's') . '-';
        } else {
            return $name . '-';
        }
    }

    public function saveType($data) {

        if (!is_array($data) || !count($data)) {
            return false;
        }
        if (isset($data['alias']) && empty($data['alias'])) {
            $data['alias'] = label_key($data['name']);
        } else {
            $data['alias'] = label_key($data['alias']);
        }

        $data['access'] = implode(',', $data['access']);

        if (isset($data['id']) && $data['id'] > 0) {

            if (isset($data['fieldset']) && count($data['fieldset'])) {
                $this->db->delete('content_type_x_fields', array('type_id' => $data['id']));
                foreach ($data['fieldset'] as $fieldset) {
                    $fieldsData[] = array(
                        'type_id' => $data['id'],
                        'group_id' => $fieldset,
                    );
                }
                $this->db->insert_batch('content_type_x_fields', $fieldsData);
            }
            unset($data['fieldset']);
            return $this->db->update('content_types', $data, array('id' => $data['id']));
        } else {
            $fieldsetA = $data['fieldset'];
            unset($data['id']);
            unset($data['fieldset']);

            $this->db->insert('content_types', $data);
            $type_id = $this->db->insert_id();
            if (isset($fieldsetA) && count($fieldsetA)) {
                foreach ($fieldsetA as $fieldset) {
                    $fieldsData[] = array(
                        'type_id' => $type_id,
                        'group_id' => $fieldset,
                    );
                }
                $this->db->insert_batch('content_type_x_fields', $fieldsData);
            }
            return TRUE;
        }
    }

    public function types_A($have_groups = false) {

        $where['enabled'] = 1;
        if ($have_groups) {
            $where['have_groups'] = 1;
        }
        $rows = $this->getTypes('id,name', $where);
        $array = array();
        if (count($rows)) {
            foreach ($rows as $row) {
                $array[$row->id] = $row->name;
            }
        }
        return $array;
    }

    public function getGroups($select = '*', $where = array(), $offset = 0, $limit = 25, $count = FALSE) {

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
        $return = $this->db->get('content_groups')->{$c}();

        return $return;
    }

    public function getGroupsTree($type, $level = 0, $prefix = '') {

        $rows = $this->db
                ->select('id,parent,name,enabled,system')
                ->where('type', $type)
                ->where('parent', $level)
                ->order_by('id', 'asc')
                ->get('content_groups')
                ->result();

        $array = array();
        if (count($rows)) {
            foreach ($rows as $row) {
                $array[] = array(
                    'id' => $row->id,
                    'parent' => $row->parent,
                    'name' => $prefix . $row->name,
                    'enabled' => $row->enabled,
                    'system' => $row->system,
                );
                $array = array_merge($array, $this->getGroupsTree($type, $row->id, $prefix . '&nbsp;&nbsp;&nbsp;'));
            }
        }
        return $array;
    }

    public function getGroupsMenu($type, $level = 0, $recursive = 0, $html = '') {

        $rows = $this->db
                ->select('id,parent,name,alias')
                ->where('type', $type)
                ->where('parent', $level)
                ->where('enabled', 1)
                ->order_by('id', 'asc')
                ->get('content_groups')
                ->result();


        if (count($rows)) {
            $html .= ($recursive) ? '<ul class="sub-menu list-unstyled">' : '<ul class="list-group list-unstyled">';
            foreach ($rows as $row) {

                $html .= '<li>';
                $html .= anchor($row->alias, $row->name);
                $recursive++;
                $html .= $this->getGroupsMenu($type, $row->id, $recursive);
                $html .= '</li>';
            }
            $html .= '</ul>';
        }
        return $html;
    }

    public function getGroupChilds($type, $level = 0) {

        $rows = $this->db
                ->select('id')
                ->where('type', $type)
                ->where('parent', $level)
                ->where('enabled', 1)
                ->order_by('id', 'asc')
                ->get('content_groups')
                ->result();

        $array = array();
        if (count($rows)) {
            foreach ($rows as $row) {

                $array[] = $row->id;
                $array = array_merge($array, $this->getGroupChilds($type, $row->id));
            }
        }
        return $array;
    }

    public function getGroupByAlias($alias) {
        return $this->db->get_where('content_groups', array('alias' => $alias))->row();
    }

    public function getGroupById($group_id) {
        return $this->db->get_where('content_groups', array('id' => $group_id))->row();
    }

    public function saveGroup($data) {

        if (!is_array($data) || !count($data)) {
            return false;
        }
        if (isset($data['alias']) && empty($data['alias'])) {
            $data['alias'] = label_key($data['name']);
        } else {
            $data['alias'] = label_key($data['alias']);
        }

        $data['access'] = implode(',', $data['access']);

        unset($data['return']);

        if (isset($data['id']) && $data['id'] > 0) {
            return $this->db->update('content_groups', $data, array('id' => $data['id']));
        } else {
            unset($data['id']);
            return $this->db->insert('content_groups', $data);
        }
    }

    public function groups_A($type = 1) {
        $rows = $this->getGroups('id,name', array('type' => $type));
        $array = array();
        if (count($rows)) {
            foreach ($rows as $row) {
                $array[$row->id] = $row->name;
            }
        }
        if (!count($array)) {
            $array['0'] = '--Uncategories--';
        }
        return $array;
    }

    public function getGroupsOptionTree($type = 1, $level = 0, $active = 0, $prefix = '') {

        $rows = $this->db
                ->select('id,parent,name')
                ->where('type', $type)
                ->where('parent', $level)
                ->order_by('name', 'asc')
                ->get('content_groups')
                ->result();

        $category = NULL;
        if (count($rows)) {
            foreach ($rows as $row) {
                $selected = ($row->id == $active) ? 'selected="selected"' : '';
                $category .= '<option value="' . $row->id . '" ' . $selected . '>';
                $category .= $prefix . $row->name . "\n";
                $category .= '</option>';
                $category .= $this->getGroupsOptionTree($type, $row->id, $active, $prefix . '--');
            }
        }

        return $category;
    }

    public function getFieldSets() {
        return $this->db->get('content_field_groups')->result();
    }

    public function getFieldsetById($fieldset_id) {
        return $this->db->get_where('content_field_groups', array('id' => $fieldset_id))->row();
    }

    public function getFieldsetNameById($fieldset_id) {
        return $this->db->get_where('content_field_groups', array('id' => $fieldset_id))->row('name');
    }

    public function saveFieldset($data) {

        if (!is_array($data) || !count($data)) {
            return false;
        }

        $data['access'] = implode(',', $data['access']);

        if (isset($data['id']) && $data['id'] > 0) {
            return $this->db->update('content_field_groups', $data, array('id' => $data['id']));
        } else {
            return $this->db->insert('content_field_groups', $data);
        }
    }

    public function getFields($select = '*', $where = array(), $offset = 0, $limit = 25, $count = FALSE) {

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
        $return = $this->db->get('content_fields')->{$c}();

        return $return;
    }

    public function fieldset_A($type = 1) {
        $this->db->order_by('id', 'DESC');
        $rows = $this->db->get_where('content_field_groups', array('enabled' => 1))->result();
        $array = array();
        if (count($rows)) {
            foreach ($rows as $row) {
                $array[$row->id] = $row->name;
            }
        }
        if (!count($array)) {
            $array['1'] = '--Default--';
        }
        return $array;
    }

    public function getFieldById($field_id) {
        return $this->db->get_where('content_fields', array('id' => $field_id))->row();
    }

    public function saveField($data) {

        if (!is_array($data) || !count($data)) {
            return false;
        }

        $data['access'] = implode(',', $data['access']);
        $data['name'] = preg_replace('/[^a-z0-9]/i', '_', strtolower($data['name']));

        if (isset($data['id']) && $data['id'] > 0) {

            if (isset($data['options']) && count($data['options'])) {

                $options = $data['options'];
                unset($data['options']);

                $this->db->update('content_fields', $data, array('id' => $data['id']));
                $default_value = (isset($data['default_value'])) ? $data['default_value'] : '';
                $saveMethod_name = 'save' . ucfirst($data['type']) . 'Options';
                if (method_exists($this, $saveMethod_name)) {
                    call_user_func(array($this, $saveMethod_name), $data['id'], $options, $default_value, true);
                }

                return $data['id'];
            } else {
                $this->db->update('content_fields', $data, array('id' => $data['id']));
                return $data['id'];
            }
        } else {

            unset($data['id']);
            if (isset($data['options']) && count($data['options'])) {

                $options = $data['options'];
                unset($data['options']);

                if ($this->db->insert('content_fields', $data)) {
                    $fieldId = $this->db->insert_id();
                    $default_value = (isset($data['default_value'])) ? $data['default_value'] : '';
                    $saveMethod_name = 'save' . ucfirst($data['type']) . 'Options';
                    if (method_exists($this, $saveMethod_name)) {
                        call_user_func(array($this, $saveMethod_name), $fieldId, $options, $default_value);
                    }
                    return $fieldId;
                }
            } else {
                $this->db->insert('content_fields', $data);
                return $this->db->insert_id();
            }
        }
    }

    private function saveSelectOptions($field_id, $options, $default = '', $edit = false) {
        if (!count($options)) {
            AZ::flashMSG(__('no_option'));
            return FALSE;
        }


        if ($edit) {
            $this->db->delete('content_field_options', array('field_id' => (int) $field_id));
        }
        foreach ($options['title'] as $key => $title) {
            $value = (isset($options['value'][$key])) ? $options['value'][$key] : '';
            $is_default = ($default == $value) ? 1 : 0;

            $field_options[] = array(
                'field_id' => $field_id,
                'value' => $value,
                'title' => $title,
                'is_default' => $is_default
            );
        }

        $this->db->insert_batch('content_field_options', $field_options);
        return TRUE;
    }

    private function saveCheckboxOptions($field_id, $options, $default = '', $edit = false) {

        if (!count($options)) {
            AZ::flashMSG(__('no_option'));
            return FALSE;
        }

        if ($edit) {
            $this->db->delete('content_field_options', array('field_id' => (int) $field_id));
        }
        foreach ($options['title'] as $key => $title) {
            $value = (isset($options['value'][$key])) ? $options['value'][$key] : '';
            $is_default = ($default == $value) ? 1 : 0;

            $field_options[] = array(
                'field_id' => $field_id,
                'value' => $value,
                'title' => $title,
                'is_default' => $is_default
            );
        }

        $this->db->insert_batch('content_field_options', $field_options);
        return TRUE;
    }

    private function saveRadioOptions($field_id, $options, $default = '', $edit = false) {

        if (!count($options) || !(int) $field_id) {
            AZ::flashMSG(__('no_option'));
            return FALSE;
        }

        if ($edit) {
            $this->db->delete('content_field_options', array('field_id' => (int) $field_id));
        }
        foreach ($options['title'] as $key => $title) {
            $value = (isset($options['value'][$key])) ? $options['value'][$key] : '';
            $is_default = ($default == $value) ? 1 : 0;

            $field_options[] = array(
                'field_id' => $field_id,
                'value' => $value,
                'title' => $title,
                'is_default' => $is_default
            );
        }

        $this->db->insert_batch('content_field_options', $field_options);
        return TRUE;
    }

    private function saveBoolenOptions($field_id, $options, $default = '', $edit = false) {

        if (!count($options) || !(int) $field_id) {
            AZ::flashMSG(__('no_option'));
            return FALSE;
        }

        if ($edit) {
            $this->db->delete('content_field_options', array('field_id' => (int) $field_id));
        }

        foreach ($options['title'] as $key => $title) {
            $value = (isset($options['value'][$key])) ? $options['value'][$key] : '';
            $is_default = ($default == $value) ? 1 : 0;

            $field_options[] = array(
                'field_id' => $field_id,
                'value' => $value,
                'title' => $title,
                'is_default' => $is_default
            );
        }

        $this->db->insert_batch('content_field_options', $field_options);
        return TRUE;
    }

    public function track() {
        if (!$this->session->userdata('visited') && $_SERVER['REMOTE_ADDR'] != '::1') {
            AZ::helper('date');
            
            $this->load->library('user_agent');
            $visitData = array(
                'ip' => $_SERVER['REMOTE_ADDR'],
                'is_mobile' => $this->agent->is_mobile(),
                'platform' => $this->agent->platform(),
                'is_browser' => $this->agent->is_browser(),
                'browser' => $this->agent->browser(),
                'browser_version' => $this->agent->version(),
                'device' => $this->agent->mobile(),
                'refer' => $this->agent->referrer(),
                'page' => $this->uri->uri_string(),
                'logged' => user::id()
            );
            
            return $this->db->insert('visitors', $visitData);
            
        }
    }

}

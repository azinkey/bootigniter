<?php

class Message extends CI_Model {

    public function getTotalNotifications($type = 1) {
        return $this->db->get_where('messages', array('type' => $type, 'trash' => 0))->num_rows();
    }

    public function getTotalMessages($type = 2) {
        return $this->db->get_where('messages', array('type' => $type, 'trash' => 0))->num_rows();
    }

    public function read_all_notifications() {

        $this->db->where('receiver', user::id());
        $this->db->where('type', 1);
        return $this->db->update('messages', array('is_read' => 1));
    }

    public function getUserNotifications($select = '*', $where = array(), $offset = 0, $limit = 10, $count = FALSE) {

        if (!user::id()) {
            return FALSE;
        }

        $c = ($count == FALSE) ? 'result' : 'num_rows';

        $this->db->where('type', 1);

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
        
        $this->db->order_by('created','DESC');
        
        $return = $this->db->get('messages')->{$c}();

        return $return;
    }

    public function getActivities($select = '*', $where = array(), $offset = 0, $limit = 5, $count = FALSE) {

        if (!user::id()) {
            return FALSE;
        }

        $c = ($count == FALSE) ? 'result' : 'num_rows';

        $this->db->where('type', 0);

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
        $return = $this->db->get('messages')->{$c}();

        return $return;
    }

    public function getMessages($select = 'users.name,messages.*', $where = array(), $offset = 0, $limit = 10, $count = FALSE) {

        if (!user::id()) {
            return FALSE;
        }

        $c = ($count == FALSE) ? 'result' : 'num_rows';

        $this->db->where('type', 2);
        $this->db->select('labels.label AS label_name,labels.color');

        if (is_array($where) && count($where)) {
            $this->db->where($where);
        }

        if ($select != '*' && !empty($select)) {
            $this->db->select($select);
        }

        $this->db->join('users', 'users.id = messages.author');
        $this->db->join('labels', 'labels.id = messages.label', 'LEFT');

        $this->db->order_by('messages.id', 'DESC');

        $this->db
                ->offset($offset);

        if (!$count) {
            $this->db->limit($limit);
        }
        $return = $this->db->get('messages')->{$c}();

        return $return;
    }

    public function saveMessage($data) {

        if (!is_array($data) || !count($data)) {
            return false;
        }
        $message = array();
        if (count($data['users'])) {
            $i = 0;
            foreach ($data['users'] as $user) {
                $message[$i] = array(
                    'receiver' => $user,
                    'type' => 2,
                    'author' => $data['author'],
                    'subject' => $data['subject'],
                    'body' => $data['body'],
                );
                $i++;
            }
        } else {
            return false;
        }
        $this->db->insert_batch('messages', $message);
        return true;
    }

    public function getLabels($type = 1) {
        $rows = $this->db->select('id,label,color')->get_where('labels', array('groups' => $type))->result();
        return $rows;
    }

    public function saveLabel($data) {

        if (!is_array($data) || !count($data)) {
            return false;
        }
        unset($data['mode']);

        if (isset($data['id']) && $data['id'] > 0) {
            return $this->db->update('labels', $data, array('id' => $data['id']));
        } else {
            return $this->db->insert('labels', $data);
        }
    }

    public function getMessageById($message_id, $mode = 'inbox') {

        switch ($mode) {

            case 'inbox':
                if (!$message_id) {
                    $last_message = $this->getMessages('messages.id', array('messages.trash' => 0, 'messages.receiver' => user::id()), 0, 1);
                    $message_id = ($last_message && count($last_message) && isset($last_message[0]->id)) ? $last_message[0]->id : 0;
                }
                $this->db->join('users', 'users.id = messages.author');
                break;

            case 'stared':
                if (!$message_id) {
                    $last_message = $this->getMessages('messages.id', array('messages.trash' => 0, 'messages.is_star' => 1, 'messages.receiver' => user::id()), 0, 1);
                    $message_id = ($last_message && count($last_message) && isset($last_message[0]->id)) ? $last_message[0]->id : 0;
                }
                $this->db->join('users', 'users.id = messages.author');
                break;

            case 'outbox':
                if (!$message_id) {
                    $last_message = $this->getMessages('messages.id', array('messages.trash' => 0, 'messages.author' => user::id()), 0, 1);
                    $message_id = ($last_message && count($last_message) && isset($last_message[0]->id)) ? $last_message[0]->id : 0;
                }
                $this->db->join('users', 'users.id = messages.receiver');
                break;

            case 'trash':
                if (!$message_id) {
                    $last_message = $this->getMessages('messages.id', array('messages.trash' => 1, 'messages.receiver' => user::id()), 0, 1);
                    $message_id = ($last_message && count($last_message) && isset($last_message[0]->id)) ? $last_message[0]->id : 0;
                }
                $this->db->join('users', 'users.id = messages.author');
                break;

            default:
                if (!$message_id) {
                    $last_message = $this->getMessages('messages.id', array('messages.trash' => 0, 'messages.receiver' => user::id()), 0, 1);
                    $message_id = ($last_message && count($last_message) && isset($last_message[0]->id)) ? $last_message[0]->id : 0;
                }
                $this->db->join('users', 'users.id = messages.author');
                break;
        }

        $this->db->select('labels.label AS label_name,labels.color');
        $this->db->join('labels', 'labels.id = messages.label', 'LEFT');

        return $this->db->select('users.name,users.email,messages.*')->get_where('messages', array('messages.id' => $message_id))->row();
    }

    public function getMessagesByLabel($label, $offset = 0, $limit = 10, $count = FALSE) {

        if (!user::id()) {
            return FALSE;
        }

        $c = ($count == FALSE) ? 'result' : 'num_rows';


        $this->db->join('users', 'users.id = messages.author');
        $this->db->join('labels', 'labels.id = messages.label');

        $this->db->where('messages.receiver', user::id());
        $this->db->where('messages.trash', 0);
        $this->db->where('messages.type', 2);


        $this->db->select('labels.label AS label_name,labels.color');
        $this->db->select('users.name,users.email,messages.*');


        $this->db->order_by('messages.id', 'DESC');

        $this->db
                ->offset($offset);

        if (!$count) {
            $this->db->limit($limit);
        }
        $return = $this->db->get_where('messages', array('messages.label' => $label))->{$c}();

        return $return;
    }

    public function getMessageByLabel($label) {

        if (!user::id()) {
            return FALSE;
        }

        $this->db->join('users', 'users.id = messages.author');
        $this->db->join('labels', 'labels.id = messages.label');

        $this->db->where('messages.receiver', user::id());
        $this->db->where('messages.trash', 0);
        $this->db->where('messages.type', 2);


        $this->db->select('labels.label AS label_name,labels.color');
        $this->db->select('users.name,users.email,messages.*');


        $this->db->order_by('messages.id', 'DESC');

        $this->db
                ->offset(0);

        $this->db->limit(1);

        $return = $this->db->get_where('messages', array('messages.label' => $label))->row();

        return $return;
    }

    public function getMessagesByKeyword($keyword, $offset = 0, $limit = 10, $count = FALSE) {

        if (!user::id() || empty($keyword)) {
            return FALSE;
        }

        $c = ($count == FALSE) ? 'result' : 'num_rows';

        $this->db->join('users', 'users.id = messages.author');
        $this->db->join('labels', 'labels.id = messages.label');

        $this->db->where('messages.receiver', user::id());
        $this->db->where('messages.trash', 0);
        $this->db->where('messages.type', 2);

        $words = explode(" ", $keyword);

        if (count($words)) {
            foreach ($words as $word) {
                $this->db->like('messages.subject', $word);
                $this->db->or_like('messages.body', $word);
            }
        }

        $this->db->select('labels.label AS label_name,labels.color');
        $this->db->select('users.name,users.email,messages.*');


        $this->db->order_by('messages.id', 'DESC');

        $this->db
                ->offset($offset);

        if (!$count) {
            $this->db->limit($limit);
        }
        $return = $this->db->get('messages')->{$c}();

        return $return;
    }

    public function getMessageByKeyword($keyword) {

        if (!user::id()) {
            return FALSE;
        }


        $this->db->join('users', 'users.id = messages.author');
        $this->db->join('labels', 'labels.id = messages.label');

        $this->db->where('messages.receiver', user::id());
        $this->db->where('messages.trash', 0);
        $this->db->where('messages.type', 2);

        $this->db->like('messages.subject', $keyword);
        $this->db->or_like('messages.body', $keyword);

        $this->db->select('labels.label AS label_name,labels.color');
        $this->db->select('users.name,users.email,messages.*');


        $this->db->order_by('messages.id', 'DESC');

        $this->db
                ->offset(0);

        $this->db->limit(1);

        $return = $this->db->get('messages')->row();

        return $return;
    }

    public function getMessagesData($mode = 'inbox', $message_id = 0, $offset = 0) {

        switch ($mode) {
            case 'inbox':
                $limit = AZ::setting('record_per_page');
                $total_message = $this->getMessages('*', array('messages.trash' => 0, 'messages.receiver' => user::id()), 0, 0, true);

                $pagination = AZ::pagination('admin/dashboard/messages/' . $mode . '/' . $message_id, 6, $limit, $total_message);

                $messages = $this->getMessages('users.name,messages.id,messages.label,messages.is_read,messages.is_star,messages.subject,messages.body,messages.created,messages.author,messages.have_attachment', array('messages.trash' => 0, 'messages.receiver' => user::id()), $offset, $limit);

                break;

            case 'stared':
                $limit = AZ::setting('record_per_page');
                $total_message = $this->getMessages('*', array(
                    'messages.trash' => 0,
                    'messages.is_star' => 1,
                    'messages.receiver' => user::id()
                        ), 0, 0, true);

                $pagination = AZ::pagination('admin/dashboard/messages/' . $mode . '/' . $message_id, 6, $limit, $total_message);

                $messages = $this->getMessages('users.name,messages.id,messages.label,messages.is_read,messages.is_star,messages.subject,messages.body,messages.created,messages.author,messages.have_attachment', array(
                    'messages.trash' => 0,
                    'messages.is_star' => 1,
                    'messages.receiver' => user::id()
                        ), $offset, $limit);

                break;

            case 'outbox':
                $limit = AZ::setting('record_per_page');
                $total_message = $this->getMessages('*', array(
                    'messages.trash' => 0,
                    'messages.author' => user::id()
                        ), 0, 0, true);

                $pagination = AZ::pagination('admin/dashboard/messages/' . $mode . '/' . $message_id, 6, $limit, $total_message);

                $messages = $this->getMessages('users.name,messages.id,messages.label,messages.is_read,messages.is_star,messages.subject,messages.body,messages.created,messages.author,messages.have_attachment', array(
                    'messages.trash' => 0,
                    'messages.author' => user::id()
                        ), $offset, $limit);

                break;
            case 'trash':
                $limit = AZ::setting('record_per_page');
                $total_message = $this->getMessages('*', array(
                    'messages.trash' => 1,
                    'messages.receiver' => user::id()
                        ), 0, 0, true);

                $pagination = AZ::pagination('admin/dashboard/messages/' . $mode . '/' . $message_id, 6, $limit, $total_message);

                $messages = $this->getMessages('users.name,messages.id,messages.label,messages.is_read,messages.is_star,messages.subject,messages.body,messages.created,messages.author,messages.have_attachment', array(
                    'messages.trash' => 1,
                    'messages.receiver' => user::id()
                        ), $offset, $limit);

                break;



            default:
                $limit = AZ::setting('record_per_page');
                $total_message = $this->getMessages('*', array('messages.trash' => 0, 'messages.receiver' => user::id()), 0, 0, true);

                $pagination = AZ::pagination('admin/dashboard/messages/' . $mode . '/' . $message_id, 6, $limit, $total_message);

                $messages = $this->getMessages('users.name,messages.id,messages.label,messages.is_read,messages.is_star,messages.subject,messages.body,messages.created,messages.author,messages.have_attachment', array('messages.trash' => 0, 'messages.receiver' => user::id()), $offset, $limit);

                break;
        }

        $messagesData = array(
            'total_message' => $total_message,
            'pagination' => $pagination,
            'messages' => $messages,
        );

        return $messagesData;
    }

}

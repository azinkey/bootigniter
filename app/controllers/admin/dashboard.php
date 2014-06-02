<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {

        parent::__construct();
        user::redirectUnauthorizedAccess('administrator/login', lang('Unauthorized access'), true);

        AZ::model('message');
        AZ::model('content');
        AZ::helper('form');
        AZ::helper('text');
        
    }

    public function index() {
        
        $total_users = $this->user->getTotalUsers();
        $total_messages = $this->message->getTotalMessages();
        $total_notification = $this->message->getTotalNotifications();

        $activities = $this->message->getActivities();
        $messages = $this->message->getMessages('*', array('messages.trash' => 0, 'messages.receiver' => user::id()), 0, 10);

        AZ::layout('left-content', array(
            'block' => 'dashboard/index',
            'total_users' => $total_users,
            'total_messages' => $total_messages,
            'total_notification' => $total_notification,
            'activities' => $activities,
            'messages' => $messages,
            'scripts' => array(
                'scripts/jquery.flot.min.js',
                'scripts/jquery.flot.categories.min.js',
                'scripts/jquery.flot.tooltip.min.js',
                'scripts/jquery.flot.resize.min.js',
                'scripts/jquery.flot.spline.min.js',
            )
        ));
    }

    public function notifications($offset = 0) {

        $limit = AZ::setting('record_per_page');
        $total_notification = $this->message->getUserNotifications('*', array('trash' => 0, 'type' => 1, 'receiver' => user::id()), 0, 0, true);
        $pagination = AZ::pagination('admin/dashboard/notifications', 4, $limit, $total_notification);

        $notifications = $this->message->getUserNotifications('id,label,is_read,is_star,subject,body,created', array('trash' => 0, 'type' => 1, 'receiver' => user::id()), $offset, $limit);

        AZ::layout('left-content', array(
            'block' => 'messages/notifications',
            'notifications' => $notifications,
            'total_notification' => $total_notification,
            'pagination' => $pagination,
        ));


        $this->message->read_all_notifications();
    }

    public function remove_notification($id) {

        $this->db->where('id', (int) $id);
        if ($this->db->update('messages', array('trash' => 1))) {
            AZ::redirectSuccess('admin/dashboard/notifications', lang('Notification removed successfully'));
        } else {
            AZ::redirectError('admin/dashboard/notifications', lang('Error occured'));
        }
    }

    public function clear_notice() {

        if ($this->message->read_all_notifications()) {
            AZ::redirectSuccess('admin/dashboard', lang('Clear notification'));
        } else {
            AZ::redirectError('admin/dashboard', lang('Error occured'));
        }
    }

    public function messages($mode = 'inbox', $message_id = 0, $offset = 0) {

        $messagesData = $this->message->getMessagesData($mode, $message_id, $offset);

        $labels = $this->message->getLabels();
        $selected_message = $this->message->getMessageById($message_id, $mode);

        $count_unread_message = $this->message->getMessages('*', array('messages.trash' => 0, 'messages.is_read' => 0, 'messages.receiver' => user::id()), 0, 0, true);

        AZ::layout('left-content', array(
            'block' => 'messages/index',
            'mode' => $mode,
            'labels' => $labels,
            'selected_message' => $selected_message,
            'messages' => $messagesData['messages'],
            'total_message' => $messagesData['total_message'],
            'pagination' => $messagesData['pagination'],
            'count_unread_message' => $count_unread_message,
        ));

        $this->db->update('messages', array('is_read' => 1), array('id' => $selected_message->id));
    }

    public function label_messages($label = '1', $message_id = 0, $offset = 0) {

        $limit = AZ::setting('record_per_page');
        $total_message = $this->message->getMessagesByLabel($label, $offset, $limit, true);
        $pagination = AZ::pagination('admin/dashboard/label_messages/' . $label . '/' . $message_id, 6, $limit, $total_message);

        $messages = $this->message->getMessagesByLabel($label, $offset, $limit);

        $labels = $this->message->getLabels();
        $selected_message = $this->message->getMessageByLabel($label);

        $count_unread_message = $this->message->getMessages('*', array('messages.trash' => 0, 'messages.is_read' => 0, 'messages.receiver' => user::id()), 0, 0, true);

        AZ::layout('left-content', array(
            'block' => 'messages/label',
            'label_id' => $label,
            'labels' => $labels,
            'selected_message' => $selected_message,
            'messages' => $messages,
            'total_message' => $total_message,
            'pagination' => $pagination,
            'count_unread_message' => $count_unread_message,
        ));

        $this->db->update('messages', array('is_read' => 1), array('id' => $selected_message->id));
    }

    public function search_messages($keyword = '', $message_id = 0, $offset = 0) {

        $post = $this->input->post();
        if (!isset($post['keyword'])) {
            return false;
        }
        if (empty($keyword)) {
            $keyword = trim($post['keyword']);
        }
        $limit = AZ::setting('record_per_page');
        $total_message = $this->message->getMessagesByKeyword($keyword, $offset, $limit, true);
        $pagination = AZ::pagination('admin/dashboard/search_messages/', 5, $limit, $total_message);
        $messages = $this->message->getMessagesByKeyword($keyword, $offset, $limit);
        $labels = $this->message->getLabels();
        $selected_message = $this->message->getMessageByKeyword($keyword);
        $count_unread_message = $this->message->getMessages('*', array('messages.trash' => 0, 'messages.is_read' => 0, 'messages.receiver' => user::id()), 0, 0, true);
        AZ::layout('left-content', array(
            'block' => 'messages/search',
            'keyword' => $keyword,
            'labels' => $labels,
            'messages' => $messages,
            'selected_message' => $selected_message,
            'total_message' => $total_message,
            'pagination' => $pagination,
            'count_unread_message' => $count_unread_message,
        ));
    }

    public function write_message($message_id = 0) {

        if ($message_id) {
            $message = $this->message->getMessageById($message_id);
            $to_user = (isset($message->author)) ? $message->author : NULL;
        } else {
            $to_user = NULL;
        }

        $user_options = $this->user->getUserOptions();

        AZ::layout('left-content', array(
            'block' => 'messages/form',
            'user_options' => $user_options,
            'message_id' => $message_id,
            'to_user' => $to_user,
            'scripts' => array(
                'scripts/chosen.jquery.js',
            ),
            'styles' => array(
                'css/chosen.css',
            )
        ));
    }

    public function forward_message($message_id) {

        $user_options = $this->user->getUserOptions();
        $message = $this->message->getMessageById($message_id);

        AZ::layout('left-content', array(
            'block' => 'messages/forward-form',
            'user_options' => $user_options,
            'message' => $message,
            'scripts' => array(
                'scripts/chosen.jquery.js',
            ),
            'styles' => array(
                'css/chosen.css',
            )
        ));
    }

    public function send_message() {

        $post = $this->input->post();

        if (!$post || !count($post)) {
            return FALSE;
        }

        $this->load->library('form_validation');
        $this->form_validation->set_rules('users[]', lang('User'), 'trim|required');
        $this->form_validation->set_rules('subject', lang('Subject'), 'trim|required');
        $this->form_validation->set_rules('body', lang('Message'), 'trim|required');

        if (!$this->form_validation->run()) {
            $return_url = (isset($post['return']) && !empty($post['return'])) ? $post['return'] : 'admin/dashboard/write_message/' . $post['message_id'];
            AZ::redirectError($return_url, validation_errors());
            return false;
        }
        $return_url = (isset($post['return']) && !empty($post['return'])) ? $post['return'] : 'admin/dashboard/messages/';
        if (!$this->message->saveMessage($post)) {
            AZ::redirectError($return_url, lang('Message sent'));
        } else {
            AZ::redirectSuccess($return_url, lang('Error occured'));
        }
    }

    public function save_label() {

        $post = $this->input->post();

        if (!$post || !count($post)) {
            return FALSE;
        }

        $this->load->library('form_validation');
        $this->form_validation->set_rules('label', lang('Label Name'), 'trim|required');

        if (!$this->form_validation->run()) {
            AZ::redirectError('admin/dashboard/messages/' . $post['mode'], validation_errors());
            return false;
        }

        if (!$this->message->saveLabel($post)) {
            AZ::redirectError('admin/dashboard/messages/' . $post['mode'], lang('Error occured'));
        } else {
            AZ::redirectSuccess('admin/dashboard/messages/' . $post['mode'], lang('Saved'));
        }
    }

    public function remove_label($id) {

        if ($this->db->delete('labels', array('id' => (int) $id, 'user_id' => user::id()))) {
            AZ::redirectSuccess('admin/dashboard/messages', lang('Removed'));
        } else {
            AZ::redirectError('admin/dashboard/messages', lang('Error occured'));
        }
    }

    public function trash_message($id) {

        $this->db->where('id', (int) $id);
        if ($this->db->update('messages', array('trash' => 1))) {
            AZ::redirectSuccess('admin/dashboard/messages', lang('Removed'));
        } else {
            AZ::redirectError('admin/dashboard/messages', lang('Error occured'));
        }
    }

    public function remove_message($id) {

        if ($this->db->delete('messages', array('id' => (int) $id))) {
            AZ::redirectSuccess('admin/dashboard/messages/trash', lang('Removed'));
        } else {
            AZ::redirectError('admin/dashboard/messages/trash', lang('Error occured'));
        }
    }

    public function message_star_flag($id, $flag) {

        $this->db->where('id', (int) $id);
        if ($this->db->update('messages', array('is_star' => ($flag) ? 0 : 1))) {
            AZ::redirectSuccess('admin/dashboard/messages', ($flag) ? lang('unmarked_as_star') : lang('marked_as_star'));
        } else {
            AZ::redirectError('admin/dashboard/messages', lang('update_error'));
        }
    }

    public function message_label($id, $label) {

        $this->db->where('id', (int) $id);
        if ($this->db->update('messages', array('label' => $label))) {
            AZ::redirectSuccess('admin/dashboard/messages', lang('Saved'));
        } else {
            AZ::redirectError('admin/dashboard/messages', lang('Error occured'));
        }
    }

    public function load_activity_json() {
        AZ::helper('date');
        $offset = $this->input->post('offset');
        $activities = $this->message->getActivities('*', array(), $offset, 5);
        $posts = array();
        if (count($activities)) {

            $i = 0;
            foreach ($activities as $activity) {
                $posts[$i] = new stdClass();
                $posts[$i]->subject = $activity->subject;
                $posts[$i]->body = $activity->body;
                $posts[$i]->created = date_when(human_to_unix($activity->created));
                $i++;
            }
        }
        echo json_encode($posts);
    }

}

/* End of file dashboard.php */
/* Location: ./app/controllers/admin/dashboard.php */
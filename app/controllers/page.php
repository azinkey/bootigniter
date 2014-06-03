<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Page extends CI_Controller {

    public function __construct() {
        parent::__construct();
        AZ::model('content');
        //$this->content->track(); // uncomment for enabled self tracking
    }

    public function index() {
        AZ::layout('content', array(
            'block' => 'index',
            'page_title' => __('Bootigniter - Another Open Source CMS, A Pack of Codeigniter + Bootstrap', true)
        ));
    }

    public function content($alias) {

        $activeLanguageId = $this->content->getActiveLanguageId();

        $content = $this->content->getContentByAlias($alias, $activeLanguageId);

        $varriables = array(
            'block' => 'content/page',
            'content' => $content,
        );

        if (isset($content->page_title)) {
            $varriables['page_title'] = $content->page_title;
        }

        AZ::layout('content-right', $varriables);
    }

    public function page_not_found() {
        $this->load->view('page_not_found');
    }

    public function _remap($method) {
        $count_segments = $this->uri->total_segments();
        $segments = $this->uri->segment_array();
        $alias = $this->uri->uri_string();

        switch ($count_segments) {
            case 0:

                $this->index();

                break;
            case 1:
                if ($this->content->checkAlias($alias)) {
                    $this->content($alias);
                } else {
                    $this->page_not_found();
                }

                break;
            case 2:


                break;
            case 3:


                break;

            default:
                $this->page_not_found();
                break;
        }
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
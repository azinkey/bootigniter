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
 * @package		Front
 * @subpackage          Controllers
 * @author		AZinkey
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Page extends CI_Controller {

    public function __construct() {
        parent::__construct();

        // Load Content Model
        AZ::model('content');
        //$this->content->track(); // uncomment for enabled self tracking
    }

    /**
     * Index Page for this controller or site
     *
     * Primary View is views/front/blocks/index
     * 
     * @return	Layout
     */
    public function index() {
        AZ::layout('content', array(
            'block' => 'index',
            'page_title' => __('Bootigniter - Another Open Source CMS, A Pack of Codeigniter + Bootstrap', true)
        ));
    }

    /**
     * Single Content Page By Alias 
     *
     * Primary View is views/front/blocks/content/page
     * 
     * @param	string $alias
     * @return	Layout
     */
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

    /**
     * Showing Customized and Controled 404 Error Page
     *
     * Primary View is views/page_not_found
     * 
     * @return	Layout
     */
    public function page_not_found() {
        $this->load->view('page_not_found');
    }

    /**
     * Check User Request & call associate method
     *
     * 
     * @param	string $method Request Query String
     * @return	Method
     */
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

                $this->page_not_found();
                break;
            case 3:

                $this->page_not_found();
                break;

            default:
                $this->page_not_found();
                break;
        }
    }

}

/* End of file page.php */
/* Location: ./application/controllers/page.php */
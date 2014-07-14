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

        //$this->content->track(); // uncomment for enabled self tracking into Visitors
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
            'block' => 'content/page_' . $content->type_id,
            'content' => $content,
        );

        if (isset($content->page_title)) {
            $varriables['page_title'] = $content->page_title;
        }
        if (isset($content->news_headline)) {
            $varriables['page_title'] = $content->news_headline;
        }

        AZ::layout('content-right', $varriables);

        //$this->content->track(); // uncomment for enabled self tracking into Visitors
    }

    /**
     * Group Category Page By Alias 
     *
     * Primary View is views/front/blocks/content/page
     * 
     * @param	string $alias
     * @return	Layout
     */
    public function group($alias, $offset = 0) {

        $group = $this->content->getGroupByAlias($alias);

        if (!$group || !isset($group->id)) {
            $this->page_not_found();
            return false;
        }


        $total_contents = $this->content->getContentsByGroup($group->id, $group->type, 0, 0, true);
   

        $pagination = AZ::pagination($alias, 2, 5, $total_contents, true);

        $contents = $this->content->getContentsByGroup($group->id, $group->type, $offset, 5);
        
        $varriables = array(
            'block' => 'content/group-contents_' . $group->type,
            'contents' => $contents,
            'total_contents' => $total_contents,
            'pagination' => $pagination,
        );

        if (isset($group->name)) {
            $varriables['page_title'] = $group->name;
        }

        AZ::layout('content-right', $varriables);

        //$this->content->track(); // uncomment for enabled self tracking into Visitors
    }

    /**
     * Group Category Page By Alias 
     *
     * Primary View is views/front/blocks/content/page
     * 
     * @param	string $alias
     * @return	Layout
     */
    public function search($keyword, $offset = 0) {

        $total_contents = $this->content->getContentsByWords($keyword, 0, 0, true);

        $pagination = AZ::pagination('search?words=' . $keyword, 2, 5, $total_contents, true,true);

        $contents = $this->content->getContentsByWords($keyword, $offset, 5);

        $varriables = array(
            'block' => 'content/search',
            'contents' => $contents,
            'total_contents' => $total_contents,
            'pagination' => $pagination,
        );

        if (isset($group->name)) {
            $varriables['page_title'] = 'Search Result for ' . $keyword;
        }

        AZ::layout('content-right', $varriables);

        //$this->content->track(); // uncomment for enabled self tracking into Visitors
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
        $query = $this->input->get();

        switch ($count_segments) {
            case 0:

                $this->index();

                break;
            case 1:

                if ($segments[1] == 'search' && isset($query['words'])) {
                    $this->search($query['words'], (isset($query['per_page'])) ? $query['per_page'] : 0 );
                    return;
                }
                // check Group first
                if ($this->content->checkGroupAlias($alias)) {
                    $this->group($alias);
                    return true;
                }

                // can remap Page
                if ($this->content->checkAlias($alias)) {
                    $this->content($alias);
                } else {
                    $this->page_not_found();
                }

                break;
            case 2:

                if ($segments[1] == 'search') {
                    $searchURI = explode("/", $query['words']);
                    $this->search($searchURI[0], $segments[2]);
                    return;
                }

                if (is_numeric($segments[2]) && $this->content->checkGroupAlias($segments[1])) {
                    $this->group($segments[1], $segments[2]);
                    return true;
                }

                if ($this->content->checkGroupAlias($alias)) {
                    $this->group($alias);
                    return true;
                } else {
                    $this->page_not_found();
                }

                break;
            case 3:
                echo '<pre>';
                print_r($segments);
                echo '</pre>';
                if (is_numeric($segments[4]) && $this->content->checkGroupAlias($segments[1])) {
                    $this->group($segments[1], $segments[2]);
                    return true;
                }

                if ($this->content->checkGroupAlias($alias)) {
                    $this->group($alias);
                    return true;
                } else {
                    $this->page_not_found();
                }
                break;
            default:
                $this->page_not_found();
                break;
        }
    }

}

/* End of file page.php */
/* Location: ./application/controllers/page.php */
<?php

/**
 * Bootigniter
 *
 * An Open Source CMS Boilerplate for PHP 5.1.6 or newer
 *
 * @package		Bootigniter
 * @author		AZinkey
 * @copyright   Copyright (c) 2015, AZinkey LLC.
 * @license		http://bootigniter.org/license
 * @link		http://bootigniter.org
 * @Version		Version 1.0
 */
// ------------------------------------------------------------------------

/**
 * Template Helper
 *
 * @package		Helper
 * @subpackage  Template
 * @author		AZinkey
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');


/**
 * Render Content type admin links
 *
 *
 * @access	public
 * @return	string
 */
if (!function_exists('get_content_types_admin_navigations')) {

    function get_content_types_admin_navigations() {
        AZ::model('content');
        $CI = & get_instance();

        $rows = $CI->content->getTypes('id,name,alias,have_groups', array('enabled' => 1));
        $html = '';
        if (count($rows)) {
            foreach ($rows as $row) {
                $html .= ($row->have_groups) ? '<li class="parent">' : '<li>';
                $manage_url = ($row->have_groups) ? 'javascript:void(0);' : site_url('admin/contents/index/' . $row->alias);
                $html .= '<a href="' . $manage_url . '"> ';
                $html .= ' <i class="fa fa-2x fa-fw fa-pencil-square"></i> ';
                $html .= '<span class="menu-text">' . __($row->name, true) . '</span>';
                $html .= ($row->have_groups) ? '<span class="pull-right arrow">&gt;</span>' : '';
                $html .= '</a>';

                if ($row->have_groups) {
                    $html .= '<ul class="submenu">';
                    $html .= '<li>
                                <a title="' . lang('Add New') . '" href="' . site_url('admin/contents/edit/' . $row->alias) . '">
                                    <i class="fa fa-fw fa-plus"></i>
                                    <span>' . lang('Add New') . '</span> 
                                </a>
                             </li>';
                    $html .= '<li>
                                <a title="' . lang('View All') . '" href="' . site_url('admin/contents/index/' . $row->alias) . '">
                                    <i class="fa fa-fw fa-list"></i>
                                    <span>' . lang('View All') . '</span> 
                                </a>
                             </li>';
                    $html .= '<li>
                                <a title="View All" href="' . site_url('admin/contents/groups/' . $row->id) . '">
                                    <i class="fa fa-fw fa-folder-open-o"></i>
                                    <span>' . lang('Groups') . '</span> 
                                </a>
                             </li>';

                    $html .= '</ul>';
                }


                $html .= '</li>';
            }
        }

        return $html;
    }

}

/**
 * Get User Notifications
 *
 *
 * @access	public
 * @return	string
 */
if (!function_exists('get_user_notifications')) {

    function get_user_notifications() {
        AZ::model('message');
        AZ::helper('date');
        $CI = & get_instance();

        $rows = $CI->message->getUserNotifications('id,label,is_read,is_star,subject,body,created', array('trash' => 0, 'type' => 1, 'is_read' => 0, 'receiver' => user::id()));

        $html = '';
        if (count($rows)) {
            foreach ($rows as $row) {
                $star = ($row->is_star) ? 'glyphicon-star-empty info' : 'glyphicon-info-sign ';
                $html .= '<a class="media border-dotted new" href="' . site_url('admin/dashboard/notifications') . '">
                                <span class="media-object pull-left">
                                    <span class="glyphicon ' . $star . '"></span>
                                </span>
                                <span class="media-body">
                                    <span class="media-text">
                                        <div class="text-primary semibold">' . $row->subject . '</div>
                                        ' . substr($row->body, 0, 50) . '
                                    </span>
                                    <span class="media-meta pull-right">' . date_when(human_to_unix($row->created)) . '</span>
                                </span>
                            </a>';
            }
        }

        return $html;
    }

}

/**
 * Count user notification
 *
 *
 * @access	public
 * @return	integer
 */
if (!function_exists('count_user_notifications')) {

    function count_user_notifications() {
        AZ::model('message');
        AZ::helper('date');
        $CI = & get_instance();

        $count = $CI->message->getUserNotifications('id, label, is_read, is_star, subject, body, created', array('trash' => 0, 'type' => 1, 'is_read' => 0), 0, 0, true);

        return $count;
    }

}

/**
 * Get User Message
 *
 *
 * @access	public
 * @return	string
 */
if (!function_exists('get_user_messages')) {

    function get_user_messages() {
        AZ::model('message');
        AZ::helper('date');
        $CI = & get_instance();

        $rows = $CI->message->getMessages('users.name,messages.*', array('messages.trash' => 0, 'messages.receiver' => user::id()), 0, 10);

        $html = '';
        if (count($rows)) {
            foreach ($rows as $row) {
                $attachment = ($row->have_attachment) ? '<span class="media-meta glyphicon glyphicon-paperclip"></span>' : '';
                $star = ($row->is_star) ? '<span class="media-meta glyphicon glyphicon-star"></span>' : '';
                $new = ($row->is_read) ? ' old ' : ' new ';
                $html .= '<a class="media border-dotted ' . $new . '" href="' . site_url('admin/dashboard/messages/inbox/' . $row->id) . '">
                                <span class="media-body">
                                    <span class="media-heading">' . $row->name . '</span>
                                    <span class="media-text ellipsis nm">
                                        ' . substr($row->body, 0, 50) . '
                                    </span>
                                    ' . $attachment . ' 
                                    ' . $star . ' 
                                    <span class = "media-meta pull-right">' . date_when(human_to_unix($row->created)) . '</span>
                                </span>
                                </a>';
            }
        } else {
            $html .= '<p class="p10">' . lang('User dont have any Message') . '</p>';
        }

        return $html;
    }

}

/**
 * Count user message
 *
 *
 * @access	public
 * @return	integer
 */
if (!function_exists('count_user_messages')) {

    function count_user_messages() {
        AZ::model('message');
        AZ::helper('date');
        $CI = & get_instance();

        $count = $CI->message->getMessages('*', array('messages.trash' => 0, 'messages.is_read' => 0, 'messages.receiver' => user::id()), 0, 0, true);

        return $count;
    }

}

/**
 * Get Page Title
 *
 *
 * @access	public
 * @param	title
 * @return	string
 */
if (!function_exists('page_title')) {

    function page_title($title = NULL) {

        if (empty($title) || is_null($title)) {
            $uri = uri_string();
            $slices = explode('/', $uri);
            if (count($slices)) {
                foreach ($slices as $page) {
                    $title .= ucwords(str_replace("_", " ", $page)) . ' | ';
                }
                $title = rtrim($title, ' | ');
            }
        }



        return $title;
    }

}

/**
 * Load Stylesheets
 *
 *
 * @access	public
 * @param	styles
 * @param	theme
 * @return	string
 */
if (!function_exists('load_styles')) {

    function load_styles($styles, $theme = 'default') {
        if (is_string($styles)) {
            $link = '<link rel = "stylesheet" type = "text/css" href = "';
            $link .= ('//' === "" || strrpos($styles, '//', -strlen($styles)) !== FALSE) ? $styles : skin_url($theme) . $styles;
            $link .= '" media = "screen" />';
        } else if (count($styles) == count($styles, COUNT_RECURSIVE)) {
            $link = NULL;
            foreach ($styles as $style) {
                $link .= '<link rel = "stylesheet" type = "text/css" href = "';
                $link .= ('//' === "" || strrpos($style, '//', -strlen($style)) !== FALSE) ? $style : skin_url($theme) . $style;
                $link .= '" media = "screen" />
';
            }
        } else {
            $link = NULL;

            foreach ($styles as $style) {
                if (isset($style['src'])) {

                    $link .= '<link rel = "stylesheet" type = "text/css" href = "';
                    $link .= ('//' === "" || strrpos($style['src'], '//', -strlen($style['src'])) !== FALSE) ? $style['src'] : skin_url($theme) . $style['src'];
                    $media = (isset($style['media'])) ? $style['media'] : 'screen';
                    $link .= '" media = "' . $media . '" />
';
                }
            }
        }
        echo $link;
    }

}

/**
 * Load Javascripts
 *
 *
 * @access	public
 * @param	scripts
 * @param	theme
 * @return	string
 */
if (!function_exists('load_scripts')) {

    function load_scripts($scripts, $theme = 'default') {
        if (is_string($scripts)) {
            $link = '<script type = "text/javascript" src = "';
            $link .= ('//' === "" || strrpos($scripts, '//', -strlen($scripts)) !== FALSE) ? $scripts : skin_url($theme) . $scripts;
            $link .= '"></script>';
        } else if (count($scripts) == count($scripts, COUNT_RECURSIVE)) {
            $link = NULL;
            foreach ($scripts as $script) {
                $link .= '<script type="text/javascript" src="';
                $link .= ('//' === "" || strrpos($script, '//', -strlen($script)) !== FALSE) ? $script : skin_url($theme) . $script;
                $link .= '"></script>
';
            }
        } else {
            $link = NULL;
            foreach ($scripts as $script) {
                if (isset($script['src'])) {

                    $link .= '<script type="text/javascript" src="';
                    $link .= ('//' === "" || strrpos($style['src'], '//', -strlen($style['src'])) !== FALSE) ? $style['src'] : skin_url($theme) . $style['src'];
                    $link .= '"></script>
';
                }
            }
        }
        return $link;
    }

}

/**
 * Make Page class for body tag
 *
 *
 * @access	public
 * @return	string
 */
if (!function_exists('page_class')) {

    function page_class() {
        $uri = uri_string();
        $class = str_replace('/', '-', $uri);
        return (empty($class)) ? 'front' : $class;
        
    }

}

/**
 * Wrap lang method
 *
 *
 * @access	public
 * @param	str
 * @param	return
 */
if (!function_exists('__')) {

    function __($str, $return = false) {
        if (!lang($str)) {
            if ($return) {
                return $str;
            } else {
                echo $str;
            }
        } else {

            if ($return) {
                return lang($str);
            } else {
                echo lang($str);
            }
        }
    }

}

/**
 * Wrap List
 *
 *
 * @access	public
 * @param	str
 * @param	class
 * @return	string
 */
if (!function_exists('li')) {

    function li($str = '', $class = '') {
        return '<li class="' . $class . '">' . $str . '</li>';
    }

}

/**
 * Wrap anchor method
 *
 *
 * @access	public
 * @param	uri
 * @param	title
 * @param	attributes
 */
if (!function_exists('_a')) {

    function _a($uri, $title, $attributes = NULL) {
        echo anchor($uri, $title, $attributes);
    }

}

/**
 * Wrap Site url method
 *
 *
 * @access	public
 * @param	uri
 */
if (!function_exists('_u')) {

    function _u($uri = '') {
        echo site_url($uri);
    }

}

/**
 * Render Menu Navigation html
 *
 *
 * @access	public
 * @param	name
 * @param	wrapper_class
 * @return	array
 */
if (!function_exists('menu')) {

    function menu($name = 'Primary',$wrapper_class = 'nav navbar-nav navbar-left') {

        AZ::model('menu');
        AZ::helper('html');
        $CI = & get_instance();
        $items = $CI->menu->getItemsByName($name,$wrapper_class);
        return $items;
    }

}

/* End of file template_helper.php */
/* Location: ./app/helpers/template_helper.php */
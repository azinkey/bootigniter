<?php

class LanguageLoader {

    function initialize() {
        
        $ci = & get_instance();
        $uri = & load_class('URI', 'core');
        $admin = $uri->segment(1);
        $is_admin = ($admin == 'administrator' || $admin == 'admin') ? true : false;
        $language = ($is_admin) ? admin_language() : site_language();
        $side = ($is_admin) ? 'app' : 'site';
        $user_lang_request = trim($ci->input->get('lang'));
        $user_lang = $ci->session->userdata('user_lang');
        if (!empty($user_lang_request)) {
            $ci->session->set_userdata('user_lang', $user_lang_request);
            AZ::redirect(current_url());
        }
        if (isset($user_lang) && !empty($user_lang) && !$is_admin ) {
            $ci->lang->load($side, $user_lang);
        } else {
            $ci->lang->load($side, $language);
        }
    }

}

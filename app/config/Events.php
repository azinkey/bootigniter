<?php

namespace Config;

use CodeIgniter\Events\Events;

/**
 * BootIgniter Events
 *
 * Replaces the CI3 hooks (BootigniterLoader + LanguageLoader).
 * This fires after every controller is initialized.
 */
Events::on('post_controller_constructor', static function () {
    // BootigniterLoader: Check DB config + auto-install on first run
    $db = db_connect();
    $dbConfig = config('Database')->default;

    if (empty($dbConfig['hostname']) || empty($dbConfig['database']) || empty($dbConfig['username'])) {
        throw new \RuntimeException(
            'Missing Database Configuration. Please configure <strong>app/Config/Database.php</strong> '
            . 'or set your credentials in the <strong>.env</strong> file, then refresh.'
        );
    }

    // Auto-install: run install.sql if tables don't exist yet
    $forge = \CodeIgniter\Database\Forge::class;
    if (
        ! $db->tableExists('access') ||
        ! $db->tableExists('users') ||
        ! $db->tableExists('languages') ||
        ! $db->tableExists('contents')
    ) {
        $file = APPPATH . 'database/setup/install.sql';
        if (! file_exists($file)) {
            throw new \RuntimeException('Install file not found: ' . $file);
        }

        $queries = file_get_contents($file);
        $lines   = explode(';', $queries);
        foreach ($lines as $query) {
            $query = trim($query);
            if (! empty($query)) {
                $db->query('SET FOREIGN_KEY_CHECKS = 0');
                $query = str_replace('%PREFIX%', $db->getPrefix(), $query);
                $db->query($query);
                $db->query('SET FOREIGN_KEY_CHECKS = 1');
            }
        }

        // Set default admin user
        $setting = new \Setting();
        $setting->setSetting('site_url', site_url());

        AZ::flashMSG('Your first login credential is <strong>admin / 123456</strong>');
        AZ::redirectSuccess('administrator', 'BootIgniter setup complete!');
    }

    // LanguageLoader: detect and load the correct language file
    $uri     = service('uri');
    $segment = $uri->getSegment(1);
    $isAdmin = ($segment === 'administrator' || $segment === 'admin');
    $side    = $isAdmin ? 'app' : 'site';

    $session = service('session');
    $langRequest = trim((string) service('request')->getGet('lang'));
    $userLang    = $session->get('user_lang');

    if (! empty($langRequest)) {
        $session->set('user_lang', $langRequest);
        AZ::redirect(current_url());
    }

    if (! empty($userLang) && ! $isAdmin) {
        service('language')->load($side, $userLang);
    } else {
        $defaultLang = $isAdmin ? admin_language() : site_language();
        service('language')->load($side, $defaultLang);
    }
});

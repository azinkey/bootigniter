<?php

namespace Config;

use CodeIgniter\Config\AutoloadConfig;

/**
 * BootIgniter Autoload Configuration
 * Minimal — only helpers that BootIgniter needs globally.
 */
class Autoload extends AutoloadConfig
{
    /**
     * PSR4 namespace mappings.
     * App\ namespace points to the app/ directory.
     *
     * @var array<string, list<string>|string>
     */
    public $psr4 = [
        APP_NAMESPACE => APPPATH,
        'Config'      => APPPATH . 'Config',
    ];

    /**
     * Global helpers to load on every request.
     * Same set as the old autoload.php helper array.
     *
     * @var list<string>
     */
    public $helpers = [
        'url',
        'setting',
        'user',
        'language',
        'template',
    ];
}

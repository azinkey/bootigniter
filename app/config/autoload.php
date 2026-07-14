<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

/**
 * BootIgniter Autoload Configuration
 * Minimal — only helpers that BootIgniter needs globally.
 */
class Autoload extends BaseConfig
{
    /**
     * PSR4 namespace mappings.
     * App\ namespace points to the app/ directory.
     *
     * @var array<string, list<string>|string>
     */
    public array $psr4 = [
        APP_NAMESPACE => APPPATH,
        'Config'      => APPPATH . 'Config',
    ];

    /**
     * Global helpers to load on every request.
     * Same set as the old autoload.php helper array.
     */
    public array $helpers = [
        'url',
        'setting',
        'user',
        'language',
        'template',
    ];
}

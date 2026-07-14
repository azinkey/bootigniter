<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;
use CodeIgniter\Filters\InvalidChars;
use CodeIgniter\Filters\SecureHeaders;

/**
 * BootIgniter Filters
 * Replaces CI3's hooks.php.
 * The BootigniterLoader and LanguageLoader hooks are now handled in Events.php.
 */
class Filters extends BaseConfig
{
    /**
     * Filter aliases.
     * 'auth' filter can be used in routes to protect admin pages.
     */
    public array $aliases = [];

    /**
     * List of filter aliases that are always run in every request.
     */
    public array $globals = [
        'before' => [],
        'after'  => [],
    ];

    public array $methods = [];

    public array $filters = [];
}

<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

/**
 * BootIgniter App Configuration
 * Minimal — only settings BootIgniter actually uses.
 */
class App extends BaseConfig
{
    /**
     * Base Site URL — set this to your site's URL with trailing slash.
     * Auto-detected if empty (development only — set it for production).
     */
    public string $baseURL = '';

    /** @var list<string> */
    public array $allowedHostnames = [];

    /**
     * Leave as 'index.php', or set to '' if using mod_rewrite / clean URLs.
     */
    public string $indexPage = 'index.php';

    public string $uriProtocol = 'REQUEST_URI';

    public string $permittedURIChars = 'a-z 0-9~%.:_\-';

    public string $defaultLocale = 'en';

    public bool $negotiateLocale = false;

    /** @var list<string> */
    public array $supportedLocales = ['en'];

    public string $appTimezone = 'UTC';

    public string $charset = 'UTF-8';

    public bool $forceGlobalSecureRequests = false;

    /** @var array<string, string> */
    public array $proxyIPs = [];

    public bool $CSPEnabled = false;

    /*
    |--------------------------------------------------------------------------
    | Encryption Key
    |--------------------------------------------------------------------------
    | Used by the Session and Encryption libraries.
    | CHANGE THIS to a long random string for your installation.
    */
    public string $encryptionKey = 'Fxj<k+A(Ud*HR)Q[X4<E_mNjU|]DuyS$[1i0,nCSH3i<dF5-Y+cVI>!$uM2@FKl';
}

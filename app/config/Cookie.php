<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

/**
 * BootIgniter Cookie Configuration
 */
class Cookie extends BaseConfig
{
    public string $prefix = '';
    public int $expires = 0;
    public string $path = '/';
    public string $domain = '';
    public bool $secure = false;
    public bool $httponly = false;
    public ?string $samesite = 'Lax';
    public bool $raw = false;
}

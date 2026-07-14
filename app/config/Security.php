<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Security extends BaseConfig
{
    public string $csrfProtection  = 'cookie';
    public int    $tokenRandomize  = 0;
    public string $tokenName       = 'csrf_token_name';
    public string $headerName      = 'X-CSRF-TOKEN';
    public string $cookieName      = 'csrf_cookie_name';
    public int    $expires         = 7200;
    public bool   $regenerate      = true;
    public bool   $redirect        = true;
    public string $samesite        = 'Lax';
    public string $secretKey       = '';
}

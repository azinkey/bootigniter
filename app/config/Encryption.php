<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Encryption extends BaseConfig
{
    public string $key    = '';
    public string $driver = 'OpenSSL';
    public string $blockSize = '16';
    public string $digest = 'SHA512';
    public ?string $rawData = null;
}

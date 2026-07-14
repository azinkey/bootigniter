<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Migrations extends BaseConfig
{
    public bool   $enabled   = true;
    public string $table     = 'migrations';
    public bool   $timestampFormat_Y = true;
    public string $timestampFormat   = 'Y-m-d-His_';
}

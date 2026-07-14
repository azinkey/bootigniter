<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class View extends BaseConfig
{
    public string $adapter      = 'CodeIgniter\View\View';
    public string $savePath     = WRITEPATH . 'cache/';
    public bool   $debug        = CI_DEBUG;
    public array  $decorators   = [];
}

<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Honeypot extends BaseConfig
{
    public bool $hidden          = true;
    public string $label         = 'Fill This Field';
    public string $name          = 'honeypot';
    public string $template      = '<label>{label}</label><input type="text" name="{name}" value=""/>';
    public string $container     = '<div style="display:none">{template}</div>';
    public string $containerId   = 'hpc';
}

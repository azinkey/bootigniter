<?php

namespace Config;

use CodeIgniter\Config\Routing as BaseRouting;

class Routing extends BaseRouting
{
    public string $defaultNamespace = 'App\Controllers';
    public string $defaultController = 'Page';
    public string $defaultMethod = 'index';
    public bool $translateURIDashes = false;
    public bool $autoRoute = true;
    public bool $prioritize = false;
    public array $moduleRoutes = [];
}

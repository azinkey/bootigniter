<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Toolbar extends BaseConfig
{
    public array $collectors = [
        \CodeIgniter\Debug\Toolbar\Collectors\Timers::class,
        \CodeIgniter\Debug\Toolbar\Collectors\Database::class,
        \CodeIgniter\Debug\Toolbar\Collectors\Logs::class,
        \CodeIgniter\Debug\Toolbar\Collectors\Views::class,
        \CodeIgniter\Debug\Toolbar\Collectors\Cache::class,
        \CodeIgniter\Debug\Toolbar\Collectors\Files::class,
        \CodeIgniter\Debug\Toolbar\Collectors\Routes::class,
        \CodeIgniter\Debug\Toolbar\Collectors\Events::class,
    ];

    public int    $maxHistory       = 20;
    public string $watchedDirectory = WRITEPATH;
    public bool   $darkMode         = false;
    public int    $maxQueries       = 100;
}

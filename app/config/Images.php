<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Images extends BaseConfig
{
    public string $defaultHandler = 'gd';
    public string $gdPath         = '';
    public string $imageMagickPath = '';

    public array $handlers = [
        'gd'      => \CodeIgniter\Images\Handlers\GDHandler::class,
        'imagick' => \CodeIgniter\Images\Handlers\ImageMagickHandler::class,
    ];
}

<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Format extends BaseConfig
{
    public array $supportedResponseFormats = [
        'application/json',
        'application/xml',
        'text/xml',
        'text/html',
        'text/plain',
        'application/x-json',
        'text/json',
        'text/javascript',
        'text/x-javascript',
        'application/javascript',
        'application/rss+xml',
        'text/yaml',
        'application/yaml',
        'application/x-yaml',
        'text/csv',
        'application/csv',
    ];

    public array $formatters = [
        'application/json' => \CodeIgniter\Format\JSONFormatter::class,
        'application/xml'  => \CodeIgniter\Format\XMLFormatter::class,
        'text/xml'         => \CodeIgniter\Format\XMLFormatter::class,
        'text/html'        => \CodeIgniter\Format\HTMLFormatter::class,
        'text/csv'         => \CodeIgniter\Format\CSVFormatter::class,
    ];

    /**
     * Options per formatter — keyed by MIME type.
     *
     * @var array<string, int>
     */
    public array $formatterOptions = [
        'application/json' => JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES,
    ];

    /**
     * Max json_encode depth.
     */
    public int $jsonEncodeDepth = 512;

    public bool $jsonUnescapedUnicode = false;
}

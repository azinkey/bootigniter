<?php

namespace Config;

use CodeIgniter\Cache\Handlers\ApcuHandler;
use CodeIgniter\Cache\Handlers\DummyHandler;
use CodeIgniter\Cache\Handlers\FileHandler;
use CodeIgniter\Cache\Handlers\MemcachedHandler;
use CodeIgniter\Cache\Handlers\PredisHandler;
use CodeIgniter\Cache\Handlers\RedisHandler;
use CodeIgniter\Cache\Handlers\WincacheHandler;
use CodeIgniter\Config\BaseConfig;

class Cache extends BaseConfig
{
    public string $handler        = 'dummy';
    public string $backupHandler  = 'dummy';
    public string $storePath      = WRITEPATH . 'cache/';
    public bool   $cacheQueryString = false;
    public int    $ttl            = 60;


    /**
     * Valid cache handlers and their class names.
     *
     * @var array<string, class-string>
     */
    public array $validHandlers = [
        'dummy'     => DummyHandler::class,
        'file'      => FileHandler::class,
        'memcached' => MemcachedHandler::class,
        'redis'     => RedisHandler::class,
        'predis'    => PredisHandler::class,
        'apcu'      => ApcuHandler::class,
        'wincache'  => WincacheHandler::class,
    ];

    public array $file = [
        'storePath' => '',
        'mode'      => 0640,
    ];

    public array $memcached = [
        'host'   => '127.0.0.1',
        'port'   => 11211,
        'weight' => 1,
        'raw'    => false,
    ];

    public array $redis = [
        'host'     => '127.0.0.1',
        'password' => null,
        'port'     => 6379,
        'timeout'  => 0,
        'database' => 0,
    ];

    public array $wincache = [];
    public string $prefix   = '';
}

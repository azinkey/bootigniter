<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Session\Handlers\FileHandler;

/**
 * BootIgniter Session Configuration
 */
class Session extends BaseConfig
{
    /**
     * Session storage driver.
     * Options: FileHandler, DatabaseHandler, MemcachedHandler, RedisHandler
     */
    public string $driver = FileHandler::class;

    public string $cookieName = 'ci_session';

    /**
     * Session expiry in seconds. 7200 = 2 hours.
     */
    public int $expiration = 7200;

    /**
     * Where to save session files.
     * Uses the writable/session directory.
     */
    public string $savePath = WRITEPATH . 'session';

    public bool $matchIP = false;

    public int $timeToUpdate = 300;

    public bool $regenerateDestroy = false;
}

<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

/**
 * BootIgniter Database Configuration
 *
 * STEP 1: Set your database credentials here.
 * This is the same 2-step setup as before — just a new file format.
 */
class Database extends \CodeIgniter\Database\Config
{
    /**
     * The default database connection group name.
     */
    public string $defaultGroup = 'default';

    /**
     * Default connection settings.
     * Fill in your database credentials here.
     */
    public array $default = [
        'DSN'          => '',
        'hostname'     => 'localhost',
        'username'     => '',        // ← Set your DB username
        'password'     => '',        // ← Set your DB password
        'database'     => '',        // ← Set your DB name
        'DBDriver'     => 'MySQLi',
        'DBPrefix'     => '',
        'pConnect'     => false,
        'DBDebug'      => true,
        'charset'      => 'utf8',
        'DBCollat'     => 'utf8_general_ci',
        'swapPre'      => '',
        'encrypt'      => false,
        'compress'     => false,
        'strictOn'     => false,
        'failover'     => [],
        'port'         => 3306,
        'numberNative' => false,
    ];
}

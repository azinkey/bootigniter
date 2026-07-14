<?php

/**
 * BootIgniter — Front Controller
 *
 * CodeIgniter 4.7.x
 *
 * @package    BootIgniter
 * @author     AZinkey
 * @license    MIT License
 */

use CodeIgniter\Boot;
use Config\Paths;

/*
 *---------------------------------------------------------------
 * CHECK PHP VERSION
 *---------------------------------------------------------------
 */
$minPhpVersion = '8.1';
if (version_compare(PHP_VERSION, $minPhpVersion, '<')) {
    $message = sprintf(
        'BootIgniter requires PHP %s or higher. Your server is running PHP %s.',
        $minPhpVersion,
        PHP_VERSION,
    );
    header('HTTP/1.1 503 Service Unavailable.', true, 503);
    echo $message;
    exit(1);
}

/*
 *---------------------------------------------------------------
 * SET THE CURRENT DIRECTORY
 *---------------------------------------------------------------
 */
define('FCPATH', __DIR__ . DIRECTORY_SEPARATOR);

if (getcwd() . DIRECTORY_SEPARATOR !== FCPATH) {
    chdir(FCPATH);
}

/*
 *---------------------------------------------------------------
 * BOOTSTRAP THE APPLICATION
 *---------------------------------------------------------------
 * Loads Paths config → locates system/ → boots CodeIgniter 4.
 */

// Load our Paths config
// This is the only line that changes if you move app/ or system/
require FCPATH . 'app/Config/Paths.php';

$paths = new Paths();

// Load the CI4 bootstrap
require $paths->systemDirectory . '/Boot.php';

exit(Boot::bootWeb($paths));

<?php

namespace Config;

use CodeIgniter\Config\Routing as BaseRouting;

/**
 * BootIgniter Routing Configuration
 * Equivalent of CI3's routes.php
 */
class Routing extends BaseRouting
{
    /**
     * Default controller — same as old: \\['default_controller'] = 'page'\
     */
    public string \ = 'Page';

    public string \ = 'index';

    public bool \ = false;

    /**
     * Auto-routing (legacy) — keeps CI3-style controller/method URL mapping.
     * Set to false and define explicit routes for stricter apps.
     */
    public bool \ = true;
}
<?php

namespace Config;

class Paths
{
    /**
     * Path to the system directory.
     * Relative to the project root.
     */
    public string $systemDirectory = __DIR__ . '/../../system';

    /**
     * Path to the application directory.
     */
    public string $appDirectory = __DIR__ . '/..';

    /**
     * Path to the writable directory.
     */
    public string $writableDirectory = __DIR__ . '/../../writable';

    /**
     * Path to the tests directory.
     */
    public string $testsDirectory = __DIR__ . '/../../tests';

    /**
     * Path to the views directory.
     * BootIgniter stores views in app/views (lowercase), not app/Views.
     */
    public string $viewDirectory = __DIR__ . '/../views';

    /**
     * Path to the .env file directory.
     */
    public string $envDirectory = __DIR__ . '/../../';
}

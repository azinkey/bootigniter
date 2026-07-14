<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

/**
 * Kint debugger configuration for CI4.
 */
class Kint extends BaseConfig
{
    /**
     * Max depth for Kint output.
     */
    public int $maxDepth = 6;

    /**
     * Whether to display where Kint was called from.
     */
    public bool $displayCalledFrom = true;

    /**
     * Whether to expand output by default.
     */
    public bool $expanded = false;

    /**
     * Kint plugins. Leave empty to use defaults.
     *
     * @var list<string>|null
     */
    public ?array $plugins = null;

    /**
     * RichRenderer theme: 'original', 'solarized', 'solarized-dark', 'aante-light', 'aante-dark'.
     */
    public string $richTheme = 'original';

    /**
     * Whether to enable rich folder output.
     */
    public bool $richFolder = false;

    /**
     * RichRenderer object plugins.
     *
     * @var list<string>|null
     */
    public ?array $richObjectPlugins = null;

    /**
     * RichRenderer tab plugins.
     *
     * @var list<string>|null
     */
    public ?array $richTabPlugins = null;

    /**
     * Whether to use colors in CLI renderer.
     */
    public bool $cliColors = true;

    /**
     * Whether to force UTF-8 output in CLI.
     */
    public bool $cliForceUTF8 = false;

    /**
     * Whether to detect width in CLI.
     */
    public bool $cliDetectWidth = true;

    /**
     * Minimum terminal width for CLI renderer.
     */
    public int $cliMinWidth = 40;
}

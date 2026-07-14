<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

/**
 * CI4 ContentSecurityPolicy Configuration
 */
class ContentSecurityPolicy extends BaseConfig
{
    public bool   $reportOnly       = false;
    public string $defaultSrc       = 'none';
    public $scriptSrc               = 'self';
    public $styleSrc                = 'self';
    public string $imageSrc         = 'self';
    public string $baseURI          = '';
    public $childSrc                = 'self';
    public $connectSrc              = 'self';
    public string $fontSrc          = '';
    public string $formAction       = 'self';
    public string $frameAncestors   = 'none';
    public $frameSrc                = 'none';
    public string $mediaSrc         = '';
    public string $objectSrc        = 'none';
    public string $pluginTypes      = '';
    public string $reportURI        = '';
    public bool   $sandbox          = false;
    public string $manifestSrc      = '';
    public bool   $upgradeInsecureRequests = false;
    public bool   $blockAllMixedContent    = false;
    // Note: scriptSrcAttr, scriptSrcElem, styleSrcAttr, styleSrcElem, workerSrc
    // are internal properties — omit from config to let CI4 use its own defaults.
}

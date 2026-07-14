<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Email extends BaseConfig
{
    public string $fromEmail  = '';
    public string $fromName   = '';
    public string $recipients = '';
    public string $userAgent  = 'CodeIgniter';
    public string $protocol   = 'mail';
    public string $mailPath   = '/usr/sbin/sendmail';
    public string $SMTPHost   = '';
    public string $SMTPUser   = '';
    public string $SMTPPass   = '';
    public int    $SMTPPort   = 465;
    public int    $SMTPTimeout = 5;
    public bool   $SMTPKeepAlive = false;
    public string $SMTPCrypto = 'ssl';
    public bool   $wordWrap   = true;
    public int    $wrapChars  = 76;
    public string $mailType   = 'text';
    public string $charset    = 'UTF-8';
    public bool   $validate   = true;
    public int    $priority   = 3;
    public string $CRLF       = "\r\n";
    public string $newline    = "\r\n";
    public bool   $BCCBatchMode = false;
    public int    $BCCBatchSize = 200;
    public bool   $DSN        = false;
}

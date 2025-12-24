<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Email extends BaseConfig
{
    public string $fromEmail  = 'maizarnififtin@gmail.com'; // Gmail Anda
    public string $fromName   = 'Genegraft Admin';
    public string $recipients = '';

    public string $userAgent  = 'CodeIgniter';
    public string $protocol   = 'smtp';
    public string $SMTPHost   = 'smtp.gmail.com';
    public string $SMTPUser   = 'maizarnififtin@gmail.com'; // Gmail
    public string $SMTPPass   = 'ijkjniwxidyzcrmo'; // App password 16 karakter
    public int    $SMTPPort   = 587;
    public string $SMTPCrypto = 'tls';

    public bool   $SMTPKeepAlive = false;
    public int    $SMTPTimeout   = 5;

    public bool   $wordWrap    = true;
    public int    $wrapChars   = 76;
    public string $mailType    = 'html';
    public string $charset     = 'UTF-8';
    public bool   $validate    = false;
    public int    $priority    = 3;
    public string $CRLF        = "\r\n";
    public string $newline     = "\r\n";
    public bool   $BCCBatchMode = false;
    public int    $BCCBatchSize = 200;
    public bool   $DSN         = false;
}

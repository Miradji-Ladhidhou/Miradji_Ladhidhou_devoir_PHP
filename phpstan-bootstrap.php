<?php
// Charge la config (où sont définis DB_HOST, DB_NAME, etc.)
require_once __DIR__ . '/config/config.php';

// Évite les erreurs quand PHPStan lance ce script hors contexte HTTP
if (!defined('ROOT')) {
    $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
    $protocol = isset($_SERVER['HTTPS']) ? 'https' : 'http';
    $self = $_SERVER['PHP_SELF'] ?? '/index.php';
    define('ROOT', str_replace('index.php', '', $protocol . '://' . $host . $self));
}

<?php
declare(strict_types=1);

use TMCms\Config\Configuration;
use TMCms\Config\Settings;
use TMCms\Log\Errors;

defined('INC') or exit;

// Path of root folder
define('DIR_BASE', str_replace('\\', '/', __DIR__) . '/');

// Using Composer
$autoload_file = DIR_BASE . 'vendor/autoload.php';
if (!file_exists($autoload_file)) {
    die('Vendor libraries not found. Run command <code style="background-color: #000; color: #fff">composer -v update</code> in console.');
}
require_once $autoload_file;

// Error and exception handler
set_error_handler([Errors::class, 'Handler']);

// Load default configuration
$config = Configuration::getInstance();
$config->addConfigurationEnv();

// Check auth
$auth = Configuration::getInstance()->get('http_auth');
$login = $auth['login'] ?? '';
$password = $auth['password'] ?? '';
if (
    ($login && $password) // If login and password are set in config...
    && ( // ... we check that same are supplied by user
        !isset($_SERVER['PHP_AUTH_USER'])
        || !isset($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW'])
        || ($_SERVER['PHP_AUTH_USER'] !== $login || $_SERVER['PHP_AUTH_PW'] !== $password))
    ) {
    header('WWW-Authenticate: Basic realm="Authentication System"');
    header('HTTP/1.0 401 Unauthorized');

    die('No access');
}

// Init settings from admin panel
Settings::getInstance()->init();

// Hide all errors in prod env
if (Settings::isProductionState()) {
    ini_set('display_errors', false);
    ini_set('display_startup_errors', false);
}

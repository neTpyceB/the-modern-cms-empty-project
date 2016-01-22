<?php

use TMCms\Config\Configuration;
use TMCms\Config\Settings;

defined('INC') or exit;

// Path of root folder
define('DIR_BASE', str_replace('\\', '/', dirname(__FILE__)) . '/');

// Using Composer
$autoloader_file = DIR_BASE . 'vendor/autoload.php';
if (file_exists($autoloader_file)) {
    require_once $autoloader_file;
} else {
    die('Vendor libraries not found.<br>Run composer -v update in console.<br>Autoloader must be in "' . $autoloader_file . '"');
}

// Error handler
set_error_handler(array('\TMCms\Log\Errors', 'Handler'));

$config = Configuration::getInstance();

$config->addConfigurationEnv(); // Set default

// Check auth
$auth = Configuration::getInstance()->get('http_auth');
$login = isset($auth['login']) ? $auth['login'] : '';
$password = isset($auth['password']) ? $auth['password'] : '';
if ($login && $password) {
    if (!isset($_SERVER['PHP_AUTH_USER']) || (!isset($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW'])) || ($_SERVER['PHP_AUTH_USER'] != $login || $_SERVER['PHP_AUTH_PW'] != $password)) {
        header('WWW-Authenticate: Basic realm="Authentication System"');
        header('HTTP/1.0 401 Unauthorized');
        echo "No access";
        exit;
    }
}

// Init Settings
Settings::getInstance()->init();

// Hide all errors in prod env
if (Settings::isProductionState()) {
    error_reporting(0);
    ini_set('display_errors', false);
    ini_set('display_startup_errors', false);
}
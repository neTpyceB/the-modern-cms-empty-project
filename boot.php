<?php
use neTpyceB\TMCms\Config\Settings;
defined('INC') or exit;

// Define all pathes to folders as aliases
define('DIR_BASE',  str_replace('\\', '/', dirname(__FILE__)) .'/');
$bd_so = strlen(DIR_BASE);

define('DIR_BASE_URL', '/'. substr(DIR_BASE, $bd_so)); // Can be used to run App from under folder

define('DIR_CMS', DIR_BASE .'cms/');
define('DIR_CMS_URL', '/'. substr(DIR_CMS, $bd_so));

define('DIR_CACHE', DIR_BASE . 'cache/');
define('DIR_CACHE_URL', '/'. substr(DIR_CACHE, $bd_so));

define('DIR_CMS_PAGES', DIR_CMS . 'p/');

define('DIR_FRONT', DIR_BASE . 'project/');

define('DIR_FRONT_AJAX', DIR_FRONT . 'ajax/');
define('DIR_FRONT_AJAX_URL', '/'. substr(DIR_FRONT_AJAX, $bd_so));

define('DIR_FRONT_LOGS', DIR_FRONT . 'logs/');

define('DIR_FRONT_CONTROLLERS', DIR_FRONT . 'controllers/');

define('DIR_FRONT_PAGES', DIR_FRONT . 'pages/'); // Cms Pages

define('DIR_FRONT_PLUGINS', DIR_FRONT . 'plugins/');
define('DIR_FRONT_PLUGINS_URL', '/'. substr(DIR_FRONT_PLUGINS, $bd_so));

define('DIR_FRONT_SERVICES', DIR_FRONT .'services/');
define('DIR_FRONT_SERVICES_URL', '/'. substr(DIR_FRONT_SERVICES, $bd_so));

define('DIR_FRONT_TEMPLATES', DIR_FRONT . 'templates/');
define('DIR_FRONT_TEMPLATES_URL', '/'. substr(DIR_FRONT_TEMPLATES, $bd_so));

define('DIR_FRONT_VIEWS', DIR_FRONT . 'views/');

define('DIR_PUBLIC', DIR_BASE . 'public/');
define('DIR_PUBLIC_URL', '/'. substr(DIR_PUBLIC, $bd_so));

define('DIR_ASSETS', DIR_PUBLIC . 'assets/');
define('DIR_ASSETS_URL', '/'. substr(DIR_ASSETS, $bd_so));

define('DIR_MODULES', DIR_FRONT .'modules/');

define('DIR_MIGRATIONS', DIR_FRONT .'migrations/');
define('DIR_MIGRATIONS_URL', '/'. substr(DIR_MIGRATIONS, $bd_so));

define('DIR_TEMP', DIR_BASE .'temp/');

define('DIR_TESTS', DIR_BASE .'tests/');

unset($bd_so);

// Send first header

if (!headers_sent()) {
    header('X-Content-Type-Options: nosniff'); // Allow only named scripts (type=«text/javascript», type=«text/css»)
    header('X-Frame-Options: DENY');
    header('Strict-Transport-Security: max-age=expireTime'); // Enable SSL and use only it
    header_remove('X-Powered-By'); // Remove PHP version
}

// Site-based config
require_once DIR_BASE .'config.php';

ob_implicit_flush(0);
ignore_user_abort(1);

ini_set('display_errors', true);
ini_set('display_startup_errors', true);
ini_set('register_globals', '0');
ini_set('magic_quotes_gpc', '0');
ini_set('allow_url_fopen', '0');
ini_set('mysql.trace_mode', '0');
if (session_status() != PHP_SESSION_ACTIVE) ini_set('session.use_trans_sid', false); // Disable showing PHPSESSID in URL
ini_set('session.use_only_cookies', true); // Use Cokies only in headers
ini_set('session.entropy_file', '/dev/urandom');
ini_set('session.entropy_length', 32);
ini_set('session.hash_bits_per_character', 6);
ini_set('session.cookie_httponly', false); // We may need Cookies in JavaScript

mb_internal_encoding('UTF-8');
if (session_status() != PHP_SESSION_ACTIVE && !headers_sent()) session_start();

if (empty($_SESSION['__session_name_validated'])) { // Every time we start Session - give it a unique name for security
    $random_cookie_name = function() {
        $length = rand(16, 32);
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    };
    ini_set('session.name', $random_cookie_name());
    $_SESSION['__session_name_validated'] = 1;
}

// Ini
if (!isset($_SERVER['HTTP_HOST'])) $_SERVER['HTTP_HOST'] = '';
if (!isset($_SERVER['REQUEST_TIME'])) $_SERVER['REQUEST_TIME'] = time();
if (!isset($_SERVER['HTTP_REFERER'])) $_SERVER['HTTP_REFERER'] = '';
if (!isset($_SERVER['HTTP_ACCEPT_ENCODING'])) $_SERVER['HTTP_ACCEPT_ENCODING'] = '';
if (!isset($_SERVER['QUERY_STRING'])) $_SERVER['QUERY_STRING'] = '';
if (!isset($_SERVER['HTTP_USER_AGENT'])) $_SERVER['HTTP_USER_AGENT'] = '';
if (!isset($_SERVER['REQUEST_URI'])) $_SERVER['REQUEST_URI'] = '/';
if (!isset($_SERVER['REMOTE_ADDR']) || !preg_match('/^[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}$/', $_SERVER['REMOTE_ADDR'])) $_SERVER['REMOTE_ADDR'] = '0.0.0.0';
if (!isset($_SERVER['SERVER_ADDR']) || !preg_match('/^[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}$/', $_SERVER['SERVER_ADDR'])) $_SERVER['SERVER_ADDR'] = '0.0.0.0';

// Check for legal URL
define('SELF', isset($_SERVER['REDIRECT_URL']) ? $_SERVER['REDIRECT_URL'] : $_SERVER['REQUEST_URI']);
if (strlen(SELF) > 255 || strpos(SELF, 'eval(') !== false || stripos(SELF, 'CONCAT') !== false  || stripos(SELF, 'UNION+SELECT') !== false  || stripos(SELF, 'base64') !== false ) {
    header("HTTP/1.1 414 Request-URI Too Long");
    header("Status: 414 Request-URI Too Long");
    header("Connection: Close");
    exit('Wrong URL');
}

// Disabling magic quotes in case we have old software
if (get_magic_quotes_gpc()) {
    $process = array(&$_GET, &$_POST, &$_COOKIE, &$_REQUEST);
    while (list($key, $val) = each($process)) {
        foreach ($val as $k => $v) {
            unset($process[$key][$k]);
            if (is_array($v)) {
                $process[$key][stripslashes($k)] = $v;
                $process[] = &$process[$key][stripslashes($k)];
            } else {
                $process[$key][stripslashes($k)] = stripslashes($v);
            }
        }
    }
    unset($process, $key, $val, $k, $v);
}

/* Constants */
define('HOST', mb_strtolower(trim($_SERVER['HTTP_HOST'])));
if (!defined('CFG_DOMAIN')) define('CFG_DOMAIN',  HOST);
define('REF', isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : NULL);
define('QUERY', isset($_SERVER['REDIRECT_QUERY_STRING']) ? $_SERVER['REDIRECT_QUERY_STRING'] : $_SERVER['QUERY_STRING']);
define('SELF_WO_QUERY', rtrim(QUERY ? substr(SELF, 0, -strlen(QUERY) - 1) : SELF, '?'));
define('IP', $_SERVER['REMOTE_ADDR']);
define('IP_LONG', sprintf('%u', ip2long(IP)));
define('USER_AGENT', $_SERVER['HTTP_USER_AGENT']);
define('SERVER_IP', $_SERVER['SERVER_ADDR']);
define('NOW', $_SERVER['REQUEST_TIME']);
define('VISITOR_HASH', md5(IP .':'. USER_AGENT));

date_default_timezone_set('Europe/Riga');

// Settings
define('CFG_DB_CONNECT_DELAY', 500000);
define('CFG_DB_MAX_CONNECT_ATTEMPTS', 3);
if (!defined('PHP_OS')) define('PHP_OS', "Linux"); // PHP_OS can be already set by environment
define('CFG_CMS_DATE_FORMAT', 'Y-m-d');
define('CFG_CMS_DATETIME_FORMAT', 'Y-m-d H:i');
define('CFG_MYSQL_DATETIME_FORMAT', 'YYYY-MM-DD HH:MM:SS');
define('CFG_MIN_PHP_VERSION_REQUIRED', '5.4');
define('CFG_MAIL_ERRORS', 1); // Send or not errors
define('CFG_DEFAULT_FILE_PERMISSIONS', 0777);
define('CFG_DEFAULT_DIR_PERMISSIONS', 0777);
define('CFG_JS_CLOSE_PARENT_PERIOD', 500); // Close all child popups, when parent is closed, in ms. Set 0 to disable
define('REF_SE_KEYWORD_MIN_MATCH', 70); // Minimum match to search query from search engines to trigger quicklinks

/* CMS */
define('CMS_VERSION', '15.05');
define('CMS_NAME', 'The Modern CMS');
define('CMS_DEVELOPERS', 'Vadims Petrusevs a.k.a. neTpyceB');
define('CMS_OWNER_COMPANY', 'SIA DEVP');
define('CMS_SUPPORT_EMAIL', 'info@devp.lv'); // Support e-mail for errors, etc.
define('CMS_SITE', 'http://devp.lv/');
if (!defined('CFG_GIT_BRANCH')) define('CFG_GIT_BRANCH', 'master'); // Default git branch from which CMS is updated

if (!defined('CFG_DB_SERVER')) define('CFG_DB_SERVER', 'localhost');


// Using Composer
$autoloader_file = DIR_BASE . 'vendor/autoload.php';
if (file_exists($autoloader_file)) {
    require_once $autoloader_file;
} else {
    die('Please, install Composer. Autoloader must be in "'. $autoloader_file .'"');
}

// Error handler
set_error_handler(array('\neTpyceB\TMCms\Log\Errors', 'Handler'));

// Init Settings
Settings::init();

// Hide all errors in prod env
if (Settings::isProductionState()) {
    error_reporting(0);
    ini_set('display_errors', false);
    ini_set('display_startup_errors', false);
}
<?php
declare(strict_types=1);

use TMCms\Admin\FrontPanel;
use TMCms\Admin\Users;
use TMCms\App\Frontend;
use TMCms\Config\Settings;
use TMCms\Log\Stats;

$start_microtime = microtime(true);
error_reporting(-1);

// No direct access to PHP files
define('INC', true);
define('MODE', 'site');

// Path constants
require_once 'boot.php';

// Removes X-Frame-Options form same host and Yandex webvisor.com
if(preg_match('~^https?:\/\/([^\/]+\\.)?('.preg_quote(HOST).'|webvisor\.com)\/~', $_SERVER['HTTP_REFERER'])){
    header_remove('X-Frame-Options');
}

// Run main Application
echo Frontend::getInstance();

// Show debug info including execution time, memory usage and DB queries
if (Settings::get('debug_panel')) {
    Stats::getView();
}
// Panel ot top of site if you are admin
if (Settings::get('admin_panel_on_site') && Users::getInstance()->isLogged()) {
    echo FrontPanel::getView();
}

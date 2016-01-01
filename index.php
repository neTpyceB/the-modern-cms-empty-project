<?php

use TMCms\Admin\FrontPanel;
use TMCms\Admin\Users;
use TMCms\App\Frontend;
use TMCms\Config\Settings;
use TMCms\Log\Stats;

$start_microtime = microtime(1);
error_reporting(-1);

// No direct access to PHP files
define('INC', true);
define('MODE', 'site');

// Path constants
require_once 'boot.php';

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
<?php

use neTpyceB\TMCms\Admin\FrontPanel;
use neTpyceB\TMCms\Admin\Users;
use neTpyceB\TMCms\App\Frontend;
use neTpyceB\TMCms\Config\Settings;
use neTpyceB\TMCms\Log\Stats;

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
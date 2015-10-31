<?php

use neTpyceB\TMCms\App\Backend;
use neTpyceB\TMCms\Config\Settings;
use neTpyceB\TMCms\Log\Stats;

$start_microtime = microtime(1);
error_reporting(-1);

define('INC', true);
define('MODE', 'cms');

// Startup
require_once '../boot.php';

echo new Backend;

// Show debug info including execution time, memory usage and DB queries
if (Settings::get('debug_panel')) {
    Stats::getView();
}
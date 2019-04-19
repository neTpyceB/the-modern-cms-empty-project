<?php
declare(strict_types=1);

use TMCms\App\Backend;
use TMCms\Config\Settings;
use TMCms\Log\Stats;

$start_microtime = microtime(true);
error_reporting(-1);

define('INC', true);
define('MODE', 'cms');

// Startup
require_once __DIR__ . '/../boot.php';

echo new Backend;

// Show debug info including execution time, memory usage and DB queries
if (Settings::get('debug_panel')) {
    Stats::getView();
}

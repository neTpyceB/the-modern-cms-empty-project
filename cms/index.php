<?php

use neTpyceB\TMCms\App\Backend;

$start_microtime = microtime(1);
error_reporting(-1);

define ('INC', true);
define('MODE', 'cms');

// Startup
require_once '../boot.php';

echo new Backend;
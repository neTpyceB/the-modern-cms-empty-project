<?php

// These are production server settings, shared between all developers
$config_prod = [
    'db' => [
        'login' => 'login',
        'password' => 'password',
        'name' => 'db_name'
    ],
    'site' => [
        'email' => 'your@email.com',
        'name' => 'Website Name'
    ],
    'cms' => [
        'unique_key' => 'your_unique_key'
    ]
];

// Change all your local settings in local.php
// File should return array with fields that need to be overwritten
$config_local = [];
if (file_exists(__DIR__ . '/local.php')) {
    $config_local = include_once __DIR__ . '/local.php';
}

return array_merge($config_prod, $config_local);
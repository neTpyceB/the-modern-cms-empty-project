<?php

// These are production server settings, shared between all developers
$config_prod = [
    'db' => [
        'login' => 'phpci-tmcms-empt',
        'password' => 'phpci-tmcms-empty',
        'name' => 'phpci_tmcms_empty'
    ],
    'site' => [
        'email' => 'your@email.com',
        'name' => 'Website Name'
    ],
    'cms' => [
        'unique_key' => 'your_unique_key', // Required for updates
        'logo' => '/vendor/devp-eu/tmcms-core/src/assets/images/logo.png', // Logo in admin panel
        'favicon' => DIR_CMS_IMAGES_URL . 'logo_square.png', // Favicon in admin panel
        'logo_link' => 'http://devp.eu/', // Link on logo in admin panel
    ],
    'http_auth' => [
        'login' => '', // Set if required
        'password' => '',
    ]
];

// Change all your local settings in local.php - file should return array with fields to be overwritten
$config_local = [];
if (file_exists(__DIR__ . '/local.php')) {
    $config_local = include __DIR__ . '/local.php';
}

return array_replace_recursive($config_prod, $config_local);
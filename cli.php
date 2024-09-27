<?php

declare(strict_types=1);

use Laminas\Mvc\Application;
use Laminas\Stdlib\ArrayUtils;

// Ensure error reporting is enabled
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

chdir(dirname(__DIR__));

// Determine the path to vendor/autoload.php
$vendorAutoload = __DIR__ . '/vendor/autoload.php';

if (!file_exists($vendorAutoload)) {
    // Attempt to locate vendor directory in parent directories
    $vendorAutoload = dirname(__DIR__) . '/vendor/autoload.php';
    if (!file_exists($vendorAutoload)) {
        throw new RuntimeException(
            "Unable to locate vendor/autoload.php. Please run 'composer install' in the appropriate directory."
        );
    }
}

require $vendorAutoload;

if (!class_exists(Application::class)) {
    throw new RuntimeException(
        "Unable to load application.\n"
        . "- Type `composer install` if you are developing locally.\n"
        . "- Type `vagrant ssh -c 'composer install'` if you are using Vagrant.\n"
        . "- Type `docker-compose run laminas composer install` if you are using Docker.\n"
    );
}

$appConfig = require __DIR__ . '/../config/application.config.php';
if (file_exists(__DIR__ . '/../config/development.config.php')) {
    $appConfig = ArrayUtils::merge($appConfig, require __DIR__ . '/../config/development.config.php');
}

// Initialize the application
$application = Application::init($appConfig);

// Define the cache directory
$cacheDir = __DIR__ . '/../data/cache/';

// Check if the cache directory exists
if (is_dir($cacheDir)) {
    // Recursively delete cache files
    $files = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($cacheDir, RecursiveDirectoryIterator::SKIP_DOTS),
        RecursiveIteratorIterator::CHILD_FIRST
    );

    foreach ($files as $fileinfo) {
        $todo = ($fileinfo->isDir() ? 'rmdir' : 'unlink');
        $todo($fileinfo->getRealPath());
    }

    echo "Configuration cache cleared successfully.\n";
} else {
    echo "Cache directory does not exist.\n";
}

<?php

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Notes\DoctrineConnector\EntityManagerFactory;

require_once __DIR__ . '/vendor/autoload.php'; // Use require_once for better practice

// Create a global container to hold dependencies
global $container;

// Include the container configuration
$container = require 'config/container.php';

// Create an instance of EntityManagerFactory
$factory = new EntityManagerFactory();

// Try to create the EntityManager instance
try {
    $entityManager = $factory($container);
} catch (\Exception $e) {
    // Handle exceptions during EntityManager creation
    echo 'Error creating EntityManager: ' . $e->getMessage() . PHP_EOL;
    exit(1); // Exit with a failure code
}

// Return the ConsoleRunner helper set with the created EntityManager
return ConsoleRunner::createHelperSet($entityManager);

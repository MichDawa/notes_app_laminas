<?php

namespace Notes\DoctrineConnector;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Doctrine\DBAL\Driver\Mysqli\Driver; // Import MySQLi driver
use Doctrine\DBAL\Types\Type;
use Psr\Container\ContainerInterface;
use Webmozart\Assert\Assert;

class EntityManagerFactory
{
    /**
     * Create and return a Doctrine EntityManager instance.
     *
     * @param ContainerInterface $container The service container
     * @throws \RuntimeException If Doctrine configuration is missing
     * @return EntityManager The configured EntityManager instance
     */
    public function __invoke(ContainerInterface $container): EntityManager
    {
        // Retrieve configuration from the container
        $config = $container->get('config');
        
        // Ensure the 'doctrine' configuration exists
        Assert::that($config)
            ->keyExists('doctrine', "No Doctrine ORM configuration specified. Check your 'config/autoload/doctrine.global.php'.");

        // Retrieve Doctrine configuration settings
        $doctrineConfigArray = $config['doctrine'];

        // Extract necessary configuration parameters
        $paths = $doctrineConfigArray['driver']['orm_default']['paths']; // Entity paths
        $dbParams = $doctrineConfigArray['connection']['orm_default']['params']; // DB params
        $isDevMode = $doctrineConfigArray['is_dev_mode'];

        // Set up Doctrine ORM configuration
        $doctrineConfig = Setup::createAnnotationMetadataConfiguration(
            $paths, 
            $isDevMode, 
            null, 
            null, 
            false // not using simple annotation reader
        );

        // Optional: Set proxy directory if needed
        $doctrineConfig->setProxyDir('data/DoctrineORMModule/Proxy');
        $doctrineConfig->setAutoGenerateProxyClasses($isDevMode);

        // Ensure MySQLi driver is used for the DBAL connection
        $dbParams['driverClass'] = Driver::class;

        // Create the EntityManager with the given database parameters and configuration
        $entityManager = EntityManager::create($dbParams, $doctrineConfig);

        // Optional: Add custom type support (e.g., boolean)
        if (!Type::hasType('boolean')) {
            Type::addType('boolean', 'Doctrine\DBAL\Types\BooleanType');
        }

        // Return the EntityManager instance
        return $entityManager;
    }
}

<?php

namespace Notes\DoctrineConnector; // Replace with your actual namespace

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Driver\Mysqli\Driver; // Import the MySQLi driver
use Psr\Container\ContainerInterface;
use Webmozart\Assert\Assert;

class EntityManagerFactory
{
    /**
     * Set up and return a Doctrine EntityManager instance.
     *
     * @param ContainerInterface $container The service container
     * @throws \RuntimeException If the Doctrine configuration is not found
     * @return EntityManager The configured EntityManager instance
     */
    public function __invoke(ContainerInterface $container): EntityManager
    {
        // Retrieve configuration from the container
        $config = $container->get('config');

        // Ensure Doctrine configuration exists
        Assert::that($config)
            ->keyExists('doctrine', "No Doctrine ORM configuration specified. Check your 'config/autoload/database.local.php'");

        // Extract configuration parameters
        $paths = $config['doctrine']['paths'];
        $dbParams = $config['doctrine']['db_params'];
        $isDevMode = $config['doctrine']['is_dev_mode'];

        // Create configuration for Doctrine
        $doctrineConfig = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
        $doctrineConfig->setProxyDir("temp/proxies");
        $doctrineConfig->setAutoGenerateProxyClasses($isDevMode); // Consider using auto-generation in dev mode

        // Specify the driver class for MySQLi
        $dbParams['driverClass'] = Driver::class; // Specify MySQLi driver

        // Create EntityManager with the given database parameters and configuration
        $entityManager = EntityManager::create($dbParams, $doctrineConfig);

        // Note: MySQLi does not require enabling native prepared statements like PDO
        // so no additional code for setting attributes is necessary

        // Optionally, you can manage the boolean type manually if needed
        if (!Type::hasType('boolean')) {
            Type::addType('boolean', 'Doctrine\DBAL\Types\BooleanType'); // Use default BooleanType
        }

        return $entityManager;
    }
}

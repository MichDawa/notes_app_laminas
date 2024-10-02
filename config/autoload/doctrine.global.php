<?php

use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Doctrine\DBAL\Driver\Mysqli\Driver;

return [
    'doctrine' => [

        'connection' => [
            'orm_default' => [
                'driverClass' => Driver::class,
                'params'   => [
                    'host'     => 'localhost',
                    'port'     => '3306',
                    'dbname'   => 'notes',
                    'user'     => 'root',
                    'password' => '',
                    'charset'  => 'utf8mb4',
                    'server_version' => 'mariadb-10.4.32',
                ],
            ],
        ],

        'migrations' => [
            'directory' => __DIR__ . '/../../data/DoctrineMigrations',
            'table' => 'doctrine_migration_versions',
            'migrations_paths' => [
                'DoctrineMigrations' => __DIR__ . '/../../data/DoctrineMigrations',
            ],
        ],

        'driver' => [
            'orm_default' => [
                'class' => AnnotationDriver::class,
                'paths' => [__DIR__ . '/../../module/Notes/src/Entity'],
            ],
        ],

        'configuration' => [
            'orm_default' => [
                'proxy_dir' => __DIR__ . '/../data/DoctrineORMModule/Proxy',
                'proxy_namespace' => 'DoctrineORMModule\Proxy',
            ],
        ],
        
        'is_dev_mode' => false,
    ],
];

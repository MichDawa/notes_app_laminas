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
                    'dbname'   => 'todo_db',
                    'user'     => 'root',
                    'password' => '',
                ],
            ],
        ],
        
        'migrations' => [
            'directory' => 'data/DoctrineMigrations',
            'namespace' => 'DoctrineMigrations',
            'table' => 'doctrine_migration_versions',
        ],

        'driver' => [
            'orm_default' => [
                'class' => AnnotationDriver::class,
                'paths' => ['C:\Users\mldawa\Desktop\CRUD\notes_app_laminas\backend\module\Notes\src\Entity'], // Path to your entity classes
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
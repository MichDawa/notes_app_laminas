<?php

declare(strict_types=1);

namespace Notes;

use Laminas\Router\Http\Literal;
use Laminas\Router\Http\Segment;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Doctrine\DBAL\Driver\Mysqli\Driver;

return [
    'router' => [
        'routes' => [
            'notes' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/notes[/:action[/:id]]',
                    'defaults' => [
                        'controller' => Controller\NoteController::class,
                        'action'     => 'all',
                    ],
                    'constraints' => [
                        'id' => '[0-9]+',
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ],
                ],
            ],
        ],
    ],

    'controllers' => [
        'factories' => [
            Controller\NoteController::class => function ($container) {
                return new Controller\NoteController($container->get(EntityManager::class));
            },
        ],
    ],

    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => [
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'notes/note/all' => __DIR__ . '/../view/notes/index/all.phtml',
            // 'notes/note/new' => __DIR__ . '/../view/notes/index/new.phtml',
            'notes/note/view' => __DIR__ . '/../view/notes/index/view.phtml',
            // 'notes/note/edit' => __DIR__ . '/../view/notes/index/edit.phtml',
            // 'notes/note/delete' => __DIR__ . '/../view/notes/index/delete.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],

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
                'paths' => ['C:/Users/mldawa/Desktop/CRUD/notes_app_laminas/backend/module/Notes/src/Entity'],
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

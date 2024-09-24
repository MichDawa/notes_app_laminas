<?php

declare(strict_types=1);

namespace Notes;

use Laminas\Router\Http\Literal;
use Laminas\Router\Http\Segment;
use Laminas\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'notes' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/notes[/:action]',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'all',
                    ],
                ],
            ],
            'new' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/new[/:action]',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'new',
                    ],
                ],
            ],
            'view' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/view[/:action]',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'view',
                    ],
                ],
            ],
            'edit' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/edit[/:action]',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'edit',
                    ],
                ],
            ],
            'delete' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/delete[/:action]',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'delete',
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\IndexController::class => InvokableFactory::class,
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
            'notes/index/all' => __DIR__ . '/../view/notes/index/all.phtml',
            'notes/index/new' => __DIR__ . '/../view/notes/index/new.phtml',
            'notes/index/view' => __DIR__ . '/../view/notes/index/view.phtml',
            'notes/index/edit' => __DIR__ . '/../view/notes/index/edit.phtml',
            'notes/index/delete' => __DIR__ . '/../view/notes/index/delete.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];

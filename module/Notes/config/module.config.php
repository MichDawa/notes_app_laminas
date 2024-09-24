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
                        'controller' => Controller\NoteController::class,
                        'action'     => 'all',
                    ],
                ],
            ],
            'new' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/new[/:action]',
                    'defaults' => [
                        'controller' => Controller\NoteController::class,
                        'action'     => 'new',
                    ],
                ],
            ],
            'view' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/view[/:action]',
                    'defaults' => [
                        'controller' => Controller\NoteController::class,
                        'action'     => 'view',
                    ],
                ],
            ],
            'edit' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/edit[/:action]',
                    'defaults' => [
                        'controller' => Controller\NoteController::class,
                        'action'     => 'edit',
                    ],
                ],
            ],
            'delete' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/delete[/:action]',
                    'defaults' => [
                        'controller' => Controller\NoteController::class,
                        'action'     => 'delete',
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\NoteController::class => InvokableFactory::class,
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
            'notes/note/new' => __DIR__ . '/../view/notes/index/new.phtml',
            'notes/note/view' => __DIR__ . '/../view/notes/index/view.phtml',
            'notes/note/edit' => __DIR__ . '/../view/notes/index/edit.phtml',
            'notes/note/delete' => __DIR__ . '/../view/notes/index/delete.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];

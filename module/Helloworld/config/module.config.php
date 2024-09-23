<?php

declare(strict_types=1);

namespace Helloworld;

use Laminas\Router\Http\Literal;
use Laminas\ServiceManager\Factory\InvokableFactory;
use Laminas\Log\Logger;


return [
    'service_manager' => [
        'factories' => [
            Logger::class => Factory\LoggerFactory::class,
        ],
    ],
    'router' => [
        'routes' => [
            'helloworld' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/helloworld',
                    'defaults' => [
                        'controller' => Controller\HelloWorldController::class,
                        'action'     => 'helloworld',
                    ],
                ],
            ],
        ],
    ],
    
    'controllers' => [
        'factories' => [
            Controller\HelloWorldController::class => Factory\LoggerFactory::class,
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
            'helloworld/index/index'  => __DIR__ . '/../view/helloworld/hello-world/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];

<?php

/**
 * If you need an environment-specific system or application configuration,
 * there is an example in the documentation
 *
 * @see https://docs.laminas.dev/tutorials/advanced-config/#environment-specific-system-configuration
 * @see https://docs.laminas.dev/tutorials/advanced-config/#environment-specific-application-configuration
 */

 return [
    'modules' => require __DIR__ . '/modules.config.php',

    'module_listener_options' => [
        'use_laminas_loader' => false,
        'module_paths' => [
            './module',
            './vendor',
        ],
        'config_glob_paths' => [
            realpath(__DIR__) . '/autoload/{{,*.}global,{,*.}local}.php',
        ],
        'config_cache_enabled' => true,
        'config_cache_key' => 'application.config.cache',
        'module_map_cache_enabled' => true,
        'module_map_cache_key' => 'application.module.cache',
        'cache_dir' => 'data/cache/',
    ],

    // 'service_manager' => [
    //     'factories' => [
    //         Laminas\ApiTools\ContentNegotiation\AcceptListener::class => function($container) {
    //             $config = $container->get('config'); // Retrieve the 'config' array
    //             return new Laminas\ApiTools\ContentNegotiation\AcceptListener($config['api-tools-content-negotiation']);
    //         },
    //     ],
    // ],
];

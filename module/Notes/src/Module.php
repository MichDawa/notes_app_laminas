<?php

declare(strict_types=1);

namespace Notes;

use Laminas\Mvc\MvcEvent;
use Laminas\Db\Adapter\Adapter;
use Notes\Listener\CorsListener;

class Module
{
    public function getConfig(): array
    {
        /** @var array $config */
        $config = include __DIR__ . '/../config/module.config.php';
        return $config;
    }

    public function getServiceConfig()
    {
        return [
            'factories' => [
                'Laminas\Db\Adapter\Adapter' => function ($container) {
                    $config = $container->get('config');
                    return new Adapter($config['db']);
                },
            ],
        ];
    }
}

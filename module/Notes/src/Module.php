<?php

declare(strict_types=1);

namespace Notes;

use Laminas\Mvc\MvcEvent;
use Laminas\Db\Adapter\Adapter;

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

    public function onBootstrap(MvcEvent $e)
    {
        $app = $e->getApplication();
        $em  = $app->getEventManager();

        $em->attach(MvcEvent::EVENT_ROUTE, [$this, 'enableCors'], -1000);
    }

    public function enableCors(MvcEvent $e)
    {
        /** @var \Laminas\Http\Response $response */
        $response = $e->getResponse();
        /** @var \Laminas\Http\Request $request */
        $request  = $e->getRequest();

        $response->getHeaders()->addHeaderLine('Access-Control-Allow-Origin', '*')
            ->addHeaderLine('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
            ->addHeaderLine('Access-Control-Allow-Headers', 'Content-Type, Authorization');

        if ($request->getMethod() === 'OPTIONS') {
            // Return early for preflight requests
            $response->setStatusCode(200);
            return $response;
        }
    }
}

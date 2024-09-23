<?php

declare(strict_types=1);

namespace Helloworld\Factory;

use Helloworld\Controller\HelloWorldController;
use Laminas\Log\Logger;
use Psr\Container\ContainerInterface;

class LoggerFactory
{
    public function __invoke(ContainerInterface $container): HelloWorldController
    {
        $logger = $container->get(Logger::class);
        return new HelloWorldController($logger);
    }
}

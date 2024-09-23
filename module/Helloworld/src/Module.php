<?php

declare(strict_types=1);

namespace Helloworld;

use Laminas\Mvc\MvcEvent;
use Laminas\Log\Logger;

class Module
{
    public function getConfig(): array
    {
        /** @var array $config */
        $config = include __DIR__ . '/../config/module.config.php';
        return $config;
    }

}

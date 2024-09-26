<?php

use Notes\DoctrineConnector\EntityManagerFactory;

return [
    'factories' => [
        Doctrine\ORM\EntityManager::class => EntityManagerFactory::class,
    ],
];

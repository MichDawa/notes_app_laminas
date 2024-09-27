<?php

/**
 * List of enabled modules for this application.
 *
 * This should be an array of module namespaces used in the application.
 */
return [
    'Laminas\Mvc\I18n',
    'Laminas\Cache',
    'Laminas\Paginator',
    'Laminas\Form',
    'Laminas\I18n',
    'Laminas\Log',
    'Laminas\InputFilter',
    'Laminas\Filter',
    'Laminas\Hydrator',
    'Laminas\Di',
    'Laminas\Db',
    'Laminas\Router',
    'Laminas\Validator',
    'Laminas\DeveloperTools',
    'Laminas\ZendFrameworkBridge',
    
    // Correct Laminas Api Tools modules
    'Laminas\ApiTools\Versioning',
    'Laminas\ApiTools\ApiProblem',
    'Laminas\ApiTools\ContentNegotiation',
    'Laminas\ApiTools\Rpc',
    'Laminas\ApiTools\MvcAuth',
    'Laminas\ApiTools\Hal',
    'Laminas\ApiTools\Rest',
    'Laminas\ApiTools\ContentValidation',
    'Laminas\ApiTools\Configuration',
    'Laminas\ApiTools\Admin',
    'Laminas\ApiTools\Admin\Ui',
    
    // Your custom modules
    'Application',
    'Notes',

    // Doctrine modules
    'DoctrineModule',
    'DoctrineORMModule',
];


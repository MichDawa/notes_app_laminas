<?php

declare(strict_types=1);

namespace Helloworld\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class HelloWorldController extends AbstractActionController
{
    public function indexAction()
    {
        return new ViewModel(['message' => 'Hello, World!']);
    }
}

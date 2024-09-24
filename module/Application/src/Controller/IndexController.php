<?php

declare(strict_types=1);

namespace Application\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function homeAction()
    {
        $viewModel = new ViewModel();
        $viewModel->setTemplate('application/index/home');
        return $viewModel;
    }

    public function indexAction()
    {
        $viewModel = new ViewModel();
        $viewModel->setTemplate('application/index/index');
        return $viewModel;
    }
}

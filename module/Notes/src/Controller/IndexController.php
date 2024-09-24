<?php

declare(strict_types=1);

namespace Notes\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function allAction()
    {
        return new ViewModel();
    }
    public function newAction()
    {
        return new ViewModel();
    }
    
    public function viewAction()
    {
        return new ViewModel();
    }
    
    public function editAction()
    {
        return new ViewModel();
    }
    public function deleteAction()
    {
        return new ViewModel();
    }
}

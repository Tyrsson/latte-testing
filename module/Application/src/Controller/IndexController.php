<?php

declare(strict_types=1);

namespace Application\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use Latte\Model\LatteModel;

class IndexController extends AbstractActionController
{
    public function indexAction(): LatteModel
    {
        $data  = [
            'user'    => 'John Doe',
            'message' => 'Hello!!',
        ];
        $latte = new LatteModel();
        $latte->setVariables($data);
        return $latte;
    }

    public function testAction(): ViewModel
    {
        $data = [
            'user'    => 'John Doe',
            'message' => 'Hello!!',
        ];
        $view = new ViewModel();
        $view->setVariables($data);
        return $view;
    }
}

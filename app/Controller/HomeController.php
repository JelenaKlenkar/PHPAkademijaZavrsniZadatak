<?php


namespace App\Controller;


use App\Model\Employee\EmployeeResource;

class HomeController extends AbstractController {

    public function indexAction(){

        return $this->view->render('login');
    }
}

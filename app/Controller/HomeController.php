<?php


namespace App\Controller;


use App\Model\User;

class HomeController extends AbstractController {

    public function indexAction(){

        return $this->view->render('login');
    }
}

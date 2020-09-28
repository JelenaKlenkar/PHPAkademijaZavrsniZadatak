<?php
namespace app\Controller;


class homeController {
    public function index(){
        return $this->view->renderer('login');
    }
}

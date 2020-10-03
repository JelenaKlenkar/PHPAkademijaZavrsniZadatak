<?php


namespace App\Controller;

use App\Core\Auth;
use App\Core\Session;
use App\Core\View;

abstract class AbstractController
{
    protected $view;
    protected $auth;
    protected $session;

    public function __construct()
    {
        $this->view = new View();
        $this->auth = Auth::getInstance();
        $this->session = Session::getInstance();
    }

    protected function isPost(): bool
    {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    protected function isGet(): bool
    {
        return $_SERVER['REQUEST_METHOD'] === 'GET';
    }
}
<?php

namespace App\Controller;

use App\Model;
use App\Model\User;


class UserController extends AbstractController
{
    public function loginAction()
    {
        if (!$this->auth->isLoggedIn()) {
            return $this->view->render('login');
        }

        header('Location: /user/');
    }

    public function registerAction()
    {
        if (!$this->auth->isLoggedIn()) {
            return $this->view->render('register');
        }

        header('Location: /user/');
    }

    public function registerSubmitAction()
    {
        if (!$this->isPost()) {
            // only POST requests are allowed
            header('Location: /user/');
            return;
        }

        $requiredKeys = ['username', 'email', 'password', 'confirm_password'];
        if (!$this->validateData($_POST, $requiredKeys)) {
            // set error message
            header('Location: /user/register');
            return;
        }

        if ($_POST['password'] !== $_POST['confirm_password']) {
            // set error message
            header('Location: /user/register');
            return;
        }

        $user = User::getOne('email', $_POST['email']);

        if ($user->getId()) {
            // user already exists
            header('Location: /user/register');
            return;
        }

        (new \App\Model\User\UserResource)->insertUser([
            'username' => $_POST['username'] ?? null,
            'email' => $_POST['email'] ?? null,
            'user_type' => $_POST['user_type'],
            'password' => password_hash($_POST['password'], PASSWORD_DEFAULT)
        ]);

        header('Location: /user/login');
    }

    public function loginSubmitAction()
    {
        // only POST requests are allowed
        if (!$this->isPost() || $this->auth->isLoggedIn()) {
            header('Location: /user/login');
            return;
        }

        $requiredKeys = ['email', 'password'];
        if (!$this->validateData($_POST, $requiredKeys)) {
            // set error message
            header('Location: /user/login');
            return;
        }

        $user = User::getOne('email', $_POST['email']);

        if (!$user->getId() || !password_verify($_POST['password'], $user->getPassword())) {
            // set error message
            header('Location: /user/login');
            return;
        }

        $this->auth->login($user);
        header('Location: /user/loginSubmit');
    }

    protected function validateData(array $data, array $keys): bool
    {
        foreach ($keys as $key) {
            $isValueValid = isset($data[$key]) && $data[$key];
            if (!$isValueValid) {
                return false;
            }
        }
        return true;
    }

    public function logoutAction()
    {
        if ($this->auth->isLoggedIn()) {
            $this->auth->logout();
        }

        header('Location: /');
    }
}

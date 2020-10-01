<?php
namespace App\Controller;

use App\Core\Request;
use App\Core\Session;
use App\Core\View;
use App\Model\User\User;
use App\Model\User\UserRepository;
use App\Model\User\UserResource;

class UserController{

    private $userRepository;
    private $userResource;
    private $session;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
        $this->userResource = new UserResource();
        $this->session = Session::getInstance();
    }

    public function loginAction()
    {
        $view = new View();
        $view->render('login');
    }

    public function loginSubmitAction()
    {
        // Check if user is logged in already
        $session = $this->session;
        if ($session->getUser()) {
            return;
        }

        // Get data from POST
        $postData = Request::getPostParams();
        $email = Request::getPostParam('email');
        $password = Request::getPostParam('pass');

        // Check if submit data is missing
        if (!$email || !$password) {
            return;
        }

        // Get user by email
        $user =  $this->userRepository->getUserByEmail($email);

        // No user with this email
        if (!$user) {
            return;
        }

        // User Exists, get hash to check password
        $hash = $user->getPass();

        // Invalid username or password
        if (!password_verify($password, $hash)) {
            return;
        }

        // All ok, login user, attach to session and redirect somewhere
        $session->setUser($user);
        header('Location: ' . Config::get('url'));

//        $path = session_save_path();
//        $sessionID = session_id();
//        $session->setTest('test');
////        $_SESSION['favcolor'] = 'green';
////        $_SESSION['animal']   = 'cat';
////        $_SESSION['time']     = time();
    }

    /**
     * Logout and redirect to homepage
     */
    public function logoutAction()
    {
        Session::getInstance()->logout();
        header('Location: ' . Config::get('url'));
    }

    public function registerAction()
    {
        // Check session, if it exists, redirect to home
        if ($this->session->isLoggedIn()) {
            $url = Config::get('url');
            header('Location: ' . $url);
            exit();
        }

        $view = new View();
        $view->render('register', []);
    }

    public function registerSubmitAction()
    {
        $postData = Request::getPostParams();
        $email = Request::getPostParam('email');
        $firstname = Request::getPostParam('firstname');
        $lastname = Request::getPostParam('lastname');
        $password = Request::getPostParam('pass');

        // Check if submit data is missing
        if (!$email || !$firstname || !$lastname || !$password) {
            return;
        }

        // Check if user email already exists
        if($this->userRepository->userEmailExists($email)) {
            return;
        }

        // Create new user
        $result = $this->userResource->insertUser($postData);

        // Something went wrong inserting user
        if (!$result) {
            return;
        }

        // Everything ok
        Session::getInstance()->logout();
        $url = Config::get('url') . 'user/login';
        header('Location: ' . $url);
    }
}

<?php


namespace Controllers;


use Config\Config;

class Login extends Base
{
    public function index($params, $method)
    {
        $params['action'] = '/Login';

        if ($method === 'POST') {
            $this->signIn($params);
        }

        if (static::isLoggedIn()) {
            $this->redirection('/?success_login');
        }

        return $this->render('Login', $params);
    }

    public function signOut()
    {
        unset($_SESSION['user']);
        session_destroy();

        return $this->redirection('/Login');
    }

    protected function signIn(&$params)
    {
        $login = $_POST['login'] ?? null;
        $password = $_POST['password'] ?? null;

        if ($login === Config::$adminLogin && $password === Config::$adminPassword) {
            $_SESSION['user'] = md5("$login|$password");
        } else {
            $params['alert'] = static::alert("Введен неверный логин или пароль", 'danger');
        }

        return true;
    }
}
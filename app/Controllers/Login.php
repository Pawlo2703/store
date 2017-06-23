<?php

namespace Shop\Controllers;

use Shop\Core\Controller;
use Shop\Models\User;
use Shop\Models\RememberMe;
use Shop\Core\Cookie;

class Login extends Controller {

    public function display() {
        $this->header();
        $this->view('home/login/login');
    }

    public function submit() {
        $this->header();
        $params = $this->getParameters();
        $user = new User;
        $remember = new RememberMe;
        $cookie = new Cookie;

        if ($userId = $user->findByEmail($params['email'])) {

            if (!$userId) {
                $this->view('home/login/error/email');
                return;
            }

            $userPw = $user->checkPassword($userId);
            $pw = $params['password'];
            if (password_verify($pw, $userPw)) {
                $user->load($userId); // dorobic w modelu wczytywanie danych
                $this->session->set('zmienna2', $user->getId());
            } else {
                $this->view('home/login/error/password');
                exit;
            }
        } else {
            $this->view('home/login/error/email');
            exit;
        }

        if (isset($params['remember'])) {
            $bigKey = $cookie->generateRandomString();
            var_dump($bigKey);
            $remember->setBigKey($bigKey);
            $remember->addCookie($userId);
            setcookie('email', $bigKey, time() + 60 * 60 * 7);
            var_dump($_COOKIE['email']);
        }


        $this->redirect("home");
    }

}

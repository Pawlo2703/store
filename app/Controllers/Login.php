<?php

namespace Shop\Controllers;

use Shop\Core\Controller;
use Shop\Models\User;

class Login extends Controller {

    public function display() {
        $this->header();
        $this->view('home/login/login');
    }

    public function submit() {
        $this->header();
        $params = $this->getParameters();
        $user = new User;

        if ($userId = $user->findByEmail($params['email'])) {

            if (!$userId) {
                $this->view('home/login/error/email');
                return;
            }

            $userPw = $user->checkPassword($userId);
            $pw = $params['password'];
            if (password_verify($pw, $userPw)) {
                $user->load($userId); // dorobic w modelu wczytywanie danych
                $this->session->set('zmienna', $user->getName());
                $this->session->set('zmienna2', $user->getId());
            } else {
                $this->view('home/login/error/password');
                exit;
            }
        } else {
            $this->view('home/login/error/email');
            exit;
        }
        $this->redirect("home");
    }

}

<?php

namespace Shop\Controllers;

use Shop\Core\Controller;
use Shop\Models\User;

class Register extends Controller {

    const NAME_LENGTH = 20;

    public function display() {
        $this->header();
        $this->view('home/register/register');
    }

    public function submit() {
        $this->header();
        $params = $this->getParameters();
        $user = new User;

        $this->nameLength($params);

        $user->setName($params['name']);
        $user->setSurname($params['surname']);
        $user->setEmail($params['email']);
        $user->setPassword(password_hash($params['password'], PASSWORD_DEFAULT, ['cost' => 10]));

        if ($user->register() == !NULL) {
            $this->view('home/register/created');
            die();
        } else {
            $this->view('home/register/error/email_in_use');
            die();
        }
    }

    public function nameLength($params) {
        if (strlen($params['name']) <= self::NAME_LENGTH && (strlen($params['surname'])) <= self::NAME_LENGTH) {
            $this->passwordValidate($params);
        } else {
            $this->view('home/register/error/name_length');
            die();
        }
    }

    public function passwordValidate($params) {
        if (strlen($params['password']) < 25 && strlen($params['password']) > 6) {
            if ($params['password'] == $params['password_confirmation']) {
                $this->emailValidate($params);
            } else {
                $this->view('home/register/error/password_confirmation');
                die();
            }
        } else {
            $this->view('home/register/error/password_lenght');
            die();
        }
    }

    public function emailValidate($params) {
        if (filter_var($params['email'], FILTER_VALIDATE_EMAIL)) {
            
        } else {
            $this->view('home/register/error/email_validate');
            die();
        }
    }

}

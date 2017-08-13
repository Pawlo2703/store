<?php

namespace Shop\Controllers;

use Shop\Core\Controller;
use Shop\Models\User;

/**
 * Class Register
 */
class Register extends Controller {

    /**
     * Maximum name length
     */
    const NAME_LENGTH = 20;

    /**
     * Display register form
     */
    public function display() {
        $this->header();
        $user = new User;
        $data = ['user' => $user];
        $this->view('home/register/register', $data);
    }

    /**
     * Register form submit
     */
    public function submit() {
        $this->header();
        $params = $this->getParameters();
        $user = new User;

        $this->nameLength($params);
        $user->setName($params['name']);
        $user->setSurname($params['surname']);
        $user->setEmail($params['email']);

        if (isset($params['newsletter'])) {
            $user->setNewsletter($params['newsletter']);
        }
        $user->setPassword(password_hash($params['password'], PASSWORD_DEFAULT, ['cost' => 10]));
        if ($user->register() == !NULL) {
            $this->view('home/register/created');
            exit;
        } else {
            $this->view('home/register/error/email_in_use');
            exit;
        }
    }

    /**
     * Check if name lenght does not exceed 20 characters
     * @param array $params
     */
    public function nameLength($params) {
        if (strlen($params['name']) <= self::NAME_LENGTH && (strlen($params['surname'])) <= self::NAME_LENGTH) {
            $this->passwordValidate($params);
        } else {
            $this->view('home/register/error/name_length');
            exit;
        }
    }

    /**
     * Check if password is between 6 and 25 characters and compare it with password from database
     * @param array $params
     */
    public function passwordValidate($params) {
        if (strlen($params['password']) < 25 && strlen($params['password']) > 6) {
            if ($params['password'] == $params['password_confirmation']) {
                $this->emailValidate($params);
            } else {
                $this->view('home/register/error/password_confirmation');
                exit;
            }
        } else {
            $this->view('home/register/error/password_lenght');
            exit;
        }
    }

    /**
     * Check if email has proper form
     * @param array $params
     */
    public function emailValidate($params) {
        if (filter_var($params['email'], FILTER_VALIDATE_EMAIL)) {
            
        } else {
            $this->view('home/register/error/email_validate');
            exit;
        }
    }

}

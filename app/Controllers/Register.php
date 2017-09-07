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
        $user->setPassword(password_hash($params['password'], PASSWORD_DEFAULT, ['cost' => 10]));

        if (isset($params['newsletter'])) {
            $user->setNewsletter($params['newsletter']);
        }

        if ($user->findEmail() !== NULL) {
            $this->view('home/register/error/email_in_use');
            return;
        }

        $user->register();
        $this->view('home/register/created');
    }

    /**
     * Check if name lenght does not exceed 20 characters
     * @param array $params
     */
    public function nameLength($params) {
        if (!(strlen($params['name']) <= self::NAME_LENGTH && (strlen($params['surname'])) <= self::NAME_LENGTH)) {
            $this->view('home/register/error/name_length');
            return;
        }
        $this->passwordValidate($params);
    }

    /**
     * Check if password is between 6 and 25 characters and compare it with password from database
     * @param array $params
     */
    public function passwordValidate($params) {
        if (!(strlen($params['password']) < 25 && strlen($params['password']) > 6)) {
            $this->view('home/register/error/password_lenght');
            return;
        }
        if (($params['password'] !== $params['password_confirmation'])) {
            $this->view('home/register/error/password_confirmation');
            return;
        }
        $this->emailValidate($params);
    }

    /**
     * Check if email has proper form
     * @param array $params
     */
    public function emailValidate($params) {
        if (!(filter_var($params['email'], FILTER_VALIDATE_EMAIL))) {
            $this->view('home/register/error/email_validate');
            return;
        }
    }

}

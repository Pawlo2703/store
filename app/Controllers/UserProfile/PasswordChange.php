<?php

namespace Shop\Controllers\UserProfile;

use Shop\Core\Controller;
use Shop\Models\User;

/**
 * Class PasswordChange
 */
class PasswordChange extends Controller {

    /**
     * Maximum password length
     */
    const PW_LENGTH = 20;

    /**
     * Display password change form
     */
    public function display() {
        $this->checkIfUser();
        $this->header();
        $this->view('home/User_profile/Password_change/password_change_form');
    }

    /**
     * Replace current password with a new one
     */
    public function changePassword() {
        $this->header();
        $params = $this->getParameters();
        $user = new User;
        $id = $this->session->get('user_id');
        $user->setId($id);

        if (($params['newpassword'] !== $params['confirmpassword'])) {
            $this->view('home/User_profile/Password_change/incorrect_pw');
            return;
        }

        $password = $user->checkPassword($id);
        $user->setPassword($password);
        $user->setNewPassword($params['newpassword']);

        if (!(password_verify($params['password'], $user->getPassword()))) {
            $this->view('home/User_profile/Password_change/incorrect_pw');
            return;
        }

        if (strlen($params['newpassword']) >= self::PW_LENGTH) {
            $this->view('home/User_profile/Password_change/bad_length_pw');
            return;
        }

        $user->setNewPassword(password_hash($params['newpassword'], PASSWORD_DEFAULT, ['cost' => 10]));
        $user->updatePassword();
        $this->view('home/User_profile/Password_change/password_change_succes');
    }

}

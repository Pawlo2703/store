<?php

namespace Shop\Controllers;

use Shop\Core\Controller;

/**
 * Class Logout
 */
class Logout extends Controller {

    /**
     * Logout from account
     */
    public function logout() {
        if (isset($_COOKIE['email'])) {
            setcookie('email', '', time());
        }
        $this->session->destroy();
        $this->redirect('home', '');
    }

}

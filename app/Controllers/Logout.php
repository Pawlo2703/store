<?php

namespace Shop\Controllers;

use Shop\Core\Controller;
use Shop\libs\Session;

class Logout extends Controller {

    public function submit() {

        $session = new Session;
        if (isset($_COOKIE['email'])) {
            setcookie('email', '', time());
        }
        $session->destroy();
        $this->redirect('home');
    }
}

<?php

namespace Shop\Controllers;

use Shop\Core\Controller;
use Shop\Models\RememberMe;

/**
 * Class Cookie
 */
class Cookie extends Controller {

    /**
     * Check if cookie exists
     */
    public function checkCookie() {
        $rememberMe = new RememberMe;
        if (isset($_COOKIE['email'])) {
            $rememberMe->setBigKey($_COOKIE['email']);
            $rememberMe->loadCookie();
            $this->session->set('user_id', $rememberMe->getId());
            $this->session->set('admin', $rememberMe->getAdmin());
        }
    }

}

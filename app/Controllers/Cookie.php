<?php

namespace Shop\Controllers;

use Shop\Core\Controller;
use Shop\Models\RememberMe;

class Cookie extends Controller {

    public function checkCookie() {
        $remember = new RememberMe;
        if (isset($_COOKIE['email'])) {
            $remember->setBigKey($_COOKIE['email']);
            $remember->checkCookie();
        }
    }

}

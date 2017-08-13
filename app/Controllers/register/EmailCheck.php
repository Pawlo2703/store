<?php

namespace Shop\Controllers\Register;

use Shop\Core\Controller;
use Shop\Models\User;

/**
 * Class EmailCheck
 */
class EmailCheck extends Controller {

    public function emailConfirmation() {
        $params = $this->getParameters();
        var_dump($params);
        exit();
        $user = new User;
        $user->findByEmail($email);
    }

}

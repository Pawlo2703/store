<?php

namespace Shop\Core;

use Shop\libs\Session;

class Cookie {

    private $id;

    public function getId() {
        return $this->id;
    }

    public function __construct() {
        $this->database = \Shop\Core\Database::getInstance();
        $this->session = new Session();
    }

    public function checkCookie() {
        if (isset($_COOKIE['email'])) {
            $bigKey = $_COOKIE['email'];
            $result = $this->database->getRow('id', 'remember', "WHERE bigKey = ?", [$bigKey]);
            if (!empty($result)) {
                $this->id = $result['id'];
                $this->session->set('zmienna2', $this->id);
                var_dump($_SESSION);
            }
        }
    }

    function generateRandomString() {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $string = '';
        for ($i = 0; $i < 20; ++$i) {
            $string .= $characters[rand(0, $charactersLength - 1)];
        }
        return $string;
    }

}

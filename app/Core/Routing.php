<?php

namespace Shop\Core;

class Routing {

    public function __construct() {
        if (isset($_GET['url'])) {
            $action = array("home", "rejestracja", "submit", "login", "zalogowano", "logout");
            $controller = array("home/display", "register/display", "register/submit", "login/display", "login/submit", "logout/submit");
            $url = $_GET['url'];
            $key = array_search($url, $action);

            switch ($url) {
                case "$action[$key]":
                    $_GET['url'] = "$controller[$key]";
                    break;
                default:
                    $_GET['url'] = 'error/404';
                    break;
            }
        }
    }

}

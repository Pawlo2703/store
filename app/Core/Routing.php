<?php

namespace Shop\Core;

class Routing {

    public function __construct() {
        //var_dump($_GET['url']);

        if (isset($_GET['url'])) {
            $action = array("home", "rejestracja", "submit");
            $controller = array("home/display", "register/display", "register/submit");
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

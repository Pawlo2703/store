<?php

namespace Shop\Core;

class Routing {

    public function __construct() {

        $action = array("home", "rejestracja", "submit", "login", "zalogowano", "logout", "dodaj_kat", "zatwierdz_kat", "admin");
        $controller = array("home/display", "register/display", "register/submit", "login/display", "login/submit", "logout/submit", "admin_category/display", "admin_category/submit", "admin_admin/display");

        if (isset($_GET['url'])) {
            if (strpos($_GET['url'], '/') !== false) {
                $url = $this->parseUrl();

                $key = array_search($url[0], $action);

                switch ($url[0]) {
                    case "$action[$key]":
                        $_GET['url'] = "$controller[$key]/$url[1]";
                        break;
                    default:
                        $_GET['url'] = 'error/404';
                        break;
                }
            } else {
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

    public function parseUrl() {
        if (isset($_GET['url'])) {
            return $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
    }

}

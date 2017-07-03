<?php

namespace Shop\Core;

class Routing {

    public function __construct() {
        $action = array("home", "rejestracja", "submit", "login", "zalogowano", "logout", "dodaj_kat",
            "zatwierdz_kat", "category", "product", "dodaj_pro", "zatwierdz_pro", "usun_produkt", "usun_kategorie", "widok_produktu", "zmiana_produktu", "dostepnosc_produktu");

        $controller = array("home/display", "register/display", "register/submit", "login/display",
            "login/submit", "logout/submit", "admin_addnew/displayCategory", "admin_category_category/addCategory",
            "admin_category_category/display", "admin_product_productlist/display", "admin_addnew/displayProduct", "admin_product_productlist/addProduct",
            "admin_product_productlist/remove", "admin_category_category/remove", "admin_product_productview/display", "admin_product_productupdate/update", "admin_product_productlist/isavailable");

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

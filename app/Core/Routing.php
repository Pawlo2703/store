<?php

namespace Shop\Core;

/**
 * Class Routing
 */
class Routing extends Controller {

    /**
     * Constructor
     */
    public function __construct() {
        $action = array("home", "rejestracja", "submit", "login", "zalogowano", "logout", "dodaj_kat",
            "zatwierdz_kat", "category", "product", "dodaj_pro", "zatwierdz_pro", "usun_produkt", "usun_kategorie", "widok_produktu", "zmiana_produktu",
            "dostepnosc_produktu", "kategoria", "dostepnosc_kategorii", "zatwierdz_zmiane", "zmiana_nazwy_kategorii", "produkt", "koszyk", "pokaz_koszyk", "usun_z_koszyka",
            "checkout", "podsumowanie", "loginCheck", "orderCreate", "dokonano_zakupu", "adres_dostawy", "SetAddress", "zamowienia_oplacone", "zamowienie", "pwchange", 
            "zmiana_hasla", "profil");

        $controller = array("home/display", "register/display", "register/submit", "login/display",
            "login/submit", "logout/logout", "admin_category_category/displaycreatecategoryform", "admin_category_category/createCategory",
            "admin_category_category/display", "admin_product_product/display", "admin_product_product/displayCreateProductForm", "admin_product_product/createProduct",
            "admin_product_product/remove", "admin_category_category/remove", "admin_product_productview/display", "admin_product_productactions/updateproduct",
            "admin_product_productactions/changeAvailability", "category_viewcategory/display", "admin_category_categoryactions/changeavailability", "admin_category_categoryactions/changeCategoryName",
            "admin_category_categoryactions/displaynamechangeform", "product_viewproduct/display", "product_AddToCart/addProductToCart", "cart_CartView/display",
            "cart_ItemRemove/remove", "cart_Checkout/cartUpdate", "cart_Checkout/display", "cart_Payment/loginCheck", "cart_Payment/orderCreate", "cart_Payment/display", "cart_Address/display",
            "cart_Address/setAddress", "UserProfile_OrdersHistory/ordersView", "UserProfile_OrdersHistory/orderItemsView", "UserProfile_PasswordChange/changePassword", 
            "UserProfile_PasswordChange/display", "UserProfile_Profile/display");
        var_dump($_SESSION);
        if (isset($_GET['url'])) {
            if (strpos($_GET['url'], '/') !== false) {
                $url = $this->parseUrl($_GET['url']);
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

}

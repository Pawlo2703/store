<?php

namespace Shop\Controllers;

use Shop\Core\Controller;
use Shop\Models\User;
use Shop\Models\Cart\{
    Item,
    Cart
};
use Shop\Models\RememberMe;

/**
 * Class Login
 */
class Login extends Controller {

    /**
     * Display login form
     */
    public function display() {
        $this->header();
        $url = $this->parseUrl($_GET['url']);

        if (isset($url[2])) {
            $loginParameter = ($url[2]);
            $data = $loginParameter;
        } else {
            $data = 'blad';
        }

        $data = $this->view('home/login/login', $data);
    }

    /**
     * Submit login form
     */
    public function submit() {
        $this->header();
        $url = $this->parseUrl($_GET['url']);
        $params = $this->getParameters();
        $user = new User;

        if (!($userId = $user->findByEmail($params['email']))) {
            $this->view('home/login/error/email');
            return;
        }

        $databasePassword = $user->checkPassword($userId);
        $formPassword = $params['password'];

        if (!(password_verify($formPassword, $databasePassword))) {
            $this->view('home/login/error/password');
            return;
        }

        $user->load($userId);
        $this->session->set('admin', $user->getAdmin());
        $this->session->set('user_id', $user->getId());
        $this->setCookie($userId);
        $this->updateUserId();

        if (isset($url[2])) {
            if ($url[2] == "payment") {
                $this->redirect('adres_dostawy', '');
            }
        }

        $this->redirect('home', '');
    }

    /**
     * Create cookie
     */
    public function setCookie($userId) {
        $user = new User;
        $rememberMe = new RememberMe;
        $params = $this->getParameters();
        
        $user->load($userId);
        if (!isset($params['remember'])) {
            return;
        }
        $bigKey = $rememberMe->generateRandomString();
        $rememberMe->setBigKey($bigKey);
        $result = $rememberMe->checkCookie($userId);

        if (!$result) {
            $rememberMe->addCookie($userId, $user->getAdmin());
        } else {
            $rememberMe->updateCookie($userId, $user->getAdmin());
        }

        setcookie('email', $bigKey, time() + 60 * 60 * 7);
    }

    /**
     * Update user ID if cart was created while user wasn't logged in
     */
    public function updateUserId() {
        $item = new Item;
        $cart = new Cart;

        if (($this->session->get('cart_id')) !== NULL) {
            $item->setUserId($this->session->get('user_id'));
            $item->setCartId($this->session->get('cart_id'));
            $cart->saveUserId($item);
        }
    }

}

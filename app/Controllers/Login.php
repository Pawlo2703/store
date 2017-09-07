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
        $url = $this->parseUrl($_GET['url']);
        $params = $this->getParameters();
        $cart = new Cart;
        $user = new User;
        $rememberMe = new RememberMe;


        if ($userId = $user->findByEmail($params['email'])) {
            if (!$userId) {
                $this->view('home/login/error/email');
                return;
            }
            $databasePassword = $user->checkPassword($userId);
            $formPassword = $params['password'];
            if (password_verify($formPassword, $databasePassword)) {
                $user->load($userId);
                $this->session->set('admin', $user->getAdmin());
                $this->session->set('user_id', $user->getId());
            } else {
                $this->view('home/login/error/password');
                exit;
            }
        } else {
            $this->view('home/login/error/email');
            exit;
        }

        if (isset($params['remember'])) {
            $bigKey = $rememberMe->generateRandomString();
            $rememberMe->setBigKey($bigKey);
            $admin = $user->getAdmin();
            $rememberMe->addCookie($userId, $admin);
            setcookie('email', $bigKey, time() + 60 * 60 * 7);
        }


        if (($this->session->get('cart_id')) !== NULL) {
            $item = new Item;
            $item->setUserId($this->session->get('user_id'));
            $item->setCartId($this->session->get('cart_id'));
            $cart->saveUserId($item);
        }

        if (isset($url[2])) {
            if ($url[2] == "payment") {
                $this->redirect('orderCreate', '');
            }
        }

        $this->redirect('home', '');
    }

}

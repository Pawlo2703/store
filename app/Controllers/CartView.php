<?php

namespace Shop\Controllers;

use Shop\Core\Controller;
use Shop\Models\Cart\{
    CartCollection,
    CartManagement
};

/**
 * Class Home
 */
class CartView extends Controller {
    /*
     * Display Cart View
     */

    public function display() {
        $this->header();
        $cartCollection = new CartCollection;
        $cartManagement = new CartManagement;
        
        $cartId = $this->session->get('cart_id');
        $cartManagement->setCartId($cartId);
        $quote = $cartManagement->loadQuote();
        $cartManagement->setTotalQuantity($quote['quantity']);
        $cartManagement->setTotalPrice($quote['price']);
        $cart = $cartCollection->createCartCollection($cartId);
        
        $data = [
            'cart' => $cart,
            'cartManagement' => $cartManagement
        ];
        $this->view('home/cart/cart_view', $data);
    }

}

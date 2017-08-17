<?php

namespace Shop\Controllers\cart;

use Shop\Core\Controller;
use Shop\Models\Cart\{
    CartCollection,
    ItemRemoval,
    Product,
    CartManagement,
    CheckoutManagement
}
;

/**
 * Class Checkout
 */
class Checkout extends Controller {
    /*
     * Display Checkout
     */

    public function cartUpdate() {
        $this->header();
        $params = $this->getParameters();
        $checkoutManagement = new CheckoutManagement;
        $cartCollection = new CartCollection;
        $cartManagement = new CartManagement;
        $itemRemoval = new ItemRemoval;

        $cartId = $this->session->get('cart_id');

        $cartCollection->filterBy('cart_id', $cartId);
        $cart = $cartCollection->createCartCollection();

        for ($i = 0; $i < sizeof($params) - 1; $i++) {
            $itemRemoval->calculatePrice($cart[$i]);
            $itemRemoval->calculateQuantity($cart[$i]);

            $cart[$i]->setProductQuantity($params[$i]);
        }
        $checkoutManagement->cartUpdate($cart);

        for ($i = 0; $i < sizeof($params) - 1; $i++) {
            $cartManagement->calculateQuantity($cart[$i]);
            $cartManagement->calculatePrice($cart[$i]);
        }

        $this->redirect("podsumowanie", "");
    }

    public function display() {
        $this->header();
        $cartCollection = new CartCollection();
        $cartManagement = new CartManagement();
        $product = new Product;

        $cartId = $this->session->get('cart_id');
        $product->setCartId($cartId);

        $cartManagement->loadcart($product);

        $cartCollection->filterBy('cart_id', $cartId);
        $cart = $cartCollection->createCartCollection();

        $data = [
            'cartCollection' => $cart,
            'product' => $product
        ];
        $this->view('home/cart/checkout', $data);
    }

}

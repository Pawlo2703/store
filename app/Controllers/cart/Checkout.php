<?php

namespace Shop\Controllers\cart;

use Shop\Core\Controller;
use Shop\Models\Cart\{
    CartCollection,
    ItemRemove,
    Item,
    Cart,
    Checkout as CheckoutModel
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
        $checkout = new CheckoutModel;
        $cartCollection = new CartCollection;
        $cart = new Cart;
        $itemRemove = new ItemRemove;

        $cartId = $this->session->get('cart_id');

        $cartCollection->filterBy('cart_id', $cartId);
        $cartCollection = $cartCollection->createCartCollection();

        for ($i = 0; $i < sizeof($params) - 1; $i++) {
            $itemRemove->calculatePrice($cartCollection[$i]);
            $itemRemove->calculateQuantity($cartCollection[$i]);

            $cartCollection[$i]->setProductQuantity($params[$i]);
        }
        $checkout->cartUpdate($cartCollection);

        for ($i = 0; $i < sizeof($params) - 1; $i++) {
            $cart->calculateQuantity($cartCollection[$i]);
            $cart->calculatePrice($cartCollection[$i]);
        }

        $this->redirect("podsumowanie", "");
    }

    public function display() {
        $this->header();
        $cartCollection = new CartCollection();
        $cart = new Cart();
        $item = new Item;

        $cartId = $this->session->get('cart_id');
        $item->setCartId($cartId);

        $cart->loadcart($item);

        $cartCollection->filterBy('cart_id', $cartId);
        $cart = $cartCollection->createCartCollection();

        $data = [
            'cartCollection' => $cart,
            'product' => $item
        ];
        $this->view('home/cart/checkout', $data);
    }

}

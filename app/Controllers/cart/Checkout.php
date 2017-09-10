<?php

namespace Shop\Controllers\cart;

use Shop\Core\Controller;
use Shop\Models\Cart\{
    CartCollection,
    ItemRemove,
    Item,
    Calculations,
    Cart
}
;

/**
 * Class Checkout
 */
class Checkout extends Controller {

    /**
     * Display Checkout
     */
    public function cartUpdate() {
        $this->header();
        $params = $this->getParameters();
        $cartCollection = new CartCollection;
        $cart = new Cart;
        $item = new Item;
        $calculations = new Calculations;
        $itemRemove = new ItemRemove;

        $cartId = $this->session->get('cart_id');
        $item->setCartId($cartId);

        $cartCollection->filterBy('cart_id', $cartId);
        $cartCollection = $cartCollection->createCartCollection();


        for ($i = 0; $i < sizeof($params) - 1; $i++) {
            $cart->loadCart($item);

            $cartCollection[$i]->setTotalPrice($item->getTotalPrice());
            $calculations->removeProductPrice($cartCollection[$i], $item);
            $cartCollection[$i]->setTotalPrice($item->getTotalPrice());
            $cart->savePrice($cartCollection[$i]);

            $cartCollection[$i]->setTotalQuantity($item->getTotalQuantity());
            $calculations->removeProductQuantity($cartCollection[$i], $item);
            $cart->saveQuantity($item);
            $cartCollection[$i]->setProductQuantity($params[$i]);
        }
        $cart->cartUpdate($cartCollection);

        for ($i = 0; $i < sizeof($params) - 1; $i++) {
            $cart->loadCart($item);
            $calculations->setNewQuantity($cartCollection[$i]->getProductQuantity());
            $calculations->calculateQuantity($item);

            $cartCollection[$i]->setTotalPrice($item->getTotalPrice());

            $cartCollection[$i]->setProductQuantity($params[$i]);

            $calculations->calculatePrice($cartCollection[$i]);
            $cart->saveQuantity($item);
            $cart->savePrice($cartCollection[$i]);
            $cart->loadCart($item);
        }
        $this->redirect("podsumowanie", "");
    }

    /**
     * Display checkout window
     */
    public function display() {
        $this->header();
        $cartCollection = new CartCollection();
        $cart = new Cart();
        $item = new Item;

        $cartId = $this->session->get('cart_id');
        $item->setCartId($cartId);
        $cart->loadCart($item);

        $cartCollection->filterBy('cart_id', $cartId);
        $cart = $cartCollection->createCartCollection();

        $data = [
            'cartCollection' => $cart,
            'product' => $item
        ];
        $this->view('home/cart/checkout', $data);
    }

}

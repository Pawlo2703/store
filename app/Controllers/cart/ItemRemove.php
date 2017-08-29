<?php

namespace Shop\Controllers\cart;

use Shop\Core\Controller;
use Shop\Models\Cart\{
    ItemRemove as ItemRemoveModel,
    CartCollection,
    Item,
    Calculations,
    Cart
};

/**
 * Class ItemRemove
 */
class ItemRemove extends Controller {

    /**
     * Remove item from cart
     */
    public function remove() {
        $this->header();
        $url = $this->parseUrl($_GET['url']);
        $position = $url[2];
        $cartId = $this->session->get('cart_id');

        $item = new Item;
        $cart = new Cart;
        $itemRemove = new ItemRemoveModel;
        $calculations = new Calculations;
        $cartCollection = new CartCollection;

        $cartCollection->filterBy('cart_id', $cartId);
        $cartCollection = $cartCollection->createCartCollection();
        $item->setCartId($cartId);
        $cart->loadCart($item);

        $cartCollection[$position]->setTotalQuantity($item->getTotalQuantity());
        $cartCollection[$position]->setTotalPrice($item->getTotalPrice());
     
        $calculations->removeProductPrice($cartCollection[$position], $item);
        $calculations->removeProductQuantity($cartCollection[$position], $item);
        $cart->savePrice($item);
        $cart->saveQuantity($item);
        $itemRemove->removeItem($cartCollection[$position]);
        
        $this->redirect("pokaz_koszyk", "");
    }

}

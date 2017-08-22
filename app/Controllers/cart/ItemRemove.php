<?php

namespace Shop\Controllers\cart;

use Shop\Core\Controller;
use Shop\Models\Cart\{
    CartCollection,
    ItemRemove as ItemRemoveModel,
    Item,
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
        $productId = $url[2];
        $cartId = $this->session->get('cart_id');

        $item = new Item;
        $cart = new Cart;
        $itemRemove = new ItemRemoveModel();



        $item->setCartId($cartId);
        $item->setProductId($productId);

        $itemRemove->calculatePrice($item);
        $itemRemove->calculateQuantity($item);
        $itemRemove->removeItem($item);
        $this->redirect("pokaz_koszyk", "");
    }

}

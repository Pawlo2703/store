<?php

namespace Shop\Controllers\cart;

use Shop\Core\Controller;
use Shop\Models\Cart\{
    CartCollection,
    ItemRemoval,
    Product,
    CartManagement
};

/**
 * Class ItemRemove
 */
class ItemRemove extends Controller {
    /*
     * Remove item from cart
     */

    public function remove() {
        $this->header();
        $url = $this->parseUrl($_GET['url']);
        $productId = $url[2];
        $cartId = $this->session->get('cart_id');
        
        $product = new Product;
        $cartManagement = new CartManagement;
        $cartCollection = new CartCollection;
        
        $cartCollection->filterBy('cart_id', $cartId);
        $cart = $cartCollection->createCartCollection();
        
       
        $itemRemoval = new ItemRemoval;
        $product->setCartId($cartId);
        $product->setProductId($productId);
        
        $itemRemoval->calculatePrice($product);
        $itemRemoval->calculateQuantity($product);
        $itemRemoval->removeItem($product);
        $this->redirect("pokaz_koszyk", "");
    }

}

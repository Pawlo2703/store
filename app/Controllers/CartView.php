<?php

namespace Shop\Controllers;

use Shop\Core\Controller;
use Shop\Models\Products\{
    ProductCollection,
    ProductManagement
};
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
        $productCollection = new ProductCollection;
        $productManagement = new ProductManagement;
        if (($this->session->get('cart_id')) === null) {
            $this->view('home/cart/empty_cart');
            exit;
        }

        $cartId = $this->session->get('cart_id');
        $cartManagement->setCartId($cartId);
        $cartManagement->loadcart();

        $productQuantity = $cartManagement->getProductQuantity();
        $productPrice = $cartManagement->getProductPrice();

        $cartManagement->setTotalQuantity($productQuantity);
        $cartManagement->setTotalPrice($productPrice);

        $cartCollection->filterBy('cart_id', $cartId);
        $product = $productCollection->createProductCollection();
        $cart = $cartCollection->createCartCollection();

        $data = [
            'product' => $product,
            'cart' => $cart,
            'cartManagement' => $cartManagement,
                'productManagement' => $productManagement
        ];
        $this->view('home/cart/cart_view', $data);
    }

}

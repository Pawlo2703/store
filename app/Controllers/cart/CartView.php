<?php

namespace Shop\Controllers\cart;

use Shop\Core\Controller;
use Shop\Models\Products\{
    ProductCollection,
    ProductManagement
};
use Shop\Models\Cart\{
    CartCollection,
    Product,
    CartManagement
};

/**
 * Class CartView
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
        $product = new Product;


        $cartId = $this->session->get('cart_id');
        $product->setCartId($cartId);


        if ($cartManagement->loadCartItem($product) === false) {
            $this->view('home/cart/empty_cart');
            exit;
        }

        $productQuantity = $product->getProductQuantity();
        $productPrice = $product->getProductPrice();

        $product->setTotalQuantity($productQuantity);
        $product->setTotalPrice($productPrice);

        $cartCollection->filterBy('cart_id', $cartId);
        $products = $productCollection->createProductCollection();
        $cart = $cartCollection->createCartCollection();

        $data = [
            'product' => $products,
            'cart' => $cart,
            'cartManagement' => $cartManagement,
            'productManagement' => $productManagement
        ];
        $this->view('home/cart/cart_view', $data);
    }

}

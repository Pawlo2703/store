<?php

namespace Shop\Controllers\cart;

use Shop\Core\Controller;
use Shop\Models\Products\{
    ProductCollection,
    Product
};
use Shop\Models\Cart\{
    CartCollection,
    Item,
    Cart
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
        $cart = new Cart;
        $productCollection = new ProductCollection;
        $product = new Product;
        $item = new Item;
        $cartId = $this->session->get('cart_id');
        $item->setCartId($cartId);

        $cartCollection->filterBy('cart_id', $cartId);
        $cartCollection = $cartCollection->createCartCollection();

        if (!(isset($cartId))) {
            $this->view('home/cart/empty_cart');
            exit;
        }

        if ($cartCollection->createCartCollection() === null) {
            $this->view('home/cart/empty_cart');
            exit;
        }

        $productQuantity = $item->getProductQuantity();
        $productPrice = $item->getProductPrice();
        $item->setTotalQuantity($productQuantity);
        $item->setTotalPrice($productPrice);

        $products = $productCollection->createProductCollection();


        $data = [
            'product' => $products,
            'cart' => $cartCollection,
            'cartManagement' => $cart,
            'productManagement' => $product
        ];
        $this->view('home/cart/cart_view', $data);
    }

}

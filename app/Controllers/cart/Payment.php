<?php

namespace Shop\Controllers\cart;

use Shop\Core\Controller;
use Shop\Models\Cart\{
    CheckoutManagement,
    CartManagement,
    Product
};

/**
 * Class Payment
 */
class Payment extends Controller {
    /*
     * Display Cart View
     */

    public function loginCheck() {
        $this->header();
        if ($this->session->get('user_id') !== NULL) {
            $this->redirect("orderCreate", "");
        }

        $this->redirect('login', 'payment');
    }

    public function orderCreate() {
        $this->header();
        $cartManagement = new CartManagement;
        $product = new Product;
        $checkoutManagement = new CheckoutManagement;

        $cartId = $this->session->get('cart_id');
        $product->setCartId($cartId);

        $cartManagement->loadcart($product);
        $checkoutManagement->orderCreate($product);
        $checkoutManagement->removeCart($product);

        $this->redirect('dokonano_zakupu', '');
    }

    public function display() {
        $this->header();
        $checkoutManagement = new CheckoutManagement;
        $product = new Product;

        $cartId = $this->session->get('cart_id');
        $product->setCartId($cartId);

        $checkoutManagement->loadOrderByCartId($product);
        $orderId = $checkoutManagement->getOrderId();

        if ($this->session->get('cart_id') !== NULL) {
            $this->session->pull('cart_id');
        }
        $data = [
            'checkoutManagement' => $checkoutManagement
        ];
        $this->view('home/cart/order_finished_view', $data);
    }

}

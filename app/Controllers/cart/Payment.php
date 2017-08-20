<?php

namespace Shop\Controllers\cart;

use Shop\Core\Controller;
use Shop\Models\Cart\{
    UserAddress,
    CartCollection,
    CheckoutManagement,
    CartManagement,
    Product
};

/**
 * Class Payment
 */
class Payment extends Controller {

    /**
     * Check if user is logged in
     */
    public function loginCheck() {
        if ($this->session->get('user_id') !== NULL) {
            $this->redirect("orderCreate", "");
        }

        $this->redirect('login', 'payment');
    }

    /**
     * Create orders and orders_items tables, update products quantity
     */
    public function orderCreate() {
        $cartCollection = new CartCollection;
        $cartManagement = new CartManagement;
        $product = new Product;
        $checkoutManagement = new CheckoutManagement;
        $address = new UserAddress;

        $cartId = $this->session->get('cart_id');
        $product->setCartId($cartId);

        $cartCollection->filterBy('cart_id', $cartId);
        $cartCollectionz = $cartCollection->createCartCollection();

        $cartManagement->loadcart($product);

        $checkoutManagement->orderCreate($product);
        $checkoutManagement->searchOrderId();
        $checkoutManagement->orderItemsCreate($cartCollectionz);
        $checkoutManagement->updateProductsQuantity($cartCollectionz);
        $checkoutManagement->checkIfOutOfStock($cartCollectionz);

        $orderId = $this->session->set('order_id', $checkoutManagement->getOrderId());
        $orderId = $this->session->get('order_id');
        $this->redirect('adres_dostawy', '');
    }

    /**
     * View of finished order
     */
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

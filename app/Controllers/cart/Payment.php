<?php

namespace Shop\Controllers\cart;

use Shop\Core\Controller;
use Shop\Models\Cart\{
    UserAddress,
    CartCollection,
    Checkout,
    Cart,
    Item
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
        $cart = new Cart;
        $item = new Item;
        $checkout = new Checkout;
        $address = new UserAddress;
        
        $cartId = $this->session->get('cart_id');
        $item->setCartId($cartId);

        $cartCollection->filterBy('cart_id', $cartId);
        $cartCollectionz = $cartCollection->createCartCollection();

        $cart->loadcart($item);

        $checkout->orderCreate($item);
        $checkout->searchOrderId();
        $checkout->orderItemsCreate($cartCollectionz);
        $checkout->updateProductsQuantity($cartCollectionz);
        $checkout->checkIfOutOfStock($cartCollectionz);

        $orderId = $this->session->set('order_id', $checkout->getOrderId());
        $orderId = $this->session->get('order_id');
        $this->redirect('adres_dostawy', '');
    }

    /**
     * View of finished order
     */
    public function display() {
        $this->header();
        $checkout = new Checkout;
        $item = new Item;

        $cartId = $this->session->get('cart_id');
        $item->setCartId($cartId);

        $checkout->loadOrderByCartId($item);
        $orderId = $checkout->getOrderId();

        if ($this->session->get('cart_id') !== NULL) {
            $this->session->pull('cart_id');
        }
        $data = [
            'checkoutManagement' => $checkout
        ];
        $this->view('home/cart/order_finished_view', $data);
    }

}

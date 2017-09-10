<?php

namespace Shop\Controllers\cart;

use Shop\Core\Controller;
use Shop\Models\Cart\{
    Item,
    Cart,
    UserAddress
};

/**
 * Class Address
 */
class Address extends Controller {

    /**
     * View of address form
     */
    public function display() {
        $this->header();
        $this->view('home/cart/address_form');
    }

    /**
     * Save address
     */
    public function setAddress() {
        $address = new UserAddress;
        $item = new Item;
        $cart = new Cart;
        $params = $this->getParameters();
               
        $orderId = $this->session->get('order_id');
        $address->setOrderId($orderId);
        $address->setName($params['name']);
        $address->setSurname($params['surname']);
        $address->setZipcode($params['zipcode']);
        $address->setStreet($params['street']);
        $address->setHouseNumber($params['housenumber']);
        $address->setDoorsNumber($params['doorsnumber']);
        $address->saveAddress(); 
        $cartId = $this->session->get('cart_id');
        $item->setCartId($cartId);
        $cart->removeCart($item);

        $this->redirect('dokonano_zakupu', '');
    }

}

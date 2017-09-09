<?php

namespace Shop\Models\Cart;

use Shop\Core\Model;
use Shop\Models\Cart\{
    CartDetails,
    ProductDetails
}
;

/**
 * Class Cart
 */
class Cart extends Model {

    /**
     * Create row cart
     */
    public function createCart($item) {
        if ($item->getCartId() !== null) {
            return;
        }
        $id = $this->database->insertRow('cart', "(`user_id`,`quantity`,`price`) VALUES(?,?,?)", ["0", "0", "0"]);
        $item->setCartId($id);
    }

    /**
     * Create row cartItem, update if exists
     */
    public function saveCartItem($item) {
        if (($item->getCartId() !== null)) {
            $this->database->insertRow('cart_item', "(`cart_id`,`product_id`,`product_quantity`,`product_price`) VALUES(?,?,?,?)", [$item->getCartId(), $item->getProductId(), $item->getProductQuantity(), $item->getProductPrice()]);
        }
    }

    /**
     * Check if specific item already exists in cart_item table
     */
    public function checkIfItemExistsInCart($item) {
        $result = $this->database->getRow('product_quantity', 'cart_item', "WHERE cart_id =? AND product_id = ?", [$item->getCartId(), $item->getProductId()]);
        return $result;
    }

    /**
     * Update product in cart_item
     */
    public function updateCartItem($item) {
        $this->database->updateRow('cart_item', "product_quantity= '{$item->getProductQuantity()}'"
                . "WHERE cart_id = {$item->getCartId()} AND product_id = {$item->getProductId()}");
    }

    /**
     * Save products quantity
     */
    public function saveQuantity($item) {
        $this->database->updateRow('cart', "quantity= '{$item->getTotalQuantity()}'"
                . "WHERE cart_id = {$item->getCartId()}");
    }

    /**
     * Save products price
     */
    public function savePrice($item) {
        $this->database->updateRow('cart', "price= '{$item->getTotalPrice()}'"
                . "WHERE cart_id = {$item->getCartId()}");
    }

    /**
     * Load cart_item by cart ID
     */
    public function loadCartItem($cartCollection, $item) {
        $cartItem = $this->database->getRow('*', 'cart_item', "WHERE cart_id = ? ", [$cartCollection->getCartId()]);

        if (!empty($cartItem)) {
            $item->setProductId($cartItem['product_id']);
            $item->setProductPrice($cartItem['product_price']);
            $item->setProductQuantity($cartItem['product_quantity']);
        }
    }

    /**
     * Load cart by cart ID
     */
    public function loadCart($item) {
        $cart = $this->database->getRow('*', 'cart', "WHERE cart_id = ? ", [$item->getCartId()]);

        if (!empty($cart)) {
            $item->setUserId($cart['user_id']);
            $item->setTotalQuantity($cart['quantity']);
            $item->setTotalPrice($cart['price']);
        }
    }

    /**
     * Saves/updates user id
     */
    public function saveUserId($item) {
        $this->database->updateRow('cart', "user_id = '{$item->getUserId()}' "
                . "WHERE cart_id = {$item->getCartId()}");
    }

}

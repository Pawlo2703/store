<?php

namespace Shop\Models\Cart;

use Shop\Core\Model;
use Shop\Models\Cart\{
    CartDetails,
    ProductDetails
}
;

/**
 * Class CartManagement
 */
class CartManagement extends Model {

    /**
     * Create row cart
     */
    public function createCart($product) {
        if ($product->getCartId() !== null) {
            return;
        }
        $this->database->insertRow('cart', "(`user_id`,`quantity`,`price`) VALUES(?,?,?)", ["0", "0", "0"]);
    }

    /**
     * Create row cartItem, update if exists
     */
    public function saveCartItem($product) {
        if (!($product->getCartId() !== null)) {

            $cartId = $this->database->getRow('cart_id', 'cart', "ORDER BY cart_id DESC LIMIT 1");
            $product->setCartId($cartId['cart_id']);

            $this->database->insertRow('cart_item', "(`cart_id`,`product_id`,`product_quantity`,`product_price`) VALUES(?,?,?,?)", [$product->getCartId(), $product->getProductId(), $product->getProductQuantity(), $product->getProductPrice()]);
            return;
        }
        $result = $this->database->getRow('product_quantity', 'cart_item', "WHERE cart_id =? AND product_id = ?", [$product->getCartId(), $product->getProductId()]);
        if (!empty($result)) {
            $productAmount = $product->getProductQuantity() + $result['product_quantity'];
            $this->database->updateRow('cart_item', "product_quantity= '$productAmount'"
                    . "WHERE cart_id = {$product->getCartId()} AND product_id = {$product->getProductId()}");
            return;
        }
        $this->database->insertRow('cart_item', "(`cart_id`,`product_id`,`product_quantity`,`product_price`) VALUES(?,?,?,?)", [$product->getCartId(), $product->getProductId(), $product->getProductQuantity(), $product->getProductPrice()]);
    }

    /*
     * Calculate products quantity
     */

    public function calculateQuantity($product) {
        $cart = $this->database->getRow('quantity, price', 'cart', "WHERE cart_id = ? ", [$product->getCartId()]);

        if (isset($cart)) {
            $newQuantity = (int) ($cart['quantity']) + (int) ($product->getProductQuantity());
            $this->database->updateRow('cart', "quantity= '$newQuantity'"
                    . "WHERE cart_id = {$product->getCartId()}");
        }
    }

    /**
     * Calculate products price
     */
    public function calculatePrice($product) {
        $cart = $this->database->getRow('quantity, price', 'cart', "WHERE cart_id = ? ", [$product->getCartId()]);

        if (isset($product)) {
            $price = (int) ($cart['price']) + ((int) ($product->getProductPrice()) * (int) ($product->getProductQuantity()));
            $this->database->updateRow('cart', "price = '$price' "
                    . "WHERE cart_id = {$product->getCartId()}");
        }
    }

    /**
     * Moze zmienic nazwe
     */
    public function loadCartItem($product) {
        $cartItem = $this->database->getRow('*', 'cart_item', "WHERE cart_id = ? ", [$product->getCartId()]);
        return $cartItem;
    }

    /**
     * Load costam dopisac
     */
    public function loadcart($product) {
        $cart = $this->database->getRow('*', 'cart', "WHERE cart_id = ? ", [$product->getCartId()]);

        if (!empty($cart)) {
            $product->setTotalQuantity($cart['quantity']);
            $product->setTotalPrice($cart['price']);
        }
    }

    /**
     * Saves/updates user id
     */
    public function saveUserId($product) {
        $userId = $product->getUserId();
        $cartId = $product->getCartId();
        $this->database->updateRow('cart', "user_id = '$userId' "
                . "WHERE cart_id = $cartId");
    }

}

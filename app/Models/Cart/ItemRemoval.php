<?php

namespace Shop\Models\Cart;

use Shop\Core\Model;

/**
 * Class CartManagement
 */
class ItemRemoval extends Model {

    public function removeItem($product) {
        $this->database->deleteRow('cart_item', "WHERE product_id = ? AND cart_id = ?", [$product->getProductId(), $product->getCartId()]);
    }

    /*
     * Calculate products quantity and substract it from total amount
     */

    public function calculateQuantity($product) {
        $cart = $this->database->getRow('quantity, price', 'cart', "WHERE cart_id = ? ", [$product->getCartId()]);
        $quantity = $this->database->getRow('product_quantity', 'cart_item', "WHERE product_id = ? AND cart_id = ?", [$product->getProductId(), $product->getCartId()]);

        if (isset($cart)) {
            $newQuantity = (int) ($cart['quantity']) - (int) ($quantity['product_quantity']);
            $this->database->updateRow('cart', "quantity= '$newQuantity'"
                    . "WHERE cart_id = {$product->getCartId()}");
        }
    }

    /**
     * Calculate products price and substract it from total amount
     */
    public function calculatePrice($product) {
        $cartItem = $this->database->getRow('product_quantity, product_price', 'cart_item', "WHERE cart_id = ? ORDER BY id DESC LIMIT 1", [$product->getCartId()]);
        $quantity = $this->database->getRow('product_quantity', 'cart_item', "WHERE product_id = ? AND cart_id = ?", [$product->getProductId(), $product->getCartId()]);
        
        $cart = $this->database->getRow('quantity, price', 'cart', "WHERE cart_id = ? ", [$product->getCartId()]);

        if ($product->getProductName() !== NULL) {
            $price = (int) ($cart['price']) - ((int) ($product->getProductPrice()) * (int) ($product->getProductQuantity()));
            $this->database->updateRow('cart', "price = '$price' "
                    . "WHERE cart_id = {$product->getCartId()}");
            return;
        }
        
        if (isset($cartItem)) {
            $price = (int) ($cart['price']) - ((int) ($cartItem['product_price']) * (int) ($quantity['product_quantity']));
            $this->database->updateRow('cart', "price = '$price' "
                    . "WHERE cart_id = {$product->getCartId()}");
        }
    }

}

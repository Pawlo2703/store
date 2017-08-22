<?php

namespace Shop\Models\Cart;

use Shop\Core\Model;

/**
 * Class ItemRemove
 */
class ItemRemove extends Model {

    public function removeItem($item) {
        $this->database->deleteRow('cart_item', "WHERE product_id = ? AND cart_id = ?", [$item->getProductId(), $item->getCartId()]);
    }

    /*
     * Calculate products quantity and substract it from total amount
     */

    public function calculateQuantity($item) {
        $cart = $this->database->getRow('quantity, price', 'cart', "WHERE cart_id = ? ", [$item->getCartId()]);
        $quantity = $this->database->getRow('product_quantity', 'cart_item', "WHERE product_id = ? AND cart_id = ?", [$item->getProductId(), $item->getCartId()]);

        if (isset($cart)) {
            $newQuantity = (int) ($cart['quantity']) - (int) ($quantity['product_quantity']);
            $this->database->updateRow('cart', "quantity= '$newQuantity'"
                    . "WHERE cart_id = {$item->getCartId()}");
        }
    }

    /**
     * Calculate products price and substract it from total amount
     */
    public function calculatePrice($item) {
        $cartItem = $this->database->getRow('product_quantity, product_price', 'cart_item', "WHERE cart_id = ? ORDER BY id DESC LIMIT 1", [$item->getCartId()]);
        $quantity = $this->database->getRow('product_quantity', 'cart_item', "WHERE product_id = ? AND cart_id = ?", [$item->getProductId(), $item->getCartId()]);
        
        $cart = $this->database->getRow('quantity, price', 'cart', "WHERE cart_id = ? ", [$item->getCartId()]);

        if ($item->getProductName() !== NULL) {
            $price = (int) ($cart['price']) - ((int) ($item->getProductPrice()) * (int) ($item->getProductQuantity()));
            $this->database->updateRow('cart', "price = '$price' "
                    . "WHERE cart_id = {$item->getCartId()}");
            return;
        }
        
        if (isset($cartItem)) {
            $price = (int) ($cart['price']) - ((int) ($cartItem['product_price']) * (int) ($quantity['product_quantity']));
            $this->database->updateRow('cart', "price = '$price' "
                    . "WHERE cart_id = {$item->getCartId()}");
        }
    }

}

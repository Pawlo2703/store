<?php

namespace Shop\Models;

/**
 * Class Cart
 */
class Cart {

    private $productId;
    private $productQuantity;
    private $productPrice;
    private $tableId;
    private $cartId;

    public function getCartId() {
        return $this->cartId;
    }

    public function setCartId($cartId) {
        $this->cartId = $cartId;
    }

    public function getTableId() {
        return $this->tableId;
    }

    public function setTableId($tableId) {
        $this->tableId = $tableId;
    }

    public function getProductId() {
        return $this->productId;
    }

    public function getProductQuantity() {
        return $this->productQuantity;
    }

    public function getProductPrice() {
        return $this->productPrice;
    }

    public function setProductId($productId) {
        $this->productId = $productId;
    }

    public function setProductQuantity($productQuantity) {
        $this->productQuantity = $productQuantity;
    }

    public function setProductPrice($productPrice) {
        $this->productPrice = $productPrice;
    }

    public function __construct() {
        $this->database = \Shop\Core\Database::getInstance();
        $this->rem = new RememberMe();
    }

    
    public function addQuote() {
        if (isset($this->tableId)) { //if cart already does exist
            $cartId = $this->database->getRow('cart_id', 'quote_item', "WHERE table_id = ?", [$this->tableId]);
            $this->setCartId($cartId['cart_id']);
            if (isset($cartId)) {
                $this->database->insertRow('quote_item', "(`cart_id`,`product_id`,`product_quantity`,`product_price`, `table_id`) VALUES(?,?,?,?,?)", [$cartId['cart_id'], $this->productId, $this->productQuantity, $this->productPrice, $this->tableId]);
                $tableId = $this->tableId;
                return $tableId;
            }
        } else { //if cart doesnt exist
            $tableId = $this->rem->generateRandomString();
            $this->tableId = $tableId;
            $this->database->insertRow('quote', "(`user_id`,`quantity`,`price`) VALUES(?,?,?)", ["0", "0", "0"]);
            $cartId = $this->database->getRow('cart_id', 'quote', "ORDER BY cart_id DESC LIMIT 1");
            $this->setCartId($cartId['cart_id']);
            if (isset($cartId)) {
                $this->database->insertRow('quote_item', "(`cart_id`,`product_id`,`product_quantity`,`product_price`, `table_id`) VALUES(?,?,?,?,?)", [$cartId['cart_id'], $this->productId, $this->productQuantity, $this->productPrice, $tableId]);
                return $tableId;
            }
        }
    }

    public function calculateQuantityAndPrice() {
        $quoteItem = $this->database->getRow('product_quantity, product_price', 'quote_item', "WHERE table_id = ? ORDER BY id DESC LIMIT 1", [$this->tableId]);
        $quote = $this->database->getRow('quantity, price', 'quote', "WHERE cart_id = ? ", [$this->cartId]);
        if (isset($quoteItem)) {
            $cartId = $this->cartId;
            $price = (int) ($quote['price']) + ((int) ($quoteItem['product_price']) * (int) ($quoteItem['product_quantity']));
            $quantity = (int) ($quote['quantity']) + (int) ($quoteItem['product_quantity']);
            $this->database->updateRow('quote', "price = '$price', "
                    . "quantity= '$quantity'"
                    . "WHERE cart_id = $cartId");
        }
    }

}

<?php

namespace Shop\Models\Cart;

use Shop\Core\Model;

/**
 * Class CartManagement
 */
class CartManagement extends Model {

    /**
     * @var totalQuantity
     */
    private $totalQuantity;

    /**
     * @var totalPrice
     */
    private $totalPrice;

    /**
     * @var productId
     */
    private $productId;

    /**
     * @var productQuantity
     */
    private $productQuantity;

    /**
     * @var productPrice 
     */
    private $productPrice;

    /**
     * @var cartId 
     */
    private $cartId;

    /**
     * @var productName
     */
    private $productName;

    /**
     * 
     * @return string
     */
    public function getProductName() {
        return $this->productName;
    }

    /**
     * 
     * @param string $id
     */
    public function setProductName($id) {
        $productName = $this->database->getRow('name', 'products', "WHERE id = ?", [$id]);
        $this->productName = $productName['name'];
    }

    /**
     * 
     * @return type
     */
    public function getCartId() {
        return $this->cartId;
    }

    /**
     * 
     * @param string $cartId
     */
    public function setCartId($cartId) {
        $this->cartId = $cartId;
    }

    /**
     * 
     * @return string
     */
    public function getProductId() {
        return $this->productId;
    }

    /**
     * 
     * @return int
     */
    public function getProductQuantity() {
        return $this->productQuantity;
    }

    /**
     * 
     * @return int
     */
    public function getProductPrice() {
        return $this->productPrice;
    }

    /**
     * 
     * @param string $productId
     */
    public function setProductId($productId) {
        $this->productId = $productId;
    }

    /**
     * 
     * @param int $productQuantity
     */
    public function setProductQuantity($productQuantity) {
        $this->productQuantity = $productQuantity;
    }

    /**
     * @param string $productPrice
     */
    public function setProductPrice($productPrice) {
        $this->productPrice = $productPrice;
    }

    /**
     * @return string
     */
    public function getTotalQuantity() {
        return $this->totalQuantity;
    }

    /**
     * @return string
     */
    public function getTotalPrice() {
        return $this->totalPrice;
    }

    /**
     * @param string $totalQuantity
     */
    public function setTotalQuantity($totalQuantity) {
        $this->totalQuantity = $totalQuantity;
    }

    /**
     * @param string $totalPrice
     */
    public function setTotalPrice($totalPrice) {
        $this->totalPrice = $totalPrice;
    }

    /**
     * Add items to cart, create new cart if doesnt exist
     * @return string
     */
    public function createQuote() {
        if (!isset($this->cartId)) {
            $this->database->insertRow('quote', "(`user_id`,`quantity`,`price`) VALUES(?,?,?)", ["0", "0", "0"]);
            $cartId = $this->database->getRow('cart_id', 'quote', "ORDER BY cart_id DESC LIMIT 1");
            $this->setCartId($cartId['cart_id']);
            $this->database->insertRow('quote_item', "(`cart_id`,`product_id`,`product_quantity`,`product_price`) VALUES(?,?,?,?)", [$this->cartId, $this->productId, $this->productQuantity, $this->productPrice]);
            return;
        }
        $result = $this->database->getRow('product_quantity', 'quote_item', "WHERE cart_id =? AND product_id = ?", [$this->cartId, $this->productId]);
        if (!empty($result)) {
            $productAmount = $this->productQuantity + $result['product_quantity'];
            $this->database->updateRow('quote_item', "product_quantity= '$productAmount'"
                    . "WHERE cart_id = {$this->cartId} AND product_id = {$this->productId}");
            return;
        }
        $this->database->insertRow('quote_item', "(`cart_id`,`product_id`,`product_quantity`,`product_price`) VALUES(?,?,?,?)", [$this->cartId, $this->productId, $this->productQuantity, $this->productPrice]);
        return;
    }

    /*
     * Calculate products quantity
     */

    public function calculateQuantity() {
        $quote = $this->database->getRow('quantity, price', 'quote', "WHERE cart_id = ? ", [$this->cartId]);

        if (isset($quote)) {
            $newQuantity = (int) ($quote['quantity']) + (int) ($this->productQuantity);
            $this->database->updateRow('quote', "quantity= '$newQuantity'"
                    . "WHERE cart_id = {$this->cartId}");
        }
    }

    /**
     * Calculate products price
     */
    public function calculatePrice() {
        $quoteItem = $this->database->getRow('product_quantity, product_price', 'quote_item', "WHERE cart_id = ? ORDER BY id DESC LIMIT 1", [$this->cartId]);

        $quote = $this->database->getRow('quantity, price', 'quote', "WHERE cart_id = ? ", [$this->cartId]);
        if (isset($quoteItem)) {
            $price = (int) ($quote['price']) + ((int) ($quoteItem['product_price']) * (int) ($this->productQuantity));
            $this->database->updateRow('quote', "price = '$price' "
                    . "WHERE cart_id = $this->cartId");
        }
    }

    public function loadQuote() {
        $quote = $this->database->getRow('quantity, price', 'quote', "WHERE cart_id = ? ", [$this->cartId]);
        return $quote;
    }
    
}

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
     * Create row cart
     */
    public function createcart() {
        if (isset($this->cartId)) {
            return;
        }
        $this->database->insertRow('cart', "(`user_id`,`quantity`,`price`) VALUES(?,?,?)", ["0", "0", "0"]);
    }

    /**
     * Create row cartItem, update if exists
     */
    public function savecartItem() {
        if (!isset($this->cartId)) {
            $cartId = $this->database->getRow('cart_id', 'cart', "ORDER BY cart_id DESC LIMIT 1");
            $this->setCartId($cartId['cart_id']);
            $this->database->insertRow('cart_item', "(`cart_id`,`product_id`,`product_quantity`,`product_price`) VALUES(?,?,?,?)", [$this->cartId, $this->productId, $this->productQuantity, $this->productPrice]);
            return;
        }
        $result = $this->database->getRow('product_quantity', 'cart_item', "WHERE cart_id =? AND product_id = ?", [$this->cartId, $this->productId]);
        if (!empty($result)) {
            $productAmount = $this->productQuantity + $result['product_quantity'];
            $this->database->updateRow('cart_item', "product_quantity= '$productAmount'"
                    . "WHERE cart_id = {$this->cartId} AND product_id = {$this->productId}");
            return;
        }
        $this->database->insertRow('cart_item', "(`cart_id`,`product_id`,`product_quantity`,`product_price`) VALUES(?,?,?,?)", [$this->cartId, $this->productId, $this->productQuantity, $this->productPrice]);
    }

    /*
     * Calculate products quantity
     */

    public function calculateQuantity() {
        $cart = $this->database->getRow('quantity, price', 'cart', "WHERE cart_id = ? ", [$this->cartId]);

        if (isset($cart)) {
            $newQuantity = (int) ($cart['quantity']) + (int) ($this->productQuantity);
            $this->database->updateRow('cart', "quantity= '$newQuantity'"
                    . "WHERE cart_id = {$this->cartId}");
        }
    }

    /**
     * Calculate products price
     */
    public function calculatePrice() {
        $cartItem = $this->database->getRow('product_quantity, product_price', 'cart_item', "WHERE cart_id = ? ORDER BY id DESC LIMIT 1", [$this->cartId]);

        $cart = $this->database->getRow('quantity, price', 'cart', "WHERE cart_id = ? ", [$this->cartId]);
        if (isset($cartItem)) {
            $price = (int) ($cart['price']) + ((int) ($cartItem['product_price']) * (int) ($this->productQuantity));
            $this->database->updateRow('cart', "price = '$price' "
                    . "WHERE cart_id = $this->cartId");
        }
    }

    /**
     * Load costam dopisac
     */
    public function loadcart() {
        $cart = $this->database->getRow('*', 'cart', "WHERE cart_id = ? ", [$this->cartId]);

        if (!empty($cart)) {
            $this->productQuantity = $cart['quantity'];
            $this->productPrice = $cart['price'];
        }
    }

}

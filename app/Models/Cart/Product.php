<?php

namespace Shop\Models\Cart;

use Shop\Core\Model;

/**
 * Class CartManagement
 */
class Product extends Model {

    /**
     * @var totalQuantity
     */
    private $totalQuantity;

    /**
     * @var totalPrice
     */
    private $totalPrice;

    /**
     * @var cartId 
     */
    private $cartId;

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

}

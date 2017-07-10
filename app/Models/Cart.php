<?php

namespace Shop\Models;

use Shop\Core\Model;

/**
 * Class Cart
 */
class Cart extends Model {

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
     * @var tableId
     */
    private $tableId;

    /**
     * @var cartId 
     */
    private $cartId;

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
    public function getTableId() {
        return $this->tableId;
    }

    /**
     * 
     * @param string $tableId
     */
    public function setTableId($tableId) {
        $this->tableId = $tableId;
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
     * 
     * @param int $productPrice
     */
    public function setProductPrice($productPrice) {
        $this->productPrice = $productPrice;
    }

    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct($this->database);
        $this->rem = new RememberMe();
    }

    /**
     * Add items to cart, create new cart if doesnt exist
     * @return string
     */
    public function createQuote() {
        if (isset($this->tableId)) {
            $cartId = $this->database->getRow('cart_id', 'quote_item', "WHERE table_id = ?", [$this->tableId]);
            $this->setCartId($cartId['cart_id']);
            if (isset($cartId)) {
                $this->database->insertRow('quote_item', "(`cart_id`,`product_id`,`product_quantity`,`product_price`, `table_id`) VALUES(?,?,?,?,?)", [$cartId['cart_id'], $this->productId, $this->productQuantity, $this->productPrice, $this->tableId]);
                $tableId = $this->tableId;
                return $tableId;
            }
        } else {
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

    /*
     * Calculate products quantity
     */
    public function calculateQuantity() {
        $quoteItem = $this->database->getRow('product_quantity, product_price', 'quote_item', "WHERE table_id = ? ORDER BY id DESC LIMIT 1", [$this->tableId]);
        $quote = $this->database->getRow('quantity, price', 'quote', "WHERE cart_id = ? ", [$this->cartId]);
        if (isset($quoteItem)) {
            $cartId = $this->cartId;
            $quantity = (int) ($quote['quantity']) + (int) ($quoteItem['product_quantity']);
            $this->database->updateRow('quote', "quantity= '$quantity'"
                    . "WHERE cart_id = $cartId");
        }
    }

    /**
     * Calculate products price
     */
    public function calculatePrice() {
        $quoteItem = $this->database->getRow('product_quantity, product_price', 'quote_item', "WHERE table_id = ? ORDER BY id DESC LIMIT 1", [$this->tableId]);
        $quote = $this->database->getRow('quantity, price', 'quote', "WHERE cart_id = ? ", [$this->cartId]);
        if (isset($quoteItem)) {
            $cartId = $this->cartId;
            $price = (int) ($quote['price']) + ((int) ($quoteItem['product_price']) * (int) ($quoteItem['product_quantity']));
            $this->database->updateRow('quote', "price = '$price' "
                    . "WHERE cart_id = $cartId");
        }
    }

}

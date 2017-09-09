<?php

namespace Shop\Models\Cart;

use Shop\Core\Model;
use Shop\Models\Cart\{
    CartDetails,
    ProductDetails
}
;

/**
 * Class Checkout
 */
class Checkout extends Model {

    /**
     * @var orderQuantity
     */
    private $orderQuantity;

    /**
     * @var orderPrice
     */
    private $orderPrice;

    /**
     * @var userId
     */
    private $userId;

    /**
     * @var status
     */
    private $status;

    /**
     * @var orderId
     */
    private $orderId;

    /**
     * @return string
     */
    public function getOrderQuantity() {
        return $this->orderQuantity;
    }

    /**
     * @return string
     */
    public function getOrderPrice() {
        return $this->orderPrice;
    }

    /**
     * @return string
     */
    public function getUserId() {
        return $this->userId;
    }

    /**
     * @return string
     */
    public function getStatus() {
        return $this->status;
    }

    /**
     * @param string $orderQuantity
     */
    public function setOrderQuantity($orderQuantity) {
        $this->orderQuantity = $orderQuantity;
    }

    /**
     * @param string $orderPrice
     */
    public function setOrderPrice($orderPrice) {
        $this->orderPrice = $orderPrice;
    }

    /**
     * @param string $userId
     */
    public function setUserId($userId) {
        $this->userId = $userId;
    }

    /**
     * @param string $status
     */
    public function setStatus($status) {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getOrderId() {
        return $this->orderId;
    }

    /**
     * @param string $orderId
     */
    public function setOrderId($orderId) {
        $this->orderId = $orderId;
    }

    /**
     * Saves/updates user id
     */
    public function cartUpdate($cart) {
        for ($i = 0; $i < sizeof($cart); $i++) {
            $this->database->updateRow('cart_item', "product_quantity = '{$cart[$i]->getProductQuantity()}' "
                    . "WHERE product_id = {$cart[$i]->getProductId()}");
        }
    }

    /**
     * Create row in table order
     */
    public function orderCreate($item) {
        $lastId = $this->database->insertRow('orders', "(`cart_id`,`quantity`,`price`,`user_id`) VALUES(?,?,?,?)", [$item->getCartId(), $item->getTotalQuantity(), $item->getTotalPrice(), $item->getUserId()]);
        return $lastId;
    }

    /**
     * Remove cart, unnecessery as we have order now
     */
    public function removeCart($item) {
        $this->database->deleteRow('cart', "WHERE cart_id = ?", [$item->getCartId()]);
    }

    /**
     * Load Order by cartId
     */
    public function loadOrderByCartId($item) {
        $result = $cartId = $this->database->getRow('*', 'orders', "WHERE cart_id = ?", [$item->getCartId()]);

        if (!empty($result)) {
            $this->setOrderId($result['id']);
            $this->setOrderPrice($result['price']);
            $this->setOrderQuantity($result['quantity']);
            $this->setStatus($result['status']);
            $this->setUserId($result['user_id']);
        }
    }

    /**
     * Create row in table orders_items
     */
    public function orderItemsCreate($cartCollectionz) {
        for ($i = 0; $i < sizeof($cartCollectionz); $i++) {
            $this->database->insertRow('orders_items', "(`order_id`,`product_id`, `product_quantity`,`product_price`) VALUES(?,?,?,?)", [$this->orderId, $cartCollectionz[$i]->getProductId(), $cartCollectionz[$i]->getProductQuantity(), $cartCollectionz[$i]->getProductPrice()]);
        }
    }

    /**
     * Update product quantity after purchase
     */
    public function updateProductsQuantity($newQuantity, $id) {
        $this->database->updateRow('products', "quantity = '{$newQuantity}' "
                . "WHERE id = {$id}");
    }

    /**
     * Check if product is out of stock and turn it off if it is
     */
    public function checkIfOutOfStock($cartCollection) {
        for ($i = 0; $i < sizeof($cartCollection); $i++) {
            $result = $this->database->getRow('quantity', 'products', "WHERE id = ?", [$cartCollection[$i]->getProductId()]);
            if ($result['quantity'] == 0) {
                $this->database->updateRow('products', "is_available = 'turned off' "
                        . "WHERE id = {$cartCollection[$i]->getProductId()}");

                $result = $this->database->getRow('category_id', 'products', "WHERE id = ?", [$cartCollection[$i]->getProductId()]);
                $result2 = $this->database->getRow('amount', 'category', "WHERE id = ?", [$result['category_id']]);

                $newAmount = (int) ($result2['amount']) - 1;

                $this->database->updateRow('category', "amount = {$newAmount} "
                        . "WHERE id = {$result['category_id']}");
            }
        }
    }

}

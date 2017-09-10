<?php

namespace Shop\Models\Order;

use Shop\Core\Model;

/**
 * Class Order
 */
class Order extends Model {

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
     * Create row in table order
     */
    public function orderCreate($item) {
        $lastId = $this->database->insertRow('orders', "(`cart_id`,`quantity`,`price`,`user_id`) VALUES(?,?,?,?)", [$item->getCartId(), $item->getTotalQuantity(), $item->getTotalPrice(), $item->getUserId()]);
        return $lastId;
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

}

<?php

namespace Shop\Models\Cart;

use Shop\Core\Model;
use Shop\Models\Cart\{
    CartDetails,
    ProductDetails
}
;

/**
 * Class CheckoutManagement
 */
class CheckoutManagement extends Model {

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

    public function orderCreate($product) {
        $this->database->insertRow('orders', "(`cart_id`,`quantity`,`price`,`user_id`) VALUES(?,?,?,?)", [$product->getCartId(), $product->getTotalQuantity(), $product->getTotalPrice(), $product->getUserId()]);
    }

    public function removeCart($product) {
        $this->database->deleteRow('cart', "WHERE cart_id = ?", [$product->getCartId()]);
    }

    public function loadOrderByCartId($product) {
        $result = $cartId = $this->database->getRow('*', 'orders', "WHERE cart_id = ?", [$product->getCartId()]);

        if (!empty($result)) {
            $this->setOrderId($result['id']);
            $this->setOrderPrice($result['price']);
            $this->setOrderQuantity($result['quantity']);
            $this->setStatus($result['status']);
            $this->setUserId($result['user_id']);
        }
    }

}

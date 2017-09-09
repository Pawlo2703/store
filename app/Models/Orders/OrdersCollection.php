<?php

namespace Shop\Models\Orders;

use Shop\Core\Model;
use Shop\Models\Cart\Checkout;

/**
 * Class CategoryCollection
 */
class OrdersCollection extends Model {

    /**
     * @var categoryCollection
     */
    private $ordersCollection;

    /**
     * @var $tableName
     */
    protected $tableName = "orders";

    /**
     * @return array
     */
    public function getOrdersCollection() {
        return $this->ordersCollection;
    }

    /**
     * Creates objects collection and saves to array
     */
    public function createOrdersCollection() {

        $this->loadCollection();

        if (!empty($this->rawData)) {
            foreach ($this->rawData as $value) {
                $orders = new Checkout;
                $orders->setOrderId($value['id']);
                $orders->setUserId($value['user_id']);
                $orders->setOrderPrice($value['price']);
                $orders->setOrderQuantity($value['quantity']);
                $orders->setStatus($value['status']);

                if (isset($collection)) {
                    array_push($collection, $orders);
                } else {
                    $collection = array($orders);
                }
            }
        }
        return $this->ordersCollection = $collection;
    }

}

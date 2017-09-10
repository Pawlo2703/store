<?php

namespace Shop\Models\Order;

use Shop\Core\Model;
use Shop\Models\Order\Order;

/**
 * Class CategoryCollection
 */
class orderCollection extends Model {

    /**
     * @var categoryCollection
     */
    private $orderCollection;

    /**
     * @var $tableName
     */
    protected $tableName = "orders";

    /**
     * @return array
     */
    public function getorderCollection() {
        return $this->orderCollection;
    }

    /**
     * Creates objects collection and saves to array
     */
    public function createorderCollection() {

        $this->loadCollection();

        if (!empty($this->rawData)) {
            foreach ($this->rawData as $value) {
                $order = new Order;
                $order->setOrderId($value['id']);
                $order->setUserId($value['user_id']);
                $order->setOrderPrice($value['price']);
                $order->setOrderQuantity($value['quantity']);
                $order->setStatus($value['status']);

                if (isset($collection)) {
                    array_push($collection, $order);
                } else {
                    $collection = array($order);
                }
            }
        }
        return $this->orderCollection = $collection;
    }

}

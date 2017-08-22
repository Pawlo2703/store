<?php

namespace Shop\Models\Orders;

use Shop\Core\Model;
use Shop\Models\Cart\Item;
/**
 * Class CategoryCollection
 */
class OrdersItemsCollection extends Model {

    /**
     * @var categoryCollection
     */
    private $ordersItemsCollection;

    /**
     * @var $tableName
     */
    protected $tableName = "orders_items";

    /**
     * @return array
     */
    public function getOrdersItemsCollection() {
        return $this->ordersItemsCollection;
    }

    /**
     * Creates objects collection and saves to array
     */
    public function createOrdersItemsCollection() {

        Model::loadCollection();

        if (!empty($this->rawData)) {
            foreach ($this->rawData as $value) {
                $item = new Item;
                $item->setProductId($value['product_id']);
                $item->setProductPrice($value['product_price']);
                $item->setProductQuantity($value['product_quantity']);

                if (isset($collection)) {
                    array_push($collection, $item);
                } else {
                    $collection = array($item);
                }
            }
        }
        return $this->ordersItemsCollection = $collection;
    }

}

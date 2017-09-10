<?php

namespace Shop\Models\Order;

use Shop\Core\Model;
use Shop\Models\Cart\Item;

/**
 * Class CategoryCollection
 */
class OrderItemsCollection extends Model {

    /**
     * @var categoryCollection
     */
    private $OrderItemsCollection;

    /**
     * @var $tableName
     */
    protected $tableName = "orders_items";

    public function getTableName() {
        return $this->tableName;
    }

    public function setTableName($tableName) {
        $this->tableName = $tableName;
    }

    /**
     * @return array
     */
    public function getOrderItemsCollection() {
        return $this->OrderItemsCollection;
    }

    /**
     * Creates objects collection and saves to array
     */
    public function createOrderItemsCollection() {

        $this->loadCollection();

        if (!empty($this->rawData)) {
            foreach ($this->rawData as $value) {
                $item = new Item;
                $item->setProductId($value['product_id']);
                $item->setProductPrice($value['product_price']);
                $item->setProductQuantity($value['product_quantity']);

                $this->filterBy('id', $value['product_id']);
                $this->setTableName('products');
                $itemName = $this->loadCollection();
                $item->setProductNames($this->rawData[0]['name']);

                if (isset($collection)) {
                    array_push($collection, $item);
                } else {
                    $collection = array($item);
                }
            }
        }
        return $this->OrderItemsCollection = $collection;
    }

}

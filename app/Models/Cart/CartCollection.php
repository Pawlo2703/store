<?php

namespace Shop\Models\Cart;

use Shop\Core\Model;
use Shop\Models\Cart\Item;
/**
 * Class CartCollection
 */
class CartCollection extends Model {

    /**
     * @var array
     */
    private $cartCollection;

    /**
     * @var string
     */
    protected $tableName = 'cart_item';

    /**
     * @return array
     */
    public function getCartCollection() {
        return $this->cartCollection;
    }

    /**
     * Creates cart objects and saves to array
     */
    public function createCartCollection() {

        $this->loadCollection();

        if (!empty($this->rawData)) {

            foreach ($this->rawData as $value) {
                $item = new Item;
                $item->setCartId($value['cart_id']);
                $item->setProductName($value['product_id']);
                $item->setProductPrice($value['product_price']);
                $item->setProductQuantity($value['product_quantity']);
                $item->setProductId($value['product_id']);

                if (isset($collection)) {
                    array_push($collection, $item);
                } else {
                    $collection = array($item);
                }
            }
        } else {
            return;
        }
        return $this->cartCollection = $collection;
    }

}

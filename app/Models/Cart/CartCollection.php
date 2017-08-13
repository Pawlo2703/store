<?php

namespace Shop\Models\Cart;

use Shop\Core\Model;
use Shop\Models\Cart\{
    CartManagement,
    ProductDetails
};

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

        Model::loadCollection();

        if (!empty($this->rawData)) {

            foreach ($this->rawData as $value) {
                $product = new Product;
                $product->setCartId($value['cart_id']);
                $product->setProductName($value['product_id']);
                $product->setProductPrice($value['product_price']);
                $product->setProductQuantity($value['product_quantity']);
                $product->setProductId($value['product_id']);

                if (isset($collection)) {
                    array_push($collection, $product);
                } else {
                    $collection = array($product);
                }
            }
        } else {
            return;
        }
        return $this->cartCollection = $collection;
    }

}

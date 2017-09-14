<?php

namespace Shop\Models\Products;

use Shop\Core\Model;
use Shop\Models\Products\Product;

/**
 * Class CategoryCollection
 */
class HomePageProductsCollection extends Model {

    /**
     * @var array
     */
    private $homePageProductsCollection;

    /**
     * @var tableName
     */
    protected $tableName = "hp_items";

    /**
     * @return array
     */
    public function getHomePageProductsCollection() {
        return $this->homePageProductsCollection;
    }

    /**
     * Creates objects products and saves to array
     */
    public function createHomePageProductsCollection() {

        $this->loadCollection();

        if (!empty($this->rawData)) {
            foreach ($this->rawData as $value) {
                $product = new Product;
                $product->setProductId($value['product_id']);
                $product->setProductName($value['name']);
                $product->setProductImage($value['image']);
                $product->setIsAvailable($value['isAvailable']);
                $product->setProductPrice($value['price']);

                if (isset($collection)) {
                    array_push($collection, $product);
                } else {
                    $collection = array($product);
                }
            }
        } else {
            return;
        }
        return $this->homePageProductsCollection = $collection;
    }

}

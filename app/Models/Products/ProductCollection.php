<?php

namespace Shop\Models\Products;

use Shop\Core\Model;
use Shop\Models\Products\Product;

/**
 * Class CategoryCollection
 */
class ProductCollection extends Model {

    /**
     * @var array
     */
    private $productCollection;

    /**
     * @var tableName
     */
    protected $tableName = "products";
    
    /**
     * @return array
     */
    public function getProductCollection() {
        return $this->productCollection;
    }

    /**
     * Creates objects products and saves to array
     */
    public function createProductCollection() {
       
       $this->loadCollection();

        if (!empty($this->rawData)) {
            foreach ($this->rawData as $value) {
                $product = new Product;
                $product->setProductId($value['id']);
                $product->setProductName($value['name']);
                $product->setProductType($value['type']);
                $product->setProductColor($value['color']);
                $product->setProductCountry($value['country']);
                $product->setProductQuantity($value['quantity']);
                $product->setProductPrice($value['price']);
                $product->setCategoryId($value['category_id']);
                $product->setProductImage($value['image']);
                $product->setIsAvailable($value['is_available']);
                $product->setSalesCounter($value['sales_counter']);

                if (isset($collection)) {
                    array_push($collection, $product);
                } else {
                    $collection = array($product);
                }
            }
        } else {
            return;
        }
        return $this->productCollection = $collection;
    }

}

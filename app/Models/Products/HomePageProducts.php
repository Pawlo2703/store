<?php

namespace Shop\Models\Products;

use Shop\Models\Products\Product;
use Shop\Core\Model;

/**
 * Class HomePageProducts
 */
class HomePageProducts extends Model {

    /**
     * @var $table_name
     */
    private $tableName = 'hp_items';

    /**
     * @var $productId
     */
    private $productId;

    /**
     * @return string
     */
    public function getProductId() {
        return $this->productId;
    }

    /**
     * @param string $productId
     */
    public function setProductId($productId) {
        $this->productId = $productId;
    }

    /**
     * Save product id
     */
    public function save($product) {
        $this->database->insertRow("$this->tableName", "(`product_id`, `name`, `image`, `isAvailable`, `price`) VALUES(?,?,?,?,?)", [$product->getProductId(), $product->getProductName(), $product->getProductImage(), $product->getIsAvailable(), $product->getProductPrice()]);
    }

    /**
     * Delete all records
     */
    public function delete() {
        $this->database->deleteRow("$this->tableName");
    }

    /**
     * @return type
     */
    public function load() {
        return $result = $this->database->getRow('product_id', "$this->tableName");
    }

}

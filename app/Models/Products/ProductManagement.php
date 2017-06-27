<?php

namespace Shop\Models\Products;

/**
 * Class 
 */
class ProductManagement {

    private $product;
    private $type;
    private $color;
    private $country;
    private $quantity;
    private $price;
    private $category;

    public function getType() {
        return $this->type;
    }

    public function getColor() {
        return $this->color;
    }

    public function getCountry() {
        return $this->country;
    }

    public function getQuantity() {
        return $this->quantity;
    }

    public function getPrice() {
        return $this->price;
    }

    public function setType($type) {
        $this->type = $type;
    }

    public function setColor($color) {
        $this->color = $color;
    }

    public function setCountry($country) {
        $this->country = $country;
    }

    public function setQuantity($quantity) {
        $this->quantity = $quantity;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    public function getProduct() {
        return $this->product;
    }

    public function setProduct($product) {
        $this->product = $product;
    }

    public function getCategory() {
        return $this->category;
    }

    public function setCategory($category) {
        $this->category = $category;
    }

    public function __construct() {
        $this->database = \Shop\Core\Database::getInstance();
    }

    public function addPro() {
        $result = $this->database->getRow('*', 'products', "WHERE name = ?", [$this->product]);
        if ((!$result)) {
            $result = $this->database->insertRow('products', "(`name`,`category_id`,`type`,`color`,`country`,`quantity`,`price`) VALUES(?,?,?,?,?,?,?)", [$this->product, $this->category, $this->type, $this->color, $this->country, $this->quantity, $this->price]);
            return $result;
        }
        return;
    }

    public function loadProduct($id) {
        $result = $this->database->getRows('name, id', 'products', "WHERE category_id = ?", [$id]);
        return $result;
    }

    public function loadProductView($id) {
        $result = $this->database->getRows('*', 'products', "WHERE id = ?", [$id]);
        return $result;
    }

    public function remove($id) {
        $this->database->deleteRow('products', "WHERE id = ?", [$id]);
        return;
    }

}

<?php

namespace Shop\Models\Products;

/**
 * Class 
 */
class ProductManagement {

    private $id;
    private $name;
    private $type;
    private $color;
    private $country;
    private $quantity;
    private $price;
    private $category;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        if ($id == !NULL) {
            $this->id = $id;
        }
    }

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
        if ($type == !NULL) {
            $this->type = $type;
        }
    }

    public function setColor($color) {
        if ($color == !NULL) {
            $this->color = $color;
        }
    }

    public function setCountry($country) {
        if ($country == !NULL) {
            $this->country = $country;
        }
    }

    public function setQuantity($quantity) {
        if ($quantity == !NULL) {
            $this->quantity = $quantity;
        }
    }

    public function setPrice($price) {
        if ($price == !NULL) {
            $this->price = $price;
        }
    }

    public function getName() {
        return $this->Name;
    }

    public function setName($name) {
        if ($name == !NULL) {
            $this->name = $name;
        }
    }

    public function getCategory() {
        return $this->category;
    }

    public function setCategory($category) {
        if ($category > 0) {
            $this->category = $category;
        }
    }

    public function __construct() {
        $this->database = \Shop\Core\Database::getInstance();
    }

    public function addPro() {
        $result = $this->database->getRow('*', 'products', "WHERE name = ?", [$this->name]);
        if ((!$result)) {
            $result = $this->database->insertRow('products', "(`name`,`category_id`,`type`,`color`,`country`,`quantity`,`price`) VALUES(?,?,?,?,?,?,?)", [$this->name, $this->category, $this->type, $this->color, $this->country, $this->quantity, $this->price]);
            return $result;
        }

        return;
    }

    public function init($data) {
        $this->setName($data['name']);
        $this->setType($data['type']);
        $this->setColor($data['color']);
        $this->setCountry($data['country']);
        $this->setQuantity($data['quantity']);
        $this->setPrice($data['price']);
    }

    public function updateProduct() {
        $name = $this->name;
        $type = $this->type;
        $category = $this->category;
        $color = $this->color;
        $quantity = $this->quantity;
        $price = $this->price;
        $country = $this->country;
        $id = $this->id;

        $this->database->updateRow('products', "name='$name', "
                . "type='$type', "
                . "color='$color',"
                . "quantity='$quantity',"
                . "price='$price',"
                . "country='$country',"
                . "category_id='$category'"
                . "WHERE id= $id");
        return;
    }

    public function loadProduct($id) {
        $result = $this->database->getRows('name, id, is_available', 'products', "WHERE category_id = ?", [$id]);
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

    
    
    public function isAvailable($id) {
        $result = $this->database->getRow('is_available', 'products', "WHERE id = ?", [$id]);
        if (($result['is_available']) == "turned off") {
            $this->database->updateRow('products', "is_available= 'turned on'"
                    . "WHERE id= $id");
        } else {
            $this->database->updateRow('products', "is_available= 'turned off'"
                    . "WHERE id= $id");
            return;
        }
    }

}

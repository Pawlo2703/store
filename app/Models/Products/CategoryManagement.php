<?php

namespace Shop\Models\Products;

/**
 * Class AddNew
 */
class CategoryManagement {

    private $id;
    private $category;
    private $uri;
    private $name;

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getUri() {
        return $this->uri;
    }

    public function setUri($uri) {
        $this->uri = $uri;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
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

    public function addCat() {
        $result = $this->database->getRow('*', 'category', "WHERE name = ?", [$this->category]);
        if ((!$result)) {
            $result = $this->database->insertRow('category', "(`name`) VALUES(?)", [$this->category]);
            return $result;
        }
        return;
    }

    public function loadCat() {
        $result = $this->database->getRows('*', 'category');
        return $result;
    }

    public function loadCatList() {
        $result = $this->database->getRows('name', 'category');
        return $result;
    }

    public function loadId() {
        $result = $this->database->getRows('id', 'category');
        return $result;
    }

    public function getCategoryByName($name) {
        $result = $this->database->getRows('id', 'category', "WHERE name = ?", [$name]);
        return $result;
    }

    public function getCategoryById($id) {
        $result = $this->database->getRows('name', 'category', "WHERE id = ?", [$id]);
        return $result;
    }

    public function remove($id) {
        $this->database->deleteRow('category', "WHERE id = ?", [$id]);
        return;
    }

    public function isAvailable($id) {
        $result = $this->database->getRow('is_available', 'category', "WHERE id = ?", [$id]);
        if (($result['is_available']) == "turned off") {
            $this->database->updateRow('category', "is_available= 'turned on'"
                    . "WHERE id= $id");
        } else {
            $this->database->updateRow('category', "is_available= 'turned off'"
                    . "WHERE id= $id");
            return;
        }
    }

    public function nameChange($id) {
        $name = $this->name;
        $this->database->updateRow('category', "name= '$name'"
                . "WHERE id= $id");
    }

}

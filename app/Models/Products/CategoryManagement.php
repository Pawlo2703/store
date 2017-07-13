<?php

namespace Shop\Models\Products;

use Shop\Core\Model;

/**
 * Class CategoryManagement
 */
class CategoryManagement extends Model {

    /**
     * @var categoryId 
     */
    private $categoryId;

    /**
     * @var string
     */
    private $isAvailable;

    /**
     * @var string
     */
    private $amount;

    /**
     * @var categoryName
     */
    private $categoryName;

    /**
     * @var uri
     */
    private $uri;

    /**
     * @return string
     */
    public function getCategoryId() {
        return $this->categoryId;
    }

    /**
     * @return string
     */
    public function getIsAvailable() {
        return $this->isAvailable;
    }

    /**
     * @return string
     */
    public function getAmount() {
        return $this->amount;
    }

    /**
     * @return string
     */
    public function getCategoryName() {
        return $this->categoryName;
    }

    /**
     * @param string $categoryId
     */
    public function setCategoryId($categoryId) {
        $this->categoryId = $categoryId;
    }

    /**
     * @param string $isAvailable
     */
    public function setIsAvailable($isAvailable) {
        $this->isAvailable = $isAvailable;
    }

    /**
     * @param string $amount
     */
    public function setAmount($amount) {
        $this->amount = $amount;
    }

    /**
     * @param string $categoryName
     */
    public function setCategoryName($categoryName) {
        $this->categoryName = $categoryName;
    }

    /**
     * @return sring
     */
    public function getUri() {
        return $this->uri;
    }

    /**
     * @param string $uri
     */
    public function setUri($uri) {
        $this->uri = $uri;
    }

    /**
     * Create new category
     * @return array
     */
    public function createCategory() {
        $result = $this->database->getRow('*', 'category', "WHERE name = ?", [$this->categoryName]);
        if ((!$result)) {
            $result = $this->database->insertRow('category', "(`name`) VALUES(?)", [$this->categoryName]);
            return $result;
        }
    }

    /**
     * Load all categories
     * @return array
     */
    public function loadCategories() {
        $result = $this->database->getRows('*', 'category');
        return $result;
    }

    /**
     * Load categories IDs
     * @return array
     */
    public function loadCategoriesId() {
        $result = $this->database->getRows('id', 'category');
        return $result;
    }

    /**
     * Find categories by name
     * @param string $name
     * @return array
     */
    public function getCategoriesByName($name) {
        $result = $this->database->getRows('id', 'category', "WHERE name = ?", [$name]);
        return $result;
    }

    /**
     * Find category by id
     * @param string $id
     * @return array
     */
    public function getCategoriesById($id) {
        $result = $this->database->getRows('name', 'category', "WHERE id = ?", [$id]);
        return $result;
    }

    /**
     * Remove single category
     * @param string $id
     */
    public function remove($id) {
        $this->database->deleteRow('category', "WHERE id = ?", [$id]);
    }

    /**
     * Turn off or turn on category
     * @param string $id
     */
    public function isAvailable($id) {
        $result = $this->database->getRow('is_available', 'category', "WHERE id = ?", [$id]);
        if (($result['is_available']) == "turned off") {
            $this->database->updateRow('category', "is_available= 'turned on'"
                    . "WHERE id= $id");
        } else {
            $this->database->updateRow('category', "is_available= 'turned off'"
                    . "WHERE id= $id");
        }
    }

    /**
     * Change category name
     * @param string $id
     */
    public function changeCategoryName($id) {
        $this->database->updateRow('category', "name= '{$this->name}'"
                . "WHERE id= $id");
    }

}

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
     * Find categories by name
     * @param string $name
     * @return array
     */
    public function getCategoryByName($name) {
        $result = $this->database->getRow('id', 'category', "WHERE name = ?", [$name]);
        return $result;
    }

    /**
     * Find category by id
     * @param string $id
     * @return array
     */
    public function getCategoryById($id) {
        $result = $this->database->getRow('name', 'category', "WHERE id = ?", [$id]);
        return $result;
    }

    /**
     * Remove single category
     * @param string $id
     */
    public function remove() {
        $this->database->deleteRow('category', "WHERE id = ?", [$this->categoryId]);
    }

    /**
     * Turn off or turn on category
     * @param string $id
     */
    public function isAvailable() {
        $result = $this->database->getRow('is_available', 'category', "WHERE id = ?", [$this->categoryId]);
        if (($result['is_available']) == "turned off") {
            $this->database->updateRow('category', "is_available= 'turned on'"
                    . "WHERE id= {$this->categoryId}");
        } else {
            $this->database->updateRow('category', "is_available= 'turned off'"
                    . "WHERE id= {$this->categoryId}");
        }
    }

    /**
     * Change category name
     * @param string $id
     */
    public function changeCategoryName() {
        $this->database->updateRow('category', "name= '{$this->categoryName}'"
                . "WHERE id= {$this->categoryId}");
    }

}

<?php

namespace Shop\Models\Category;

use Shop\Core\Model;

/**
 * Class Category
 */
class Category extends Model {

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
        $result = $this->database->insertRow('category', "(`name`) VALUES(?)", [$this->categoryName]);
    }

    /**
     * Load all columns by given parameters
     * @param string $column
     * @param string $param
     */
    public function findBy($column, $param) {
        $result = $this->database->getRow('*', 'category', "WHERE $column = ?", [$param]);

        if (!empty($result)) {
            $this->categoryId = $result['id'];
            $this->categoryName = $result['name'];
            $this->amount = $result['amount'];
            $this->isAvailable = $result['is_available'];
        }
    }

    /**
     * Remove single category
     * @param string $id
     */
    public function removeCategory() {
        $this->database->deleteRow('category', "WHERE id = ?", [$this->categoryId]);
    }

    /**
     * Turn off category
     */
    public function turnOffCategory() {
        $this->database->updateRow('category', "is_available= 'turned off'"
                . "WHERE id= {$this->categoryId}");
    }

    /**
     * Turn on category
     */
    public function turnOnCategory() {
        $this->database->updateRow('category', "is_available= 'turned on'"
                . "WHERE id= {$this->categoryId}");
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

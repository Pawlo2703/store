<?php

namespace Shop\Models\Products;

use Shop\Core\Model;

/**
 * Class CategoryManagement
 */
class CategoryManagement extends Model {

    /**
     * @var id 
     */
    private $id;

    /**
     * @var category
     */
    private $category;

    /**
     * @var uri
     */
    private $uri;

    /**
     * @var name
     */
    private $name;

    /**
     * 
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * 
     * @param string $name
     */
    public function setName($name) {
        $this->name = $name;
    }

    /**
     * 
     * @return sring
     */
    public function getUri() {
        return $this->uri;
    }

    /**
     * 
     * @param string $uri
     */
    public function setUri($uri) {
        $this->uri = $uri;
    }

    /**
     * 
     * @return string
     */
    public function getId() {
        return $this->id;
    }

    /**
     * 
     * @param string $id
     */
    public function setId($id) {
        $this->id = $id;
    }

    /**
     * 
     * @return string
     */
    public function getCategory() {
        return $this->category;
    }

    /**
     * 
     * @param string $category
     */
    public function setCategory($category) {
        $this->category = $category;
    }

    /**
     *  Constructor
     */
    public function __construct() {
        $this->database = \Shop\Core\Database::getInstance();
    }

    /**
     * Create new category
     * @return array
     */
    public function createCategory() {
        $result = $this->database->getRow('*', 'category', "WHERE name = ?", [$this->category]);
        if ((!$result)) {
            $result = $this->database->insertRow('category', "(`name`) VALUES(?)", [$this->category]);
            return $result;
        }
        return;
    }

    /**
     * Load all categories
     * @return array
     */
    public function loadCategory() {
        $result = $this->database->getRows('*', 'category');
        return $result;
    }

    /**
     * Load category IDs
     * @return array
     */
    public function loadId() {
        $result = $this->database->getRows('id', 'category');
        return $result;
    }

    /**
     * Find category by name
     * @param string $name
     * @return array
     */
    public function getCategoryByName($name) {
        $result = $this->database->getRows('id', 'category', "WHERE name = ?", [$name]);
        return $result;
    }

    /**
     * Find category by id
     * @param string $id
     * @return array
     */
    public function getCategoryById($id) {
        $result = $this->database->getRows('name', 'category', "WHERE id = ?", [$id]);
        return $result;
    }

    /**
     * Remove single category
     * @param string $id
     */
    public function remove($id) {
        $this->database->deleteRow('category', "WHERE id = ?", [$id]);
        return;
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
            return;
        }
    }

    /**
     * Change category name
     * @param string $id
     */
    public function changeCategoryName($id) {
        $name = $this->name;
        $this->database->updateRow('category', "name= '$name'"
                . "WHERE id= $id");
    }

}

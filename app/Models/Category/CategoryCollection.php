<?php

namespace Shop\Models\Category;

use Shop\Core\Model;
use Shop\Models\Category\CategoryManagement;

/**
 * Class CategoryCollection
 */
class CategoryCollection extends Model {

    /**
     * @var categoryCollection
     */
    private $categoryCollection;

    /**
     * @var $tableName
     */
    protected $tableName = "category";

    /**
     * @return array
     */
    public function getCategoryCollection() {
        return $this->categoryCollection;
    }

    /**
     * Creates objects collection and saves to array
     */
    public function createCategoryCollection() {

        Model::loadCollection();

        if (!empty($this->rawData)) {
            foreach ($this->rawData as $value) {
                $category = new CategoryManagement;
                $category->setCategoryId($value['id']);
                $category->setCategoryName($value['name']);
                $category->setAmount($value['amount']);
                $category->setIsAvailable($value['is_available']);

                if (isset($collection)) {
                    array_push($collection, $category);
                } else {
                    $collection = array($category);
                }
            }
        }
        return $this->categoryCollection = $collection;
    }

}

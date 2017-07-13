<?php

namespace Shop\Models\Products;

use Shop\Core\Model;
use Shop\Models\Products\CategoryManagement;

/**
 * Class CategoryCollection
 */
class CategoryCollection extends Model {

    /**
     *
     * @var array
     */
    private $categoryCollection;

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
        $result = $this->database->getRows('*', 'category');

        if (!empty($result)) {
            foreach ($result as $key => $value) {
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
        } $this->categoryCollection = $collection;
    }

}

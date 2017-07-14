<?php

namespace Shop\Controllers\admin\category;

use Shop\Core\Controller;
use Shop\Models\Products\{
    CategoryManagement,
    ProductManagement,
    CategoryCollection
};

/**
 * Class Category
 */
class Category extends Controller {

    /**
     * Display categories list
     */
    public function display() {
        $this->checkIfAdmin();

        $collection = new CategoryCollection;
        $categoryCollection = $collection->createCategoryCollection();
       

        $data = [
            'categoryCollection' => $categoryCollection
        ];
        $this->view('home/admin/category', $data);
    }

    /**
     * Remove single category
     */
    public function remove() {
        $this->checkIfAdmin();
        $categoryManagement = new CategoryManagement;
        $url = $this->parseUrl($_GET['url']);
        $categoryManagement->setCategoryId($url[2]);
        $categoryManagement->remove();
        $this->redirect("category", "");
    }

    /**
     * Displays form with new Category input
     */
    public function displayCreateCategoryForm() {
        $this->checkIfAdmin();
        $this->view('home/admin/category/add_category');
    }

    /**
     * Create new category
     */
    public function createCategory() {
        $this->checkIfAdmin();
        $params = $this->getParameters();
        $categoryManagement = new CategoryManagement;
        $categoryManagement->setCategoryName($params['category']);
        if ($categoryManagement->createCategory() !== NULL) {
            $this->redirect("category", "");
            exit;
        } else {
            $this->view('home/admin/category/error/category_exists');
            exit;
        }
    }

}

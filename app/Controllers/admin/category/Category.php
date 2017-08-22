<?php

namespace Shop\Controllers\admin\category;

use Shop\Core\Controller;
use Shop\Models\Category\{
    Category as CategoryModel,
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
        $category = new CategoryModel;
        $url = $this->parseUrl($_GET['url']);
        $category->setCategoryId($url[2]);
        $category->remove();
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
        $category = new CategoryModel;
        $category->setCategoryName($params['category']);
        if ($category->createCategory() !== NULL) {
            $this->redirect("category", "");
            exit;
        } else {
            $this->view('home/admin/category/error/category_exists');
            exit;
        }
    }

}

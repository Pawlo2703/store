<?php

namespace Shop\Controllers;

use Shop\Core\Controller;
use Shop\Models\Products\{
    CategoryManagement,
    ProductManagement
};

/**
 * Class Home
 */
class Home extends Controller {

    /*
     * Display homepage
     */
    public function display() {
        $this->header();
        $categoryManagement = new CategoryManagement;
        $productManagement = new ProductManagement;

        $categoryList = $categoryManagement->loadCategory();

        $data = [
            'categoryList' => $categoryList
        ];
        $this->view('home/home_page/index', $data);
    }

}

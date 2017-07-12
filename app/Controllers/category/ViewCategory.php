<?php

namespace Shop\Controllers\category;

use Shop\Core\Controller;
use Shop\Models\Products\CategoryManagement;
use Shop\Models\Products\ProductManagement;

/**
 * Class ViewCategory
 */
class ViewCategory extends Controller {

    /**
     * Display Category View
     */
    public function display() {
        $this->header();
        $categoryManagement = new CategoryManagement;
        $producManagement = new ProductManagement;
        $url = $this->parseUrl($_GET['url']);

        if (2 < sizeof($url)) {
            $this->session->set('category_id', $url[2]);
        } else {
            $this->redirect('home', '');
        }

        $categoryList = $categoryManagement->loadCategory();
        $productsList = $producManagement->loadProducts($url[2]);
        $data = [
            'categoryList' => $categoryList,
            'productsList' => $productsList
        ];
        $this->view('home/category/view_category', $data);
    }

}

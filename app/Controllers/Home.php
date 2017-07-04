<?php

namespace Shop\Controllers;

use Shop\Core\Controller;
use Shop\Models\Products\CategoryManagement;
use Shop\Models\Products\ProductManagement;

class Home extends Controller {

    public function display() {
        $this->header();
        $cat = new CategoryManagement;
        $pro = new ProductManagement;

        $categoryList = $cat->loadCat();
        
        $data = [
            'categoryList' => $categoryList
        ];
        $this->view('home/home_page/index', $data);
    }

}

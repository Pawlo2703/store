<?php

namespace Shop\Controllers\category;

use Shop\Core\Controller;
use Shop\Models\Products\CategoryManagement;
use Shop\Models\Products\ProductManagement;
use Shop\libs\Session;

class ViewCategory extends Controller {

    public function display() {
        $this->header();
        $cat = new CategoryManagement;
        $pro = new ProductManagement;
        $url = $this->getUrlParam();

        if (2 < sizeof($url)) {
            $this->session->set('category_id', $url[2]);
        } else {
            $this->redirect('home', '');
        }

        $categoryList = $cat->loadCat();
        $productsList = $pro->loadProduct($url[2]);
        $allProducts = $pro->loadAllProducts();
        $data = [
            'categoryList' => $categoryList,
            'productsList' => $productsList,
            'allProducts' => $allProducts
        ];
        $this->view('home/category/view_category', $data);
    }

}

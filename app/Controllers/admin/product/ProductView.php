<?php

namespace Shop\Controllers\admin\product;

use Shop\Core\Controller;
use Shop\Models\Products\CategoryManagement;
use Shop\Models\Products\ProductManagement;

class ProductView extends Controller {

    public function display() {
        $this->checkIfAdmin();
        $productManagement = new ProductManagement;
        $categoryManagement = new CategoryManagement;
        $url = $this->parseUrl($_GET['url']);
        $productId = $url[2];
        $this->session->set('product_id', $url[2]);

        $categoryList = $categoryManagement->loadCategory();
        $categoryId = $this->session->get('category_id');
        $categoryNavigation = "' http://" . ($_SERVER['HTTP_HOST']) . "/" . 'category' . "'";
        $productNavigation = "' http://" . ($_SERVER['HTTP_HOST']) . "/" . 'product/' . $categoryId . "'";
        $product = $productManagement->loadProductView($productId);

        $category = $categoryManagement->getCategoryById($product[0]['category_id']);

        $data = [
            'pro' => $productManagement,
            'product' => $product,
            'category' => $category,
            'categoryNavigation' => $categoryNavigation,
            'productNavigation' => $productNavigation,         
            'categoryList' => $categoryList   
                ];
        $this->view('home/admin/product_view', $data);
    }

}

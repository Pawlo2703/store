<?php

namespace Shop\Controllers\product;

use Shop\Core\Controller;
use Shop\Models\Products\CategoryManagement;
use Shop\Models\Products\ProductManagement;
use Shop\libs\Session;

class ViewProduct extends Controller {

    public function display() {
        $this->header();
        $pro = new ProductManagement;
        $cat = new CategoryManagement;
        $url = $this->getUrlParam();
        $pro_id = $url[2];
        $this->session->set('product_id', $url[2]);
        $categoryId = $this->session->get('category_id');

        $categoryList = $cat->loadCat();
        $prodList = $this->session->get('category_id');
        $jUrl = "<a href=' http://" . ($_SERVER['HTTP_HOST']) . "/" . 'kategoria/' . $categoryId . "'>Product</a>";
        $product = $pro->loadProductView($pro_id);

        $category = $cat->getCategoryById($product[0]['category_id']);

        $data = [
            'pro' => $pro,
            'product' => $product,
            'category' => $category,
            'jUrl' => $jUrl,
            'categoryList' => $categoryList
        ];
        $this->view('home/product/product_view', $data);
    }

    public function cart() {
        $this->shoppingCart();
        
        $id = $this->session->get('product_id');
        
        $this->redirect("produkt", "$id");
        
        
    }

}

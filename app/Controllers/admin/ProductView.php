<?php

namespace Shop\Controllers\admin;

use Shop\Core\Controller;
use Shop\Models\Products\CategoryManagement;
use Shop\Models\Products\ProductManagement;

class ProductView extends Controller {

    public function display() {

        $pro = new ProductManagement;
        $cat = new CategoryManagement;
        $url = $this->getUrlParam();
        $cat_id = $url[2];
        $product = $pro->loadProductView($cat_id);
        
        $category = $cat->getCategoryById($product[0]['category_id']);
                
              
        $data = [
            'pro' => $pro,
            'product' => $product,
                'category' => $category
        ];
        $this->view('home/admin/product_view', $data);
    }

}

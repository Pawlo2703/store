<?php

namespace Shop\Controllers\admin\product;

use Shop\Core\Controller;
use Shop\Models\Products\CategoryManagement;
use Shop\Models\Products\ProductManagement;
use Shop\libs\Session;

class ProductView extends Controller {

    public function display() {

        $pro = new ProductManagement;
        $cat = new CategoryManagement;
        $url = $this->getUrlParam();
        $cat_id = $url[2];
        
        $prodList= $this->session->get('zmienna3');
        $jUrl = "<a href=' http://" . ($_SERVER['HTTP_HOST']) . "/" . 'category' . "'>Category</a>-><a href=' http://" . ($_SERVER['HTTP_HOST']) . "/" . 'product/' .$prodList . "'>Product</a>";
        $product = $pro->loadProductView($cat_id);
        
        $category = $cat->getCategoryById($product[0]['category_id']);
                
              
        $data = [
            'pro' => $pro,
            'product' => $product,
                'category' => $category,
            'jUrl' => $jUrl
        ];
        $this->view('home/admin/product_view', $data);
    }

}

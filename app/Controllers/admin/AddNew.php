<?php

namespace Shop\Controllers\admin;

use Shop\Core\Controller;
use Shop\Models\Products\CategoryManagement;
use Shop\Models\Products\ProductManagement;

class AddNew extends Controller {

    public function displayCategory() {
        $this->view('home/admin/category/add_category');
    }

    public function displayProduct() {

        $cat = new CategoryManagement;
        $url = $this->getUrlParam();
        $name = $cat->loadCatList();
        
                $data = [
            'cat' => $cat,
                        'name' => $name,
                        'url' => $url
        ];
        $this->view('home/admin/category/add_product', $data);
    }

 



}

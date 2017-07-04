<?php

namespace Shop\Controllers\admin\product;

use Shop\Core\Controller;
use Shop\Models\Products\CategoryManagement;
use Shop\Models\Products\ProductManagement;
use Shop\libs\Session;

class ProductUpdate extends Controller {

    public function update() {
        $this->checkIfAdmin();

        $pro = new ProductManagement;
        $cat = new CategoryManagement;
        $params = $this->getParameters();
        $product_id = $this->session->get('product_id');
        $loadedProduct = $pro->loadProductView($product_id);

        $pro->init($loadedProduct[0]);
        $pro->init($params);
        $pro->setId($product_id);
        $pro->setCategory($loadedProduct[0]['category_id']);
        $category_id = $cat->getCategoryByName($params['category']);
        $pro->setCategory($category_id[0]['id']);
        $pro->updateProduct();

        $this->redirect("category", '');
    }

}

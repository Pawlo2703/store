<?php

namespace Shop\Controllers\admin\product;

use Shop\Core\Controller;
use Shop\Models\Products\CategoryManagement;
use Shop\Models\Products\ProductManagement;
use Shop\libs\Session;

/**
 * ProductActions
 */
class ProductActions extends Controller {

    /**
     * Product details update
     */
    public function updateProduct() {
        $this->checkIfAdmin();

        $productManagement = new ProductManagement;
        $categoryManagement = new CategoryManagement;
        $params = $this->getParameters();
        $productId = $this->session->get('product_id');
        $loadedProduct = $productManagement->loadProductView($productId);

        $productManagement->init($loadedProduct[0]);
        $productManagement->init($params);
        $productManagement->setId($productId);
        $productManagement->setCategory($loadedProduct[0]['category_id']);
        $categoryId = $categoryManagement->getCategoryByName($params['category']);
        $productManagement->setCategory($categoryId[0]['id']);
        $productManagement->updateProduct();

        $this->redirect("category", '');
    }

    /**
     * Turn on/off single product
     */
    public function changeAvailability() {
        $productManagement = new ProductManagement;
        $url = $this->parseUrl($_GET['url']);
        $productManagement->isAvailable($url[2]);
        $categoryId = $this->session->get('category_id');
        $this->redirect("product", "$categoryId");
    }

}

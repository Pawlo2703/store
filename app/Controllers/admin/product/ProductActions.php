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
        $loadedProduct = $productManagement->loadProduct($productId);
        $productManagement->init($loadedProduct);
        $productManagement->init($params);
        $productManagement->setProductId($productId);
        $productManagement->setCategoryId($loadedProduct['category_id']);
        $categoryId = $categoryManagement->getCategoryByName($params['category']);
        $productManagement->setCategoryId($categoryId['id']);
        $productManagement->updateProduct();

        $this->redirect("category", '');
    }

    /**
     * Turn on/off single product
     */
    public function changeAvailability() {
        $productManagement = new ProductManagement;
        $productManagement->setProductId($this->parseUrl($_GET['url'])[2]);
        $productManagement->isAvailable();
        $categoryId = $this->session->get('category_id');
        $this->redirect("product", "$categoryId");
    }

}

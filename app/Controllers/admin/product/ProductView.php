<?php

namespace Shop\Controllers\admin\product;

use Shop\Models\Products\ProductManagement;
use Shop\Core\Controller;
use Shop\Models\Category\{
    CategoryManagement,
    CategoryCollection
};

class ProductView extends Controller {

    /**
     * Display view of single product
     */
    public function display() {
        $this->checkIfAdmin();
        $productManagement = new ProductManagement;
        $categoryCollection = new CategoryCollection;
        $categoryManagement = new CategoryManagement;

        $productId = $this->parseUrl($_GET['url'])[2];
        $this->session->set('product_id', $productId);

        $collection = $categoryCollection->createCategoryCollection();
        $categoryId = $this->session->get('category_id');
        $categoryNavigation = "' http://" . ($_SERVER['HTTP_HOST']) . "/" . 'category' . "'";
        $productNavigation = "' http://" . ($_SERVER['HTTP_HOST']) . "/" . 'product/' . $categoryId . "'";
        $productManagement->loadProduct($productId);
        $categoryManagement->findBy("id", $productManagement->getCategoryId());

        $data = [
            'productManagement' => $productManagement,
            'categoryManagement' => $categoryManagement,
            'categoryNavigation' => $categoryNavigation,
            'productNavigation' => $productNavigation,
            'collection' => $collection
        ];
        $this->view('home/admin/product_view', $data);
    }

}

<?php

namespace Shop\Controllers\admin\product;

use Shop\Core\Controller;
use Shop\Models\Products\{
    CategoryManagement,
    CategoryCollection,
    ProductManagement
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
        $product = $productManagement->loadProduct($productId);

        $category = $categoryManagement->getCategoryById($product['category_id']);

        $data = [
            'product' => $product,
            'category' => $category,
            'categoryNavigation' => $categoryNavigation,
            'productNavigation' => $productNavigation,
            'collection' => $collection
        ];
        $this->view('home/admin/product_view', $data);
    }

}

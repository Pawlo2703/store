<?php

namespace Shop\Controllers\admin\product;

use Shop\Models\Products\Product;
use Shop\Core\Controller;
use Shop\Models\Category\{
    Category,
    CategoryCollection
};

class ProductView extends Controller {

    /**
     * Display view of single product
     */
    public function display() {
        $this->checkIfAdmin();
        $product = new Product;
        $categoryCollection = new CategoryCollection;
        $category = new Category;

        $productId = $this->parseUrl($_GET['url'])[2];
        $this->session->set('product_id', $productId);

        $collection = $categoryCollection->createCategoryCollection();
        $categoryId = $this->session->get('category_id');
        $categoryNavigation = "' http://" . ($_SERVER['HTTP_HOST']) . "/" . 'category' . "'";
        $productNavigation = "' http://" . ($_SERVER['HTTP_HOST']) . "/" . 'product/' . $categoryId . "'";
        $product->loadProduct($productId);
        $category->findBy("id", $product->getCategoryId());

        $data = [
            'productManagement' => $product,
            'categoryManagement' => $category,
            'categoryNavigation' => $categoryNavigation,
            'productNavigation' => $productNavigation,
            'collection' => $collection
        ];
        $this->view('home/admin/product_view', $data);
    }

}

<?php

namespace Shop\Controllers\admin\product;

use Shop\Core\Controller;
use Shop\Models\Category\Category;
use Shop\Models\Products\Product;

/**
 * ProductActions
 */
class ProductActions extends Controller {

    /**
     * Product details update
     */
    public function updateProduct() {
        $this->checkIfAdmin();

        $product = new Product;
        $category = new Category;
        $params = $this->getParameters();

        $productId = $this->session->get('product_id');
        $loadedProduct = $product->loadProduct($productId);
        $product->init($loadedProduct);
        $product->init($params);
        $product->setProductId($productId);
        $product->setCategoryId($loadedProduct['category_id']);

        $category->findBy("name", $params['category']);
        $categoryId = $category->getCategoryId();
        $product->setCategoryId($categoryId);

        $product->updateProduct();

        $this->redirect("category", '');
    }

    /**
     * Turn on/off single product
     */
    public function changeAvailability() {
        $product = new Product;
        $product->setProductId($this->parseUrl($_GET['url'])[2]);
        $product->isAvailable();
        $categoryId = $this->session->get('category_id');
        $this->redirect("product", "$categoryId");
    }

}

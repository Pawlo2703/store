<?php

namespace Shop\Controllers\admin\product;

use Shop\Core\Controller;
use Shop\Models\Category\Category;
use Shop\Models\Products\Product as ProductModel;

/**
 * ProductActions
 */
class ProductActions extends Controller {

    /**
     * Product details update
     */
    public function updateProduct() {
        $this->checkIfAdmin();

        $product = new ProductModel;
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
        $product = new ProductModel;
        $product->setProductId($this->parseUrl($_GET['url'])[2]);
        $product->loadProduct($product->getProductId());
        
        if ($product->getIsAvailable() == "turned off"){
            $product->turnOnProduct();
        } else {
            $product->turnOffProduct();
        }
        
        $categoryId = $this->session->get('category_id');
        $this->redirect("product", "$categoryId");
    }

}

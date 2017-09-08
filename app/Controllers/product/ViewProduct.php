<?php

namespace Shop\Controllers\product;

use Shop\Models\Products\Product as ProductModel;
use Shop\Core\Controller;
use Shop\Models\Category\Category as CategoryModel;
use Shop\Models\Category\{
    CategoryCollection
};

/**
 * Class ViewProduct
 */
class ViewProduct extends Controller {

    /**
     * Display Product View
     */
    public function display() {
        $this->header();

        $product = new ProductModel;
        $categoryCollection = new CategoryCollection();
        $category = new CategoryModel();

        $url = $this->parseUrl($_GET['url']);
        $this->session->set('product_id', $url[2]);

        $categoryId = $this->session->get('category_id');
        $categories = $categoryCollection->createCategoryCollection();

        $navigation = "' http://" . ($_SERVER['HTTP_HOST']) . "/" . 'kategoria/' . $categoryId . "'";
        $product->loadProduct($url[2]);
        $category->findBy("id", $categoryId);
        $data = [
            'productManagement' => $product,
            'category' => $categories,
            'navigation' => $navigation,
            'categoryManagement' => $category
        ];

        $this->view('home/product/product_view', $data);
    }

}

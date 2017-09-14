<?php

namespace Shop\Controllers;

use Shop\Core\Controller;
use Shop\Models\Category\CategoryCollection;
use Shop\Models\Products\{
    HomePageProductsCollection,
    Product,
    ProductCollection,
    HomePageProducts
};

/**
 * Class Home
 */
class Home extends Controller {

    /**
     * Display homepage
     */
    public function display() {
        $this->header();
        $categoryCollection = new CategoryCollection;
        $homePageProducts = new HomePageProducts;

        $category = $categoryCollection->createCategoryCollection();

        $productCollection = $this->setProductCollection();

        $data = [
            'category' => $category,
            'productCollection' => $productCollection
        ];
        $this->view('home/home_page/index', $data);
    }

    /**
     * 
     */
    public function setProductCollection() {
        $productCollection = new ProductCollection();
        $categoryCollection = new CategoryCollection;
        $homePageProducts = new HomePageProducts;
        $homePageProductsCollection = new HomePageProductsCollection;
        $product = new Product;

        if ($homePageProducts->load() === null) {
            $productCollection->orderBy('sales_counter', 'DESC');
            $collection = $productCollection->createProductCollection();
            return $collection;
        }

        $collection = $homePageProductsCollection->createHomePageProductsCollection();
        return $collection;
    }

}

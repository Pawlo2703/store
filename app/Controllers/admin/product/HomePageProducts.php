<?php

namespace Shop\Controllers\admin\product;

use Shop\Core\Controller;
use Shop\Models\Products\{
    Product,
    HomePageProducts as HomePageProductsModel,
    ProductCollection
};

/**
 * Class HomePageProducts
 */
class HomePageProducts extends Controller {

    /**
     * Display all products list
     */
    public function display() {
        $this->checkIfAdmin();

        $productCollection = new ProductCollection;
        $productCollection = $productCollection->createProductCollection();

        $data = [
            'productCollection' => $productCollection
        ];

        $this->view('home/admin/HomePageProducts', $data);
    }

    /**
     * Save choosen products id to database
     */
    public function saveHomePageProducts() {
        $homePageProducts = new HomePageProductsModel;
        $product = new Product;
        $params = $this->getParameters();
        $homePageProducts->delete();

        for ($i = 0; $i < sizeof($params['id']); $i++) {
            $product->loadProduct($params['id'][$i]);
            $homePageProducts->save($product);
        }
    }

    /**
     * Delete all products from table, in result home page will be displaying most popular items instead
     */
    public function delete() {
        $homePageProducts = new HomePageProductsModel;
        $homePageProducts->delete();
    }

}

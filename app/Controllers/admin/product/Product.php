<?php

namespace Shop\Controllers\admin\product;

use Shop\Core\Controller;
use Shop\Models\Products\{
    ProductCollection,
    Product
};
use Shop\Models\RememberMe;

/**
 * Class Product
 */
class Product extends Controller {

    /**
     * Display products list
     */
    public function display() {
        $this->checkIfAdmin();
        $url = $this->parseUrl($_GET['url']);
        $this->session->set('category_id', $url[2]);

        $collection = new ProductCollection;
        $collection->filterBy('category_id', $url[2]);
        $productCollection = $collection->createProductCollection();

        $navigationUrl = "' http://" . ($_SERVER['HTTP_HOST']) . "/" . 'category' . "'";

        $data = [
            'productCollection' => $productCollection,
            'navigationUrl' => $navigationUrl
        ];

        if (!isset($data['productCollection'])) {
            $this->view('home/admin/no_products', $data);
        } else {
            $this->view('home/admin/product', $data);
        }
    }

    /**
     * Displays form with new Product input
     */
    public function displayCreateProductForm() {
        $this->checkIfAdmin();
        $this->view('home/admin/category/add_product');
    }

    /**
     * Create new product
     */
    public function createProduct() {
        $this->checkIfAdmin();
        $params = $this->getParameters();
        $categoryId = $this->session->get('category_id');

        $product = new Product;
        $rememberMe = new RememberMe;

        $product->setProductName($params['product']);
        $product->setProductType($params['type']);
        $product->setProductColor($params['color']);
        $product->setProductCountry($params['country']);
        $product->setProductQuantity($params['quantity']);
        $product->setProductPrice($params['price']);

        $randomString = $rememberMe->generateRandomString();
        if ($product->uploadImage($randomString) == true) {
            $product->setCategoryId($categoryId);

            if ($product->createProduct() !== NULL) {

                $this->redirect("product", "$categoryId");
                exit;
            } else {
                $this->view('home/admin/category/error/product_exists');
                exit;
            }
        } else {
            $this->view('home/admin/category/error/image_too_big');
        }
    }

    /**
     * Remove single product
     */
    public function remove() {
        $product = new Product;
        $product->setProductId($this->parseUrl($_GET['url'])[2]);
        $product->setCategoryId($this->session->get('category_id'));
        $product->remove();
        $this->redirect("product", "$categoryId");
    }

}

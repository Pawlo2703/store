<?php

namespace Shop\Controllers\admin\product;

use Shop\Core\Controller;
use Shop\Models\Products\{
    CategoryManagement,
    ProductCollection,
    ProductManagement
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
        $productCollection = $collection->createProductCollection($url[2]);

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

        $productManagement = new ProductManagement;
        $rememberMe = new RememberMe;

        $productManagement->setProductName($params['product']);
        $productManagement->setProductType($params['type']);
        $productManagement->setProductColor($params['color']);
        $productManagement->setProductCountry($params['country']);
        $productManagement->setProductQuantity($params['quantity']);
        $productManagement->setProductPrice($params['price']);

        $randomString = $rememberMe->generateRandomString();
        if ($productManagement->uploadImage($randomString) == true) {
            $productManagement->setCategoryId($categoryId);

            if ($productManagement->createProduct() !== NULL) {

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
        $productManagement = new ProductManagement;
        $productManagement->setProductId($this->parseUrl($_GET['url'])[2]);
        $productManagement->setCategoryId($this->session->get('category_id'));
        $productManagement->remove();
        $this->redirect("product", "$categoryId");
    }

}

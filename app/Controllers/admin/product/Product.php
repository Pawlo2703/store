<?php

namespace Shop\Controllers\admin\product;

use Shop\Core\Controller;
use Shop\Models\Products\{
    CategoryManagement,
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

        $productManagement = new ProductManagement;

        $productName = $productManagement->loadProducts($url[2]);
        $availability = '';
        $navigationUrl = "' http://" . ($_SERVER['HTTP_HOST']) . "/" . 'category' . "'";

        $data = [
            'productName' => $productName,
            'navigationUrl' => $navigationUrl
        ];
        $this->view('home/admin/product', $data);
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

        $productManagement->setName($params['product']);
        $productManagement->setType($params['type']);
        $productManagement->setColor($params['color']);
        $productManagement->setCountry($params['country']);
        $productManagement->setQuantity($params['quantity']);
        $productManagement->setPrice($params['price']);

        $randomString = $rememberMe->generateRandomString();
        if ($productManagement->uploadImage($randomString) == true) {
            $productManagement->setCategory($categoryId);

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
        $url = $this->parseUrl($_GET['url']);
        $productId = $url[2];
        $categoryId = $this->session->get('category_id');
        $productManagement->remove($productId, $categoryId);
        $this->redirect("product", "$categoryId");
    }

}

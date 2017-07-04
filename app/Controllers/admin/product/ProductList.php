<?php

namespace Shop\Controllers\admin\product;

use Shop\Core\Controller;
use Shop\Models\Products\CategoryManagement;
use Shop\Models\Products\ProductManagement;
use Shop\libs\Session;
use Shop\Models\RememberMe;

class ProductList extends Controller {

    public function display() {
        $this->checkIfAdmin();
        $pro = new ProductManagement;


        $url = $this->getUrlParam();
        $this->session->set('category_id', $url[2]);

        $name = $pro->loadProduct($url[2]);
        $availability = '';

        $jUrl = "<a href=' http://" . ($_SERVER['HTTP_HOST']) . "/" . 'category' . "'>Category</a>";

        $data = [
            'pro' => $pro,
            'name' => $name,
            'jUrl' => $jUrl
        ];
        $this->view('home/admin/product', $data);
    }

    public function addProduct() {
        $this->checkIfAdmin();
        $params = $this->getParameters();
        $category = $this->session->get('category_id');

        $pro = new ProductManagement;
        $cat = new CategoryManagement;
        $rem = new RememberMe;
        $pro->setName($params['product']);
        $pro->setType($params['type']);
        $pro->setColor($params['color']);
        $pro->setCountry($params['country']);
        $pro->setQuantity($params['quantity']);
        $pro->setPrice($params['price']);

        $name = $rem->generateRandomString();
        if ($pro->uploadImage($name) == true) {
            $pro->setCategory($category);

            if ($pro->addPro() !== NULL) {

                $this->redirect("product", "$category");
                exit;
            } else {
                $this->view('home/admin/category/error/product_exists');
                exit;
            }
        } else {
            $this->view('home/admin/category/error/image_too_big');
        }
    }

    public function remove() {
        $pro = new ProductManagement;
        $url = $this->getUrlParam();
        $id = $url[2];
        $categoryId = $this->session->get('category_id');
        $pro->remove($id, $categoryId);

        $this->redirect("product", "$categoryId");
    }

    public function isAvailable() {
        $pro = new ProductManagement;
        $url = $this->getUrlParam();
        $pro->isAvailable($url[2]);

        $id = $this->session->get('category_id');
        $this->redirect("product", "$id");
    }

}

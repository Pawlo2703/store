<?php

namespace Shop\Controllers\admin;

use Shop\Core\Controller;
use Shop\Models\Products\CategoryManagement;
use Shop\Models\Products\ProductManagement;

class Product extends Controller {

    public function display() {

        $pro = new ProductManagement;

        $url = $this->getUrlParam();
        $cat_id = $url[2];
        $name = $pro->loadProduct($cat_id);

        $data = [
            'pro' => $pro,
            'name' => $name
        ];
        $this->view('home/admin/product', $data);
    }

    public function addProduct() {
        $params = $this->getParameters();

        $pro = new ProductManagement;
        $cat = new CategoryManagement;
        var_dump($params);
        $pro->setProduct($params['product']);
        $pro->setType($params['type']);
        $pro->setColor($params['color']);
        $pro->setCountry($params['country']);
        $pro->setQuantity($params['quantity']);
        $pro->setPrice($params['price']);

        $id = $cat->getCategoryByName($params['category']);
        $pro->setCategory($id[0]['id']);

        if ($pro->addPro() !== NULL) {
            $this->redirect("category", "display");
            exit;
        } else {
            $this->view('home/admin/category/error/product_exists');
            exit;
        }
    }

    public function remove() {
        $pro = new ProductManagement;
        $url = $this->getUrlParam();
        $id = $url[2];
        $pro->remove($id);
        $this->redirect("category", "display");
    }

}

<?php

namespace Shop\Controllers\admin\product;

use Shop\Core\Controller;
use Shop\Models\Products\CategoryManagement;
use Shop\Models\Products\ProductManagement;
use Shop\libs\Session;

class ProductList extends Controller {

    public function display() {

        $pro = new ProductManagement;
        
        $url = $this->getUrlParam();
        $this->session->set('zmienna3', $url[2]);
        $name = $pro->loadProduct($url[2]);
        $data = [
            'pro' => $pro,
            'name' => $name
        ];
        $this->view('home/admin/product', $data);
    }

    public function addProduct() {
        $params = $this->getParameters();
        $category = $this->session->get('zmienna3');

        $pro = new ProductManagement;
        $cat = new CategoryManagement;

        $pro->setProduct($params['product']);
        $pro->setType($params['type']);
        $pro->setColor($params['color']);
        $pro->setCountry($params['country']);
        $pro->setQuantity($params['quantity']);
        $pro->setPrice($params['price']);

        $pro->setCategory($category);

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

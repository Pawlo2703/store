<?php

namespace Shop\Controllers\product;

use Shop\Core\Controller;
use Shop\Models\Products\CategoryManagement;
use Shop\Models\Products\ProductManagement;
use Shop\libs\Session;
use Shop\Models\Cart;

class ViewProduct extends Controller {

    public function display() {
        $this->header();
        $pro = new ProductManagement;
        $cat = new CategoryManagement;
        $url = $this->getUrlParam();
        $pro_id = $url[2];
        $this->session->set('product_id', $url[2]);
        $categoryId = $this->session->get('category_id');

        $categoryList = $cat->loadCat();
        $prodList = $this->session->get('category_id');
        $jUrl = "<a href=' http://" . ($_SERVER['HTTP_HOST']) . "/" . 'kategoria/' . $categoryId . "'>Product</a>";
        $product = $pro->loadProductView($pro_id);

        $category = $cat->getCategoryById($product[0]['category_id']);

        $data = [
            'pro' => $pro,
            'product' => $product,
            'category' => $category,
            'jUrl' => $jUrl,
            'categoryList' => $categoryList
        ];
        $this->view('home/product/product_view', $data);
    }

    public function cart() {
        $pro = new ProductManagement;
        $cart = new Cart;

        $id = $this->session->get('product_id');

        $params = $this->getParameters();
        $product = $pro->loadProductView($id);
        $quantity = $product[0]['quantity'];
        $amount = $params['amount'];

        if ($amount > $quantity) {
            $amount = $quantity; 
        }
        $cart->setProductId($product[0]['id']);
        $cart->setProductPrice($product[0]['price']);
        $cart->setProductQuantity($amount);

        if ($this->session->get('table_id') !== NULL) {
            $tableIdd = $this->session->get('table_id');
            $cart->setTableId($tableIdd);
        }

        $tableId = $cart->addQuote();
        $this->session->set('table_id', $tableId);
        $cart->calculateQuantityAndPrice();


        $this->redirect("produkt", "$id");
    }

}

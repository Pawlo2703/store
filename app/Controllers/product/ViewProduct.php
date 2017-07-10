<?php

namespace Shop\Controllers\product;

use Shop\Core\Controller;
use Shop\Models\Products\{
    CategoryManagement,
    ProductManagement
};
use Shop\Models\Cart;

/**
 * Class ViewProduct
 */
class ViewProduct extends Controller {

    /**
     * Display Product View
     */
    public function display() {
        $this->header();
        $productManagement = new ProductManagement;
        $categoryManagement = new CategoryManagement;
        $url = $this->parseUrl($_GET['url']);
        $productId = $url[2];
        $this->session->set('product_id', $url[2]);
        $categoryId = $this->session->get('category_id');
        $categoryList = $categoryManagement->loadCategory();
        $productList = $this->session->get('category_id');

        $navigation = "' http://" . ($_SERVER['HTTP_HOST']) . "/" . 'kategoria/' . $categoryId . "'";
        $product = $productManagement->loadProductView($productId);

        $category = $categoryManagement->getCategoryById($product[0]['category_id']);

        $data = [
            'product' => $product,
            'category' => $category,
            'navigation' => $navigation,
            'categoryList' => $categoryList
        ];
        $this->view('home/product/product_view', $data);
    }

    /**
     * Class Cart
     */
    public function addProductToCart() {
        $productManagement = new ProductManagement;
        $cart = new Cart;

        $productId = $this->session->get('product_id');

        $params = $this->getParameters();
        $product = $productManagement->loadProductView($productId);
        $productQuantityDB = $product[0]['quantity'];
        $productQuantityParams = $params['amount'];

        if ($productQuantityParams > $productQuantityDB) {
            $productQuantityParams = $productQuantityDB;
        }
        $cart->setProductId($product[0]['id']);
        $cart->setProductPrice($product[0]['price']);
        $cart->setProductQuantity($productQuantityParams);

        if ($this->session->get('table_id') !== NULL) {
            $tableId = $this->session->get('table_id');
            $cart->setTableId($tableId);
        }
        $tableId = $cart->createQuote();
        $this->session->set('table_id', $tableId);
        $cart->calculateQuantity();
        $cart->calculatePrice();
        $this->redirect("produkt", "$productId");
    }

}

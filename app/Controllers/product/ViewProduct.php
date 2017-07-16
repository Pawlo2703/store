<?php

namespace Shop\Controllers\product;

use Shop\Core\Controller;
use Shop\Models\Products\{
    CategoryCollection,
    CategoryManagement,
    ProductManagement
};
use \Shop\Models\Cart\CartManagement;

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
        $categoryCollection = new CategoryCollection();
        $categoryManagement = new CategoryManagement();

        $url = $this->parseUrl($_GET['url']);
        $this->session->set('product_id', $url[2]);

        $categoryId = $this->session->get('category_id');
        $category = $categoryCollection->createCategoryCollection();
        $productList = $this->session->get('category_id');

        $navigation = "' http://" . ($_SERVER['HTTP_HOST']) . "/" . 'kategoria/' . $categoryId . "'";
        $product = $productManagement->loadProduct($url[2]);

        $categoryName = $categoryManagement->getCategoryById($categoryId);

        $data = [
            'product' => $product,
            'category' => $category,
            'navigation' => $navigation,
            'categoryName' => $categoryName
        ];
        $this->view('home/product/product_view', $data);
    }

    /**
     * 
     */
    public function addProductToCart() {
        $productManagement = new ProductManagement;
        $cart = new CartManagement;

        $productId = $this->session->get('product_id');

        $params = $this->getParameters();
        $product = $productManagement->loadProduct($productId);
        $productQuantityDB = $product['quantity'];
        $productQuantityParams = $params['amount'];

        if ($productQuantityParams > $productQuantityDB) {
            $productQuantityParams = $productQuantityDB;
        }
        $cart->setProductId($product['id']);
        $cart->setProductPrice($product['price']);
        $cart->setProductQuantity($productQuantityParams);

        if ($this->session->get('cart_id') !== NULL) {
            $cartId = $this->session->get('cart_id');
            $cart->setCartId($cartId);
        }
        $cart->createQuote();
        $cartId = $cart->getCartId();
        $this->session->set('cart_id', $cartId);
        $cart->calculateQuantity();
        $cart->calculatePrice();
        $this->redirect("produkt", "$productId");
    }

}

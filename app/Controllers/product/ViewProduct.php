<?php

namespace Shop\Controllers\product;

use Shop\Models\Products\ProductManagement;
use Shop\Core\Controller;
use Shop\Models\Category\{
    CategoryCollection,
    CategoryManagement
};
use \Shop\Models\Cart\{
    CartDetails,
    Product,
    CartManagement
}
;

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
        $productManagement->loadProduct($url[2]);


        $categoryManagement->findBy("id", $categoryId);
        $data = [
            'productManagement' => $productManagement,
            'category' => $category,
            'navigation' => $navigation,
            'categoryManagement' => $categoryManagement
        ];
        $this->view('home/product/product_view', $data);
    }

    /**
     * 
     */
    public function addProductToCart() {
        $productManagement = new ProductManagement;
        $cart = new CartManagement;
        $product = new Product;

        $productId = $this->session->get('product_id');

        $params = $this->getParameters();
        $productManagement->loadProduct($productId);
        $productQuantityDB = $productManagement->getProductQuantity();
        $productQuantityParams = $params['amount'];

        if ($productQuantityParams > $productQuantityDB) {
            $productQuantityParams = $productQuantityDB;
        }
        $product->setProductId($productManagement->getProductId());
        $product->setProductPrice($productManagement->getProductPrice());
        $product->setProductQuantity($productQuantityParams);

        if ($this->session->get('cart_id') !== NULL) {
            $cartId = $this->session->get('cart_id');
            $product->setCartId($cartId);
        }

        $cart->createCart($product);
        $cart->saveCartItem($product);
        $cartId = $product->getCartId();
        $this->session->set('cart_id', $cartId);

        if ($this->session->get('user_id') !== NULL) {
            $product->setUserId($this->session->get('user_id'));
            $cart->saveUserId($product);
        }

        $cart->calculateQuantity($product);
        $cart->calculatePrice($product);
        $this->redirect("produkt", "$productId");
    }

}

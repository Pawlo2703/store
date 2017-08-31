<?php

namespace Shop\Controllers\product;

use Shop\Models\Products\Product as ProductModel;
use Shop\Core\Controller;
use Shop\Models\Category\Category as CategoryModel;
use Shop\Models\Category\{
    CategoryCollection
};
use \Shop\Models\Cart\{
    CartDetails,
    Calculations,
    Item,
    Cart
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
        $product = new ProductModel;
        $categoryCollection = new CategoryCollection();

        $category = new CategoryModel();

        $url = $this->parseUrl($_GET['url']);
        $this->session->set('product_id', $url[2]);

        $categoryId = $this->session->get('category_id');
        $categories = $categoryCollection->createCategoryCollection();
        $productList = $this->session->get('category_id');

        $navigation = "' http://" . ($_SERVER['HTTP_HOST']) . "/" . 'kategoria/' . $categoryId . "'";
        $product->loadProduct($url[2]);
        $category->findBy("id", $categoryId);
        $data = [
            'productManagement' => $product,
            'category' => $categories,
            'navigation' => $navigation,
            'categoryManagement' => $category
        ];

        $this->view('home/product/product_view', $data);
    }

    /**
     * 
     */
    public function addProductToCart() {
        $product = new ProductModel;
        $cart = new Cart;
        $item = new Item;
        $calculations = new Calculations;
        $productId = $this->session->get('product_id');

        $params = $this->getParameters();
        $product->loadProduct($productId);
        $productQuantityDB = $product->getProductQuantity();

        $productQuantityParams = $params['amount'];

        if ($productQuantityParams > $productQuantityDB) {
            $productQuantityParams = $productQuantityDB;
        }

        $item->setProductId($product->getProductId());
        $item->setProductPrice($product->getProductPrice());
        $item->setProductQuantity($productQuantityParams);

        if ($this->session->get('cart_id') !== NULL) {
            $cartId = $this->session->get('cart_id');
            $item->setCartId($cartId);
        }

        $cart->createCart($item);
        $cart->saveCartItem($item);
        $result = $cart->checkIfItemExistsInCart($item);
        if ($result !== null) {
            $item->getProductQuantity($item->getProductQuantity() + $result['product_quantity']);
            $cart->updateCartItem($item, $result);
        }

        $cartId = $item->getCartId();
        $this->session->set('cart_id', $cartId);

        if ($this->session->get('user_id') !== NULL) {
            $item->setUserId($this->session->get('user_id'));
            $cart->saveUserId($item);
        }

        $cart->loadCart($item);
        $calculations->setNewQuantity($productQuantityParams);
        $calculations->calculateQuantity($item);
        $calculations->setNewPrice($item->getProductPrice());
        $calculations->setNewQuantity($item->getProductQuantity());
        $calculations->calculatePrice($item);
        $cart->saveQuantity($item);
        $cart->savePrice($item);

        if ($this->session->get('product_id') !== NULL) {
            $this->session->pull('product_id');
        }

        $this->redirect("produkt", "$productId");
    }

}

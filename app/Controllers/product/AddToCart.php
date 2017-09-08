<?php

namespace Shop\Controllers\product;

use Shop\Models\Products\Product as ProductModel;
use Shop\Core\Controller;
use \Shop\Models\Cart\{
    CartDetails,
    Calculations,
    Item,
    Cart
}
;

/**
 * Class AddToCart
 */
class AddToCart extends Controller {

    /**
     * Add chooses product to cart
     */
    public function addProductToCart() {
        $product = new ProductModel;
        $cart = new Cart;
        $item = new Item;

        $productId = $this->session->get('product_id');
        $params = $this->getParameters();
        $product->loadProduct($productId);
        $productQuantityParams = $this->compareQuantity($product);

        $item->setProductId($product->getProductId());
        $item->setProductPrice($product->getProductPrice());
        $item->setProductQuantity($productQuantityParams);

        if ($this->session->get('cart_id') !== NULL) {
            $cartId = $this->session->get('cart_id');
            $item->setCartId($cartId);
        }

        $cart->createCart($item);
        $cart->saveCartItem($item);
        $this->checkIfItemExists($item);
        $cartId = $item->getCartId();
        $this->session->set('cart_id', $cartId);

        if ($this->session->get('user_id') !== NULL) {
            $item->setUserId($this->session->get('user_id'));
            $cart->saveUserId($item);
        }

        $this->calculateAndSave($item, $productQuantityParams);

        if ($this->session->get('product_id') !== NULL) {
            $this->session->pull('product_id');
        }

        $this->redirect("produkt", "$productId");
    }

    /**
     * Update product amount if choosen product is already in cart
     */
    public function checkIfItemExists($item) {
        $cart = new Cart;
        $result = $cart->checkIfItemExistsInCart($item);

        if ($result !== null) {
            $item->getProductQuantity($item->getProductQuantity() + $result['product_quantity']);
            $cart->updateCartItem($item, $result);
        }
    }

    /**
     * Calculate price and quantity of product. Save the new values.
     * @param string $item
     * @param string $productQuantityParams
     */
    public function calculateAndSave($item, $productQuantityParams) {
        $cart = new Cart;
        $calculations = new Calculations;

        $cart->loadCart($item);
        $calculations->setNewQuantity($productQuantityParams);
        $calculations->calculateQuantity($item);
        $calculations->setNewPrice($item->getProductPrice());
        $calculations->setNewQuantity($item->getProductQuantity());
        $calculations->calculatePrice($item);
        $cart->saveQuantity($item);
        $cart->savePrice($item);
    }

    /**
     * Compare item quantity given in params with qunatity saved in database
     * @param string $product
     * @return string
     */
    public function compareQuantity($product) {
        $params = $this->getParameters();

        $productQuantityDB = $product->getProductQuantity();
        $productQuantityParams = $params['amount'];

        if ($productQuantityParams > $productQuantityDB) {
            $productQuantityParams = $productQuantityDB;
        }
        return $productQuantityParams;
    }

}

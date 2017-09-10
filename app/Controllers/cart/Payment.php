<?php

namespace Shop\Controllers\cart;

use Shop\Models\Order\Order;
use Shop\Models\Category\Category;
use Shop\Models\Products\Product as ProductModel;
use Shop\Core\Controller;
use Shop\Models\Cart\{
    Calculations,
    UserAddress,
    CartCollection,
    Cart,
    Item
};

/**
 * Class Payment
 */
class Payment extends Controller {

    /**
     * Check if user is logged in
     */
    public function loginCheck() {
        if ($this->session->get('user_id') !== NULL) {
            $this->redirect("adres_dostawy", "");
        }

        $this->redirect('login', 'payment');
    }

    /**
     * Create orders and orders_items tables, update products quantity
     */
    public function orderCreate() {
        $cartCollection = new CartCollection;
        $cart = new Cart;
        $item = new Item;
        $address = new UserAddress;
        $order = new Order;

        $cartId = $this->session->get('cart_id');
        $item->setCartId($cartId);

        $cartCollection->filterBy('cart_id', $cartId);
        $cartCollectionz = $cartCollection->createCartCollection();

        $cart->loadCart($item);

        $orderId = $order->orderCreate($item);
        $order->setOrderId($orderId);
        $order->orderItemsCreate($cartCollectionz);
        $this->updateProductsQuantity($cartCollectionz);
        $this->checkIfOutOfStock($cartCollectionz);

        $cartId = $this->session->get('cart_id');
        $item->setCartId($cartId);
        $cart->removeCart($item);

        $this->redirect('dokonano_zakupu', '');
    }

    /**
     * Update products quantity
     * @param object $cartCollection
     */
    public function updateProductsQuantity($cartCollection) {
        $product = new ProductModel;
        $calculations = new Calculations;
        for ($i = 0; $i < sizeof($cartCollection); $i++) {
            $product->loadProduct($cartCollection[$i]->getProductId());
            $calculations->setQuantity($product->getProductQuantity());
            $calculations->recalculateProductQuantity($cartCollection[$i]->getProductQuantity());
            $product->updateProductsQuantity($calculations->getNewQuantity(), $cartCollection[$i]->getProductId());
        }
    }

    /**
     * Check if after purchase product amount equals 0, turn off product if it does.
     * Change category items amount aswell.
     */
    public function checkIfOutOfStock($cartCollection) {
        $product = new ProductModel;
        $category = new Category;
        $calculations = new Calculations;

        for ($i = 0; $i < sizeof($cartCollection); $i++) {
            $product->loadProduct($cartCollection[$i]->getProductId());

            if ((int) ($product->getProductQuantity()) !== 0) {
                return;
            }

            $product->turnOffProduct();
            $category->findBy('id', $product->getCategoryId());
            $calculations->calculateCategoryAmount($category);
            $category->updateCategoryAmount($calculations, $product);
        }
    }

    /**
     * View of finished order
     */
    public function display() {
        $this->header();
        $item = new Item;
        $order = new Order;

        $cartId = $this->session->get('cart_id');
        $item->setCartId($cartId);

        $order->loadOrderByCartId($item);
        $orderId = $order->getOrderId();

        if ($this->session->get('cart_id') !== NULL) {
            $this->session->pull('cart_id');
        }
        if ($this->session->get('order_id') !== NULL) {
            $this->session->pull('order_id');
        }

        $data = [
            'checkoutManagement' => $order
        ];
        $this->view('home/cart/order_finished_view', $data);
    }

}

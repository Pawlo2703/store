<?php

namespace Shop\Models\Cart;

use Shop\Core\Model;
use Shop\Models\Cart\CartManagement;

/**
 * Class CartCollection
 */
class CartCollection extends Model {

    /**
     * @var array
     */
    private $cartCollection;

    /**
     * @var string
     */
    protected $tableName = 'cart_item';
    
    /**
     * @return array
     */
    public function getCartCollection() {
        return $this->cartCollection;
    }

    /**
     * Creates cart objects and saves to array
     */
    public function createCartCollection() {

        Model::loadCollection();

        if (!empty($this->rawData)) {
            
            foreach ($this->rawData as $value) {
                $cart = new CartManagement;
                $cart->setCartId($value['cart_id']);
                $cart->setProductName($value['product_id']);
                $cart->setProductPrice($value['product_price']);
                $cart->setProductQuantity($value['product_quantity']);
                $cart->setProductId($value['product_id']);

                if (isset($collection)) {
                    array_push($collection, $cart);
                } else {
                    $collection = array($cart);
                }
            }
        } else {
            return;
        }
        return $this->cartCollection = $collection;
    }

}

<?php

namespace Shop\Models\Cart;

use Shop\Core\Model;
use Shop\Models\Cart\{
    CartDetails,
    ProductDetails
}
;

/**
 * Class CheckoutManagement
 */
class CheckoutManagement extends Model {

    /**
     * Saves/updates user id
     */
    public function cartUpdate($cart) {


        for ($i = 0; $i < sizeof($cart); $i++) {
            $this->database->updateRow('cart_item', "product_quantity = '{$cart[$i]->getProductQuantity()}' "
                    . "WHERE product_id = {$cart[$i]->getProductId()}");
        }
    }

}

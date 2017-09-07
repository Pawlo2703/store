<?php

namespace Shop\Models\Cart;

use Shop\Core\Model;

/**
 * Class ItemRemove
 */
class ItemRemove extends Model {

    public function removeItem($item) {
        $this->database->deleteRow('cart_item', "WHERE product_id = ? AND cart_id = ?", [$item->getProductId(), $item->getCartId()]);
    }

}

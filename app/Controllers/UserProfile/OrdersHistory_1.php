<?php

namespace Shop\Controllers\UserProfile;

use Shop\Core\Controller;
use Shop\Models\Products\ProductCollection;
use Shop\Models\Orders\{
    OrdersItemsCollection,
    OrdersCollection
};

/**
 * Class OrdersHistory
 */
class OrdersHistory extends Controller {
    /*
     * Orders View
     */

    public function ordersView() {
        $this->header();
        $ordersCollection = new OrdersCollection;

        $userId = $this->session->get('user_id');

        $ordersCollection->filterBy('user_id', $userId);
        $orders = $ordersCollection->createOrdersCollection();

        $data = [
            'orders' => $orders
        ];
        $this->view('home/User_profile/view_orders', $data);
    }

    public function orderItemsView() {
        $this->header();
        $productCollection = new ProductCollection;
        $productCollection = $productCollection->createProductCollection();

        $ordersCollection = new OrdersCollection;
        $ordersItemsCollection = new OrdersItemsCollection;

        $url = $this->parseUrl($_GET['url']);

        $ordersItemsCollection->filterBy('order_id', $url[2]);
        $ordersItems = $ordersItemsCollection->createOrdersItemsCollection();


        $data = [
            'ordersItems' => $ordersItems,
            'productCollection' => $productCollection
        ];
        $this->view('home/User_profile/view_order_items', $data);
    }

}

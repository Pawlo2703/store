<?php

namespace Shop\Controllers\UserProfile;

use Shop\Core\Controller;
use Shop\Models\Products\ProductCollection;
use Shop\Models\Order\{
    OrderItemsCollection,
    orderCollection
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
        $orderCollection = new orderCollection;

        $userId = $this->session->get('user_id');

        $orderCollection->filterBy('user_id', $userId);
        $orders = $orderCollection->createorderCollection();

        $data = [
            'orders' => $orders
        ];
        $this->view('home/User_profile/view_orders', $data);
    }

    public function orderItemsView() {
        $this->header();
        $productCollection = new ProductCollection;
        $productCollection = $productCollection->createProductCollection();

        $orderCollection = new orderCollection;
        $OrderItemsCollection = new OrderItemsCollection;

        $url = $this->parseUrl($_GET['url']);

        $orderItemsCollection->filterBy('order_id', $url[2]);
        $ordersItems = $OrderItemsCollection->createOrderItemsCollection();


        $data = [
            'ordersItems' => $ordersItems,
            'productCollection' => $productCollection
        ];
        $this->view('home/User_profile/view_order_items', $data);
    }

}

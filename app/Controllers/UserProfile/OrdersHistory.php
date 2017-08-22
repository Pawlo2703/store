<?php

namespace Shop\Controllers\UserProfile;

use Shop\Core\Controller;
use Shop\Models\Orders\OrdersCollection;

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
        $this->view('', $data);
        
               
    }

    public function orderItemsView() {
        $this->header();
        $ordersCollection = new OrdersCollection;
        
        $this->parseUrl($_GET['url']);
        
        $ordersItemsCollection->filterBy('order_id', $url[2]);
        $ordersItems = $ordersItemsCollection->createOrdersItemsCollection();
        
         $data = [
            'ordersItems' => $ordersItems
        ];
        $this->view('', $data);
    }
}

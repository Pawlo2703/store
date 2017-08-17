<?php

namespace Shop\Controllers\cart;

use Shop\Core\Controller;

/**
 * Class Payment
 */
class Payment extends Controller {
    /*
     * Display Cart View
     */

    
    
    public function loginCheck() {
        $this->header();
        if ($this->session->get('user_id') !== NULL) {
            $this->redirect("orderCreate", "");
        }
        
        $this->redirect('login', 'payment');
    }

    public function orderCreate() {
        
    }

    public function display() {
        
    }

}

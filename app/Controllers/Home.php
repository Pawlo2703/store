<?php

namespace Shop\Controllers;

use Shop\Core\Controller;

class Home extends Controller {

    public function display() {
        $this->header();
        $this->view('home/home_page/index');
        
    }

}

<?php

namespace Shop\Controllers\admin;

use Shop\Core\Controller;
use Shop\Models\Products\CategoryManagement;

class Admin extends Controller {

    public function display() {
     
        $cat = new CategoryManagement;
        $url = $this->getUrlParam();
        $cat->setUri($_SERVER['REQUEST_URI']);
        if (!isset($url[2])) {
                        $name = $cat->loadCat();
        } else {
            $name = $cat->loadProduct($url[2]);
        }
        $cat->setName($name);
        $data = [
            'cat' => $cat,
            'this' => $this
        ];
        $this->view('home/admin/home', $data);
    }

}

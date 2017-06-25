<?php

namespace Shop\Controllers\admin;

use Shop\Core\Controller;
use Shop\Models\Products\CategoryManagement;

class Admin extends Controller {

    public function display() {

        $cat = new CategoryManagement;
        $name = $cat->loadCat();
        $cat->setName($name);
        $data = [
            'cat' => $cat,
        ];
        $this->view('home/admin/home', $data);
    }

}

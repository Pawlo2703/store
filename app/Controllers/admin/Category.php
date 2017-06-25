<?php

namespace Shop\Controllers\admin;

use Shop\Core\Controller;
use Shop\Models\Products\CategoryManagement;

class Category extends Controller {

    public function display() {
        $this->header();
        $this->view('home/admin/category/add_new');
    }

    public function submit() {
        $this->header();
        $params = $this->getParameters();
        $new = new CategoryManagement;
        $new->setCategory($params['category']);
        if ($new->addCat() !== NULL) {
            $this->view('home/admin/category/added');
            exit;
        } else {
            $this->view('home/admin/category/error/exists');
            exit;
        }
    }

}

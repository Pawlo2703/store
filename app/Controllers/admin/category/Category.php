<?php

namespace Shop\Controllers\admin\category;

use Shop\Core\Controller;
use Shop\Models\Products\CategoryManagement;
use Shop\Models\Products\ProductManagement;
use Shop\libs\Session;

class Category extends Controller {

    public function display() {
        $cat = new CategoryManagement;
        $pro = new ProductManagement;

        $name = $cat->loadCat();
        $id = $cat->loadId();



        $data = [
            'cat' => $cat,
            'id' => $id,
            'name' => $name
        ];
        $this->view('home/admin/category', $data);
    }

    public function remove() {
        $cat = new CategoryManagement;
        $url = $this->getUrlParam();
        $id = $url[2];
        $cat->remove($id);
        $this->redirect("category", "display");
    }

    public function addCategory() {
        $params = $this->getParameters();
        $new = new CategoryManagement;
        $new->setCategory($params['category']);
        if ($new->addCat() !== NULL) {
            $this->redirect("category", "display");
            exit;
        } else {
            $this->view('home/admin/category/error/category_exists');
            exit;
        }
    }

}

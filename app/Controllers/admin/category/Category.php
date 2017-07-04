<?php

namespace Shop\Controllers\admin\category;

use Shop\Core\Controller;
use Shop\Models\Products\CategoryManagement;
use Shop\Models\Products\ProductManagement;
use Shop\libs\Session;

class Category extends Controller {

    public function display() {
        $this->checkIfAdmin();

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
        $this->redirect("category", "");
    }

    public function addCategory() {
        $this->checkIfAdmin();
        $params = $this->getParameters();
        $new = new CategoryManagement;
        $new->setCategory($params['category']);
        if ($new->addCat() !== NULL) {
            $this->redirect("category", "");
            exit;
        } else {
            $this->view('home/admin/category/error/category_exists');
            exit;
        }
    }

    public function isAvailable() {
        $cat = new CategoryManagement;
        $url = $this->getUrlParam();
        $cat->isAvailable($url[2]);

        $this->redirect("category", "");
    }

    public function nameChange() {
        $cat = new CategoryManagement;
        $params = $this->getParameters();
        $cat->setName($params['name']);
        $url = $this->getUrlParam();
        $category_id = $this->session->get('category_id');
        $cat->nameChange($category_id);

        $this->redirect("category", "");
    }

    public function nameChangeForm() {
        $this->checkIfAdmin();
        $url = $this->getUrlParam();
        $this->session->set('category_id', $url[2]);
        $this->view('home/admin/category/change_category_name');
    }

}

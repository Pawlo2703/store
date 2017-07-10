<?php

namespace Shop\Controllers\admin\category;

use Shop\Core\Controller;
use Shop\Models\Products\{
    CategoryManagement,
    ProductManagement
};

/**
 * Class CategoryActions
 */
class CategoryActions extends Controller {

    /**
     * Turn on/off single category
     */
    public function changeAvailability() {
        $cat = new CategoryManagement;
        $url = $this->parseUrl($_GET['url']);
        $cat->isAvailable($url[2]);
        $this->redirect("category", "");
    }

    /**
     * Displays form with name change input
     */
    public function displayNameChangeForm() {
        $this->checkIfAdmin();
        $url = $this->parseUrl($_GET['url']);
        $this->session->set('category_id', $url[2]);
        $this->view('home/admin/category/change_category_name');
    }

    /**
     * Change single categorys name
     */
    public function changeCategoryName() {
        $params = $this->getParameters();

        $categoryManagement = new CategoryManagement;
        $categoryManagement->setName($params['name']);

        $url = $this->parseUrl($_GET['url']);
        $category_id = $this->session->get('category_id');
        $categoryManagement->changeCategoryName($category_id);
        $this->redirect("category", "");
    }

}

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
        $categoryManagement = new CategoryManagement;
        $categoryManagement->setCategoryId($this->parseUrl($_GET['url'])[2]);
        $categoryManagement->isAvailable();
        $this->redirect("category", "");
    }

    /**
     * Displays form with name change input
     */
    public function displayNameChangeForm() {
        $this->checkIfAdmin();
        $this->session->set('category_id', $this->parseUrl($_GET['url'])[2]);
        $this->view('home/admin/category/change_category_name');
    }

    /**
     * Change single categorys name
     */
    public function changeCategoryName() {
        $params = $this->getParameters();

        $categoryManagement = new CategoryManagement;
        $categoryManagement->setCategoryName($params['name']);
        $categoryManagement->setCategoryId($this->session->get('category_id'));
        $categoryManagement->changeCategoryName();
        $this->redirect("category", "");
    }

}

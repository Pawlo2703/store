<?php

namespace Shop\Controllers\admin\category;

use Shop\Core\Controller;
use Shop\Models\Category\Category;

/**
 * Class CategoryActions
 */
class CategoryActions extends Controller {

    /**
     * Turn on/off single category
     */
    public function changeAvailability() {
        $category = new Category;
        $category->setCategoryId($this->parseUrl($_GET['url'])[2]);
        $category->findBy('id', $category->getCategoryId());

        if ($category->getIsAvailable() == 'turned off') {
            $category->turnOnCategory();
        } else {
            $category->turnOffCategory();
        }

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

        $category = new Category;
        $category->setCategoryName($params['name']);
        $category->setCategoryId($this->session->get('category_id'));
        $category->changeCategoryName();
        $this->redirect("category", "");
    }

}

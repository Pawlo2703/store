<?php

namespace Shop\Controllers;

use Shop\Core\Controller;
use Shop\Models\Category\CategoryCollection;

/**
 * Class Home
 */
class Home extends Controller {
    /*
     * Display homepage
     */

    public function display() {
        $this->header();

        $categoryCollection = new CategoryCollection;
        $category = $categoryCollection->createCategoryCollection();

        $data = [
            'category' => $category
        ];
        $this->view('home/home_page/index', $data);
    }

}

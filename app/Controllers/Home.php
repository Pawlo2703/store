<?php

namespace Shop\Controllers;

use Shop\Core\Controller;
use Shop\Models\Category\CategoryCollection;
use Shop\Models\Products\ProductCollection;

/**
 * Class Home
 */
class Home extends Controller {

    /**
     * Display homepage
     */
    public function display() {
        $this->header();
        $productCollection = new ProductCollection();
        $categoryCollection = new CategoryCollection;

        $category = $categoryCollection->createCategoryCollection();

        $productCollection->orderBy('sales_counter', 'DESC');
        $productCollection = $productCollection->createProductCollection();

        $data = [
            'category' => $category,
                'productCollection' => $productCollection
        ];
        $this->view('home/home_page/index', $data);
    }

}

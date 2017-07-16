<?php

namespace Shop\Controllers\category;

use Shop\Core\Controller;
use Shop\Models\Products\{
    CategoryCollection,
    ProductCollection
};

/**
 * Class ViewCategory
 */
class ViewCategory extends Controller {

    /**
     * Display Category View
     */
    public function display() {
        $this->header();
        $url = $this->parseUrl($_GET['url']);

        $categoryCollection = new CategoryCollection();
        $productCollection = new ProductCollection();
        
        if (2 < sizeof($url)) {
            $this->session->set('category_id', $url[2]);
        } else {
            $this->redirect('home', '');
        }

        $category = $categoryCollection->createCategoryCollection();
        $product = $productCollection->createProductCollection($url[2]);
       
        $data = [
            'category' => $category,
            'product' => $product
        ];
        $this->view('home/category/view_category', $data);
    }

}

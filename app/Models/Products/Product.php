<?php

namespace Shop\Models\Products;

use Shop\Core\Model;

/**
 * Class Product
 */
class Product extends Model {

    /**
     * @var productId
     */
    private $productId;

    /**
     * @var productName
     */
    private $productName;

    /**
     * @var productType
     */
    private $productType;

    /**
     * @var productColor
     */
    private $productColor;

    /**
     * @var productCountry
     */
    private $productCountry;

    /**
     * @var productQuantity
     */
    private $productQuantity;

    /**
     * @var productPrice
     */
    private $productPrice;

    /**
     * @var categoryId
     */
    private $categoryId;

    /**
     * @var productImage
     */
    private $productImage;

    /**
     * @var isAvailable
     */
    private $isAvailable;

    /**
     * @var salesCounter
     */
    private $salesCounter;

    /**
     * @return string
     */
    public function getSalesCounter() {
        return $this->salesCounter;
    }

    /**
     * @param string $salesCounter
     */
    public function setSalesCounter($salesCounter) {
        $this->salesCounter = $salesCounter;
    }

    /**
     * @return string
     */
    public function getIsAvailable() {
        return $this->isAvailable;
    }

    /**
     * @param string $isAvailable
     */
    public function setIsAvailable($isAvailable) {
        $this->isAvailable = $isAvailable;
    }

    /**
     * @return string
     */
    public function getProductImage() {
        return $this->productImage;
    }

    /**
     * @param string $productImage
     */
    public function setProductImage($productImage) {
        $this->productImage = $productImage;
    }

    /**
     * @return string
     */
    public function getProductId() {
        return $this->productId;
    }

    /**
     * @param string $productId
     */
    public function setProductId($productId) {
        if ($productId == !NULL) {
            $this->productId = $productId;
        }
    }

    /**
     * @return string
     */
    public function getProductType() {
        return $this->productType;
    }

    /**
     * @return string
     */
    public function getProductColor() {
        return $this->productColor;
    }

    /**
     * @return string
     */
    public function getProductCountry() {
        return $this->productCountry;
    }

    /**
     * @return string
     */
    public function getProductQuantity() {
        return $this->productQuantity;
    }

    /**
     * @return string
     */
    public function getProductPrice() {
        return $this->productPrice;
    }

    /**
     * @param string $productType
     */
    public function setProductType($productType) {
        if ($productType == !NULL) {
            $this->productType = $productType;
        }
    }

    /**
     * @param string $productColor
     */
    public function setProductColor($productColor) {
        if ($productColor == !NULL) {
            $this->productColor = $productColor;
        }
    }

    /**
     * @param string $productCountry
     */
    public function setProductCountry($productCountry) {
        if ($productCountry == !NULL) {
            $this->productCountry = $productCountry;
        }
    }

    /**
     * @param string $productQuantity
     */
    public function setProductQuantity($productQuantity) {
        if ($productQuantity == !NULL) {
            $this->productQuantity = $productQuantity;
        }
    }

    /**
     * @param string $productPrice
     */
    public function setProductPrice($productPrice) {
        if ($productPrice == !NULL) {
            $this->productPrice = $productPrice;
        }
    }

    /**
     * @return string
     */
    public function getProductName() {
        return $this->productName;
    }

    /**
     * @param string $productName
     */
    public function setProductName($productName) {
        if ($productName == !NULL) {
            $this->productName = $productName;
        }
    }

    /**
     * @return string
     */
    public function getCategoryId() {
        return $this->categoryId;
    }

    /**
     * @param string $category
     */
    public function setCategoryId($categoryId) {
        if ($categoryId > 0) {
            $this->categoryId = $categoryId;
        }
    }

    /**
     * Create new product
     * @return array
     */
    public function updateCategoryAmount($category) {
        $this->database->updateRow('category', "amount= '{$category->getAmount()}'"
                . "WHERE id= {$this->categoryId}");
    }

    /**
     * Create new product
     * @return array
     */
    public function createProduct() {
        $result = $this->database->insertRow('products', "(`name`,`category_id`,`type`,`color`,`country`,`quantity`,`price`, `image`) VALUES(?,?,?,?,?,?,?,?)", [$this->productName, $this->categoryId, $this->productType, $this->productColor, $this->productCountry, $this->productQuantity, $this->productPrice, $this->productImage]);
    }

    /**
     * Initialization
     * @param array $data
     */
    public function init($data) {
        $this->setProductName($data['product']);
        $this->setProductType($data['type']);
        $this->setProductColor($data['color']);
        $this->setProductCountry($data['country']);
        $this->setProductQuantity($data['quantity']);
        $this->setProductPrice($data['price']);
    }

    /**
     * Update product details
     */
    public function updateProduct() {
        $this->database->updateRow('products', "name='{$this->productName}', "
                . "type='{$this->productType}', "
                . "color='{$this->productColor}',"
                . "quantity='{$this->productQuantity}',"
                . "price='{$this->productPrice}',"
                . "country='{$this->productCountry}',"
                . "category_id='{$this->categoryId}'"
                . "WHERE id= {$this->productId}");
    }

    /**
     * Load single product
     * @param string $id
     * @return array
     */
    public function loadProduct($id) {
        $result = $this->database->getRow('*', 'products', "WHERE id = ?", [$id]);

        if (!empty($result)) {
            $this->productId = $id;
            $this->categoryId = $result['category_id'];
            $this->productType = $result['type'];
            $this->productColor = $result['color'];
            $this->productName = $result['name'];
            $this->productCountry = $result['country'];
            $this->productQuantity = $result['quantity'];
            $this->productPrice = $result['price'];
            $this->isAvailable = $result['is_available'];
            $this->productImage = $result['image'];
            $this->salesCounter = $result['sales_counter'];
        }
    }

    /**
     * Check if product with given name already exists
     * @return string
     */
    public function checkIfProductExists() {
        $result = $this->database->getRow('*', 'products', "WHERE name = ?", [$this->productName]);
        return $result;
    }

    /**
     * Remove single product
     */
    public function removeProduct() {
        $this->database->deleteRow('products', "WHERE id = ?", [$this->productId]);
    }

    /**
     * Set product turned on
     * @param string $id
     */
    public function turnOnProduct() {
        $this->database->updateRow('products', "is_available= 'turned on'"
                . "WHERE id= {$this->productId}");
    }

    /**
     * Set product turned off
     * @param string $id
     */
    public function turnOffProduct() {
        $this->database->updateRow('products', "is_available= 'turned off'"
                . "WHERE id= {$this->productId}");
    }

    /**
     * 
     * @param string $names
     * @return boolean|int
     */
    public function uploadImage($names) {
        if (!($_FILES['image']['name'])) {
            return;
        }
        if (($_FILES['image']['error'])) {
            return 0;
        }
        $newFileName = strtolower($_FILES['image']['name']);
        $cut = explode('.', filter_var(rtrim($_FILES['image']['name'], '.'), FILTER_SANITIZE_URL));
        $i = sizeof($cut) - 1;
        $type = $cut[$i];
        if ($_FILES['image']['size'] > (1024000)) {
            return 0;
        }
        $this->setProductImage($names . "." . $type);
        move_uploaded_file($_FILES['image']['tmp_name'], __DIR__ . '/../../../public/images/' . $names . "." . $type);
        return true;
    }

    /**
     * Update product quantity after purchase
     */
    public function updateProductsQuantity($newQuantity, $id) {
        $this->database->updateRow('products', "quantity = '{$newQuantity}' "
                . "WHERE id = {$id}");
    }

    /**
     * Update product sales counter
     */
    public function updateSalesCounter() {
        $this->database->updateRow('products', "sales_counter = '{$this->salesCounter} '+ 1 "
                . "WHERE id = {$this->productId}");
    }

}

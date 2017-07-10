<?php

namespace Shop\Models\Products;

use Shop\Core\Model;

/**
 * Class ProductManagement
 */
class ProductManagement extends Model {

    /**
     * @var id 
     */
    private $id;

    /**
     * @var name
     */
    private $name;

    /**
     * @var type 
     */
    private $type;

    /**
     * @var color
     */
    private $color;

    /**
     * @var country
     */
    private $country;

    /**
     * @var quantity
     */
    private $quantity;

    /**
     * @var price
     */
    private $price;

    /**
     * @var category
     */
    private $category;

    /**
     * @var image
     */
    private $image;

    /**
     * @return string
     */
    public function getImage() {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage($image) {
        $this->image = $image;
    }

    /**
     * @return string
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId($id) {
        if ($id == !NULL) {
            $this->id = $id;
        }
    }

    /**
     * @return string
     */
    public function getType() {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getColor() {
        return $this->color;
    }

    /**
     * @return string
     */
    public function getCountry() {
        return $this->country;
    }

    /**
     * @return string
     */
    public function getQuantity() {
        return $this->quantity;
    }

    /**
     * @return string
     */
    public function getPrice() {
        return $this->price;
    }

    /**
     * @param string $type
     */
    public function setType($type) {
        if ($type == !NULL) {
            $this->type = $type;
        }
    }

    /**
     * @param string $color
     */
    public function setColor($color) {
        if ($color == !NULL) {
            $this->color = $color;
        }
    }

    /**
     * @param string $country
     */
    public function setCountry($country) {
        if ($country == !NULL) {
            $this->country = $country;
        }
    }

    /**
     * @param string $quantity
     */
    public function setQuantity($quantity) {
        if ($quantity == !NULL) {
            $this->quantity = $quantity;
        }
    }

    /**
     * @param string $price
     */
    public function setPrice($price) {
        if ($price == !NULL) {
            $this->price = $price;
        }
    }

    /**
     * @return string
     */
    public function getName() {
        return $this->Name;
    }

    /**
     * @param string $name
     */
    public function setName($name) {
        if ($name == !NULL) {
            $this->name = $name;
        }
    }

    /**
     * @return string
     */
    public function getCategory() {
        return $this->category;
    }

    /**
     * @param string $category
     */
    public function setCategory($category) {
        if ($category > 0) {
            $this->category = $category;
        }
    }

    /**
     * Create new product
     * @return array
     */
    public function createProduct() {
        $result = $this->database->getRow('*', 'products', "WHERE name = ?", [$this->name]);
        $result2 = $this->database->getRow('amount', 'category', "WHERE id = ?", [$this->category]);
        if ((!$result)) {
            $id = $this->category;
            $amount = $result2['amount'] + 1;
            $this->database->updateRow('category', "amount= '$amount'"
                    . "WHERE id= $id");
            $result = $this->database->insertRow('products', "(`name`,`category_id`,`type`,`color`,`country`,`quantity`,`price`, `image`) VALUES(?,?,?,?,?,?,?,?)", [$this->name, $this->category, $this->type, $this->color, $this->country, $this->quantity, $this->price, $this->image]);
            return $result;
        }
        return;
    }

    /**
     * Initialization
     * @param array $data
     */
    public function init($data) {
        $this->setName($data['name']);
        $this->setType($data['type']);
        $this->setColor($data['color']);
        $this->setCountry($data['country']);
        $this->setQuantity($data['quantity']);
        $this->setPrice($data['price']);
    }

    /**
     * Update product details
     */
    public function updateProduct() {
        $name = $this->name;
        $type = $this->type;
        $category = $this->category;
        $color = $this->color;
        $quantity = $this->quantity;
        $price = $this->price;
        $country = $this->country;
        $id = $this->id;

        $this->database->updateRow('products', "name='$name', "
                . "type='$type', "
                . "color='$color',"
                . "quantity='$quantity',"
                . "price='$price',"
                . "country='$country',"
                . "category_id='$category'"
                . "WHERE id= $id");
        return;
    }

    /**
     * Load single product
     * @param string $id
     * @return array
     */
    public function loadProduct($id) {
        $result = $this->database->getRows('name, id, is_available, price, image', 'products', "WHERE category_id = ?", [$id]);
        return $result;
    }

    /**
     * Load multiple products
     * @param string $id
     * @return array
     */
    public function loadProductView($id) {
        $result = $this->database->getRows('*', 'products', "WHERE id = ?", [$id]);
        return $result;
    }

    /**
     * Remove single product
     * @param string $id
     * @param string $categoryId
     */
    public function remove($id, $categoryId) {
        $this->database->deleteRow('products', "WHERE id = ?", [$id]);
        $result = $this->database->getRow('amount', 'category', "WHERE id = ?", [$categoryId]);
        $amount = $result['amount'] - 1;
        $this->database->updateRow('category', "amount= '$amount'"
                . "WHERE id= $categoryId");
        return;
    }

    /**
     * Set product turned off or turned on
     * @param string $id
     */
    public function isAvailable($id) {
        $result = $this->database->getRow('is_available', 'products', "WHERE id = ?", [$id]);
        if (($result['is_available']) == "turned off") {
            $this->database->updateRow('products', "is_available= 'turned on'"
                    . "WHERE id= $id");
        } else {
            $this->database->updateRow('products', "is_available= 'turned off'"
                    . "WHERE id= $id");
            return;
        }
    }

    /**
     * Product image upload
     * @return boolean|int
     */
    public function uploadImage($names) {
        if ($_FILES['image']['name']) {
            if (!($_FILES['image']['error'])) {
                $newFileName = strtolower($_FILES['image']['name']);
                $cut = explode('.', filter_var(rtrim($_FILES['image']['name'], '.'), FILTER_SANITIZE_URL));
                $i = sizeof($cut) - 1;
                $type = $cut[$i];
                if ($_FILES['image']['size'] > (1024000)) {
                    return 0;
                } else {
                    $this->setImage($names . "." . $type);
                    move_uploaded_file($_FILES['image']['tmp_name'], __DIR__ . '/../../../public/images/' . $names . "." . $type);
                    return true;
                }
            } else {
                return 0;
            }
        }
    }

}

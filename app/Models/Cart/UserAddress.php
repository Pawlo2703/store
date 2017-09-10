<?php

namespace Shop\Models\Cart;

use Shop\Core\Model;

/**
 * Class Address
 */
class UserAddress extends Model {

    /**
     * @var orderId
     */
    private $orderId;

    /**
     * @var name
     */
    private $name;

    /**
     * @var surname
     */
    private $surname;

    /**
     * @var zipcode
     */
    private $zipcode;

    /**
     * @var street
     */
    private $street;

    /**
     * @var houseNumber
     */
    private $houseNumber;

    /**
     * @var doorsNumber
     */
    private $doorsNumber;

    /**
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getOrderId() {
        return $this->orderId;
    }

    /**
     * @param string $orderId
     */
    public function setOrderId($orderId) {
        $this->orderId = $orderId;
    }

    /**
     * @return string
     */
    public function getSurname() {
        return $this->surname;
    }

    /**
     * @return string
     */
    public function getZipcode() {
        return $this->zipcode;
    }

    /**
     * @return string
     */
    public function getStreet() {
        return $this->street;
    }

    /**
     * @return string
     */
    public function getHouseNumber() {
        return $this->houseNumber;
    }

    /**
     * @return string
     */
    public function getDoorsNumber() {
        return $this->doorsNumber;
    }

    /**
     * @param string $name
     */
    public function setName($name) {
        $this->name = $name;
    }

    /**
     * @param string $surname
     */
    public function setSurname($surname) {
        $this->surname = $surname;
    }

    /**
     * @param string $zipcode
     */
    public function setZipcode($zipcode) {
        $this->zipcode = $zipcode;
    }

    /**
     * @param string $street
     */
    public function setStreet($street) {
        $this->street = $street;
    }

    /**
     * @param string $houseNumber
     */
    public function setHouseNumber($houseNumber) {
        $this->houseNumber = $houseNumber;
    }

    /**
     * @param string $doorsNumber
     */
    public function setDoorsNumber($doorsNumber) {
        $this->doorsNumber = $doorsNumber;
    }

    /**
     * Save user address
     */
    public function saveAddress() {
        $result = $this->database->insertRow('orders_address', "(`order_id`,`name`,`surname`, `zipcode`, `street`, `house number`, `doors number`) VALUES(?,?,?,?,?,?,?)", ['0', $this->name, $this->surname, $this->zipcode, $this->street, $this->houseNumber, $this->doorsNumber]);
    }

}

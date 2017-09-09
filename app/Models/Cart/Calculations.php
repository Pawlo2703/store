<?php

namespace Shop\Models\Cart;

/**
 * Class Calculations
 */
class Calculations {

    /**
     * @var newQuantity
     */
    private $newQuantity;

    /**
     * @var newPrice
     */
    private $newPrice;

    /**
     * @var price
     */
    private $price;

    /**
     * @var quantity
     */
    private $quantity;

    /**
     * @return int
     */
    public function getQuantity() {
        return $this->quantity;
    }

    /**
     * 
     * @param string $quantity
     */
    public function setQuantity($quantity) {
        $this->quantity = $quantity;
    }

    /**
     * @return string
     */
    public function getPrice() {
        return $this->price;
    }

    /**
     * @param price $price
     */
    public function setPrice($price) {
        $this->price = $price;
    }

    /**
     * @return string
     */
    public function getNewQuantity() {
        return $this->newQuantity;
    }

    /**
     * @return string
     */
    public function getNewPrice() {
        return $this->newPrice;
    }

    /**
     * @param string $newQuantity
     */
    public function setNewQuantity($newQuantity) {
        $this->newQuantity = $newQuantity;
    }

    /**
     * @param string $newPrice
     */
    public function setNewPrice($newPrice) {
        $this->newPrice = $newPrice;
    }

    /**
     * Calculate products quantity for first time
     */
    public function calculateQuantity($item) {
        $newQuantity = (int) ($this->newQuantity) + (int) ($item->getTotalQuantity());
        return $item->setTotalQuantity($newQuantity);
    }

    /**
     * Remove single product quantity from totalQuantity
     */
    public function removeProductQuantity($cartCollection, $item) {
        $newQuantity = (int) ($cartCollection->getTotalQuantity()) - (int) ($cartCollection->getProductQuantity());
        return $item->setTotalQuantity($newQuantity);
    }

    /**
     * Remove single product price from totalQuantity
     */
    public function removeProductPrice($cartCollection, $item) {
        $newPrice = (int) ($cartCollection->getTotalPrice()) - ((int) ($cartCollection->getProductQuantity()) * (int) ($cartCollection->getProductPrice()));
        return $item->setTotalPrice($newPrice);
    }

    /**
     * Calculate total price of products 
     */
    public function calculatePrice($item) {
        $newPrice = (int) ($item->getProductQuantity()) * (int) ($item->getProductPrice()) + (int) ($item->getTotalPrice());
        return $item->setTotalPrice($newPrice);
    }

    /**
     * Recalculate product quantity after payment is done
     */
    public function recalculateProductQuantity($quantityToSubstract) {
        $this->newQuantity = $this->quantity - $quantityToSubstract;
    }

}

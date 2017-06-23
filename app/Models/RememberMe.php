<?php

namespace Shop\Models;

/**
 * Class User
 */
class RememberMe {

    private $bigKey;
    private $bigUserID;

    public function getBigKey() {
        return $this->bigKey;
    }

    public function getBigUserID() {
        return $this->bigUserID;
    }

    public function setBigKey($bigKey) {
        $this->bigKey = $bigKey;
    }

    public function setBigUserID($bigUserID) {
        $this->bigUserID = $bigUserID;
    }

    public function __construct() {
        $this->database = \Shop\Core\Database::getInstance();
    }

    public function addCookie($id) {
        $result = $this->database->getRow('*', 'remember', "WHERE id = ?", [$id]);
        if ((!$result) && (isset($this->bigKey))) {
            $result = $this->database->insertRow('remember', "( `id`, `bigKey`) VALUES(?,?)", [$id, $this->bigKey]);
            return $result;
        } else {
            $bigKey = $this->bigKey;
            $result = $this->database->updateRow('remember', "bigKey='$bigKey' "
                    . "WHERE id = $id");
            return $result;
        }
    }

    
}

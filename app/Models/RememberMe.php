<?php

namespace Shop\Models;

use Shop\libs\Session;

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
        $this->session = new Session;
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

    public function checkCookie() {
        $result = $this->database->getRow('id', 'remember', "WHERE bigKey = ?", [$this->bigKey]);
        if (!empty($result)) {
            $this->id = $result['id'];
            $this->session->set('user_id', $this->id);
        }
    }

    function generateRandomString() {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $string = '';
        for ($i = 0; $i < 20; ++$i) {
            $string .= $characters[rand(0, $charactersLength - 1)];
        }
        return $string;
    }

}

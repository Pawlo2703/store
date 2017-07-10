<?php

namespace Shop\Models;

use Shop\Core\Model;

/**
 * Class RememberMe
 */
class RememberMe extends Model {

    /**
     * @var bigKey
     */
    private $bigKey;
    
    /**
     * @var bigUserID
     */
    private $bigUserID;

    /**
     * @return string
     */
    public function getBigKey() {
        return $this->bigKey;
    }

    /**
     * @return string
     */
    public function getBigUserID() {
        return $this->bigUserID;
    }

    /**
     * @param string $bigKey
     */
    public function setBigKey($bigKey) {
        $this->bigKey = $bigKey;
    }

    /**
     * @param string $bigUserID
     */
    public function setBigUserID($bigUserID) {
        $this->bigUserID = $bigUserID;
    }

    /**
     * Create cookie
     * @param string $id
     * @return array
     */
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

    /**
     * Search for cookie
     */
    public function checkCookie() {
        $result = $this->database->getRow('id', 'remember', "WHERE bigKey = ?", [$this->bigKey]);
        if (!empty($result)) {
            $this->id = $result['id'];
            $this->session->set('user_id', $this->id);
        }
    }

    /**
     * Generates 20 characters long string
     * @return string
     */
    public function generateRandomString() {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $string = '';
        for ($i = 0; $i < 20; ++$i) {
            $string .= $characters[rand(0, $charactersLength - 1)];
        }
        return $string;
    }

}

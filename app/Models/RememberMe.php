<?php

namespace Shop\Models;

use Shop\Core\Model;
use Shop\libs\Session;

/**
 * Class RememberMe
 */
class RememberMe extends Model {

    /**
     *
     * @var admin
     */
    private $admin;

    /**
     *
     * @var id 
     */
    private $id;

    /**
     * @var bigKey
     */
    private $bigKey;

    /**
     * @var bigUserID
     */
    private $bigUserID;

    /**
     * 
     * @return string
     */
    public function getAdmin() {
        return $this->admin;
    }

    /**
     * 
     * @param string $admin
     */
    public function setAdmin($admin) {
        $this->admin = $admin;
    }

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
     * 
     * @return string
     */
    public function getId() {
        return $this->id;
    }

    /**
     * 
     * @param string $id
     */
    public function setId($id) {
        $this->id = $id;
    }

    /**
     * Check if user has already saved cookie
     */
    public function checkCookie($id) {
        $result = $this->database->getRow('*', 'remember', "WHERE id = ?", [$id]);
        return $result;
    }

    /**
     * Create cookie
     * @param string $id
     */
    public function addCookie($id, $admin) {
        if (isset($this->bigKey)) {
            $result = $this->database->insertRow('remember', "( `id`, `bigKey`, `admin`) VALUES(?,?,?)", [$id, $this->bigKey, $admin]);
            return;
        }
    }

    /**
     * Update cookie
     * @param string $id
     * @param string $admin
     */
    public function updateCookie($id, $admin) {
        $result = $this->database->updateRow('remember', "bigKey='{$this->bigKey}',"
                . "admin='$admin'"
                . "WHERE id = $id");
        return;
    }

    /**
     * Search for cookie
     */
    public function loadCookie() {
        $result = $this->database->getRow('id, admin', 'remember', "WHERE bigKey = ?", [$this->bigKey]);
        if (!empty($result)) {
            $this->id = $result['id'];
            $this->admin = $result['admin'];
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

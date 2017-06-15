<?php

namespace Shop\Models;

/**
 * Class User
 */
class User {

    /**
     *
     * @var id 
     */
    private $id;

    /**
     *
     * @var name 
     */
    private $name;

    /**
     *
     * @var surname 
     */
    private $surname;

    /**
     *
     * @var email 
     */
    private $email;

    /**
     *
     * @var password
     */
    private $password;

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getSurname() {
        return $this->surname;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setSurname($surname) {
        $this->surname = $surname;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function __construct() {
        $this->database = \Shop\Core\Database::getInstance();
    }

    /**
     * User register function
     * Checks if email is existing in DB
     */
    public function register() {
     //   var_dump($this->name, $this->surname);
        $email = $this->database->getRow('*', 'user', "WHERE email = ?", [$this->email]);
        if (!$email) {
            $result = $this->database->insertRow('user', "( `name`, `surname`, `email`, `password`) VALUES(?,?,?,?)", [$this->name, $this->surname, $this->email, $this->password]);
            return $result;
        }
        return NULL;
    }

}

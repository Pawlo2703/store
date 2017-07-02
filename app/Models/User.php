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

    /**
     *
     * @var newsletter
     */
    private $newsletter;
    private $admin;

    public function getAdmin() {
        return $this->admin;
    }

    public function setAdmin($admin) {
        $this->admin = $admin;
    }

    public function getNewsletter() {
        return $this->newsletter;
    }

    public function setNewsletter($newsletter) {
        $this->newsletter = $newsletter;
    }

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
        $email = $this->database->getRow('*', 'user', "WHERE email = ?", [$this->email]);
        if ((!$email) && (isset($this->newsletter))) {
            $result = $this->database->insertRow('user', "( `name`, `surname`, `email`, `password`, `newsletter`) VALUES(?,?,?,?,?)", [$this->name, $this->surname, $this->email, $this->password, $this->newsletter]);
            return $result;
        } else {
            $result = $this->database->insertRow('user', "( `name`, `surname`, `email`, `password`) VALUES(?,?,?,?)", [$this->name, $this->surname, $this->email, $this->password]);
            return $result;
        }
        return NULL;
    }

    /**
     * Searchs for email.
     * @param string $login
     * @return id
     */
    public function findByEmail($email) {
        $result = $this->database->getRow('*', 'user', "WHERE email = ?", [$email]);
        return isset($result['id']) ? $result['id'] : 0;
    }

    /**
     * Searchs for an user password by his ID
     * @param int $id
     * @return string
     */
    public function checkPassword($id) {
        $result = $this->database->getRow('*', 'user', "WHERE id = ?", [$id]);
        return isset($result['password']) ? $result['password'] : 0;
    }

    public function load($id) {
        $result = $this->database->getRow('*', 'user', "WHERE id = ?", [$id]);

        if (!empty($result)) {
            $this->id = $result['id'];
            $this->name = $result['name'];
            $this->email = $result['email'];
            $this->admin = $result['admin'];
        }
    }

}

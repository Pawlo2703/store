<?php

namespace Shop\Models;

use Shop\Core\Model;

/**
 * Class User
 */
class User extends Model {

    /**
     * @var id 
     */
    private $id;

    /**
     * @var name 
     */
    private $name;

    /**
     * @var surname 
     */
    private $surname;

    /**
     * @var email 
     */
    private $email;

    /**
     * @var password
     */
    private $password;

    /**
     * @var newsletter
     */
    private $newsletter;

    /**
     * @var admin 
     */
    private $admin;

    /**
     * @return string
     */
    public function getAdmin() {
        return $this->admin;
    }

    /**
     * @param string $admin
     */
    public function setAdmin($admin) {
        $this->admin = $admin;
    }

    /**
     * @return string
     */
    public function getNewsletter() {
        return $this->newsletter;
    }

    /**
     * @param string$newsletter
     */
    public function setNewsletter($newsletter) {
        $this->newsletter = $newsletter;
    }

    /**
     * @return string
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName() {
        return $this->name;
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
    public function getEmail() {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPassword() {
        return $this->password;
    }

    /**
     * @param string $id
     */
    public function setId($id) {
        $this->id = $id;
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
     * @param string $email
     */
    public function setEmail($email) {
        $this->email = $email;
    }

    /**
     * @param string $password
     */
    public function setPassword($password) {
        $this->password = $password;
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
        }
        $result = $this->database->insertRow('user', "( `name`, `surname`, `email`, `password`) VALUES(?,?,?,?)", [$this->name, $this->surname, $this->email, $this->password]);
        return $result;
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

    /**
     * @param string $id
     */
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

<?php

namespace Shop\Core;

use PDO;

/**
 * Class Database
 */
class Database extends Controller {

    protected $connection;
    private $username;
    private $password;
    private $host;
    private $dbname;
    private $options;
    private static $instance;

    /**
     * 
     * @return Database
     */
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    /**
     * 
     * @return type?
     */
    public function getConnection() {
        return $this->connection;
    }

    /**
     * Connection constructor
     */
    public function __construct() {
        $this->username = "root";
        $this->password = "";
        $this->host = "localhost";
        $this->dbname = "sup";
        $this->connect();
    }

    /**
     * Close connection
     */
    public function __destruct() {
        $this->disconnect();
    }

    /**
     * 
     * Connects with database
     */
    public function connect() {
        try {
            $this->connection = new PDO("mysql:host={$this->host};dbname={$this->dbname};charset=utf8", $this->username, $this->password, $this->options);
            //get an error if unable to connect db
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    /*
     * Disconnects with database
     */

    public function disconnect() {
        $this->connection = NULL;
    }

    /*
     * Selects database row
     */

        public function join($column, $table, $table2, $condition = "", $params = []) {
        $query = "SELECT $column FROM $table JOIN $table2 ON ";
        if ($condition) {
            $query .= $condition;
        }
        try {
            $stmt = $this->connection->prepare($query);
            $stmt->execute($params);
            return $stmt->fetch();
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }
    
    public function getRow($column, $table, $condition = "", $params = []) {
        $query = "SELECT $column FROM $table ";
        if ($condition) {
            $query .= $condition;
        }
        try {
            $stmt = $this->connection->prepare($query);
            $stmt->execute($params);
            return $stmt->fetch();
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }
    
        public function getRows($column, $table, $condition = "", $params = []) {
        $query = "SELECT $column FROM $table ";
        if ($condition) {
            $query .= $condition;
        }
        try {
            $stmt = $this->connection->prepare($query);
            $stmt->execute($params);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    /*
     * Creates new database row
     */

    public function insertRow($table, $condition = "", $params = []) {
        $query = "INSERT INTO $table ";
        if ($condition) {
            $query .= $condition;
        }
        try {
            $stmt = $this->connection->prepare($query);
            $stmt->execute($params);
            $lastId = $this->connection->lastInsertId();
            return $lastId;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    /*
     * Updates existing database row
     */

    public function updateRow($table, $condition = "", $params = []) {
        $query = "UPDATE $table SET ";
        if ($condition) {
            $query .= $condition;
        }
        try {
            $stmt = $this->connection->prepare($query);
            $stmt->execute($params);
            return TRUE;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    /*
     * Deletes database row
     */

    public function deleteRow($table, $condition = "", $params = []) {
        $query = "DELETE FROM $table ";
        if ($condition) {
            $query .= $condition;
        }
        try {
            $stmt = $this->connection->prepare($query);
            $stmt->execute($params);
        } catch (Exception $ex) {
            throw new Exception($e->getMessage());
        }
    }

}

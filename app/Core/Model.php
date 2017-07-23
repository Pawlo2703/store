<?php

namespace Shop\Core;

/**
 * Class Model
 */
class Model {

    /**
     * @var database
     */
    protected $database;

    /**
     * @var rawData
     */
    protected $rawData = [];

    /**
     * @var string
     */
    private $filter = "";

    /**
     * 
     * @return string
     */
    public function getParameter() {
        return $this->parameter;
    }

    /**
     * @param string $parameter
     */
    public function setParameter($parameter) {
        $this->parameter = $parameter;
    }

    /**
     * @return type
     */
    public function getDatabase() {
        return $this->database;
    }

    /**
     * @param type $database
     */
    public function setDatabase($database) {
        $this->database = $database;
    }

    /**
     * Construct
     */
    public function __construct() {
        $this->database = \Shop\Core\Database::getInstance();
    }

    /**
     * 
     * @param string $condition
     * @param array $values
     */
    public function filterBy($condition, $values) {
        $this->filter = "WHERE $condition = $values";
    }

    public function loadCollection() {
        if ($this->filter) {
            $this->rawData = $this->database->getRows('*', "$this->tableName", "$this->filter");
            return;
        }
        $this->rawData = $this->database->getRows('*', "$this->tableName");
    }

}

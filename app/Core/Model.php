<?php

namespace Shop\Core;

/**
 * Class Model
 */
class Model {

    /**
     *
     * @var database
     */
    protected $database;

    /**
     * 
     * @return type
     */
    public function getDatabase() {
        return $this->database;
    }

    /**
     * 
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

}

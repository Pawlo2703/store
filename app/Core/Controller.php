<?php

namespace Shop\Core;

class Controller {

    /**
     * @var \Shop\libs\Session
     */
    protected $session;

    public function __construct() {
        $this->session = new \Shop\libs\Session();
    }

    public function getParam($name) {
        if (isset($_POST[$name])) {
            return $_POST[$name];
        }

        if (isset($_GET[$name])) {
            return $_GET[$name];
        }
    }

    public function getParameters() {
        $params = array_merge($_POST, $_GET);
        if ($params) {
            return $params;
        }

        return [];
    }

    public function header() {
        if (($this->session->get('zmienna2')) != null) {
            $this->view('home/header_footer/header');
        } else {
            $this->view('home/header_footer/header');
        }
    }

    public function view($view, $data = []) {
        require_once '../app/Views/' . $view . '.php';
        
    }

    public function redirect($action) {

        $location = '../' . $action;

        header("Location: " . $location);
        exit;
    }

}

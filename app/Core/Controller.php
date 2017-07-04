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

    public function getUrlParam() {
        if (isset($_GET['url'])) {
            return $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
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

    public function checkIfAdmin() {
        if (($this->session->get('admin')) == !NULL) {
            if ($this->session->get('admin') == 0) {
                $this->redirect('home');
            }
        } else {
            $this->redirect('home', '');
        }
    }

    public function checkIfUser() {
        if (($this->session->get('admin')) == !NULL) {
            
        } else {
            $this->redirect('home', '');
        }
    }

    public function header() {
        if (($this->session->get('user_id')) != null) {
            $this->view('home/header_footer/header_logged');
        } else {
            $this->view('home/header_footer/header');
        }
    }

    public function view($view, $data = []) {
        require_once '../app/Views/' . $view . '.php';
    }

    public function redirect($action, $params) {
        if ($params == NULL) {
            $location = '../' . $action;
        } else {
            $location = '../' . $action . '/' . $params;
        }
        header("Location: " . $location);
        exit;
    }

}

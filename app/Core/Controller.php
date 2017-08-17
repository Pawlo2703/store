<?php

namespace Shop\Core;

use Shop\libs\Session;

class Controller {

    /**
     * @var \Shop\libs\Session
     */
    protected $session;

    /**
     * constructor
     */
    public function __construct() {
        $this->session = new \Shop\libs\Session();
    }

    /**
     * Parse URL into array elements
     * @return array
     */
    public function parseUrl($uri) {
        if (isset($uri)) {
            return $url = explode('/', filter_var(rtrim($uri, '/'), FILTER_SANITIZE_URL));
        }
    }


    /**
     * Merge $_POST and $_GET 
     * @return array params
     */
    public function getParameters() {
        $params = array_merge($_POST, $_GET);
        if ($params) {
            return $params;
        }
        return [];
    }

    /**
     * Check if logged user has admin privileges
     */
    public function checkIfAdmin() {
        if (($this->session->get('admin')) == !NULL) {
            if ($this->session->get('admin') == 0) {
                $this->redirect('home');
            }
        } else {
            $this->redirect('home', '');
        }
    }

    /**
     * Check if logged user is admin
     */
    public function checkIfUser() {
        if (($this->session->get('admin')) == !NULL) {
            
        } else {
            $this->redirect('home', '');
        }
    }

    /**
     * Create different header for logged and not logged users
     */
    public function header() {
        if (($this->session->get('user_id')) != null) {
            $this->view('home/header_footer/header_logged');
        } else {
            $this->view('home/header_footer/header');
        }
    }

    /**
     * Create view
     * @param string $view
     * @param array $data
     */
    public function view($view, $data = []) {
        require_once '../app/Views/' . $view . '.php';
    }

    /**
     * Redirect action to a different controller and method
     * @param string $action
     * @param array $params
     */
    public function redirect($action, $params) {
        $url = $this->parseUrl($_GET['url']);
        $count = count($url);

        if ($params == NULL) {
            if ($count === 1) {
                $location = '../' . $action;
            } else if ($count === 2) {
                $location = '../../' . $action;
            } else {
                $location = '../../../' . $action;
            }
        } else {
            if ($count === 1) {
                $location = '../' . $action . '/' . $params;
            } else if ($count === 2) {
                $location = '../../' . $action . '/' . $params;
            } else {
                $location = '../../../' . $action . '/' . $params;
            }
        }
        header("Location: " . $location);
        exit;
    }

}

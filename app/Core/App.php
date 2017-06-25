<?php

namespace Shop\Core;

/*
 * Class App
 */

class App {

    protected $controller = 'home';
    protected $method = 'display';
    protected $params = [];

    /**
     * Main clontrollers namespace
     * @var namespace 
     */
    private $namespace = "\\Shop\\Controllers\\";

    /*
     * Constructor
     */

    public function __construct() {
        $url = $this->parseUrl();
        $nameClass = $this->parseNamespace($url);
        if ($url != null) {
            if (count($nameClass) == 2) {
                $this->controller = ucfirst($nameClass[1]);
                $this->namespace = $this->namespace . ucfirst($nameClass[0]) . "\\";
            } else {
                $this->controller = ucfirst($url[0]);
            }
            $this->controller = $this->namespace . $this->controller;
            $this->controller = new $this->controller();
            $this->method = $url[1];
            $this->params = $url ? array_values($url) : [];
            call_user_func_array([$this->controller, $this->method], $this->params);
        } else {
            $this->controller = $this->namespace . $this->controller;
            $this->controller = new $this->controller();
            call_user_func_array([$this->controller, $this->method], $this->params);
        }
    }

    /*
     * 
     */

    public function parseUrl() {
        if (isset($_GET['url'])) {
            return $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
    }

    public function parseNamespace($url) {
        if (isset($url[0])) {
            return $nameClass = explode('_', filter_var(rtrim($url[0], '_'), FILTER_SANITIZE_URL));
        }
    }

}

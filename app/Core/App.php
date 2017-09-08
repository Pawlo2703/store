<?php

namespace Shop\Core;

/*
 * Class App
 */

class App extends Controller {

    /**
     * @var controller 
     */
    protected $controller = 'home';

    /**
     * @var method
     */
    protected $method = 'display';

    /**
     * @var params
     */
    protected $params = [];

    /**
     * Main clontrollers namespace
     * @var namespace 
     */
    private $namespace = "\\Shop\\Controllers\\";

    /**
     * Constructor
     */
    public function __construct() {
        if (!isset($_GET['url'])) {
            $_GET['url'] = 'home/display';
        }

        $url = $this->parseUrl($_GET['url']);
        $nameClass = $this->parseNamespace($url);
        $size = sizeof($nameClass);
        if ($url != null) {
            $this->controller = ucfirst($nameClass[$size - 1]);
            for ($i = 0; $i <= ($size - 2); $i ++) {
                $result = ucfirst($nameClass[$i]) . "\\";
                $this->namespace = $this->namespace . $result;
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

    /**
     * Parse subfolder and controller name
     * @param array $url
     * @return array
     */
    public function parseNamespace($url) {
        if (isset($url[0])) {
            return $nameClass = explode('_', filter_var(rtrim($url[0], '_'), FILTER_SANITIZE_URL));
        }
    }

}

<?php

namespace Shop\libs;

use Shop\Core\Controller;

class Session {

    private $session = false;

    public function start() {
        if ($this->session == false) {
            if (session_id() === "") {
                session_start();
                $this->session == true;
            }
        }
    }

    /**
     * Set session value.
     * @param string $key
     * @param mixed $value
     */
    public function set(string $key, $value) {
        $_SESSION[$key] = $value;
    }

    /**
     * Get value from session then delete it from current session.
     * @param string $key
     * @return mixed
     */
    public function pull(string $key) {
        if (isset($_SESSION[$key])) {
            $value = $_SESSION[$key];
            unset($_SESSION[$key]);
            return $value;
        }
        return null;
    }

    /**
     * Get value from session.
     * @param string $key
     * @return mixed
     */
    public function get(string $key) {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }
        return null;
    }

    /**
     * Destroy session value by key or values
     * @param string $key
     */
    public function destroy(string $key = "") {
        if ($this->session = true) {
            if ($key == "") {
                session_unset();
                session_destroy();
            } else {
                unset($_SESSION[$key]);
            }
        }
    }

    /**
     * Checks if value 'zmienna' is empty
     */
    public function loginCheck() {
        if ($_SESSION['zmienna'] == NULL) {
            $controller = new Controller();
            $controller->redirect("log", "user", array(""));
        }
    }

}

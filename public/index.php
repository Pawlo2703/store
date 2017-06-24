<?php

require_once '../app/init.php';


$session = new \Shop\libs\Session();
$session->start();


$cookie = new \Shop\Controllers\Cookie();
$cookie->checkCookie();


$routing = new \Shop\Core\Routing();
$app = new \Shop\Core\App();



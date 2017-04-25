<?php

require_once __DIR__.'/config.php';
require_once __DIR__.'/bootstrap.php';

$routeValue = filter_input(INPUT_GET,'r', FILTER_SANITIZE_SPECIAL_CHARS);
$route = (isset($routeValue)) ? $routeValue : 'home/index';
list($controller, $action) = explode('/', $route);



//include CONTROLLER_DIR."$controller.php";
$controllerObject = new $controller();
$controllerObject->$action();



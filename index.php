<?php

if (isset($_GET['module'])) {
    $controllerClass = ucfirst(strtolower($_GET['module'])).'Controller';
} else {
    $controllerClass = 'PostController';
}
if (isset($_GET['action'])) {
    $action = strtolower($_GET['action']);
} else {
    $action = 'index';
}

require_once 'src/controllers/'.$controllerClass.'.php';
$controller = new $controllerClass();
$controller->$action();

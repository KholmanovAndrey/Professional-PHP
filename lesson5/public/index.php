<?php
include $_SERVER['DOCUMENT_ROOT'] .
    '/../vendor/autoload.php';

$controllerName = $_GET['c'] ?: 'user';
$actionName = $_GET['a'];

$controllerClass = 'App\\controllers\\' .
    ucfirst($controllerName) . 'Controller';
if (class_exists($controllerClass)) {
    $controller = new $controllerClass(new \App\services\renders\TwigRenderServices());
    $controller->run($actionName);
}
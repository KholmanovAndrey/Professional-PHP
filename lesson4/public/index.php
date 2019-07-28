<?php
use  \App\models\User;
use  \App\services\BD;

include $_SERVER['DOCUMENT_ROOT'] .
    '/../services/Autoload.php';

spl_autoload_register(
    [new Autoload(),
        'loadClass']
);

$controllerName = $_GET['c'] ?: 'user';
$actionName = $_GET['a'];

$controllerClass = 'App\\controllers\\' .
    ucfirst($controllerName) . 'Controller';
if (class_exists($controllerClass)) {
    $controller = new $controllerClass();
    $controller->run($actionName);
}








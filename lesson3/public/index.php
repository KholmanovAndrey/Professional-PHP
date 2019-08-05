<?php
use \App\models\User;
use \App\models\Good;

include $_SERVER['DOCUMENT_ROOT'] .
    '/../services/Autoload.php';

spl_autoload_register(
    [new Autoload(),
        'loadClass']
);

$user = new User();
//var_dump($user->getOne(1));
//var_dump($user->getAll());

$user->setId(28);
$user->setLogin('admin');
$user->setPassword('admin');
$user->setName('admin');

$user->save();
//$user->delete();
var_dump($user->getAll());

$good = new Good();

$good->setId(1);
$good->setName('Стол');
$good->setInfo('Компьютерный стол');
$good->setPrice(1000);

$good->save();
var_dump($good->getAll());







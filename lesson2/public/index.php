<?php
use App\services\Autoload;
use App\services\BD;
use App\models\User;

include $_SERVER['DOCUMENT_ROOT'] .
    '/../services/Autoload.php';

spl_autoload_register(
    [new Autoload(),
        'loadClass']
);

$user = new User(new BD());
$user->getOne(1);
echo $user->getAll();



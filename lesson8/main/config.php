<?php
return [
    'rootName' => $_SERVER['DOCUMENT_ROOT'] .'/../',
    'name' => 'Мой магазин',
    'defaultControllerName' => 'good',
    'defaultActionName' => 'index',

    'components' => [
        'bd' => [
            'class' => \App\services\BD::class,
            'config' => [
                'user' => 'root',
                'pass' => '',
                'driver' => 'mysql',
                'bd' => 'gbphp',
                'host' => 'localhost',
                'charset' => 'UTF8',
            ]
        ],
        'userRepository' => [
            'class' => \App\models\repositories\UserRepository::class
        ]
    ],
];
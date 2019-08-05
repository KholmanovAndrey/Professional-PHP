<?php


namespace App\controllers;


class AdminController extends Controller
{
    public function behavior()
    {
        return [
            'access' => [
                'role' => 'admin',
            ],
        ];
    }
}
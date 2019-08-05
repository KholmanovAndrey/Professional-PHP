<?php


namespace App\controllers;


class ErrorController extends Controller
{
    public function error403Action()
    {
        echo $this->render('error/403');
    }

    public function error404Action()
    {
        echo $this->render('error/404');
    }
}
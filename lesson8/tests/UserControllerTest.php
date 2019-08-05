<?php


namespace App\tests;


use App\controllers\UserController;
use App\services\Request;
use App\services\Session;
use PHPUnit\Framework\TestCase;

class UserControllerTest extends TestCase
{
    public function testLogoutAction()
    {
        $controller = new UserController(
            new \App\services\renders\TwigRenderServices(),
            new Request(),
            new Session()
        );
        $string = $controller->logoutAction();
        var_dump($string);
    }
}
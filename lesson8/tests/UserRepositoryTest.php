<?php


namespace App\tests;

use App\main\App;
use PHPUnit\Framework\TestCase;

class UserRepositoryTest extends TestCase
{
    /**
     * @param $login
     * @param $password
     * @dataProvider dataForTestLogin
     */
    public function testLogin($login, $password)
    {
        $result = App::call()->userRepository
            ->login($login, $password);

        $this->assertIsObject($result);
    }

    public function dataForTestLogin()
    {
        return [
            ['admin', 'admin'],
        ];
    }
}
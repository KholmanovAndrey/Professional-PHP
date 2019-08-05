<?php
namespace App\tests;

use App\models\entities\Good;
use PHPUnit\Framework\TestCase;

class GoodTest extends TestCase
{
    /**
     * @param $string
     * @param $count
     * @dataProvider dataForTestGetShortInfo
     */
    public function testGetShortInfo($string, $count)
    {
        $good = new Good();
        $good->info = $string;
        $result = $good->getShortInfo($count);

        $this->assertEquals(mb_strlen($result), $count);
        //$this->assertTrue(mb_strlen($result) <= $count);
    }

    public function dataForTestGetShortInfo()
    {
        return [
            ['Проверка метода getShortInfo, класса Good', 10],
            ['Проверка метода getShortInfo', 10],
            ['Проверка', 10],
        ];
    }
}
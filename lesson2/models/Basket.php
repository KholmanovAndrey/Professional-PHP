<?php
/**
 * Created by PhpStorm.
 * User: Kholmanov
 * Date: 14.07.2019
 * Time: 18:25
 */

namespace App\models;


class Basket extends Model
{
    public $id;
    public $id_user;
    public $id_good;
    public $price;
    public $count;
    public $id_order;

    /**
     * Данный метод должен вернуть название таблицы
     * @return string
     */
    protected function getTableName()
    {
        return 'basket';
    }
}
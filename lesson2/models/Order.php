<?php

namespace App\models;


class Order extends Model
{
    public $id;
    public $id_user;
    public $amount;
    public $datetime_create;
    public $status;

    /**
     * Данный метод должен вернуть название таблицы
     * @return string
     */
    protected function getTableName()
    {
        return 'order';
    }
}
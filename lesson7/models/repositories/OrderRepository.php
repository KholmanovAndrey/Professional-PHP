<?php

namespace App\models\repositories;

use App\models\entities\Order;

class OrderRepository extends Repository
{

    /**
     * Данный метод должен вернуть название таблицы
     * @return string
     */
    protected function getTableName()
    {
        return '`order`';
    }

    /**
     * Данный метод должен вернуть класс
     * @return string
     */
    protected function getEntityName()
    {
        return Order::class;
    }
}
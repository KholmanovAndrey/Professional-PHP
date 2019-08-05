<?php

namespace App\models\repositories;

use App\models\entities\Basket;

class BasketRepository extends Repository
{

    /**
     * Данный метод должен вернуть название таблицы
     * @return string
     */
    protected function getTableName()
    {
        return 'basket';
    }

    /**
     * Данный метод должен вернуть класс
     * @return string
     */
    protected function getEntityName()
    {
        return Basket::class;
    }
}
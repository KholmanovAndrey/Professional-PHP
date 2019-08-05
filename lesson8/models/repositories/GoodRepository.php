<?php
namespace App\models\repositories;
use App\models\entities\Good;

/**
 * Class GoodRepository
 * @package App\models\repositories
 */
class GoodRepository extends Repository
{
    /**
     * Данный метод должен вернуть название таблицы
     * @return string
     */
    protected function getTableName()
    {
        return 'goods';
    }

    /**
     * Данный метод должен вернуть класс
     * @return string
     */
    protected function getEntityName()
    {
        return Good::class;
    }
}
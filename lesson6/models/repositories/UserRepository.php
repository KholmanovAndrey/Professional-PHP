<?php
namespace App\models\repositories;
use App\models\entities\User;

/**
 * Class UserRepository
 * @package App\models\repositories
 */
class UserRepository extends Repository
{
    /**
     * Данный метод должен вернуть название таблицы
     * @return string
     */
    protected function getTableName()
    {
        return 'users';
    }

    /**
     * Данный метод должен вернуть класс
     * @return string
     */
    protected function getEntityName()
    {
        return User::class;
    }
}

<?php
namespace App\models\repositories;
use App\main\App;
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

    public function login(string $login, string $password)
    {
        $user = $this->getOneWhere("login = '{$login}'");
        if (!empty($user)) {
            if ($password === $user->password) {
                return $user;
            }
        }
        return false;
    }
}

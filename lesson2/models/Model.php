<?php
namespace App\models;

use App\services\BD;

abstract class Model
{
    /**
     * @var BD Класс для работы с базой данных
     */
    protected $bd;

    /**
     * Model constructor.
     * @param BD $bd
     */
    public function __construct(BD $bd)
    {
        $this->bd = $bd;
    }

    /**
     * Данный метод должен вернуть название таблицы
     * @return string
     */
    abstract protected function getTableName();

    /**
     * Возращает объект с указанным id
     * @param int $id ID Записи таблицы
     */
    public function getOne(int $id)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = {$id}";
        return $this->bd->find($sql);
    }

    /**
     * Возращает объект с указанным id
     */
    public function getAll()
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM $tableName";
        return $this->bd->findAll($sql);
    }
}

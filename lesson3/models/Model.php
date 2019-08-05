<?php
namespace App\models;

use App\services\BD;
use App\services\IBD;

abstract class Model
{
    /**
     * @var BD Класс для работы с базой данных
     */
    protected $bd;

    /**
     * Model constructor.
     */
    public function __construct()
    {
        $this->bd = BD::getInstance();
    }

    /**
     * Данный метод должен вернуть название таблицы
     * @return string
     */
    abstract protected function getTableName();
    abstract protected function getProperties();

    /**
     * Возращает запись с указанным id
     *
     * @param int $id ID Записи таблицы
     * @return array
     */
    public function getOne(int $id)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";
        return $this->bd->find($sql, [':id' => $id]);
    }

    /**
     * Получение всех записей таблицы
     * @return mixed
     */
    public function getAll()
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return $this->bd->findAll($sql);
    }

    /**
     * Обновить или создать запись в таблице
     * @param int $id
     */
    public function save(){
        $proterties = $this->getProperties();
        if ($proterties['id'] !== null) {
            $this->update();
        } else {
            $this->insert();
        }
    }

    /**
     * Обновление запись в таблице
     * @param int $id
     */
    private function update()
    {
        $tableName = $this->getTableName();
        $proterties = $this->getProperties();
        $sql = "UPDATE {$tableName} SET ";
        $data = [];
        foreach ($proterties as $key => $proterty) {
            if ($key !== 'id') {
                $sql .= "{$key} = :{$key}, ";
                $data[":{$key}"] = $proterty;
            }
        }
        $sql = substr($sql,0,-2);
        $sql .= " WHERE id = {$proterties['id']}";
        $this->bd->execute($sql, $data);
    }

    /**
     * Создание записи в таблице
     */
    private function insert()
    {
        $tableName = $this->getTableName();
        $proterties = $this->getProperties();
        $nameItem = '';
        $valueItem = '';
        $data = [];
        foreach ($proterties as $key => $proterty) {
            if ($key !== 'id') {
                $nameItem .= "{$key}, ";
                $valueItem .= ":{$key}, ";
                $data[":{$key}"] = $proterty;
            }
        }
        $nameItem = substr($nameItem,0,-2);
        $valueItem = substr($valueItem,0,-2);
        $sql = "INSERT INTO {$tableName} ({$nameItem}) VALUES ({$valueItem})";
        $this->bd->execute($sql, $data);
    }

    /**
     * Удаление поля или всех полей в таблице
     * @param int $id
     */
    public function delete(int $id = 0)
    {
        $where = '';
        if ($id !== 0) {
            $where = "WHERE id = :id";
        }
        $tableName = $this->getTableName();
        $sql = "DELETE FROM {$tableName} {$where}";
        $this->bd->execute($sql, [
            ':id' => $id
        ]);
    }
}

<?php
namespace App\models\repositories;

use App\models\entities\Entity;
use App\services\BD;

abstract class Repository
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

    /**
     * Данный метод должен вернуть класс
     * @return string
     */
    abstract protected function getEntityName();

    /**
     * Возращает запись с указанным id
     *
     * @param int $id ID Записи таблицы
     * @return array
     */
    public function getOne($id)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";
        return $this->bd->queryObject(
            $sql,
            $this->getEntityName(),
            [':id' => $id]
        );
    }

    /**
     * Получение всех записей таблицы
     * @return mixed
     */
    public function getAll()
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return $this->bd->queryObjects($sql, $this->getEntityName());
    }

    public function getOneWhere(string $where)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE $where";
        return $this->bd->queryObject(
            $sql,
            $this->getEntityName(),
            []
        );
    }

    protected function insert(Entity $entity)
    {
        $columns = [];
        $params = [];

        foreach ($entity as $key => $value) {
            if ($key == 'bd') {
                continue;
            }
            $columns[] = $key;
            $params[":{$key}"] = $value;
        }

        $columnsString = implode(', ', $columns);
        $placeholders = implode(', ', array_keys($params));
        $tableName = $this->getTableName();
        $sql = "INSERT INTO {$tableName} ({$columnsString})
          VALUES ({$placeholders})";
        $this->bd->execute($sql, $params);
        $this->id = $this->bd->lastInsertId();
    }

    protected function update(Entity $entity) {
        $columns = [];
        $params = [];

        foreach ($entity as $key => $value) {
            if ($key == 'bd') {
                continue;
            }
            $columns[] = $key . ' = :' . $key;
            $params[":{$key}"] = $value;
        }

        $columnsString = implode(', ', $columns);
        $tableName = $this->getTableName();
        $sql = "UPDATE {$tableName} SET {$columnsString} WHERE id = :id";
        $this->bd->execute($sql, $params);
    }

    public function save(Entity $entity) {
        if (empty($entity->id)) {
            $this->insert($entity);
            return;
        }
        $this->update($entity);
        return;
    }

    /**
     * Удаление поля в таблице
     * @param Entity $entity
     */
    public function delete(Entity $entity)
    {
        $tableName = $this->getTableName();
        $sql = "DELETE FROM {$tableName} WHERE id = :id";
        $this->bd->execute($sql, [
            ':id' => $entity->id
        ]);
    }
}

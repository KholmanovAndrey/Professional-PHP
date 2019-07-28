<?php
namespace App\models;

class Good extends Model
{
    public $id;
    public $price;
    public $name;
    public $info;

    protected function getTableName()
    {
        return 'goods';
    }

    protected function getProperties()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->price,
            'info' => $this->info,
        ];
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getInfo()
    {
        return $this->info;
    }

    /**
     * @param mixed $info
     */
    public function setInfo($info)
    {
        $this->info = $info;
    }

    /**
     * Обновление запись в таблице
     * @param int $id
     */
    protected function update(int $id)
    {
        $tableName = $this->getTableName();
        $sql = "UPDATE {$tableName} SET login = :login, password = :password, name = :name WHERE id = :id";
        $this->bd->execute($sql, [
            ':id' => $id,
            ':login' => $this->login,
            ':password' => $this->password,
            ':name' => $this->name,
        ]);
    }

    /**
     * Создание записи в таблице
     */
    protected function insert()
    {
        $tableName = $this->getTableName();
        $sql = "INSERT INTO {$tableName} (login, password, name) VALUES (:login, :password, :name)";
        $this->bd->execute($sql, [
            ':login' => $this->login,
            ':password' => $this->password,
            ':name' => $this->name,
        ]);
    }
}
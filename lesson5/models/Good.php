<?php
namespace App\models;

class Good extends Model
{
    public $id;
    public $price;
    public $name;
    public $info;

    protected static function getTableName()
    {
        return 'goods';
    }
}
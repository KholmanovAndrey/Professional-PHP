<?php
namespace App\models\entities;
/**
 * Class Good
 * @package App\models\entities
 */
class Good extends Entity
{
    public $id;
    public $price;
    public $name;
    public $info;

    public function getShortInfo($count)
    {
        return mb_substr($this->info, 0, $count);
    }
}
<?php

namespace App\models\entities;

class Basket extends Entity
{
    public $id;
    public $id_order;
    public $id_good;
    public $quantity;
    public $price;
}
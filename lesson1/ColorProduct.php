<?php

use Product;

class ColorProduct extends Product
{

    public $color;

    public function __construct($id, $name, $description, $price, $color)
    {
        parent::__construct($id, $name, $description, $price);
        $this->color = $color;
    }

    public function display()
    {
        parent::display();
        echo $this->color;
    }

}
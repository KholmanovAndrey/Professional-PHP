<?php

class Product
{

    public $id;
    public $name;
    public $description;
    public $price;

    public function __construct($id, $name, $description, $price)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
    }

    public function getProduct()
    {

    }

    public function setProduct()
    {
        
    }

    public function display()
    {
        var_dump($this->id, $this->name, $this->description, $this->price);
    }

}
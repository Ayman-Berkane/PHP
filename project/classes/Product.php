<?php

class Product {
    public $id;
    public $name;
    public $img;
    public $description;
    public $price;
    public $vendor_id;

    public function __construct() {
        settype($this->id, "integer");
    }
}
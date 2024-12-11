<?php

class Review {
    public $id;
    public $name;
    public $content;
    public $rating;
    public $likes;
    public $time;
    public $product_id;

    public function __construct() {
        settype($this->id, "integer");
    }
}
<?php

class Vendor {
    public $id;
    public $name;
    public $img;
    public $description;

    public function __construct() {
        settype($this->id, "integer");
    }
}

?>
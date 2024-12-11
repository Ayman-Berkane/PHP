<?php
class Contact {
    public $id;
    public $name;
    public $email;
    public $subject;

    public function __construct() {
        settype($this->id, "integer");
    }
}
?>


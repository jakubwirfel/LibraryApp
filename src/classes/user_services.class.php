<?php
include_once 'validators.class.php';

class UserServices extends Validators {
    private $db;

    public function __construct($database) {
        $this -> db = $database;
    }
}
?>
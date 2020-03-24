<?php
class PostServices {
    protected $db;

    public function __construct($database) {
        $this -> db = $database;
    }

    public function addPost($title, $header, $content, $footer) {
        try {
            global $errors;

        } catch (PDOException $e) {
            array_push($errors, $e->getMessage());
        }
    }
}
?>
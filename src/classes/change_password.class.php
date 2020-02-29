<?php
include_once 'validators.class.php';

class ChangePwd extends Validators {
    private $db;

    public function __construct($database) {
        $this -> db = $database;
    }

    public function change_password($user_hashed_password) {
        try {
            $sql = "UPDATE users SET user_password = :user_new_password , user_pwd_change_date = :change_date, user_pwd_change = 0 WHERE users.user_id = :user_id";
            $query = $this -> db -> prepare($sql);
            $query -> bindParam(":user_id", $_SESSION['user_password_change']);
            $query -> bindParam(":user_new_password", $user_hashed_password);
            $query -> bindParam(":change_date", date("Y-m-d"));
            $query -> execute();
            unset($_SESSION['user_password_change']);
        } catch (PDOException $e) {
            array_push($errors, $e->getMessage());
        }
    }
    public function is_password_change() {
        if (!isset($_SESSION['user_password_change'])) {
            return true;
        }
    }
}
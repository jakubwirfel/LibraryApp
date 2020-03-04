<?php
include_once 'validators.class.php';

class UserServices extends Validators {
    protected $db;

    public function __construct($database) {
        $this -> db = $database;
    }

    public function addUser($username, $email, $password, $pwdChange, $group) {
        try {
            $date = date("Y-m-d");
            $sql = "INSERT INTO users (`user_name`, `user_email`, `user_password`, `user_pwd_change`, `user_pwd_change_date`, `group`) VALUES (:user_name, :user_email, :user_password, :pwd_change, :change_date, :group)";
            $query = $this -> db -> prepare($sql);
            $query -> bindParam(":user_name", $username);
            $query -> bindParam(":user_email", $email);
            $query -> bindParam(":user_password", $password);
            $query -> bindParam(":pwd_change", $pwdChange);
            $query -> bindParam(":change_date", $date);
            $query -> bindParam(":group", $group);
            $query -> execute();
        } catch (PDOException $e) {
            array_push($errors, $e->getMessage());
        }
    }
}
?>
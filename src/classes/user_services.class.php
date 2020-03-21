<?php
include_once 'validators.class.php';
class UserServices extends Validators {
    protected $db;

    public function __construct($database) {
        $this -> db = $database;
    }

    public function addUser($userName, $userEmail, $password_hashed, $pwdChange, $group, $firstName, $lastName, $postCode, $city, $street, $houseNum, $phoneNum) {
        try {
            global $errors;
            $date = date("Y-m-d");
            $sql = "INSERT INTO users (`user_name`, `user_email`,`first_name`,`last_name`, `phone_num`, `post_code`, `city`, `street`, `house_num`, `user_password`, `user_pwd_change`, `user_pwd_change_date`, `group`) VALUES (:user_name, :user_email, :firstName, :lastName, :phoneNum, :postCode, :city, :street, :houseNum, :user_password, :pwd_change, :change_date, :group)";
            $query = $this -> db -> prepare($sql);
            $query -> bindParam(":user_name", $userName);
            $query -> bindParam(":user_email", $userEmail);
            $query -> bindParam(":firstName", $firstName);
            $query -> bindParam(":lastName", $lastName);
            $query -> bindParam(":phoneNum", $phoneNum);
            $query -> bindParam(":postCode", $postCode);
            $query -> bindParam(":city", $city);
            $query -> bindParam(":street", $street);
            $query -> bindParam(":houseNum", $houseNum);
            $query -> bindParam(":user_password", $password_hashed);
            $query -> bindParam(":pwd_change", $pwdChange);
            $query -> bindParam(":change_date", $date);
            $query -> bindParam(":group", $group);
            $query -> execute();
        } catch (PDOException $e) {
            array_push($errors, $e->getMessage());
        }
    }
    public function deleteUser($user_id) {
        try {
            $sql = "DELETE FROM users WHERE user_id = :user_id";
            $query = $this -> db -> prepare($sql);
            $query -> bindParam(":user_id", $user_id);
            $query -> execute();
        } catch (PDOException $e) {
            array_push($errors, $e->getMessage());
        }
    }
    public function modifyUser($userId, $userName, $firstName, $lastName,$userEmail, $phoneNum, $postCode, $city, $street, $houseNum, $userPwdChange, $group) {
        try {
            global $errors;
            $sql = "UPDATE users INNER JOIN groups on users.group = groups.id SET user_name=:userName, first_name=:firstName, last_name=:lastName, user_email=:userEmail, phone_num=:phoneNum, post_code=:postCode, city=:city, street=:street, house_num=:houseNum, user_pwd_change=:userPwdChange, users.group=:group WHERE user_id=:userId";
            $query = $this -> db -> prepare($sql);
            $query -> bindParam(":userName", $userName);
            $query -> bindParam(":userId", $userId);
            $query -> bindParam(":firstName", $firstName);
            $query -> bindParam(":lastName", $lastName);
            $query -> bindParam(":userEmail", $userEmail);
            $query -> bindParam(":phoneNum", $phoneNum);
            $query -> bindParam(":postCode", $postCode);
            $query -> bindParam(":city", $city);
            $query -> bindParam(":street", $street);
            $query -> bindParam(":houseNum", $houseNum);
            $query -> bindParam(":userPwdChange", $userPwdChange);
            $query -> bindParam(":group", $group);
            $query -> execute();
            echo "<script>window.close();</script>";
        } catch (PDOException $e) {
            array_push($errors, $e->getMessage());
        }
    }
}
?>
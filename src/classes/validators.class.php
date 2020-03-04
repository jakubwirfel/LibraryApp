<?php
class Validators {

    public function passwordValidation($password, $password_repet) {
        global $errors;
        global $valid_password;
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number    = preg_match('@[0-9]@',  $password);
        $specialChars = preg_match('@[^\w]@', $password);
        // Check for empty and invalid inputs
        if (empty($password)) {
            array_push($errors, "Please enter a valid password ");
        } elseif (empty($password_repet)) {
            array_push($errors, "Please enter a valid password.");
        } elseif (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
            array_push($errors, "Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.");
        } else {
            // Check if the user may be logged in
            if ($password== $password_repet) {
                $valid_password = true;
            } else {
                array_push($errors, "Password are not the same");
            }
        }
    }

    public function usernameValidation($username) {
        global $errors;
        global $valid_name;

        $sql = "SELECT user_name FROM users WHERE user_name = :user_name";
        $query = $this -> db -> prepare($sql);
        $query -> bindParam(":user_name", $username);
        $query -> execute();
        if(!$query->rowCount() > 0) {
            $valid_name = true;
        } else {
            array_push($errors, "User already exist");
        }
    }

    public function emailValidation($email) {
        global $errors;
        global $valid_email;

        $sql = "SELECT user_email FROM users WHERE user_email = :user_email";
        $query = $this -> db -> prepare($sql);
        $query -> bindParam(":user_email", $email);
        $query -> execute();
        if(!$query->rowCount() > 0) {
            $valid_email = true;
        } else {
            array_push($errors, "Email already exist");
        }
    }
}
?>
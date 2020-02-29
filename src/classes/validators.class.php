<?php
class Validators {

    public function passwordValidation($password, $password_repet) {
        global $errors;
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number    = preg_match('@[0-9]@',  $password);
        $specialChars = preg_match('@[^\w]@', $password);
        // Check for empty and invalid inputs
        if (empty($password)) {
            array_push($errors, "Please enter a valid new password");
        } elseif (empty($password_repet)) {
            array_push($errors, "Please enter a valid new password.");
        } elseif (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
            array_push($errors, "Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.");
        } else {
            // Check if the user may be logged in
            if ($password== $password_repet) {
                $password_hashed = password_hash($password, PASSWORD_DEFAULT);
                $this-> change_password($password_hashed);
                header("Location: login.php");
                $_SESSION['redirect_from_change'] = 1;
            } else {
                array_push($errors, "Password are not the same");
            }
        }
    }
}
?>
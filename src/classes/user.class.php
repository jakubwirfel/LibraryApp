<?php
class User {

    private $db;

    public function __construct($database) {
        $this -> db = $database;
    }

    public function login ($user_name, $user_password) {
        try {
             // Define query to insert values into the users table
            $sql = "SELECT * FROM users WHERE user_name = :user_name LIMIT 1";
            // Prepare the statement
            $query = $this -> db -> prepare($sql);
            // Bind parameters
            $query -> bindParam(":user_name", $user_name);
             // Execute the query
            $query -> execute();
             // Return row as an array indexed by both column name
            $return = $query->fetch(PDO::FETCH_ASSOC);
             // Check if row is actually returned
             print_r ($return);
            if($query->rowCount() > 0) {
                // Verify hashed password against entered password
                if($user_password == $return['user_password']) {
                    // Define session on successful login
                    $_SESSION['user_session'] = $return['user_id'];
                    return true;
                } else {
                    // Define failure
                    return false;
                }
            }
        } catch (PDOException $e) {
            array_push($errors, $e->getMessage());
        }
    }
    public function is_logged_in() {
        // Check if user session has been set
        if (isset($_SESSION['user_session'])) {
            return true;
        }
    }
    // Redirect user
    public function redirect($url) {
        header("Location: $url");
    }
    // Log out user
    public function log_out() {
        // Destroy and unset active session
        session_destroy();
        unset($_SESSION['user_session']);
        return true;
    }
}
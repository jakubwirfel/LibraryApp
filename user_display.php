<?php
    include_once './src/include/start.inc.php';

    if (!$user->is_logged_in()) {
        $user->redirect('login.php');
    }
    try {
        // Define query to select values from the users table
        $sql = "SELECT * FROM users INNER JOIN groups on users.group = groups.id WHERE user_id=:user_id";

        // Prepare the statement
        $query = $database -> prepare($sql);

        // Bind the parameters
        $query->bindParam(':user_id', $_SESSION['user_session']);

        // Execute the query
        $query->execute();

        // Return row as an array indexed by both column name
        $returned = $query->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        array_push($errors, $e->getMessage());
    }

    try {
        $userId = $_GET['user'];
        $sql2 = "SELECT * FROM users INNER JOIN groups on users.group = groups.id WHERE user_id LIKE :user_id";
        $query2 = $database -> prepare($sql2);
        $query2 -> bindParam(":user_id", $userId);
        $query2->execute();
    } catch (PDOException $e) {
        array_push($errors, $e->getMessage());
    }

    if(($returned['group'] != "1") && ($returned['permissions'] != "user = 1")) :

?>
<?php endif ?>
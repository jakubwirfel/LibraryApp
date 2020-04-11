<?php
// Include necessary file
include_once './src/include/start.inc.php';

// Check if user is not logged in
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

if (isset($_GET['logout']) && ($_GET['logout'] == 'true')) {
    $user->log_out();
    $user->redirect('login.php');
}
?>
<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Library APP / Home</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="./public/css/main.css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css"  rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    </head>
<body>
<!-- Vertical navbar -->
<?php include_once './src/modules/nav.php';?>
<!-- End Vertical navbar -->
<!-- Page content holder -->
    <main class="page-content px-5 bg-primary" id="content">
        <?php
        if(isset($_GET['admin_panel'])) {
            include_once './src/modules/admin_panel.php';
        }
        if(isset($_GET['book_add'])) {
            include_once './src/modules/book_add.php';
        }
        if(isset($_GET['book_delete'])) {
            include_once './src/modules/book_delete.php';
        }
        if(isset($_GET['book_reservations'])) {
            include_once './src/modules/book_reservations.php';
        }
        if(isset($_GET['book_rented'])) {
            include_once './src/modules/book_rented.php';
        }
        if(isset($_GET['send_notification'])) {
            include_once './src/services/create_notification.php';
        }
        if(isset($_GET['add_user'])) {
            include_once './src/services/add_user.php';
        }
        if(isset($_GET['add_post'])) {
            include_once './src/services/add_post.php';
        }
        if(isset($_GET['delete_post'])) {
            include_once './src/services/delete_post.php';
        }
        // -----------USER MODULES-------------
        if(isset($_GET['search_book'])) {
            include_once './src/user_modules/search_books.php';
        }
        ?>
        <!-- Errors box -->
        <div class="center">
        <?php if (!$errors < 1): ?>
            <div class="errors_box_default">
                <?php foreach ($errors as $error): ?>
                    <p><?= $error ?></p>
                <?php endforeach ?>
            </div>
        <?php endif ?>
        </div>
        <!-- End Errors box -->
    </main>
<script src="./public/js/menuToggle.js"></script>
<script src="./public/js/usersToggle.js"></script>
<?php if(($returned['group'] != "1") && ($returned['permissions'] != "user = 1")) :?>
<script src="./public/js/panelToggle.js"></script>
<?php endif ?>
</body>
</html>
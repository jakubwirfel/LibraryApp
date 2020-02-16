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
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css"
      rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css"  rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
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
        ?>
        <!-- Errors box -->
        <?php if (!$errors < 1): ?>
            <div class="errors_box">
                <?php foreach ($errors as $error): ?>
                    <p><?= $error ?></p>
                <?php endforeach ?>
            </div>
        <?php endif ?>
        <!-- End Errors box -->
    </main>
<?php if(($returned['group'] != "1") && ($returned['permissions'] != "user = 1")) :?>
    <aside class="panel_container" id="panel">
        <div class="panel_outside_secion py-5" id="panelCollapse">
            <div class="col-lg h-25 d-flex justify-content-center align-items-start">
                <i class="fas fa-angle-double-left" id="arrow"></i>
            </div>
            <div class="col-lg h-50 d-flex justify-content-center align-items-center tu">
                <h4 class="rotated">Panel Modyfikacyjny</h4>
            </div>
            <div class="col-lg h-25 d-flex justify-content-center align-items-end">
                <i class="fas fa-angle-double-left" id="arrow"></i>
            </div>
        </div>
    </aside>
<?php endif ?>
</body>
<?php if(($returned['group'] != "1") && ($returned['permissions'] != "user = 1")) :?>
<script>
    var arrows = document.querySelectorAll("#arrow");
    $(function() {
            $('#panelCollapse').on('click', function() {
            $('#panel').toggleClass('active');
            $(arrows).toggleClass('active');
        });
    });
</script>
<?php endif ?>
</html>
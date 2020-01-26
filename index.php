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
    <nav class="vertical-nav bg-white" id="sidebar">
        <div class="py-4 px-3 mb-4 bg-light">
            <div class="media d-flex align-items-center"><img src="https://icons-for-free.com/iconfiles/png/512/bookshelf+library+icon-1320087270870761354.png" alt="logo" width="65" class="mr-3 rounded-circle img-thumbnail shadow">
                <div class="media-body">
                    <h4 class="m-0">Biblioteka WSB Toruń</h4>
                </div>
            </div>
        </div>
        <p class="text-gray font-weight-bold text-uppercase px-3 small pb-4 mb-0">User: <span class="text-primary"><?php echo $returned['user_name']?></span></p>
        <ul class="nav flex-column bg-white mb-3">
            <li class="nav-item">
                <a href="?logout=true" class="nav-link text-dark font-italic">
                    <i class="fa fa-sign-out-alt mr-3 text-primary fa-fw"></i>
                    Sign out
                </a>
            </li>
        </ul>
        <p class="text-gray font-weight-bold text-uppercase px-3 small pb-4 mb-0">Language</p>

        <div class="container lang_container">
            <div class="row">
                <div class="col-xs-6 px-3 mb-3">
                    <a href="#"/><img src="./public/assets/poland_flag.svg" alt="Polish language"  width="50" /></a>
                </div>
                <div class="col-sc-6 px-3 mb-3">
                    <a href="#"/><img src="./public/assets/uk_flag.svg" alt="English language"  width="50" /></a>
                </div>
            </div>
        </div>

        <p class="text-gray font-weight-bold text-uppercase px-3 small pb-4 mb-0">Main</p>

        <ul class="nav flex-column bg-white mb-0">
            <li class="nav-item">
                <a href="#" class="nav-link text-dark font-italic bg-light">
                    <i class="fa fa-th-large mr-3 text-primary fa-fw"></i>
                    Home
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link text-dark font-italic">
                    <i class="fa fa-address-card mr-3 text-primary fa-fw"></i>
                    About
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link text-dark font-italic">
                    <i class="fa fa-cubes mr-3 text-primary fa-fw"></i>
                    Services
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link text-dark font-italic">
                    <i class="fa fa-image mr-3 text-primary fa-fw"></i>
                    Gallery
                </a>
            </li>
        </ul>
<?php if (($returned['group'] == 3) && ($returned['permissions'] == "admin = 1")) :?>
        <p class="text-gray font-weight-bold text-uppercase px-3 small py-4 mb-0">Charts</p>

        <ul class="nav flex-column bg-white mb-0">
            <li class="nav-item">
                <a href="#" class="nav-link text-dark font-italic">
                    <i class="fa fa-chart-area mr-3 text-primary fa-fw"></i>
                    Area charts
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link text-dark font-italic">
                    <i class="fa fa-chart-bar mr-3 text-primary fa-fw"></i>
                    Bar charts
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link text-dark font-italic">
                    <i class="fa fa-chart-pie mr-3 text-primary fa-fw"></i>
                    Pie charts
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link text-dark font-italic">
                    <i class="fa fa-chart-line mr-3 text-primary fa-fw"></i>
                    Line charts
                </a>
            </li>
        </ul>
<?php endif ?>
    </nav>
<!-- End Vertical navbar -->

<!-- Page content holder -->
    <main class="page-content p-5 bg-primary" id="content">
        <button id="sidebarCollapse" type="button" class="btn btn-light bg-white rounded shadow-sm px-4 mb-4"><i class="fa fa-bars mr-1"></i><small class="text-uppercase font-weight-bold px-2">Toggle</small></button>
    </main>
    <script>
    $(function(){
        $('#sidebarCollapse').on('click', function() {
            $('#sidebar, #content').toggleClass('active');
        });
    });
    </script>
    </body>
</html>
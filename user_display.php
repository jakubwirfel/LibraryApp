<?php
    include_once './src/include/start.inc.php';

    if (!$user->is_logged_in()) {
        $user->redirect('login.php');
    }
    try {
        // Define query to select values from the users table
        $sql = "SELECT * FROM users INNER JOIN groups on users.group = groups.id WHERE user_id = :user_id";

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
        $sql2 = "SELECT * FROM users INNER JOIN groups on users.group = groups.id WHERE user_id LIKE :user_id LIMIT 1";
        $query2 = $database -> prepare($sql2);
        $query2 -> bindParam(":user_id", $userId);
        $query2->execute();
    } catch (PDOException $e) {
        array_push($errors, $e->getMessage());
    }

    if(($returned['group'] != "1") && ($returned['permissions'] != "user = 1")) :
        while($usersRow = $query2->fetch(PDO::FETCH_ASSOC)) {
?>
<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Library APP / Display user</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css"
      rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css"  rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    </head>
<body>
    <nav class="navbar fixed-top navbar-light bg-primary ">
        <h1 class="navbar-brand">User <u><?php echo $usersRow['user_name'] . "/" . $usersRow['user_id'] ?> </u>display and modification</h1>
    </nav>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" class="p-5">
    <button class="btn btn-primary mt-5"><i class="fas fa-pen"></i> Edit</button>
    <hr>
    <fieldset disabled>
        <div class="form-group row">
            <div class="col">
                <div class="row">
                    <label for="inputEmail3" class="col-sm-auto col-form-label">First name</label>
                    <div class="col-sm">
                        <input type="text" class="form-control" id="inputEmail3" placeholder="<?php echo $usersRow['first_name']?>">
                    </div>
                </div>
            </div>
            <div class="col ">
            <div class="row">
                    <label for="inputEmail3" class="col-sm-auto col-form-label">Last name</label>
                    <div class="col-sm">
                        <input type="text" class="form-control" id="inputEmail3" placeholder="<?php echo $usersRow['last_name']?>">
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col">
                <div class="row">
                    <label for="inputEmail3" class="col-sm-auto col-form-label">Email</label>
                    <div class="col-sm">
                        <input type="email" class="form-control" id="inputEmail3" placeholder="<?php echo $usersRow['user_email']?>">
                    </div>
                </div>
            </div>
            <div class="col ">
            <div class="row">
                    <label for="inputEmail3" class="col-sm-auto col-form-label">Phone num.</label>
                    <div class="col-sm">
                        <input type="text" class="form-control" id="inputEmail3" placeholder="<?php echo $usersRow['phone_num']?>">
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col">
                <div class="row">
                    <label for="inputEmail3" class="col-sm-auto col-form-label">Post. code / City</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="inputEmail3" placeholder="<?php echo $usersRow['post_code']?>">
                    </div>
                    <div class="col-sm">
                        <input type="text" class="form-control" id="inputEmail3" placeholder="<?php echo $usersRow['city']?>">
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col">
                <div class="row">
                    <label for="inputEmail3" class="col-sm-auto col-form-label">Street / House. num</label>
                    <div class="col-sm">
                        <input type="text" class="form-control"  id="inputEmail3" placeholder="<?php echo $usersRow['street']?>">
                    </div>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" id="inputEmail3" placeholder="<?php echo $usersRow['house_num']?>">
                    </div>
                </div>
            </div>
        </div>
        <hr class="my-4">
        <div class="form-group row">
            <div class="col">
                <div class="row">
                    <label for="inputEmail3" class="col-sm-auto col-form-label">User password change? </label>
                    <div class="col-sm-1">
                        <input type="radio"<?php if($usersRow['user_pwd_change'] == 1){echo "checked";}?> class="form-control" id="inputEmail3">
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col">
                <div class="row">
                    <label for="inputEmail3" class="col-sm-auto col-form-label">Last password change </label>
                    <div class="col-sm">
                        <input disabled type="text" class="form-control" id="inputEmail3" placeholder="<?php echo $usersRow['user_pwd_change_date']?>">
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col">
                <div class="row">
                    <label for="inputEmail3" class="col-sm-auto col-form-label">User group</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" id="inputEmail3" placeholder="<?php echo $usersRow['group']?>">
                    </div>
                    <div class="col-sm">
                        <input disabled type="text" class="form-control" id="inputEmail3" placeholder="<?php switch($usersRow['group']){case 1: echo "User"; break;
                                                                                                                                        case 2: echo "Moderator"; break;
                                                                                                                                        case 3: echo "Admin"; break;} ?>">
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </fieldset>
    </form>
</body>
</html>
<?php } endif ?>
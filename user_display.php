<?php
    include_once './src/include/start.inc.php';
    $UserServices = new UserServices($database);
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
        $userId = 10;
        $sql2 = "SELECT * FROM users INNER JOIN groups on users.group = groups.id WHERE user_id LIKE :user_id LIMIT 1";
        $query2 = $database -> prepare($sql2);
        $query2 -> bindParam(":user_id", $userId);
        $query2->execute();
    } catch (PDOException $e) {
        array_push($errors, $e->getMessage());
    }

    if(isset($_POST['update']) && $_POST['update'] == 'Update'){
        try {
            $userId = $_POST['userId'];
            $userName = $_POST['userName'];
            $firstName = $_POST['firstName'];
            $lastName = $_POST['lastName'];
            $userEmail = $_POST['email'];
            $phoneNum = $_POST['phone'];
            $postCode = $_POST['postCode'];
            $city = $_POST['city'];
            $street = $_POST['street'];
            $houseNum = $_POST['houseNum'];
            $userPwdChange = $_POST['userPwdChange'];
            $group = $_POST['group'];
            $UserServices -> modifyUser($userId, $userName, $firstName, $lastName, $userEmail, $phoneNum, $postCode, $city, $street, $houseNum, $userPwdChange, $group);
        } catch (PDOException $e) {
            array_push($errors, $e->getMessage());
        }
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
    <input type="hidden" name="userId"value="<?php echo $usersRow['user_id']?>">
    <div class="btn btn-primary mt-5" id="ToogleFieldset"><i class="fas fa-pen"></i> Edit</div>
    <hr>
    <fieldset id="Fieldset" disabled>
        <div class="form-group row">
            <div class="col">
                <div class="row">
                    <label for="inputFirstName" class="col-sm-auto col-form-label">First name</label>
                    <div class="col-sm">
                        <input type="text" name="firstName" class="form-control" id="inputFirstName" value="<?php echo $usersRow['first_name']?>">
                    </div>
                </div>
            </div>
            <div class="col ">
            <div class="row">
                    <label for="inputLastName" class="col-sm-auto col-form-label">Last name</label>
                    <div class="col-sm">
                        <input type="text" name="lastName" class="form-control" id="inputLastName" value="<?php echo $usersRow['last_name']?>">
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col">
                <div class="row">
                    <label for="inputEmail" class="col-sm-auto col-form-label">Email</label>
                    <div class="col-sm">
                        <input type="email" name = "email" class="form-control" id="inputEmail" value="<?php echo $usersRow['user_email']?>">
                    </div>
                </div>
            </div>
            <div class="col ">
            <div class="row">
                    <label for="inputPhone" class="col-sm-auto col-form-label">Phone num.</label>
                    <div class="col-sm">
                        <input type="text" name ="phone" class="form-control" id="inputPhone" value="<?php echo $usersRow['phone_num']?>">
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col">
                <div class="row">
                    <label for="inputPostCode" class="col-sm-auto col-form-label">Post. code / City</label>
                    <div class="col-sm-3">
                        <input type="text" name="postCode" class="form-control" id="inputPostCode" value="<?php echo $usersRow['post_code']?>">
                    </div>
                    <div class="col-sm">
                        <input type="text" name="city" class="form-control"  value="<?php echo $usersRow['city']?>">
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col">
                <div class="row">
                    <label for="inputStreet" class="col-sm-auto col-form-label">Street / House. num</label>
                    <div class="col-sm">
                        <input type="text" name="street" class="form-control"  id="inputStreet" value="<?php echo $usersRow['street']?>">
                    </div>
                    <div class="col-sm-2">
                        <input type="text" name="houseNum"class="form-control" value="<?php echo $usersRow['house_num']?>">
                    </div>
                </div>
            </div>
        </div>
        <hr class="my-4">
        <div class="form-group row">
            <div class="col">
                <div class="row">
                    <label for="inputPwd" class="col-sm-auto col-form-label">User password change? </label>
                    <div class="col-sm-1">
                        <input type="hidden" value="0" name="userPwdChange">
                        <input type="radio"<?php if($usersRow['user_pwd_change'] == 1){echo "checked";}?> name="userPwdChange" class="form-control" id="inputPwd" value="1">
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col">
                <div class="row">
                    <label for="inputPwdDate" class="col-sm-auto col-form-label">Last password change </label>
                    <div class="col-sm">
                        <input disabled type="text" class="form-control" id="inputPwdDate" placeholder="<?php echo $usersRow['user_pwd_change_date']?>">
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col">
                <div class="row">
                    <label for="inputGroup" class="col-sm-auto col-form-label">User group</label>
                    <div class="col-sm-2">
                        <input type="text" name="group" class="form-control" id="inputGroup" value="<?php echo $usersRow['group']?>">
                    </div>
                    <div class="col-sm">
                        <input disabled type="text" class="form-control" id="inputEmail3" placeholder="<?php switch($usersRow['group']){case 1: echo "User"; break;
                                                                                                                                        case 2: echo "Moderator"; break;
                                                                                                                                        case 3: echo "Admin"; break;} ?>">
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col">
                <div class="row">
                    <label for="inputUsername" class="col-sm-auto col-form-label">Username</label>
                    <div class="col-sm">
                        <input type="text" name="userName" class="form-control" id="inputUsername" value="<?php echo $usersRow['user_name']?>">
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" name="update" value="Update" class="btn btn-primary">Submit</button>
    </fieldset>
    </form>
    <?php if (!$errors < 1): ?>
            <div class="errors_box_default">
                <?php foreach ($errors as $error): ?>
                    <p><?= $error ?></p>
                <?php endforeach ?>
            </div>
    <?php endif ?>
    <script>
        var toogleFieldset = document.getElementById("ToogleFieldset");
        var fieldset = document.getElementById("Fieldset");
        toogleFieldset.addEventListener("click" , function(){
            if (fieldset.disabled == false) {
                fieldset.disabled = true;
            } else {
                fieldset.disabled = false;
            }
        });
    </script>
</body>
</html>
<?php } endif ?>
<?php
    include_once './src/include/start.inc.php';
    $notificationServices = new NotificationServices($database);
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
        $sql2 = "SELECT * FROM users WHERE user_id LIKE :user_id LIMIT 1";
        $query2 = $database -> prepare($sql2);
        $query2 -> bindParam(":user_id", $_GET['user']);
        $query2->execute();
    } catch (PDOException $e) {
        array_push($errors, $e->getMessage());
    }

    try {
        $sql3 = "SELECT * FROM groups";
        $query3 = $database -> prepare($sql3);
        $query3->execute();
    } catch (PDOException $e) {
        array_push($errors, $e->getMessage());
    }

    if(isset($_POST['send']) && $_POST['send'] == 'Send'){
        try {
            $sender = $_SESSION['user_session'];
            $recipient = trim($_POST['recipient']);
            $massage = trim($_POST['massage']);
            $forGroup = trim($_POST['forGroup']);
            $groupId = trim($_POST['groupId']);
            $notificationServices -> sendNotification($sender, $recipient, $massage, $forGroup, $groupId);
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
        <title>Library APP / Send notification</title>
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
        <h1 class="navbar-brand">Send notification to <u><?php echo $usersRow['user_name']?> </u></h1>
    </nav>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" class="p-5">
    <input type="hidden" name="recipient" value="<?php echo $usersRow['user_id']?>">
    <fieldset class="my-5">
        <div class="form-group row">
            <div class="col">
                <div class="row">
                    <label for="inputFirstName" class="col-sm-auto col-form-label">To:</label>
                    <div class="col-sm">
                        <input type="text" name="firstName" class="form-control" id="inputFirstName" value="<?php echo $usersRow['user_name']?> / <?php echo $usersRow['first_name']?> <?php echo $usersRow['last_name']?>" disabled>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col">
                <div class="row">
                    <label for="inputForGroup" class="col-sm-auto col-form-label">Send notification to group</label>
                    <div class="col-sm-1">
                        <input type="hidden" value="0" name="forGroup">
                        <input type="checkbox" name="forGroup" class="form-control" id="inputForGroup" value="1" onclick="toogleSelect()">
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group row" id="groups" style="display:none">
            <div class="col">
                <div class="row">
                    <label for="selectGroup" class="col-sm-auto col-form-label">Select group:</label>
                    <div class="col-sm">
                    <select class="form-control" id="selectGroup" name="groupId" >
                        <option value="0" selected>---------------------</option>
                    <?php while($groupRow = $query3->fetch(PDO::FETCH_ASSOC)) { ?>
                        <option value="<?php echo $groupRow['id']?>"><?php echo $groupRow['name']?></option>
                    <?php }?>
                    </select>
                    </div>
                </div>
            </div>
        </div>
        <hr class="my-4">
        <div class="form-group row">
            <label for="inputNotification" class="col-sm-4 col-form-label">Massage</label>
            <div class="col-sm-8">
                <textarea name="massage" class="form-control"  id="inputNotification" rows="5" ><?php if(isset($_POST['massage'])) { echo $_POST['massage'];} else {echo '';}?></textarea>
            </div>
        </div>
        <button type="submit" name="send" value="Send" class="btn btn-primary">Send notification</button>
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
        function toogleSelect() {
            var checkBox = document.getElementById("inputForGroup");
            var select = document.getElementById("groups");
            if (checkBox.checked == true){
                select.style.display = "block";
            } else {
                select.style.display = "none";
            }
        }
    </script>
</body>
</html>
<?php } endif ?>
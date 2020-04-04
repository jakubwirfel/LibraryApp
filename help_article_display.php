<?php
    include_once './src/include/start.inc.php';
    $articleServices = new HelpArticleServices($database);
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
        $sql2 = "SELECT * FROM groups";
        $query2 = $database -> prepare($sql2);
        $query2->execute();
    } catch (PDOException $e) {
        array_push($errors, $e->getMessage());
    }

    try {
        $sql3 = "SELECT * FROM help_articles INNER JOIN groups on help_articles.group_id = id WHERE article_id LIKE :id LIMIT 1";
        $query3 = $database -> prepare($sql3);
        $query3 -> bindParam(":id", $_GET['article']);
        $query3->execute();
    } catch (PDOException $e) {
        array_push($errors, $e->getMessage());
    }

    if(isset($_POST['update']) && $_POST['update'] == 'Update'){
        try {
            $articleId = trim($_POST['articleId']);
            $articleName = trim($_POST['articleName']);
            $articleTitle = trim($_POST['title']);
            $articleContent = trim($_POST['content']);
            $groupId = trim($_POST['groupId']);
            $articleServices -> modifyArticle($articleId, $groupId, $articleName, $articleTitle, $articleContent);
        } catch (PDOException $e) {
            array_push($errors, $e->getMessage());
        }
    }
    if(($returned['group'] != "1") && ($returned['permissions'] != "user = 1")) :
        while($articleRow = $query3->fetch(PDO::FETCH_ASSOC)) {
?>
<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Library APP / Display article</title>
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
        <h1 class="navbar-brand">Article <u><?php echo $articleRow['article_name'] . "/" . $articleRow['article_id'] ?> </u>display and modification</h1>
    </nav>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" class="p-5">
    <input type="hidden" name="articleId" value="<?php echo $articleRow['article_id']?>">
    <div class="btn btn-primary mt-5" id="ToogleFieldset"><i class="fas fa-pen"></i> Edit</div>
    <hr>
    <fieldset id="Fieldset" disabled>
    <div class="form-group row">
            <label for="inputName" class="col-sm-4 col-form-label">Name of aricle</label>
            <div class="col-sm-8">
            <input type="text" name="articleName" class="form-control" id="inputName"  value="<?php echo $articleRow['article_name']?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="inputTitle" class="col-sm-4 col-form-label">Article title</label>
            <div class="col-sm-8">
            <input type="text" class="form-control" id="inputTitle" name="title" value="<?php echo $articleRow['article_title']?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="inputContent" class="col-sm-4 col-form-label">Article content</label>
            <div class="col-sm-8">
            <textarea name="content" class="form-control"  id="inputContent" rows="10" ><?php echo $articleRow['article_content']?></textarea>
            </div>
        </div>
        <div class="form-group row">
                <div class="col">
                    <div class="row">
                        <label for="selectGroup" class="col-sm-4 col-form-label">Article display for group:</label>
                        <div class="col-sm-8">
                        <select class="form-control" id="selectGroup" name="groupId" >
                        <?php while($groupRow = $query2->fetch(PDO::FETCH_ASSOC)) { ?>
                            <option value="<?php echo $groupRow['id']?>"><?php echo $groupRow['name']?></option>
                        <?php }?>
                        </select>
                        </div>
                    </div>
                </div>
            </div>
        <hr class="my-4">
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
<?php
    include_once './src/include/start.inc.php';
    $postServices = new PostServices($database);
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
        $postId = $_GET['post'];
        $sql2 = "SELECT * FROM posts INNER JOIN users on posts.creator = users.user_id WHERE post_id LIKE :post_id LIMIT 1";
        $query2 = $database -> prepare($sql2);
        $query2 -> bindParam(":post_id", $postId);
        $query2->execute();
    } catch (PDOException $e) {
        array_push($errors, $e->getMessage());
    }

    if(isset($_POST['update']) && $_POST['update'] == 'Update'){
        try {
            $postId = trim($_POST['postId']);
            $title = trim($_POST['title']);
            $header = trim($_POST['header']);
            $content = trim($_POST['content']);
            $footer = trim($_POST['footer']);
            $image = $_FILES['image'];
            $imgPath = trim($_POST['imgDir']);
            $imgName = trim($_POST['imgName']);
            $likes = trim($_POST['likes']);
            if(!isset($image)) {
                $image = false;
            }
            $postServices -> modifyPost($postId, $title, $header, $content, $footer, $image, $imgPath, $imgName, $likes);
        } catch (PDOException $e) {
            array_push($errors, $e->getMessage());
        }
    }
    if(($returned['group'] != "1") && ($returned['permissions'] != "user = 1")) :
        while($postRow = $query2->fetch(PDO::FETCH_ASSOC)) {
?>
<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Library APP / Display post</title>
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
        <h1 class="navbar-brand">Post <u><?php echo $postRow['title'] . "/" . $postRow['post_id'] ?> </u>display and modification</h1>
    </nav>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" class="p-5" enctype="multipart/form-data">
    <input type="hidden" name="postId" value="<?php echo $postRow['post_id']?>">
    <div class="btn btn-primary mt-5" id="ToogleFieldset"><i class="fas fa-pen"></i> Edit</div>
    <hr>
    <fieldset id="Fieldset" disabled>
        <div class="form-group row">
            <label for="inputTitle" class="col-sm-4 col-form-label">Tytuł</label>
            <div class="col-sm-8">
            <input type="text" name="title" class="form-control" id="inputTitle" value="<?php echo $postRow['title']?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="inputHeader" class="col-sm-4 col-form-label">Nagłówek</label>
            <div class="col-sm-8">
            <input type="text" class="form-control" id="inputHeader" name="header" value="<?php echo $postRow['header']?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="inputContent" class="col-sm-4 col-form-label">Tekst główny</label>
            <div class="col-sm-8">
            <textarea name="content" class="form-control"  id="inputContent" rows="10" ><?php echo $postRow['content']?></textarea>
            </div>
        </div>
        <div class="form-group row">
            <label for="inputFooter" class="col-sm-4 col-form-label">Stopka</label>
            <div class="col-sm-8">
            <input type="text" class="form-control" id="inputFooter" placeholder="Stopka posta" name="footer" value="<?php echo $postRow['footer']?>">
            </div>
        </div>
        <div class="form-group row">
            <img class="img-fluid" src="<?php echo $postRow['img_dir']?>" alt="<?php echo $postRow['img_name']?>" >
            <input type="hidden" name="imgName" value="<?php echo $postRow['img_name']?>">
            <input type="hidden" name="imgDir" value="<?php echo $postRow['img_dir']?>">
            <input type="hidden" name="likes" value="<?php echo $postRow['likes']?>">
        </div>
        <div class="form-group row">
            <label for="inputImage" class="col-sm-4 col-form-label">Zmień zdjęcie</label>
            <div class="col-sm-8">
                <input type="file" id="inputImage" name="image" class="btn btn-primary my-2">
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
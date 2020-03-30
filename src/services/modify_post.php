<?php
$postServices = new PostServices($database);
if (isset($_POST['searchPost']) && $_POST['searchPost'] !== '') {
    try {
        $searchPost =  '%' . $_POST['searchPost'] . '%';
        $sql = "SELECT * FROM posts INNER JOIN users on posts.creator = user_id WHERE title LIKE :title";
        $query = $database -> prepare($sql);
        $query -> bindParam(":title", $searchPost);
        $query->execute();
    } catch (PDOException $e) {
        array_push($errors, $e->getMessage());
    }
} else {
    try {
        $sql = "SELECT * FROM posts INNER JOIN users on posts.creator = user_id";
        $query = $database -> prepare($sql);
        $query->execute();
    } catch (PDOException $e) {
        array_push($errors, $e->getMessage());
    }
}
if(isset($_POST['refresh']) && $_POST['refresh'] == 'Refresh') {
    try {
        $sql = "SELECT * FROM posts INNER JOIN users on posts.creator = user_id";
        $query = $database -> prepare($sql);
        $query->execute();
    } catch (PDOException $e) {
        array_push($errors, $e->getMessage());
    }
}
?>
<div>
<h6 class="display-4 my-3">Select post for modification</h6>
<form action="index.php?admin_panel&panel=modify_post" method="POST">
    <div class="input-group md-form form-sm form-1 pl-0 pb-3">
        <div class="input-group-prepend">
            <span class="input-group-text bg-primary lighten-2" id="basic-text1"><i class="fas fa-search text-white"
                aria-hidden="true"></i></span>
        </div>
        <input class="form-control my-0 py-1" name="searchPost" type="text" placeholder="Search by title" aria-label="Search" value ="<?php if(isset($_POST['searchPost'])) { echo $_POST['searchPost'];} else {echo '';}?>">
    </div>
</form>
<form action="index.php?admin_panel&panel=modify_post" method="POST">
    <table class="table table-dark table-hover">
        <thead>
        <tr class="text-center">
            <th>Title</th>
            <th>Author</th>
            <th>Likes</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php
            while($postRow = $query->fetch(PDO::FETCH_ASSOC)) {
        ?>
        <tr class="text-center user_row">
            <td><?php echo $postRow['title']?></td>
            <td><?php echo $postRow['user_name']?></td>
            <td><?php echo $postRow['likes']?></td>
            <td><button onClick="javascript:window.open('http://127.0.0.1/LibraryApp/post_display.php?post=<?php echo $postRow['post_id']?>','Windows','width=950,height=850,location=no,toolbar=no,menubar=no,scrollbars=yes,resizable=yes,location=no,directories=no,status=no');return false")" value="<?php echo $postRow['post_id']?>" class="btn-md btn-danger"><i class="fas fa-eye"></i></button></td>
        </tr>
        <?php }?>
        </tbody>
    </table>
    <div class="form-group row">
        <div class="col-sm-11">

        </div>
        <div class="col-sm-1">
        <button type="submit" name="refresh" value="Refresh" class="btn btn-danger"><i class="fas fa-sync-alt"></i></button>
        </div>
    </div>
</form>
</div>
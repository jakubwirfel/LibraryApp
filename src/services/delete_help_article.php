<?php
$articleServices = new HelpArticleServices($database);
if (isset($_POST['searchArticle']) && $_POST['searchArticle'] !== '') {
    try {
        $searchArticle =  '%' . $_POST['searchArticle'] . '%';
        $sql = "SELECT * FROM help_articles INNER JOIN groups on help_articles.group_id = id WHERE article_title LIKE :title";
        $query = $database -> prepare($sql);
        $query -> bindParam(":title", $searchArticle);
        $query->execute();
    } catch (PDOException $e) {
        array_push($errors, $e->getMessage());
    }
} else {
    try {
        $sql = "SELECT * FROM help_articles INNER JOIN groups on help_articles.group_id = id";
        $query = $database -> prepare($sql);
        $query->execute();
    } catch (PDOException $e) {
        array_push($errors, $e->getMessage());
    }
}
if (isset($_POST['deleteArticle']) && $_POST['deleteArticle'] == 'DeleteArticle' && isset($_POST['articleToDelete'])) {
    $articleId = $_POST['articleToDelete'];
    $articleServices -> deleteArticle($articleId);
}
if(isset($_POST['refresh']) && $_POST['refresh'] == 'Refresh') {
    try {
        $sql = "SELECT * FROM help_articles INNER JOIN groups on help_articles.group_id = id";
        $query = $database -> prepare($sql);
        $query->execute();
    } catch (PDOException $e) {
        array_push($errors, $e->getMessage());
    }
}
?>
<div>
<h6 class="display-4 my-3">Select article for deletion</h6>
<form action="index.php?admin_panel&panel=delete_article" method="POST">
    <div class="input-group md-form form-sm form-1 pl-0 pb-3">
        <div class="input-group-prepend">
            <span class="input-group-text bg-primary lighten-2" id="basic-text1"><i class="fas fa-search text-white"
                aria-hidden="true"></i></span>
        </div>
        <input class="form-control my-0 py-1" name="searchArticle" type="text" placeholder="Search by title" aria-label="Search" value ="<?php if(isset($_POST['searchArticle'])) { echo $_POST['searchArticle'];} else {echo '';}?>">
    </div>
</form>
<form action="index.php?admin_panel&panel=delete_article" method="POST">
    <table class="table table-dark table-hover">
        <thead>
        <tr class="text-center">
            <th>Name</th>
            <th>Title</th>
            <th>For user</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php
            while($articleRow = $query->fetch(PDO::FETCH_ASSOC)) {
        ?>
        <tr class="text-center user_row">
            <td><?php echo $articleRow['article_name']?></td>
            <td><?php echo $articleRow['article_title']?></td>
            <td><?php echo $articleRow['name']?></td>
            <td><input type="radio" class="radio-btn" name="articleToDelete" value="<?php echo $articleRow['article_id']?>"></td>
        </tr>
        <?php }?>
        </tbody>
    </table>
    <div class="form-group row">
        <div class="col-sm-11">
        <button type="submit" name="deleteArticle" value="DeleteArticle" class="btn btn-primary">Delete article</button>
        </div>
        <div class="col-sm-1">
        <button type="submit" name="refresh" value="Refresh" class="btn btn-danger"><i class="fas fa-sync-alt"></i></button>
        </div>
    </div>
</form>
</div>
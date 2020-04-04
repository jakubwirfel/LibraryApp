<?php
try {
    $sql2 = "SELECT * FROM groups";
    $query2 = $database -> prepare($sql2);
    $query2->execute();
} catch (PDOException $e) {
    array_push($errors, $e->getMessage());
}


if (isset($_POST['addArticle']) && $_POST['addArticle'] == 'AddArticle') {
    $articleServices = new HelpArticleServices($database);
    $articleName = trim($_POST['articleName']);
    $articleTitle = trim($_POST['title']);
    $articleContent = trim($_POST['content']);
    $groupId = trim($_POST['groupId']);
    $articleServices -> addArticle($articleName, $articleTitle, $articleContent, $groupId);
}
?>
<div>
    <h6 class="display-4 my-3">Add help article for group</h6>
    <form action="index.php?admin_panel&panel=add_article" method="POST">
        <div class="form-group row">
            <label for="inputName" class="col-sm-4 col-form-label">Name of aricle</label>
            <div class="col-sm-8">
            <input type="text" name="articleName" class="form-control" id="inputName" placeholder="Name of article" value="<?php if(isset($_POST['articleName'])) { echo $_POST['articleName'];} else {echo '';}?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="inputTitle" class="col-sm-4 col-form-label">Article title</label>
            <div class="col-sm-8">
            <input type="text" class="form-control" id="inputTitle" placeholder="Title" name="title" value="<?php if(isset($_POST['title'])) { echo $_POST['title'];} else {echo '';}?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="inputContent" class="col-sm-4 col-form-label">Article content</label>
            <div class="col-sm-8">
            <textarea name="content" class="form-control"  id="inputContent" rows="10" ><?php if(isset($_POST['content'])) { echo $_POST['content'];} else {echo 'Proszę podać tekst główny';}?></textarea>
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
        <div class="form-group row">
            <div class="col-sm-10">
            <button type="submit" name="addArticle" value="AddArticle" class="btn btn-primary">Add article</button>
            </div>
        </div>
    </form>
</div>
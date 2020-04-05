<?php
$postServices = new PostServices($database);

if (isset($_POST['addPost']) && $_POST['addPost'] == 'AddPost' && isset($_FILES['image'])) {
    $title = trim($_POST['title']);
    $header = trim($_POST['header']);
    $content = trim($_POST['content']);
    $footer = trim($_POST['footer']);
    $image = $_FILES['image'];
    $postServices ->  addPost($title, $header, $content, $footer, $image);
}
?>
<div>
    <h6 class="display-4 my-3">Add post</h6>
    <form action="index.php?admin_panel&panel=add_post" method="POST" enctype="multipart/form-data">
    <div class="form-group row">
        <label for="inputTitle" class="col-sm-4 col-form-label">Tytuł</label>
        <div class="col-sm-8">
        <input type="text" name="title" class="form-control" id="inputTitle" placeholder="Tytuł posta" value="<?php if(isset($_POST['title'])) { echo $_POST['title'];} else {echo '';}?>">
        </div>
    </div>
    <div class="form-group row">
        <label for="inputHeader" class="col-sm-4 col-form-label">Nagłówek</label>
        <div class="col-sm-8">
        <input type="text" class="form-control" id="inputHeader" placeholder="Nagłówek posta" name="header" value="<?php if(isset($_POST['header'])) { echo $_POST['header'];} else {echo '';}?>">
        </div>
    </div>
    <div class="form-group row">
        <label for="inputContent" class="col-sm-4 col-form-label">Tekst główny</label>
        <div class="col-sm-8">
        <textarea name="content" class="form-control"  id="inputContent" rows="10" ><?php if(isset($_POST['content'])) { echo $_POST['content'];} else {echo 'Proszę podać tekst główny';}?></textarea>
        </div>
    </div>
    <div class="form-group row">
        <label for="inputFooter" class="col-sm-4 col-form-label">Stopka</label>
        <div class="col-sm-8">
        <input type="text" class="form-control" id="inputFooter" placeholder="Stopka posta" name="footer" value="<?php if(isset($_POST['footer'])) { echo $_POST['footer'];} else {echo '';}?>">
        </div>
    </div>
    <input type="file" name="image" class="btn btn-primary my-2">
    <hr class="my-4">
    <div class="form-group row">
        <div class="col-sm-10">
        <button type="submit" name="addPost" value="AddPost" class="btn btn-primary">Dodaj post</button>
        </div>
    </div>
    </form>
</div>
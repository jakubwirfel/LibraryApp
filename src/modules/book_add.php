<?php
try {
    $sql = "SELECT * FROM books_types";
    $query = $database -> prepare($sql);
    $query->execute();
} catch (PDOException $e) {
    array_push($errors, $e->getMessage());
}

if (isset($_POST['addBook']) && $_POST['addBook'] == 'AddBook' && isset($_FILES['image'])) {
    $bookServices = new BookServices($database);
    $title = trim($_POST['title']);
    $author = trim($_POST['author']);
    $description = trim($_POST['description']);
    $type = trim($_POST['type']);
    $date = trim($_POST['date']);
    $pages = trim($_POST['pages']);
    $image = $_FILES['image'];
    $bookServices -> addBook($title, $author, $description, $type, $date, $pages, $image);
}

if(($returned['group'] != "1") && ($returned['permissions'] != "user = 1")) :
?>
<div class="container-fluid content_container py-1 px-5">
<h6 class="display-4 my-5">Add book to library</h6>
    <form action="http://127.0.0.1/libraryapp/index.php?book_add" method="POST" enctype="multipart/form-data">
    <div class="form-group row">
        <label for="inputTitle" class="col-sm-4 col-form-label">Title</label>
        <div class="col-sm-4">
        <input type="text" name="title" class="form-control" id="inputTitle" placeholder="Book title" value="<?php if(isset($_POST['title'])) { echo $_POST['title'];} else {echo '';}?>">
        </div>
    </div>
    <div class="form-group row">
        <label for="inputAuthor" class="col-sm-4 col-form-label">Author</label>
        <div class="col-sm-4">
        <input type="text" class="form-control" id="inputAuthor" placeholder="Book author" name="author" value="<?php if(isset($_POST['author'])) { echo $_POST['author'];} else {echo '';}?>">
        </div>
    </div>
    <div class="form-group row">
        <label for="inputDescription" class="col-sm-4 col-form-label">Description</label>
        <div class="col-sm-4">
        <textarea name="description" class="form-control"  id="inputDescription" rows="5" ><?php if(isset($_POST['description'])) { echo $_POST['description'];} else {echo 'Please add description';}?></textarea>
        </div>
    </div>
    <div class="form-group row">
        <label for="inputFooter" class="col-sm-4 col-form-label">Type</label>
        <div class="col-sm-4">
            <input name="type" list="type" class="form-control">
            <datalist id="type">
            <?php while($typeRow = $query->fetch(PDO::FETCH_ASSOC)) { ?>
                <option value="<?php echo $typeRow['type_id']?>"><?php echo $typeRow['type_name']?></option>
            <?php }?>
            </datalist>
        </div>
    </div>
    <div class="form-group row">
        <label for="datepicker" class="col-sm-4">Date of publishing</label>
        <div class="col-sm-4">
            <input type="text" name="date" class="form-control col-sm-4" id="datepicker" placeholder="Select a Date" readonly>
        </div>
    </div>
    <div class="form-group row">
        <label for="pages" class="col-sm-4">Number of pages</label>
        <div class="col-sm-4">
            <input type="text" name="pages" class="form-control col-sm-4">
        </div>
    </div>
    <input type="file" name="image" class="btn btn-primary my-2">
    <hr class="my-4">
    <div class="form-group row">
        <div class="col-sm-10">
        <button type="submit" name="addBook" value="AddBook" class="btn btn-primary">Add book to library</button>
        </div>
    </div>
    </form>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#datepicker').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true
        });
    });
</script>
<?php endif ?>
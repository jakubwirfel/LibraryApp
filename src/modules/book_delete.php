<?php
if (isset($_POST['searchBook']) && $_POST['searchBook'] !== '') {
    try {
        $searchBook =  '%' . $_POST['searchBook'] . '%';
        $sql = "SELECT * FROM books INNER JOIN books_types on books.book_type = type_id WHERE book_title LIKE :search OR book_author LIKE :search OR type_name LIKE :search";
        $query = $database -> prepare($sql);
        $query -> bindParam(":search", $searchBook);
        $query->execute();
    } catch (PDOException $e) {
        array_push($errors, $e->getMessage());
    }
} else {
    try {
        $sql = "SELECT * FROM books INNER JOIN books_types on books.book_type = type_id";
        $query = $database -> prepare($sql);
        $query->execute();
    } catch (PDOException $e) {
        array_push($errors, $e->getMessage());
    }
}

if (isset($_POST['deleteBook']) && $_POST['deleteBook'] == 'DeleteBook' && isset($_POST['bookToDelete'])) {
    $bookServices = new BookServices($database);
    $title = $_POST['book_title'];
    $bookId = $_POST['bookToDelete'];
    $imgPath = $_POST['imgPath'];
    $bookServices -> deleteBook($bookId, $imgPath);
    array_push($errors, "Book $title has been deleted");
}

if(($returned['group'] != "1") && ($returned['permissions'] != "user = 1")) :
?>
<div class="container-fluid content_container py-1 px-5">
<h6 class="display-4 my-5">Delete book from library</h6>
<form action="index.php?book_delete" method="POST">
        <div class="input-group md-form form-sm form-1 pl-0 pb-3">
            <div class="input-group-prepend">
                <span class="input-group-text bg-primary lighten-2" id="basic-text1"><i class="fas fa-search text-white"
                    aria-hidden="true"></i></span>
            </div>
            <input class="form-control my-0 py-1" name="searchBook" type="text" placeholder="Search by title / author / type" aria-label="Search" value ="<?php if(isset($_POST['searchBook'])) { echo $_POST['searchBook'];} else {echo '';}?>">

        </div>
    </form>
    <form action="index.php?book_delete" method="POST">
    <div class="col-md-auto text-center">
        <button type="submit" name="deleteBook" value="DeleteBook" class="btn btn-danger my-3">Delete selected book</button>
    </div>
        <table class="table table-dark table-hover">
            <thead>
            <tr class="text-center">
                <th>Title</th>
                <th>Author</th>
                <th>Type</th>
                <th>Num of pages</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>
            <?php
                while($bookRow = $query->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <tr class="text-center user_row">
                <td>"<?php echo $bookRow['book_title']?>"</td>
                <td><?php echo $bookRow['book_author']?></td>
                <td><?php echo $bookRow['type_name']?></td>
                <td><?php echo $bookRow['book_num_pages']?></td>
                <td><input type="radio" class="radio-btn" name="bookToDelete" value="<?php echo $bookRow['book_id']?>" ></td>
                <input type="hidden" name="imgPath" value="<?php echo $bookRow['book_img_dir']?>">
                <input type="hidden" name="title" value="<?php echo $bookRow['book_title']?>">
            </tr>
            <?php }?>
            </tbody>
        </table>
    </form>
</div>
<?php endif ?>
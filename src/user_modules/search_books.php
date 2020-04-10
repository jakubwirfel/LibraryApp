<?php
$postServices = new PostServices($database);
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

if (isset($_POST['reservationSubmit']) && $_POST['reservationSubmit'] == 'Reserved') {
    $bookServices = new BookServices($database);
    $bookId = trim($_POST['bookId']);
    $date = trim($_POST['date']);
    $notes = trim($_POST['notes']);
    if(!isset($notes)) {
        $notes = "";
    }
    $bookServices -> reservBook($bookId, $date, $notes);
}
?>
<div class="container-fluid content_container py-1 px-5">
    <h6 class="display-4 my-3">Find book for you</h6>
    <form action="index.php?search_book" method="POST">
        <div class="input-group md-form form-sm form-1 pl-0 pb-3">
            <div class="input-group-prepend">
                <span class="input-group-text bg-primary lighten-2" id="basic-text1"><i class="fas fa-search text-white"
                    aria-hidden="true"></i></span>
            </div>
            <input class="form-control my-0 py-1" name="searchBook" type="text" placeholder="Search by title / author / type" aria-label="Search" value ="<?php if(isset($_POST['searchBook'])) { echo $_POST['searchBook'];} else {echo '';}?>">
        </div>
    </form>
        <table class="table table-dark table-hover">
            <thead>
            <tr class="text-center">
                <th>Title</th>
                <th>Author</th>
                <th>Type</th>
                <th>Num of pages</th>
                <th></th>
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
                <td hidden><?php echo $bookRow['book_pub_year']?></td>
                <td hidden><?php echo $bookRow['book_description']?></td>
                <td hidden><?php echo $bookRow['book_img_title']?></td>
                <td hidden><?php echo $bookRow['book_img_dir']?></td>
                <td hidden><?php echo $bookRow['book_id']?></td>
                <td><button type="button" data-toggle="modal" data-target="#showBook" class="btn-md btn-danger displaybtn"><i class="fas fa-eye"></i></button></td>
            </tr>
            <?php }?>
            </tbody>
        </table>
</div>
<!-- -------------MODAL BOOK PREWIEV---------------->
<div class="modal fade" id="showBook">
    <form action="index.php?search_book" method="POST">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Choose a book</h4>
                <button type="button" class="close" data-dismiss="modal" id="close">&times;</button>
            </div>

                <!-- -------------MODAL BOOK VIEW---------------->
                <div class="modal-body" id="displaybook">
                    <div class="row">
                        <div class="col">
                            <span>Book title:</span><p id="title">Choose a book</p>
                            <span >Author:</span><p id="author">Choose a book</p>
                            <span >Publishing year:</span><p id="year">Choose a book</p>
                            <span >Description:</span><p id="description">Choose a book</p>
                            <span >Type:</span><p id="type">Choose a book</p>
                            <span >Number of pages:</span><p id="pages">Choose a book</p>
                        </div>
                        <div class="col">
                            <img id="img" src="Choose a book" alt="Choose a book" width="100%" height="100%">
                        </div>
                        <input type="hidden" value="" id="book" name="bookId">
                    </div>
                </div>
                <!-- -------------MODAL BOOK RESERVATION---------------->
                <div class="modal-body" id="Reservation">
                    <div class="form-group row">
                        <label for="datepicker" class="col-sm-4">Date of receipt</label>
                        <div class="col-sm-4">
                            <input type="date" name="date" class="form-control col-sm" id="datapicker" placeholder="Select a Date" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputNotes" class="col-sm-4 col-form-label">Aditionals notes</label>
                        <div class="col-sm">
                        <textarea name="notes" class="form-control" id="inputNotes" rows="5" ></textarea>
                        </div>
                    </div>
                </div>
                <!-- -------------MODAL CHECK RESERVATIONS---------------->
                <div class="modal-body" id="CheckReserv">
                <table class="table table-dark table-hover">
                    <thead>
                    <tr class="text-center">
                        <th>Reservation ID</th>
                        <th>Reserved From</th>
                        <th>Reserved To</th>
                    </tr>
                    </thead>
                    <tbody id="table_check"></tbody>
                </table>
                </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" id="checkReservations" class="btn btn-primary" >Sprawdź dostępność</button>
                <button type="button" id="reserved" class="btn btn-danger">Rezerwuj</button>
                <button type="submit" name="reservationSubmit" value="Reserved" id="ConfirmReservation" class="btn btn-danger">Rezerwuj teraz</button>
            </div>

        </div>
    </div>
    </form>
</div>
<script>
    $(document).ready(function() {
        $('#checkReservations').on('click', function() {
            var bookId = $('#book').val();
            $("#table_check").load("./src/ajax/check_reservation.php", {
                book_Id: bookId
            });
        });
    });
</script>
<script src="./public/js/bookDataCapture.js"></script>
<script src="./public/js/bookPrewievToogle.js"></script>
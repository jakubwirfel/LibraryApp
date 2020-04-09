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
<div class="modal fade" id="showBook">
    <form action="index.php?search_book" method="POST">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Choose a book</h4>
                <button type="button" class="close" data-dismiss="modal" id="close">&times;</button>
            </div>

            <!-- Modal body -->
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
                </div>
            </div>
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
                <input type="hidden" value="" id="book" name="bookId">
            </div>

            <div class="modal-body" id="CheckReserv">
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

                </tbody>
            </table>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" id="checkReservations" class="btn btn-primary">Sprawdź dostępność</button>
                <button type="button" id="reserved" class="btn btn-danger">Rezerwuj</button>
                <button type="submit" name="reservationSubmit" value="Reserved" id="ConfirmReservation" class="btn btn-danger">Rezerwuj teraz</button>
            </div>

        </div>
    </div>
    </form>
</div>

<script>
$(document).ready(function () {
    $('.displaybtn').on('click', function() {
        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();

        $(".modal-title").html(data[0]);
        $("#title").html(data[0]);
        $("#author").html(data[1]);
        $("#year").html(data[4]);
        $("#description").html(data[5]);
        $("#pages").html(data[3]);
        $("#type").html(data[2]);
        $("#img").attr("alt",data[6])
        $("#img").attr("src",data[7])
        $("#book").val(data[8])
    });
});
</script>
<script>
$(document).ready(function () {
    $('#reserved').on('click', function() {
        $('#displaybook').toggleClass('unactive');
        $('#Reservation').toggleClass('active');
        $('#reserved').hide();
        $('#ConfirmReservation').toggleClass('active');
        $('#checkReservations').toggleClass('active');
    });
    $('#checkReservations').on('click', function() {
        $('#CheckReserv').toggleClass('active');
        $('#Reservation').toogleClass('active');
    });

    $('#close').on('click', function() {
        $('#reserved').show();
        $('#ConfirmReservation').removeClass('active');
        $('#displaybook').removeClass('unactive');
        $('#Reservation').removeClass('active');
        $('#CheckReserv').removeClass('active');
        $('#checkReservations').removeClass('active');
    });
});
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#datepicker').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true
        });
    });
</script>
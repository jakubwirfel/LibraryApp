<?php
if (isset($_POST['searchReservation']) && $_POST['searchReservation'] !== '') {
    try {
        $searchReservation =  '%' . $_POST['searchReservation'] . '%';
        $sql = "SELECT * FROM reservations LEFT JOIN books on reservations.reservation_book_id = book_id LEFT JOIN users on  reservations.reservation_user_id = user_id WHERE last_name LIKE :search ORDER BY reservations.reservation_to DESC";
        $query = $database -> prepare($sql);
        $query -> bindParam(":search", $searchReservation);
        $query->execute();
    } catch (PDOException $e) {
        array_push($errors, $e->getMessage());
    }
} else {
    try {
        $sql = "SELECT * FROM reservations LEFT JOIN books on reservations.reservation_book_id = book_id LEFT JOIN users on  reservations.reservation_user_id = user_id ORDER BY reservations.reservation_to DESC";
        $query = $database -> prepare($sql);
        $query->execute();
    } catch (PDOException $e) {
        array_push($errors, $e->getMessage());
    }
}

if (isset($_POST['rentBook']) && $_POST['rentBook'] == 'RentBook' && isset($_POST['bookToRENT'])) {
    $bookServices = new BookServices($database);
    $resId = $_POST['reservationId'];
    $bookId = $_POST['bookToRENT'];
    $userId = $_POST['renterId'];
    $renter = $_POST['renter'];
    $title = $_POST['title'];
    $bookServices -> rentBook($bookId, $userId);
    $bookServices -> deleteReservation($resId);
    array_push($errors, "Book $title has been rent by $renter");
}

if(($returned['group'] != "1") && ($returned['permissions'] != "user = 1")) :
?>
<div class="container-fluid content_container py-1 px-5">
<h6 class="display-4 my-5">Book reservations</h6>
<form action="index.php?book_reservations" method="POST">
        <div class="input-group md-form form-sm form-1 pl-0 pb-3">
            <div class="input-group-prepend">
                <span class="input-group-text bg-primary lighten-2" id="basic-text1"><i class="fas fa-search text-white"
                    aria-hidden="true"></i></span>
            </div>
            <input class="form-control my-0 py-1" name="searchReservation" type="text" placeholder="Search by user last name" aria-label="Search" value ="<?php if(isset($_POST['searchReservation'])) { echo $_POST['searchReservation'];} else {echo '';}?>">

        </div>
    </form>
    <form action="index.php?book_reservations" method="POST">
        <div class="col-md-auto text-center">
            <button type="submit" name="rentBook" value="RentBook" class="btn btn-danger my-3">Change to rent selected book</button>
        </div>
        <table class="table table-dark table-hover">
            <thead>
            <tr class="text-center">
                <th>Book title</th>
                <th>Reserving</th>
                <th>From</th>
                <th>To</th>
                <th>Change to RENTED</th>
            </tr>
            </thead>
            <tbody>
            <?php
                while($reservationRow = $query->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <tr class="text-center user_row">
                <td>"<?php echo $reservationRow['book_title']?>"</td>
                <td><?php echo $reservationRow['first_name'] . " " . $reservationRow['last_name']?></td>
                <td><?php echo $reservationRow['reservation_from']?></td>
                <td><?php echo $reservationRow['reservation_to']?></td>
                <td><input type="radio" class="radio-btn" name="bookToRENT" value="<?php echo $reservationRow['book_id']?>" ></td>
                <input type="hidden" name="renterId" value="<?php echo $reservationRow['user_id']?>">
                <input type="hidden" name="reservationId" value="<?php echo $reservationRow['reservation_id']?>">
                <input type="hidden" name="renter" value="<?php  echo $reservationRow['first_name'] . " " . $reservationRow['last_name']?>">
                <input type="hidden" name="title" value="<?php  echo $reservationRow['book_title']?>">
            </tr>
            <?php }?>
            </tbody>
        </table>
    </form>
</div>
<?php endif ?>
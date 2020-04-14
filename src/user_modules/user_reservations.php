<?php
    try {
        $sql = "SELECT * FROM reservations INNER JOIN books on reservations.reservation_book_id = book_id WHERE reservation_user_id = :user";
        $query = $database -> prepare($sql);
        $query -> bindParam(":user", $_SESSION['user_session']);
        $query->execute();
    } catch (PDOException $e) {
        array_push($errors, $e->getMessage());
    }
?>
<div class="container-fluid content_container py-1 px-5">
<h6 class="display-4 my-5">My book reservations</h6>
        <table class="table table-dark table-hover">
            <thead>
            <tr class="text-center">
                <th>Book title</th>
                <th>Reserved in</th>
                <th>Reserved to</th>
            </tr>
            </thead>
            <tbody>
            <?php
                while($reservationRow = $query->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <tr class="text-center user_row">
                <td>"<?php echo $reservationRow['book_title']?>"</td>
                <td><?php echo $reservationRow['reservation_from']?></td>
                <td><?php echo $reservationRow['reservation_to']?></td>
            </tr>
            <?php }?>
            </tbody>
        </table>
</div>
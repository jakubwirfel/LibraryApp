<?php
    try {
        $sql = "SELECT * FROM rented INNER JOIN books on rented.rented_book_id = book_id WHERE rented_user_id = :user";
        $query = $database -> prepare($sql);
        $query -> bindParam(":user", $_SESSION['user_session']);
        $query->execute();
    } catch (PDOException $e) {
        array_push($errors, $e->getMessage());
    }
?>
<div class="container-fluid content_container py-1 px-5">
<h6 class="display-4 my-5">My rented books</h6>
        <table class="table table-dark table-hover">
            <thead>
            <tr class="text-center">
                <th>Book title</th>
                <th>Reserved in</th>
                <th>Reserved to</th>
                <th>Surcharge</th>
            </tr>
            </thead>
            <tbody>
            <?php
                while($rentedRow = $query->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <tr class="text-center user_row">
                <td>"<?php echo $rentedRow['book_title']?>"</td>
                <td><?php echo $rentedRow['rented_from']?></td>
                <td><?php echo $rentedRow['rented_to']?></td>
                <td>
                    <?php
                        $datetime1 = date_create();
                        $datetime2 = date_create($rentedRow['rented_to']);
                        $interval = date_diff($datetime2, $datetime1);
                        if ($datetime1 >= $datetime2 ) {
                        echo $interval->format('%R%a days');
                        }
                    ?>
                </td>
            </tr>
            <?php }?>
            </tbody>
        </table>
</div>
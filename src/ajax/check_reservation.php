<?php
include_once '../include/db.inc.php';
try {
    $bookId = $_POST['book_Id'];
    $sql2 = "SELECT * FROM reservations  WHERE reservation_book_id = :bookId ORDER BY reservations.reservation_to DESC";
    $query2 = $database -> prepare($sql2);
    $query2 -> bindParam(":bookId", $bookId);
    $query2->execute();
    while($postRow = $query2->fetch(PDO::FETCH_ASSOC)) { ?>
        <tr class="text-center reservation_row">
            <td><?php echo $postRow['reservation_id']?></td>
            <td><?php echo $postRow['reservation_from']?></td>
            <td><?php echo $postRow['reservation_to']?></td>
        </tr>
    <?php }
} catch (PDOException $e) {
    array_push($errors, $e->getMessage());
}
?>
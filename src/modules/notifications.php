<?php
try {
    $sql = "SELECT * FROM notifications INNER JOIN users ON notifications.sender = user_id WHERE recipient = :userId OR group_id = :group";
    $query = $database -> prepare($sql);
    $query -> bindParam(":userId", $_SESSION['user_session']);
    $query -> bindParam(":group", $returned['group']);
    $query->execute();
} catch (PDOException $e) {
    array_push($errors, $e->getMessage());
}
if (isset($_POST['deleteNotify']) && $_POST['deleteNotify'] == 'DeleteNotify' && isset($_POST['notifyToDelete'])) {
    $notificationServices = new NotificationServices($database);
    $notificationId = $_POST['notifyToDelete'];
    $notificationServices  -> deleteNotification($notificationId);
    array_push($errors, "Notification has been deleted");
}
?>
<div class="container-fluid content_container py-1 px-5">
<h6 class="display-4 my-3">My notifications</h6>
<form action="" method="POST">
    <table class="table table-dark table-hover">
        <thead>
            <tr class="text-center">
                <th>Sender</th>
                <th>Date</th>
                <th>Massage</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php
                while($notificationsRow = $query->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <tr class="text-center user_row">
                <td><?php echo $notificationsRow['first_name']." ".$notificationsRow['last_name']." (".$notificationsRow['user_name'].")"?></td>
                <td><?php echo $notificationsRow['date']?></td>
                <td><?php echo $notificationsRow['massage']?></td>
                <td><input type="radio" class="radio-btn" name="notifyToDelete" value="<?php echo $notificationsRow['notification_id']?>"></td>
            </tr>
            <?php }?>
        </tbody>
    </table>
    <div class="col-sm-11">
        <button type="submit" name="deleteNotify" value="DeleteNotify" class="btn btn-danger">Delete selected notification</button>
    </div>
    </form>
</div>
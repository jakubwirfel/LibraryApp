<?php
$notificationServices = new NotificationServices($database);
if (isset($_POST['searchNotify']) && $_POST['searchNotify'] !== '') {
    try {
        $searchNotify =  '%' . $_POST['searchNotify'] . '%';
        $sql = "SELECT * FROM notifications LEFT JOIN groups on notifications.group_id = id LEFT JOIN users on notifications.recipient = user_id WHERE user_name LIKE :searchNotify OR name LIKE :groupName";
        $query = $database -> prepare($sql);
        $query -> bindParam(":searchNotify", $searchNotify);
        $query -> bindParam(":groupName", $searchNotify);
        $query->execute();
    } catch (PDOException $e) {
        array_push($errors, $e->getMessage());
    }
} else {
    try {
        $sql = "SELECT * FROM notifications LEFT JOIN groups on notifications.group_id = id LEFT JOIN users on notifications.recipient = user_id";
        $query = $database -> prepare($sql);
        $query->execute();
    } catch (PDOException $e) {
        array_push($errors, $e->getMessage());
    }
}
if (isset($_POST['deleteNotify']) && $_POST['deleteNotify'] == 'DeleteNotify' && isset($_POST['notifyToDelete'])) {
    $notificationId = $_POST['notifyToDelete'];
    $notificationServices  -> deleteNotification($notificationId);
    array_push($errors, "Notification has been deleted");
}
if(isset($_POST['refresh']) && $_POST['refresh'] == 'Refresh') {
    try {
        $sql = "SELECT * FROM notifications LEFT JOIN groups on notifications.group_id = id LEFT JOIN users on notifications.recipient = user_id";
        $query = $database -> prepare($sql);
        $query->execute();
    } catch (PDOException $e) {
        array_push($errors, $e->getMessage());
    }
}
?>
<div>
<h6 class="display-4 my-3">Select notification for deletion</h6>
<form action="index.php?admin_panel&panel=delete_notification" method="POST">
    <div class="input-group md-form form-sm form-1 pl-0 pb-3">
        <div class="input-group-prepend">
            <span class="input-group-text bg-primary lighten-2" id="basic-text1"><i class="fas fa-search text-white"
                aria-hidden="true"></i></span>
        </div>
        <input class="form-control my-0 py-1" name="searchNotify" type="text" placeholder="Search by recipient" aria-label="Search" value ="<?php if(isset($_POST['searchNotify'])) { echo $_POST['searchNotify'];} else {echo '';}?>">
    </div>
</form>
<form action="index.php?admin_panel&panel=delete_notification" method="POST">
    <table class="table table-dark table-hover">
        <thead>
        <tr class="text-center">
            <th>Sender</th>
            <th>Date</th>
            <th>Recipient</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php
            while($notifyRow = $query->fetch(PDO::FETCH_ASSOC)) {
                $sql2 = "SELECT user_name FROM notifications LEFT JOIN users on notifications.sender = user_id WHERE user_id LIKE :sender";
                $query2 = $database -> prepare($sql2);
                $query2 -> bindParam(":sender", $notifyRow['sender']);
                $query2->execute();
                $senderRow = $query2->fetch(PDO::FETCH_ASSOC);
        ?>
        <tr class="text-center user_row">
            <td><?php echo $senderRow['user_name']?></td>
            <td><?php echo $notifyRow['date']?></td>
            <td><?php if(isset($notifyRow['recipient'])){echo $notifyRow['user_name'];}else{echo $notifyRow['name'];}?></td>
            <td><input type="radio" class="radio-btn" name="notifyToDelete" value="<?php echo $notifyRow['notification_id']?>" ></td>
        </tr>
        <?php }?>
        </tbody>
    </table>
    <div class="form-group row">
        <div class="col-sm-11">
        <button type="submit" name="deleteNotify" value="DeleteNotify" class="btn btn-primary">Delete notification</button>
        </div>
        <div class="col-sm-1">
        <button type="submit" name="refresh" value="Refresh" class="btn btn-danger"><i class="fas fa-sync-alt"></i></button>
        </div>
    </div>
</form>
</div>
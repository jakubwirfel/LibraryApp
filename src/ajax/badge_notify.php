<?php
include_once '../include/db.inc.php';
global $errors;
try {
    $userId = $_POST['user'];
    $groupId = $_POST['group'];
    $sql2 = "SELECT COUNT(notification_id) FROM notifications WHERE recipient = :userId OR group_id = :group";
    $query2 = $database -> prepare($sql2);
    $query2 -> bindParam(":userId", $userId);
    $query2 -> bindParam(":group", $groupId);
    $query2->execute();
    echo $query2->fetchColumn(0);
} catch (PDOException $e) {
    echo  $e->getMessage();
}
?>

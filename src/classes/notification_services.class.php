<?php
class NotificationServices {
    protected $db;

    public function __construct($database) {
        $this -> db = $database;
    }

    public function sendNotification($sender, $recipient, $massage, $forGroup, $groupId) {
        try {
            if($groupId != 0) {
                $recipient = null;
            } else {
                $forGroup = null;
                $groupId = null;
            }
            global $errors;
            $date = date("Y-m-d");
            $sql = "INSERT INTO `notifications` (`sender`, `recipient`, `date`, `massage`, `for_group`, `group_id`) VALUES (:sender, :recipient, :date, :massage, :forGroup, :groupId)";
            $query = $this -> db -> prepare($sql);
            $query -> bindParam(":sender", $sender);
            $query -> bindParam(":recipient", $recipient);
            $query -> bindParam(":date", $date);
            $query -> bindParam(":massage", $massage);
            $query -> bindParam(":forGroup", $forGroup);
            $query -> bindParam(":groupId", $groupId);
            $query -> execute();
            echo "<script>window.close();</script>";
        } catch (PDOException $e) {
            array_push($errors, $e->getMessage());
        }
    }

    public function deleteNotification($notificationId) {
        try {
            $sql = "DELETE FROM notifications WHERE notification_id = :notificationId";
            $query = $this -> db -> prepare($sql);
            $query -> bindParam(":notificationId", $notificationId);
            $query -> execute();
        } catch (PDOException $e) {
            array_push($errors, $e->getMessage());
        }
    }
}
?>
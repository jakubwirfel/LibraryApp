<?php
class ContactServices {
    protected $db;

    public function __construct($database) {
        $this -> db = $database;
    }

    public function addContact($contactName, $supervisor, $phoneNum, $email, $groupId) {
        global $errors;
        try {
            $sql = "INSERT INTO contacts (`contact_name`, `group_id`, `supervisor`, `contact_email`, `contact_phone`) VALUES (:name, :groupId, :supervisor, :email, :phone)";
            $query = $this -> db -> prepare($sql);
            $query -> bindParam(":name", $contactName);
            $query -> bindParam(":groupId", $groupId);
            $query -> bindParam(":supervisor", $supervisor);
            $query -> bindParam(":email", $email);
            $query -> bindParam(":phone", $phoneNum);
            $query -> execute();
            array_push($errors, "Contact $contactName has been added");
        } catch (PDOException $e) {
            array_push($errors, $e->getMessage());
        }
    }

    public function deleteContact($contactId) {
        try {
            $sql = "DELETE FROM contacts WHERE contact_id = :contactId";
            $query = $this -> db -> prepare($sql);
            $query -> bindParam(":contactId", $contactId);
            $query -> execute();
        } catch (PDOException $e) {
            array_push($errors, $e->getMessage());
        }
    }

    public function modifyContact($contactId, $contactName, $groupId, $supervisor, $phoneNum, $email) {
        try {
            global $errors;
            $sql = "UPDATE contacts INNER JOIN groups on contacts.group_id = groups.id SET contact_name=:contactName, group_id=:groupId, supervisor=:supervisor, contact_email=:email, contact_phone=:phoneNum WHERE contact_id=:contactId";
            $query = $this -> db -> prepare($sql);
            $query -> bindParam(":contactName", $contactName);
            $query -> bindParam(":groupId", $groupId);
            $query -> bindParam(":supervisor", $supervisor);
            $query -> bindParam(":email", $email);
            $query -> bindParam(":phoneNum", $phoneNum);
            $query -> bindParam(":contactId", $contactId);
            $query -> execute();
            echo "<script>window.close();</script>";
        } catch (PDOException $e) {
            array_push($errors, $e->getMessage());
        }
    }
}
?>
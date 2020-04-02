<?php
$contactServices = new ContactServices($database);
if (isset($_POST['searchContact']) && $_POST['searchContact'] !== '') {
    try {
        $searchPost =  '%' . $_POST['searchContact'] . '%';
        $sql = "SELECT * FROM contacts INNER JOIN groups on contacts.group_id = id WHERE contact_name LIKE :name";
        $query = $database -> prepare($sql);
        $query -> bindParam(":name", $searchPost);
        $query->execute();
    } catch (PDOException $e) {
        array_push($errors, $e->getMessage());
    }
} else {
    try {
        $sql = "SELECT * FROM contacts INNER JOIN groups on contacts.group_id = id";
        $query = $database -> prepare($sql);
        $query->execute();
    } catch (PDOException $e) {
        array_push($errors, $e->getMessage());
    }
}
if (isset($_POST['deleteContact']) && $_POST['deleteContact'] == 'DeleteContact' && isset($_POST['contactToDelete'])) {
    $contactId = $_POST['contactToDelete'];
    $contactServices -> deleteContact($contactId);
}
if(isset($_POST['refresh']) && $_POST['refresh'] == 'Refresh') {
    try {
        $sql = "SELECT * FROM contacts INNER JOIN groups on contacts.group_id = id";
        $query = $database -> prepare($sql);
        $query->execute();
    } catch (PDOException $e) {
        array_push($errors, $e->getMessage());
    }
}
?>
<div>
<h6 class="display-4 my-3">Select contact for deletion</h6>
<form action="index.php?admin_panel&panel=delete_contact" method="POST">
    <div class="input-group md-form form-sm form-1 pl-0 pb-3">
        <div class="input-group-prepend">
            <span class="input-group-text bg-primary lighten-2" id="basic-text1"><i class="fas fa-search text-white"
                aria-hidden="true"></i></span>
        </div>
        <input class="form-control my-0 py-1" name="searchContact" type="text" placeholder="Search by contact name" aria-label="Search" value ="<?php if(isset($_POST['searchContact'])) { echo $_POST['searchContact'];} else {echo '';}?>">
    </div>
</form>
<form action="index.php?admin_panel&panel=delete_contact" method="POST">
    <table class="table table-dark table-hover">
        <thead>
        <tr class="text-center">
            <th>Name</th>
            <th>For user</th>
            <th>Supervisor</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php
            while($contactRow = $query->fetch(PDO::FETCH_ASSOC)) {
        ?>
        <tr class="text-center user_row">
            <td><?php echo $contactRow['contact_name']?></td>
            <td><?php echo $contactRow['name']?></td>
            <td><?php echo $contactRow['supervisor']?></td>
            <td><input type="radio" class="radio-btn" name="contactToDelete" value="<?php echo $contactRow['contact_id']?>" ></td>
        </tr>
        <?php }?>
        </tbody>
    </table>
    <div class="form-group row">
        <div class="col-sm-11">
        <button type="submit" name="deleteContact" value="DeleteContact" class="btn btn-primary">Delete contact</button>
        </div>
        <div class="col-sm-1">
        <button type="submit" name="refresh" value="Refresh" class="btn btn-danger"><i class="fas fa-sync-alt"></i></button>
        </div>
    </div>
</form>
</div>
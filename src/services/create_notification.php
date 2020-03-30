<?php
$UserServices = new UserServices($database);
if (isset($_POST['searchUser']) && $_POST['searchUser'] !== '') {
    try {
        $searchUser =  '%' . $_POST['searchUser'] . '%';
        $sql = "SELECT * FROM users INNER JOIN groups on users.group = groups.id WHERE user_name LIKE :user_name";
        $query = $database -> prepare($sql);
        $query -> bindParam(":user_name", $searchUser);
        $query -> bindParam(":userId", $_SESSION['user_session']);
        $query->execute();
    } catch (PDOException $e) {
        array_push($errors, $e->getMessage());
    }
} else {
    try {
        $sql = "SELECT * FROM users INNER JOIN groups on users.group = groups.id WHERE user_id != :userId";
        $query = $database -> prepare($sql);
        $query -> bindParam(":userId", $_SESSION['user_session']);
        $query->execute();
    } catch (PDOException $e) {
        array_push($errors, $e->getMessage());
    }
}
if(isset($_POST['refresh']) && $_POST['refresh'] == 'Refresh') {
    try {
        $sql = "SELECT * FROM users INNER JOIN groups on users.group = groups.id WHERE user_id != :userId";
        $query = $database -> prepare($sql);
        $query -> bindParam(":userId", $_SESSION['user_session']);
        $query->execute();
    } catch (PDOException $e) {
        array_push($errors, $e->getMessage());
    }
}
?>
<div>
<h6 class="display-4 my-3">Select user for this massage</h6>
<form action="index.php?admin_panel&panel=create_notification" method="POST">
    <div class="input-group md-form form-sm form-1 pl-0 pb-3">
        <div class="input-group-prepend">
            <span class="input-group-text bg-primary lighten-2" id="basic-text1"><i class="fas fa-search text-white"
                aria-hidden="true"></i></span>
        </div>
        <input class="form-control my-0 py-1" name="searchUser" type="text" placeholder="Search by username" aria-label="Search" value ="<?php if(isset($_POST['searchUser'])) { echo $_POST['searchUser'];} else {echo '';}?>">
    </div>
</form>
<form action="index.php?admin_panel&panel=create_notification" method="POST">
    <table class="table table-dark table-hover">
        <thead>
        <tr class="text-center">
            <th>Username</th>
            <th>Email</th>
            <th>Telephone</th>
            <th>Group</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php
            while($usersRow = $query->fetch(PDO::FETCH_ASSOC)) {
        ?>
        <tr class="text-center user_row">
            <td><?php echo $usersRow['user_name']?></td>
            <td><?php echo $usersRow['user_email']?></td>
            <td><?php echo $usersRow['phone_num']?></td>
            <td><?php echo $usersRow['name']?></td>
            <td><button onClick="javascript:window.open('http://127.0.0.1/LibraryApp/send_notification.php?user=<?php echo $usersRow['user_id']?>','Windows','width=650,height=850,location=no,toolbar=no,menubar=no,scrollbars=yes,resizable=yes,location=no,directories=no,status=no');return false")" value="<?php echo $usersRow['user_id']?>" class="btn-md btn-danger"><i class="fas fa-paper-plane"></i></button></td>
        </tr>
        <?php }?>
        </tbody>
    </table>
    <div class="form-group row">
        <div class="col-sm-11">

        </div>
        <div class="col-sm-1">
        <button type="submit" name="refresh" value="Refresh" class="btn btn-primary"><i class="fas fa-sync-alt"></i></button>
        </div>
    </div>
</form>
</div>
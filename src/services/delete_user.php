<?php
$UserServices = new UserServices($database);
if (isset($_POST['searchUser']) && $_POST['searchUser'] !== '') {
    try {
        $searchUser =  '%' . $_POST['searchUser'] . '%';
        $sql = "SELECT * FROM users INNER JOIN groups on users.group = groups.id WHERE user_name LIKE :user_name AND user_id != :userId";
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
if (isset($_POST['deleteUser']) && $_POST['deleteUser'] == 'DeleteUsers') {
    $user_name = $_POST['userName'];
    $user_id = $_POST['userToDelete'];
    $UserServices  -> deleteUser($user_id);
    array_push($errors, "User $user_name has been deleted");
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
<h6 class="display-4 my-3">Select user for deletion</h6>
<form action="index.php?admin_panel&panel=delete_user" method="POST">
    <div class="input-group md-form form-sm form-1 pl-0 pb-3">
        <div class="input-group-prepend">
            <span class="input-group-text bg-primary lighten-2" id="basic-text1"><i class="fas fa-search text-white"
                aria-hidden="true"></i></span>
        </div>
        <input class="form-control my-0 py-1" name="searchUser" type="text" placeholder="Search by username" aria-label="Search" value ="<?php if(isset($_POST['searchUser'])) { echo $_POST['searchUser'];} else {echo '';}?>">
    </div>
</form>
<form action="index.php?admin_panel&panel=delete_user" method="POST">
    <table class="table table-dark table-hover">
        <thead>
        <tr class="text-center">
            <th>Username</th>
            <th>Email</th>
            <th>Group</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php
            while($usersRow = $query->fetch(PDO::FETCH_ASSOC)) {
        ?>
        <tr class="text-center user_row">
            <td><?php echo $usersRow['user_name']?></td>
            <td><?php echo $usersRow['user_email']?></td>
            <td><?php echo $usersRow['group']?></td>
            <td><input type="radio" class="radio-btn" name="userToDelete" value="<?php echo $usersRow['user_id']?>" ></td>
            <input type="hidden" name="userName" value="<?php echo $usersRow['user_name']?>">
        </tr>
        <?php }?>
        </tbody>
    </table>
    <div class="form-group row">
        <div class="col-sm-11">
        <button type="submit" name="deleteUser" value="DeleteUsers" class="btn btn-primary">Usuń zaznaczonych</button>
        </div>
        <div class="col-sm-1">
        <button type="submit" name="refresh" value="Refresh" class="btn btn-danger"><i class="fas fa-sync-alt"></i></button>
        </div>
    </div>
</form>
</div>
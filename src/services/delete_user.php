<?php
    try {
        $sql = "SELECT * FROM users INNER JOIN groups on users.group = groups.id";
        $query = $database -> prepare($sql);
        $query->execute();
    } catch (PDOException $e) {
        array_push($errors, $e->getMessage());
    }
?>
<div>
    <div class="input-group md-form form-sm form-1 pl-0 pb-3">
        <div class="input-group-prepend">
            <span class="input-group-text bg-primary lighten-2" id="basic-text1"><i class="fas fa-search text-white"
                aria-hidden="true"></i></span>
        </div>
        <input class="form-control my-0 py-1" name="searchUser" type="text" placeholder="Search" aria-label="Search">
    </div>
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
        <?php $count = 1;
            while($usaersRow = $query->fetch(PDO::FETCH_ASSOC)) {
        ?>
        <tr id="<?php echo "userRow" . $count?>" class="text-center ">
            <td><?php echo $usaersRow['user_name']?></td>
            <td><?php echo $usaersRow['user_email']?></td>
            <td><?php echo $usaersRow['group']?></td>
            <td><input type="checkbox" id="userDelate" name="userToDelete" value="<?php echo $usaersRow['user_name']?>" onclick="UserMark(<?php echo $count ?>)"></td>
        </tr>
        <?php $count = $count + 1; }?>
        </tbody>
    </table>
    <div class="form-group row">
        <div class="col-sm-10">
        <button type="submit" name="delete_user" value="DeleteUsers" class="btn btn-primary">Usuń zaznaczonych</button>
        </div>
    </div>
</div>
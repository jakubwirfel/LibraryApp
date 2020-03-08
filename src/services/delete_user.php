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
        <?php while($usaersRow = $query->fetch(PDO::FETCH_ASSOC)) { ?>
        <tr id="userRow" class="text-center">
            <td><?php echo $usaersRow['user_name']?></td>
            <td><?php echo $usaersRow['user_email']?></td>
            <td><?php echo $usaersRow['group']?></td>
            <td><input type="checkbox" id="userDelate" name="userToDelete" value="<?php echo $usaersRow['user_name']?>"></td>
        </tr>
        <?php }?>
        </tbody>
    </table>
    <div class="form-group row">
        <div class="col-sm-10">
        <button type="submit" name="delete_user" value="DeleteUsers" class="btn btn-primary">Usuń zaznaczonych</button>
        </div>
    </div>
</div>
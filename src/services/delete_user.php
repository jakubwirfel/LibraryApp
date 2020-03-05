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
        <tr class="text-center">
            <td><?php echo $usaersRow['user_name']?></td>
            <td><?php echo $usaersRow['user_email']?></td>
            <td><?php echo $usaersRow['group']?></td>
            <td><a href="#" class="btn btn-danger btn-sm" id="userDelate"><i class="fas fa-trash"></i></a></td>
        </tr>
        <?php }?>
        </tbody>
    </table>
</div>
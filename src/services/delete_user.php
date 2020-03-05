<?php
    $deleteUser = new UserServices($database);
    $deleteUser -> selectAllUsers();
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
        <tr class="text-center">
            <td><?php ?></td>
            <td><?php ?></td>
            <td><?php ?></td>
            <td><a href="#" class="btn btn-primary btn-sm" id="panelCollapse"><i class="fas fa-trash"></i></a></td>
        </tr>
        </tbody>
    </table>
</div>
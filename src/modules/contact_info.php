<?php
try {
    $sql = "SELECT * FROM contacts WHERE group_id LIKE :group";
    $query = $database -> prepare($sql);
    $query -> bindParam(":group", $returned['group']);
    $query->execute();
} catch (PDOException $e) {
    array_push($errors, $e->getMessage());
}
?>
<div class="container-fluid content_container py-1 px-5">
<h6 class="display-4 my-3">Contact to departament</h6>
<fieldset id="Fieldset" class="col-sm-auto" disabled>
    <table class="table table-dark table-hover">
        <thead>
            <tr class="text-center">
                <th>Contact name</th>
                <th>Supervisor</th>
                <th>Email</th>
                <th>Phone</th>
            </tr>
        </thead>
        <tbody>
            <?php
                while($contactRow = $query->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <tr class="text-center user_row">
                <td><?php echo $contactRow['contact_name']?></td>
                <td><?php echo $contactRow['supervisor']?></td>
                <td><?php echo $contactRow['contact_email']?></td>
                <td><?php echo $contactRow['contact_phone']?></td>
            </tr>
            <?php }?>
        </tbody>
    </table>
    </fieldset>
</div>
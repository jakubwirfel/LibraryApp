<?php
try {
    $sql2 = "SELECT * FROM groups";
    $query2 = $database -> prepare($sql2);
    $query2->execute();
} catch (PDOException $e) {
    array_push($errors, $e->getMessage());
}


if (isset($_POST['addContact']) && $_POST['addContact'] == 'AddContact') {
    $contactServices = new ContactServices($database);
    $contactName = trim($_POST['contactName']);
    $supervisor = trim($_POST['supervisor']);
    $phoneNum = trim($_POST['phoneNum']);
    $email = trim($_POST['email']);
    $groupId = trim($_POST['groupId']);
    $contactServices -> addContact($contactName, $supervisor, $phoneNum, $email, $groupId);
}
?>
<div>
    <h6 class="display-4 my-3">Add contact to departament</h6>
    <form action="index.php?admin_panel&panel=add_contact" method="POST">
        <div class="form-group row">
            <label for="inputName" class="col-sm-4 col-form-label">Name of contact</label>
            <div class="col-sm-8">
            <input type="text" name="contactName" class="form-control" id="inputName" placeholder="Name of contact" value="<?php if(isset($_POST['contactName'])) { echo $_POST['contactName'];} else {echo '';}?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="inputSupervisor" class="col-sm-4 col-form-label">Supervisor</label>
            <div class="col-sm-8">
            <input type="text" class="form-control" id="inputSupervisor" placeholder="Supervisor" name="supervisor" value="<?php if(isset($_POST['supervisor'])) { echo $_POST['supervisor'];} else {echo '';}?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="inputPhone" class="col-sm-4 col-form-label">Phone number</label>
            <div class="col-sm-8">
            <input type="text" class="form-control" id="inputPhone" placeholder="Phone number (xxx-xxx-xxx)" name="phoneNum" value="<?php if(isset($_POST['phoneNum'])) { echo $_POST['phoneNum'];} else {echo '';}?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="inputEmail" class="col-sm-4 col-form-label">Email adress</label>
            <div class="col-sm-8">
            <input type="email" class="form-control" id="inputEmail" placeholder="Email adress" name="email" value="<?php if(isset($_POST['email'])) { echo $_POST['email'];} else {echo '';}?>">
            </div>
        </div>
        <div class="form-group row">
                <div class="col">
                    <div class="row">
                        <label for="selectGroup" class="col-sm-4 col-form-label">Contact display for group:</label>
                        <div class="col-sm-8">
                        <select class="form-control" id="selectGroup" name="groupId" >
                        <?php while($groupRow = $query2->fetch(PDO::FETCH_ASSOC)) { ?>
                            <option value="<?php echo $groupRow['id']?>"><?php echo $groupRow['name']?></option>
                        <?php }?>
                        </select>
                        </div>
                    </div>
                </div>
            </div>
        <hr class="my-4">
        <div class="form-group row">
            <div class="col-sm-10">
            <button type="submit" name="addContact" value="AddContact" class="btn btn-primary">Add contact</button>
            </div>
        </div>
    </form>
</div>
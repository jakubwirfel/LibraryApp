<?php
try {
    $sql = "SELECT * FROM users INNER JOIN groups on users.group = groups.id WHERE user_id LIKE :user_id LIMIT 1";
    $query = $database -> prepare($sql);
    $query -> bindParam(":user_id", $_SESSION['user_session']);
    $query->execute();
} catch (PDOException $e) {
    array_push($errors, $e->getMessage());
}
    while($usersRow = $query->fetch(PDO::FETCH_ASSOC)) {
?>
<div class="container-fluid content_container py-1 px-5">
<h6 class="display-4 my-3">My account informations</h6>
<fieldset id="Fieldset" class="col-sm-auto" disabled>
        <div class="form-group row">
            <div class="col">
                <div class="row">
                    <label for="inputFirstName" class="col-sm-auto col-form-label">First name</label>
                    <div class="col-sm">
                        <input type="text" name="firstName" class="form-control" id="inputFirstName" value="<?php echo $usersRow['first_name']?>">
                    </div>
                </div>
            </div>
            <div class="col ">
            <div class="row">
                    <label for="inputLastName" class="col-sm-auto col-form-label">Last name</label>
                    <div class="col-sm">
                        <input type="text" name="lastName" class="form-control" id="inputLastName" value="<?php echo $usersRow['last_name']?>">
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col">
                <div class="row">
                    <label for="inputEmail" class="col-sm-auto col-form-label">Email</label>
                    <div class="col-sm">
                        <input type="email" name = "email" class="form-control" id="inputEmail" value="<?php echo $usersRow['user_email']?>">
                    </div>
                </div>
            </div>
            <div class="col ">
            <div class="row">
                    <label for="inputPhone" class="col-sm-auto col-form-label">Phone num.</label>
                    <div class="col-sm">
                        <input type="text" name ="phone" class="form-control" id="inputPhone" value="<?php echo $usersRow['phone_num']?>">
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col">
                <div class="row">
                    <label for="inputPostCode" class="col-sm-auto col-form-label">Post. code / City</label>
                    <div class="col-sm-3">
                        <input type="text" name="postCode" class="form-control" id="inputPostCode" value="<?php echo $usersRow['post_code']?>">
                    </div>
                    <div class="col-sm">
                        <input type="text" name="city" class="form-control"  value="<?php echo $usersRow['city']?>">
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col">
                <div class="row">
                    <label for="inputStreet" class="col-sm-auto col-form-label">Street / House. num</label>
                    <div class="col-sm">
                        <input type="text" name="street" class="form-control"  id="inputStreet" value="<?php echo $usersRow['street']?>">
                    </div>
                    <div class="col-sm-2">
                        <input type="text" name="houseNum"class="form-control" value="<?php echo $usersRow['house_num']?>">
                    </div>
                </div>
            </div>
        </div>
        <hr class="my-4">
        <div class="form-group row">
            <div class="col">
                <div class="row">
                    <label for="inputPwdDate" class="col-sm-auto col-form-label">Last password change </label>
                    <div class="col-sm">
                        <input disabled type="text" class="form-control" id="inputPwdDate" placeholder="<?php echo $usersRow['user_pwd_change_date']?>">
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col">
                <div class="row">
                    <label for="inputGroup" class="col-sm-auto col-form-label">User group</label>
                    <div class="col-sm-2">
                        <input type="text" name="group" class="form-control" id="inputGroup" value="<?php echo $usersRow['group']?>">
                    </div>
                    <div class="col-sm">
                        <input disabled type="text" class="form-control" id="inputEmail3" placeholder="<?php switch($usersRow['group']){case 1: echo "User"; break;
                                                                                                                                        case 2: echo "Moderator"; break;
                                                                                                                                        case 3: echo "Admin"; break;} ?>">
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col">
                <div class="row">
                    <label for="inputUsername" class="col-sm-auto col-form-label">Username</label>
                    <div class="col-sm">
                        <input type="text" name="userName" class="form-control" id="inputUsername" value="<?php echo $usersRow['user_name']?>">
                    </div>
                </div>
            </div>
        </div>
    </fieldset>
</div>
<?php }?>
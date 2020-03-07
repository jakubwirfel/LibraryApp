<?php
$addNewUser = new UserServices($database);

if (isset($_POST['add_user'])) {
    $userName = trim($_POST['user_name']);
    $userEmail = trim($_POST['email']);
    $password = trim($_POST['password']);
    $passwordRepet = trim($_POST['password_repet']);

    $addNewUser -> usernameValidation($userName);
    $addNewUser -> emailValidation($userEmail);
    $addNewUser -> passwordValidation($password, $passwordRepet);

    if ($valid_name == true && $valid_password == true &&  $valid_email == true) {
        $password_hashed = password_hash($password, PASSWORD_DEFAULT);
        $pwdChange = trim($_POST['password_change']);
        $group = trim($_POST['group']);
        $addNewUser -> addUser($userName, $userEmail, $password_hashed, $pwdChange, $group);
        unset($accept_password);
        array_push($errors, "User added");
    } else {
        array_push($errors, "User cannot be added");
    }

}
?>
<div id="add_user">
    <form action="index.php?admin_panel&panel=add_user" method="POST">
    <div class="form-group row">
        <label for="inputUsername" class="col-sm-4 col-form-label">Nazwa użytkownika</label>
        <div class="col-sm-8">
        <input type="text" name="user_name" class="form-control" id="inputUsername" placeholder="Nazwa użytkownika" value="<?php if(isset($_POST['user_name'])) { echo $_POST['user_name'];} else {echo '';}?>">
        </div>
    </div>
    <div class="form-group row">
        <label for="inputEmail" class="col-sm-4 col-form-label">Email</label>
        <div class="col-sm-8">
        <input type="email" class="form-control" id="inputEmail" placeholder="Email" name="email" value="<?php if(isset($_POST['email'])) { echo $_POST['email'];} else {echo '';}?>">
        </div>
    </div>
    <div class="form-group row">
        <label for="inputPassword" class="col-sm-4 col-form-label">Hasło</label>
        <div class="col-sm-8">
        <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Hasło">
        </div>
    </div>
    <div class="form-group row">
        <label for="inputPassword2" class="col-sm-4 col-form-label"></label>
        <div class="col-sm-8">
        <input type="password" name="password_repet" class="form-control" id="inputPassword2" placeholder="Powtórz hasło">
        </div>
    </div>

    <div class="form-group form-check">
    <input type="hidden" value="0" name="password_change">
    <input type="checkbox" class="form-check-input" id="PwdChange" value="1" name="password_change">
    <label class="form-check-label checkbox" for="PwdChange">Użytkownik musi zmienić hasło przy logowaniu</label>
  </div>
    <fieldset class="form-group">
        <div class="row">
        <legend class="col-form-label col-sm-3 pt-0">Grupa </legend>
        <div class="col-sm-9">
            <div class="form-check">
            <input class="form-check-input" type="radio" name="group" id="standard" value="1" checked>
            <label class="form-check-label" for="standard">
                Użytkownik standardowy
            </label>
            </div>
            <div class="form-check">
            <input class="form-check-input" type="radio" name="group" id="moderator" value="2">
            <label class="form-check-label" for="moderator">
                Moderator
            </label>
            </div>
            <div class="form-check disabled">
            <input class="form-check-input" type="radio" name="group" id="admin" value="3">
            <label class="form-check-label" for="admin">
                Administrator
            </label>
            </div>
        </div>
        </div>
    </fieldset>
    <div class="form-group row">
        <div class="col-sm-10">
        <button type="submit" name="add_user" value="AddUser" class="btn btn-primary">Dodaj użytkownika</button>
        </div>
    </div>
    </form>
</div>
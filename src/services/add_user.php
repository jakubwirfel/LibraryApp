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
        $firstName = trim($_POST['firstName']);
        $lastName = trim($_POST['lastName']);
        $postCode = trim($_POST['postCode']);
        $city = trim($_POST['city']);
        $street = trim($_POST['street']);
        $houseNum = trim($_POST['houseNum']);
        $phoneNum = trim($_POST['phoneNum']);
        $addNewUser -> addUser($userName, $userEmail, $password_hashed, $pwdChange, $group, $firstName, $lastName, $postCode, $city, $street, $houseNum, $phoneNum);
        unset($accept_password);
        array_push($errors, "User $userName added");
    } else {
        array_push($errors, "User cannot be added");
    }

}
?>
<div class="container-fluid content_container py-1 px-5">
<h6 class="display-4 my-3">Add user</h6>
    <form action="" method="POST">
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
    <hr class="my-4">
    <div class="form-group row">
            <div class="col">
                <div class="row">
                    <label for="inputFirstName" class="col-sm-auto col-form-label">Imię</label>
                    <div class="col-sm">
                        <input type="text" name="firstName" class="form-control" placeholder="Imię" id="inputFirstName" value="<?php if(isset($_POST['firstName'])) { echo $_POST['firstName'];} else {echo '';}?>">
                    </div>
                </div>
            </div>
            <div class="col ">
            <div class="row">
                    <label for="inputLastName" class="col-sm-auto col-form-label">Nazwisko</label>
                    <div class="col-sm">
                        <input type="text" name="lastName" class="form-control" placeholder="Nazwisko" id="inputLastName" value="<?php if(isset($_POST['lastName'])) { echo $_POST['lastName'];} else {echo '';}?>">
                    </div>
                </div>
            </div>
    </div>
    <div class="form-group row">
            <div class="col">
                <div class="row">
                    <label for="inputPostCode" class="col-sm-4 col-form-label">Post. code / City</label>
                    <div class="col-sm-2">
                        <input type="text" name="postCode" class="form-control" placeholder="Kod poczty" id="inputPostCode" value="<?php if(isset($_POST['postCode'])) { echo $_POST['postCode'];} else {echo '';}?>">
                    </div>
                    <div class="col-sm-6">
                        <input type="text" name="city" class="form-control"  placeholder="Miasto" value="<?php if(isset($_POST['city'])) { echo $_POST['city'];} else {echo '';}?>">
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col">
                <div class="row">
                    <label for="inputStreet" class="col-sm-4 col-form-label">Street / House. num</label>
                    <div class="col-sm-6">
                        <input type="text" name="street" class="form-control" placeholder="Ulica (xxxxxxx)" id="inputStreet" value="<?php if(isset($_POST['street'])) { echo $_POST['street'];} else {echo '';}?>">
                    </div>
                    <div class="col-sm-2">
                        <input type="text" name="houseNum"class="form-control"placeholder="Nr domu" value="<?php if(isset($_POST['houseNum'])) { echo $_POST['houseNum'];} else {echo '';}?>">
                    </div>
                </div>
            </div>
        </div>
    <div class="form-group row">
        <label for="inputPhoneNum" class="col-sm-4 col-form-label">Numer telefonu</label>
        <div class="col-sm-8">
        <input type="text" class="form-control" id="inputPhoneNum" placeholder="Numer telefonu (xxx-xxx-xxx)" name="phoneNum" value="<?php if(isset($_POST['phoneNum'])) { echo $_POST['phoneNum'];} else {echo '';}?>">
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
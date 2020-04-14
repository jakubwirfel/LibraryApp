<?php
// Include necessary file
require_once('./src/include/start.inc.php');

$user_pwd_change = new ChangePwd($database);

// Check if user is already logged in
if ($user->is_logged_in()) {
    // Redirect logged in user to their home page
    $user->redirect('index.php');
}

// Check if log-in form is submitted
if (isset($_POST['change_password'])) {
    // Retrieve form input
    $new_user_password = trim($_POST['new_user_password']);
    $new_user_password_repet = trim($_POST['new_user_password_repet']);
    $user_pwd_change -> passwordValidation($new_user_password, $new_user_password_repet);
    if ($valid_password == 1) {
      $password_hashed = password_hash($new_user_password, PASSWORD_DEFAULT);
      $user_pwd_change -> change_password($password_hashed);
      $user->redirect('login.php');
      unset($accept_password);
    } else {
      array_push($errors, "Password cannot be change");
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Library APP / Change password</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="./public/css/login.css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css"
      rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    </head>
<body>
  <main class="container">
    <div class="d-flex justify-content-center h-100">
      <div class="card">
        <div class="card-header">
          <h3>Change password</h3>
          <div class="d-flex justify-content-end align-items-center rounded-pill lib_container">
            <img src="https://icons-for-free.com/iconfiles/png/512/bookshelf+library+icon-1320087270870761354.png" alt="..." width="65" class="mr-3 rounded-circle img-thumbnail shadow logo">
            <h3 class="m-0 lib_name">Biblioteka WSB Toruń</h3>
				</div>
        </div>
        <div class="card-body">
          <form action="change_password.php" method="POST">
            <div class="input-group form-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-key"></i></span>
              </div>
              <input type="password" name="new_user_password" class="form-control" placeholder="New password" required>
            </div>
            <div class="input-group form-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-key"></i></span>
              </div>
						<input type="password" name="new_user_password_repet" class="form-control" placeholder="New password" required>
					</div>
            <div class="form-group">
						<input type="submit" name="change_password" value="Change" class="btn float-right login_btn">
					</div>
          </form>
			</div>
      </div>
      <?php if (!$errors < 1): ?>
      <div class="errors_box">
          <?php foreach ($errors as $error): ?>
              <p><?= $error ?></p>
          <?php endforeach ?>
      </div>
      <?php endif ?>
    </div>
  </main>
</body>
</html>
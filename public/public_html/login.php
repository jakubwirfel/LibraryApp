<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Library APP / Login</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../css/login.css">
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
          <h3>Sign In</h3>
          <div class="d-flex justify-content-end align-items-center rounded-pill lib_container">
            <img src="https://icons-for-free.com/iconfiles/png/512/bookshelf+library+icon-1320087270870761354.png" alt="..." width="65" class="mr-3 rounded-circle img-thumbnail shadow logo">
            <h3 class="m-0 lib_name">Biblioteka WSB Toruń</h3>
				  </div>
        </div>
        <div class="card-body">
          <form action="index.php">
            <div class="input-group form-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-user"></i></span>
              </div>
              <input type="text" class="form-control" placeholder="username">
            </div>
            <div class="input-group form-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-key"></i></span>
              </div>
						  <input type="password" class="form-control" placeholder="password">
					  </div>
            <div class="form-group">
						  <input type="submit" value="Login" class="btn float-right login_btn">
					  </div>
          </form>
        </div>
        <div class="card-footer">
          <div class="d-flex justify-content-center">
            <a href="#" class="pwd_forgot">Forgot your password?</a>
          </div>
			  </div>
      </div>
      <div class="errors_box">
          <p>consequatur adipisci facere distinctio ratione numquam animi omnis qui quidem ad tenetur officiis!</p>
      </div>
    </div>
  </main>
</body>
</html>
<?php
session_start();
include "koneksi.php";
	
	$username = "admin";
	$password = "password";
	$error_message = "";
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if ($_POST["username"] == $username && $_POST["password"] == $password) {
			$_SESSION["username"] = $username;
			header("Location: read.php");
			exit();
		} else {
			$error_message = "Username atau password salah";
		}
	}
?>
<html>
  <head>
    <title>Login Page</title>
    <!-- Tambahkan link CSS untuk Bootstrap -->
    <link
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    />
  </head>
  <body style="background-color: black;">
    <div class="container">
      <div class="row">
        <div class="col-md-6 mx-auto mt-5">
          <div class="card">
            <div class="card-header">
              <h3 class="mb-0" style="text-align: center;">Login</h3>
            </div>
			<div style="text-align: center;">
                <img src="../FSWD1-arkatama-php-4/assets/rusa.png" width="300" height="300">
            </div>
            <div class="card-body">
              <form class="form" role="form" method="POST" action="login.php">
                <div class="form-group">
                  <label for="username">Username:</label>
                  <input type="text" class="form-control" id="username" name="username" required/>
                </div>
                <div class="form-group">
                  <label for="password">Password:</label>
                  <input type="password" class="form-control" id="password" name="password" required/>
                </div>
				<div><p class="error" style="text-align: center;"><?php echo $error_message ?></p></div>
				<a href="lupa_password.php" class="mr-2">Lupa Password?</a><br><br>
                <button type="submit" class="btn btn-success btn-md float-right">Login</button>
				<a href="login.html" class="btn btn-primary btn-md float-right mr-2">Kembali</a>
				
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Tambahkan script untuk Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  </body>
</html>
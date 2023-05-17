<?php 
 
include 'koneksi.php';
 
error_reporting(0);
 
session_start();
 
if (isset($_SESSION['name'])) {
    header("Location: loginsukses.php");
}
if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
  
    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $sql);
    if ($result->num_rows > 0) {
        $row = mysqli_fetch_array($result);
        $_SESSION['name'] = $row['name'];
        header("Location: loginsukses.php");
    } else {
        echo "<script>alert('Email atau password Anda salah. Silahkan coba lagi!')</script>";
    }
}

 
?>
 
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
 
    <link rel="stylesheet" type="text/css" href="./CSS/style2.css">
 
    <title>Arkatama_Store</title>
</head>
<body>
    <div class="alert alert-warning" role="alert">
        <?php echo $_SESSION['name']?>
    </div>
 
    <div class="container">
        <form action="" method="POST" class="login-email">
            <p class="login-text" style="font-size: 2rem; font-weight: 800;">Login</p>
            <div class="input-group">
                <input type="email" placeholder="Email" name="email">
            </div>
            <div class="input-group">
            <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password" aria-describedby="password-addon">
            </div>
            <div class="input-group">
                <button name="submit" class="btn">Login</button>
                <br>
                <div><p class="error" style="text-align: center;"><?php echo $error_message ?></p></div>
				<a href="lupa_password.php" class="btn">Lupa Password?</a><br><br>
            </div>
    </div>
</body>
</html>
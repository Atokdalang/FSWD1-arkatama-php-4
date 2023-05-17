<!DOCTYPE html>
<html>
<head>
	<title>Lupa Password</title>
	<!-- Tambahkan link CSS untuk Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"/>
</head>
<body style="background-color: black">
<div class="container">
      <div class="row">
        <div class="col-md-6 mx-auto mt-5">
          <div class="card">
            <div class="card-header">
				<h2 style="text-align: center;">Lupa Password</h2>
				<hr>
				<?php 
				// Jika form disubmit
				if(isset($_POST['submit'])){
					// Validasi email
					if(empty($_POST['email'])){
						$error_message = "Email harus diisi";
					} else {
						$email = $_POST['email'];
						// Cek apakah email valid
						if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
							$error_message = "Email tidak valid";
						} else {
							// Proses reset password
							// (implementasi reset password disini)
							$success_message = "Link reset password telah dikirim ke email anda";
						}
					}
				}
				?>
				<?php if(isset($error_message)): ?>
					<div class="alert alert-danger"><?php echo $error_message; ?></div>
				<?php endif; ?>
				<?php if(isset($success_message)): ?>
					<div class="alert alert-success"><?php echo $success_message; ?></div>
				<?php endif; ?>
				<form method="POST">
					<div class="form-group">
						<label for="email">Email:</label>
						<input type="email" class="form-control" id="email" name="email" required>
					</div>
					<center><button type="submit" class="btn btn-dark btn-block btn-lg" name="submit">Reset Password</button></center>
				</form>
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

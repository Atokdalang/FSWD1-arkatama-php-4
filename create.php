<?php
require_once 'koneksi.php';

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $role = $_POST['role'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $avatar = $_FILES['avatar'];

    // Check if a file is selected for upload
    if ($avatar['name'] != '') {
        // Specify the directory to which the file will be uploaded
        $targetDir = 'assets/';

        // Generate a unique name for the uploaded file
        $uniqueName = uniqid() . '_' . $avatar['name'];

        // Set the path of the uploaded file
        $targetFilePath = $targetDir . $uniqueName;

        // Move the uploaded file to the destination directory
        if (move_uploaded_file($avatar['tmp_name'], $targetFilePath)) {
            // File upload success, insert the user data into the database
            $query = "INSERT INTO users (name, role, password, email, phone, address, avatar) VALUES ('$name', '$role', '$password', '$email', '$phone', '$address', '$uniqueName')";

            if ($conn->query($query) === TRUE) {
                header('location: read.php');
                exit();
            } else {
                echo 'Gagal menambahkan pengguna: ' . $conn->error;
            }
        } else {
            echo 'Gagal mengunggah file.';
        }
    } else {
        // File not selected for upload, insert the user data into the database without the avatar
        $query = "INSERT INTO users (name, role, password, email, phone, address) VALUES ('$name', '$role', '$password', '$email', '$phone', '$address')";

        if ($conn->query($query) === TRUE) {
            header('location: read.php');
            exit();
        } else {
            echo 'Gagal menambahkan pengguna: ' . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <style>
      .container-custom {
        width: 97%; /* Atur lebar container sesuai kebutuhan */
        margin: 0 auto; /* Pusatkan container secara horizontal */
      }
    </style>
    <title>Tambah Pengguna</title>

</head>
<body>
<nav class="navbar navbar-expand-lg bg-dark Shadow-lg Sticky-top">
<div class="container-custom">
  <h1 style="color:white"><img src="./assets/database.png" width="30" alt=""> Tambah Pengguna </h1>
  </div>
</nav>
<br>
<form action="" method="post" enctype="multipart/form-data">
    <div class="col-md-11 mx-auto">
        <div class="form-group">
            <label for="name">Nama</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan Nama" required>
        </div>
        <div class="row align-items-end">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="role" class="form-label">Role</label>
                    <select class="form-control" id="role" name="role" required>
                        <option value="">Pilih Role Pengguna</option>
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password" required>
                        <button class="btn btn-primary" type="button" id="password-addon"><i class="bi bi-eye"></i> Lihat</button>
                    </div>
                </div>
                <script>
                    function togglePasswordVisibility() {
                        const passwordInput = document.querySelector('#password');
                        const passwordAddon = document.querySelector('#password-addon');
                        const passwordText = document.querySelector('#password-text');
                        passwordAddon.addEventListener("click", function(){
                            if (passwordInput.type === 'password') {
                                passwordInput.type = 'text';
                                passwordText.textContent = ' Sembunyikan Password';
                            } else {
                                passwordInput.type = 'password';
                                passwordText.textContent = ' Lihat';
                            }
                        });
                    }
    togglePasswordVisibility();
            </script>
        </div>
    </div>
    <div class="row align-items-end">
        <div class="col-md-6">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan Email" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="phone" class="form-label">Nomor Telepon</label>
                <input type="tel" class="form-control" id="phone" name="phone" placeholder="Masukkan Nomor Telepon Anda" required>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="address">Alamat Lengkap</label>
        <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
    </div>
    <div class="form-group">
        <label for="avatar">Unggah Foto:</label><br>
        <input type="file" name="avatar" id="avatar" required><br><br>
    </div>
    <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
    <a href="read.php" class="btn btn-secondary">Batal</a>
</div>
</form>
</body>
</html>
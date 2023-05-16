<!DOCTYPE html>
<html lang="en">
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
<style>
      .container-custom {
        width: 97%; /* Atur lebar container sesuai kebutuhan */
        margin: 0 auto; /* Pusatkan container secara horizontal */
      }
    </style>    
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Document</title>
</head>
<body>
<?php
// koneksi ke database
require_once 'koneksi.php';

// ambil data dari database berdasarkan id
if (isset($_GET['id'])) {
  $id = $_GET['id'];

  $query = "SELECT * FROM users WHERE id = '$id'";
  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_array($result);
  } else {
    echo "Data tidak ditemukan.";
    exit();
  }
}

// fungsi untuk update data ke tabel users
if (isset($_POST['submit'])) {
  $id = $_POST['id'];
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
      $update = "UPDATE users SET name='$name', role='$role', password='$password', email='$email', phone='$phone', address='$address', avatar='$uniqueName' WHERE id='$id'";

      if (mysqli_query($conn, $update)) {
        echo "Data berhasil diperbarui";
        header('location: read.php');
        exit();
      } else {
        echo "Gagal memperbarui data: " . mysqli_error($conn);
      }
    } else {
      echo "Upload gagal!";
    }
  } else {
    // Jika tidak ada file yang diunggah, lakukan update data tanpa mengubah avatar
    $update = "UPDATE users SET name='$name', role='$role', password='$password', email='$email', phone='$phone', address='$address' WHERE id='$id'";

    if (mysqli_query($conn, $update)) {
      echo "Data berhasil diperbarui";
      header('location: read.php');
      exit();
    } else {
      echo "Gagal memperbarui data: " . mysqli_error($conn);
    }
  }
}
?>

<nav class="navbar navbar-expand-lg bg-dark Shadow-lg Sticky-top">
<div class="container-custom">
  <h1 style="color:white"><img src="./assets/database.png" width="30" alt=""> Edit Data Pengguna </h1>
  </div>
</nav>
<br>
<form action="" method="post" enctype= "multipart/form-data">
<?php if(isset($row)): ?>
  <input type="hidden" name="id" value="<?= $row['id'] ?>">
<?php endif; ?>
    <div class="col-md-11 mx-auto">
      <div class="form-group">
        <label for="name">Nama</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan Nama">
      </div>
      <div class="row align-items-end">
  <div class="col-md-6">
    <div class="form-group">
      <label for="role" class="form-label">Role</label>
      <select class="form-control" id="role" name="role">
      <option selected>Pilih Role Pengguna</option>
      <option value="admin" <?php if (isset($row['role']) && $row['role'] == 'admin') echo 'selected' ?>>Admin</option>
              <option value="user" <?php if (isset($row['role']) && $row['role'] == 'user') echo 'selected' ?>>User</option>
      </select>
    </div>
  </div>
  <div class="col-md-6">
  <div class="form-group">
  <label for="password">Password</label>
  <div class="input-group">
    <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password" aria-describedby="password-addon">
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
            <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan Email">
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
    <textarea class="form-control" id="address" name="address" rows="3"></textarea>
  </div>
      <div class="form-group">
          <label for="avatar">Unggah Foto:</label><br>
          <input type="file" name="avatar" id="avatar"><br><br>
      </div>
      <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
      <a href="read.php" class="btn btn-secondary">Batal</a>
    </div>
  </div>
</form>
</body>
</html>
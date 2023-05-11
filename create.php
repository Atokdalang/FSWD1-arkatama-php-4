<!DOCTYPE html>
<html lang="en">
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
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
  $alamat = $_POST['alamat'];

  $update = "UPDATE users SET name='$name', email='$email', phone='$phone', role='$role' WHERE id='$id'";

  if (mysqli_query($conn, $update)) {
    echo "Data berhasil diperbarui";
    header('location: read.php');
  } else {
    echo "Gagal memperbarui data: " . mysqli_error($conn);
  }
}

?>

<h1>Tambah Pengguna</h1>

<hr>

<form action="" method="post">
  <input type="hidden" name="id" value="<?= $row['id'] ?>">
  <div class="row">
    <div class="col-md-11 mx-auto">
      <div class="form-group">
        <label for="inputName">Nama</label>
        <input type="text" class="form-control" id="inputName" placeholder="Masukkan Nama">
      </div>
      <div class="row align-items-end">
  <div class="col-md-6">
    <div class="form-group">
      <label for="role" class="form-label">Role</label>
      <select class="form-select" id="role" name="role">
        <option value="admin" <?php if ($row['role'] == 'admin') echo 'selected' ?>>Admin</option>
        <option value="user" <?php if ($row['role'] == 'user') echo 'selected' ?>>User</option>
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
            <label for="inputEmail">Email</label>
            <input type="email" class="form-control" id="inputEmail" placeholder="Masukkan Email">
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
    <label for="inputAddress">Alamat Lengkap</label>
    <textarea class="form-control" id="inputAddress" rows="3"></textarea>
  </div>
      <div class="form-group">
        <form action="upload.php" method="post" enctype="multipart/form-data">
          <label for="foto">Unggah Foto:</label><br>
          <input type="file" name="foto" id="foto"><br><br>
        </form>
      </div>
      <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
      <a href="read.php" class="btn btn-secondary">Batal</a>
    </div>
  </div>
</form>
</body>
</html>
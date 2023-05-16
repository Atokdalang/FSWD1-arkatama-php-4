<html>
  <head>
    <title>Data Pengguna</title> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css"/>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>

    <style>
      .container-custom {
        width: 97%; /* Atur lebar container sesuai kebutuhan */
        margin: 0 auto; /* Pusatkan container secara horizontal */
      }
    </style>
  </head>
  <body>
    <?php
    session_start();

    if (!isset($_SESSION['username'])) {
      header('Location: login.php');
      exit;
    }
      // koneksi ke database
      require_once 'koneksi.php';

      // query untuk menampilkan data
      $query = "SELECT * FROM users";

      // eksekusi query
      $result = mysqli_query($conn, $query);

      if (!$result) {
        die("Query error: " . mysqli_error($conn));
      }
    ?>

<nav class="navbar navbar-expand-lg bg-dark Shadow-lg Sticky-top">
<div class="container">
<h1 style="color:white"><img src="./assets/database.png" width="30" alt=""> Data Pengguna </h1>
<div><a href="read.php" class="btn btn-secondary float-right">Kembali</a></div>
  </div>
</nav>
<br>
    <!-- Tampilkan Data -->
    <div class="container-custom">
      <table id="myTable" class="table-striped">
        <thead>
          <tr>
            <th>#</th>
            <th>Avatar</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Role</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = mysqli_fetch_array($result)) { ?>
            <tr>
              <td><?= $row['id'] ?></td>
              <td><img src="assets/<?= $row['avatar']; ?>" alt="Avatar" width="50">'</td>
              <td><?= $row['name'] ?></td> 
              <td><?= $row['email'] ?></td>
              <td><?= $row['phone'] ?></td> 
              <td><?= $row['role'] ?></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>

    <!-- Inisialisasi DataTables -->
    <script>
      $(document).ready(function () {
        $('#myTable').DataTable();
      });
    </script>
  </body>
</html>

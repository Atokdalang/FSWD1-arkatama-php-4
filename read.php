<html>
  <head>
    <title>Data Pengguna</title> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <link rel="stylesheet" href="../PHP/CSS/style.css">
  </head>
  <body>
    
  <?php
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

<h1>Data Pengguna</h1>

<hr>

<!-- Tampilkan Data -->
<table id="myTable">
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
        <td><?php echo '<img src="../PHP/assets/avatar.png" width="50">' ?> </td>
        <td><?= $row['name'] ?></td> 
        <td><?= $row['email'] ?></td>
        <td><?= $row['phone'] ?></td> 
        <td><?= $row['role'] ?></td>
      </tr>
        <?php } ?>
      </tbody>
    </table>

    <!-- Inisialisasi DataTables -->
    <script>
      $(document).ready( function () {
        $('#myTable').DataTable();
      });
    </script>

  </body>
</html>

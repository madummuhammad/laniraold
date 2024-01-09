<?php 

session_start();
if (isset($_SESSION['id']) && isset($_SESSION['username'])) {
    ?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>DND</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
    
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php include "include/sidebar.php" ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <!-- Main content -->
  <?php 

  include "../config/conn.php";

  $query_pelanggan = "SELECT COUNT(*) AS total_pelanggan FROM members";
  $result_pelanggan = mysqli_query($conn, $query_pelanggan);
  $data_pelanggan = mysqli_fetch_assoc($result_pelanggan);
  $total_pelanggan = $data_pelanggan['total_pelanggan'];

  $query_produk = "SELECT COUNT(*) AS total_produk FROM products";
  $result_produk = mysqli_query($conn, $query_produk);
  $data_produk = mysqli_fetch_assoc($result_produk);
  $total_produk = $data_produk['total_produk'];

  $query_total_belanja = "SELECT SUM(total) AS total_belanja FROM orders";
  $result_total_belanja = mysqli_query($conn, $query_total_belanja);
  $data_total_belanja = mysqli_fetch_assoc($result_total_belanja);
  $total_belanja = $data_total_belanja['total_belanja'];


  ?>
  <div class="content">
  <div class="container-fluid">
    <br>
    <h3>Dashboard</h3>
    <div class="row">
      <div class="col-md-4">
        <div class="card" style="background-color: purple;">
          <div class="card-body">
            <h5 class="card-title text-white">Total Pelanggan</h5>
            <p class="card-text text-white">Jumlah pelanggan: <?php echo $total_pelanggan; ?></p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card" style="background-color: purple;">
          <div class="card-body">
            <h5 class="card-title text-white">Total Produk</h5>
            <p class="card-text text-white">Jumlah produk: <?php echo $total_produk; ?></p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card" style="background-color: purple;">
          <div class="card-body">
            <h5 class="card-title text-white">Total Pesanan</h5>
            <p class="card-text text-white">Jumlah pesanan: Rp. <?php echo number_format($total_belanja); ?></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

  <!-- /.content -->
</div>

  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy;2023
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/dist/js/adminlte.min.js"></script>
</body>
</html>
<?php 
}else{
    echo "<script>alert('Silahkan Login terlebih dahulu');</script>";
    echo "<script>location='login.php';</script>";
}
?>

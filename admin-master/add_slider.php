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
      <div class="content">
        <div class="container-fluid"><br>
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                 <h3>Add Slider</h3>
                 <form action="proses/proses_insert_slider.php" method="post" enctype="multipart/form-data">
                   <div id="item-form">
                    <br>
                    
                    <div class="form-group">
                      <label for="inputDescription">Gambar Slider</label>
                      <input type="file" class="form-control" name="img">
                    </div>
                    
                    <div class="d-flex justify-content-between">
                      <button type="submit" class="btn btn-success">Insert Slider</button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.card-header -->
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

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
<script type="text/javascript">
  $(document).ready(function() {
    $("#add-row").click(function() {
      var newRow = '<tr>' +
      '<td><input type="text" class="form-control" name="size[]"></td>' +
      '<td><input type="number" class="form-control" name="stok[]"></td>' +
      '<td><input type="number" class="form-control" name="price[]"></td>' +
      '</tr>';
      $("table").append(newRow);
    });
  });
</script>
<script type="text/javascript">
  $(function() {
    $('#row_dim').hide(); 
    $('#type_select').change(function(){
      if($('#type_select').val() == 'PO') {
        $('#row_dim').show(); 
      } else {
        $('#row_dim').hide(); 
      } 
    });
  });
</script>

<?php 

session_start();
if (isset($_SESSION['id']) && isset($_SESSION['username'])) {
  ?>
  <!DOCTYPE html>
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


  <style type="text/css">
      table {
        border-collapse: collapse;
        width: 100%;
      }

      thead {
        background-color: #f2f2f2;
      }

      th, td {
        text-align: left;
        padding: 8px;
      }

      tr:nth-child(even) {
        background-color: #f2f2f2;
      }

      a {
        color: #007bff;
      }

      .pagination {
        margin-top: 20px;
        display: flex;
        justify-content: center;
      }

      .page-item {
        margin: 0 5px;
      }

      .page-item.active .page-link {
        background-color: #007bff;
        border-color: #007bff;
      }

      .page-link {
        color: #007bff;
        background-color: #fff;
        border: 1px solid #dee2e6;
        border-radius: 0.25rem;
        padding: 0.375rem 0.75rem;
        transition: all 0.3s ease-in-out;
      }

      .page-link:hover {
        color: #fff;
        background-color: #007bff;
        border-color: #007bff;
      }

      .page-link:focus {
        color: #fff;
        background-color: #007bff;
        border-color: #007bff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
      }

      .page-item.disabled .page-link {
        color: #6c757d;
        background-color: #fff;
        border-color: #dee2e6;
      }

      .page-item.disabled .page-link:hover {
        color: #6c757d;
        background-color: #fff;
        border-color: #dee2e6;
      }

      .page-item:first-child .page-link {
        border-top-left-radius: 0.25rem;
        border-bottom-left-radius: 0.25rem;
      }

      .page-item:last-child .page-link {
        border-top-right-radius: 0.25rem;
        border-bottom-right-radius: 0.25rem;
      }

    </style>
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
                  <a class="btn btn-primary" href="add_slider.php" role="button">Add Slider</a>
                  <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                      <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                      <div class="input-group-append">
                        <button type="submit" class="btn btn-default">
                          <i class="fas fa-search"></i>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">

                  <?php
                    include "../config/conn.php";
                    $per_page = 10; 
                    $page = isset($_GET['page']) ? $_GET['page'] : 1;
                    $start = ($page - 1) * $per_page;

                    $query = "SELECT * FROM slider LIMIT $start, $per_page";
                    $result = mysqli_query($conn, $query);

                    $total = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM slider"));
                    $pages = ceil($total / $per_page);
                    ?>

                  <table class="table table-hover text-nowrap">
                    <thead>
                      <tr>
                        <th>Image</th>
                        <th>Edit</th>
                      </tr>
                    </thead>
                     <tbody>
                        <?php while ($data = mysqli_fetch_array($result)) { ?>
                          <tr>
                            <td><img src="fotoslider/<?php echo $data['gambar']; ?>" class="img-fluid" alt="Image" style="width: 150px;"></td>
                            <td><a href="edit_slider.php?id=<?=$data['id']?>">Edit</a> || <a href="proses/delete_slider.php?id=<?=$data['id']?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</a></td>
                          </tr>
                        <?php } ?>
                      </tbody>
                  </table>

                  <nav aria-label="Page navigation example">
                      <ul class="pagination">
                        <?php if ($page > 1) { ?>
                          <li class="page-item">
                            <a class="page-link" href="?page=<?php echo $page - 1 ?>" aria-label="Previous">
                              <span aria-hidden="true">&laquo;</span>
                              <span class="sr-only">Previous</span>
                            </a>
                          </li>
                        <?php } ?>

                        <?php for ($i = 1; $i <= $pages; $i++) { ?>
                          <li class="page-item <?php if ($i == $page) echo 'active' ?>"><a class="page-link" href="?page=<?php echo $i ?>"><?php echo $i ?></a></li>
                        <?php } ?>

                        <?php if ($page < $pages) { ?>
                          <li class="page-item">
                            <a class="page-link" href="?page=<?php echo $page + 1 ?>" aria-label="Next">
                              <span aria-hidden="true">&raquo;</span>
                              <span class="sr-only">Next</span>
                            </a>
                          </li>
                        <?php } ?>
                      </ul>
                    </nav>
                </div>
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

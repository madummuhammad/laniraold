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

    <script src="https://cdn.tiny.cloud/1/3m2ggekyc02yk5n2gkgkor3ctoxya9w6dulhtl2vfezzjjfx/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
      tinymce.init({
        selector: '#inputDescription'
      });
    </script>

  </head>
  <body class="hold-transition sidebar-mini">
    <div class="wrapper">
      <?php include "include/sidebar.php" ?>
      <?php $page = isset($_GET['page']) ? $_GET['page'] : 1; ?>
      <div class="content-wrapper">
        <!-- Main content -->
        <div class="content">
          <div class="container-fluid"><br>
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                   <h3>Add Product</h3>
                   <form action="proses/proses_insert.php?page=<?php echo $page ?>" method="post" enctype="multipart/form-data">
                     <div id="item-form">
                      <br>
                      <div class="form-group">
                        <label for="inputName">Nama Produk</label>
                        <input type="text" id="inputName" class="form-control" name="name_produk" required>
                      </div>
                      <div class="form-group">
                        <label for="inputName">Link Katalog</label>
                        <input type="text" id="inputName" class="form-control" name="link_katalog">
                      </div>
                      <div class="form-group">
                        <label for="inputName">Diskon Produk</label><span style="color: red"> Dalam %</span>
                        <input type="text" id="inputName" class="form-control" name="diskon_produk" required>
                      </div>
                      <div class="form-group">
                        <label for="inputStatus">Brand</label>
                        <select id="inputStatus" class="form-control custom-select" name="brand" required>
                          <option selected disabled>---Silahkan pilih brand---</option>
                          <?php
                          include "../config/conn.php";
                          $result = mysqli_query($conn,"SELECT * FROM brands");
                          while($row = $result->fetch_assoc()) { ?>
                            <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                          <?php } ?>
                        </select>
                      </div>

                      <div class="form-group">
                        <label for="inputStatus">Tipe Produk</label>
                        <select id="type_select" class="form-control custom-select" name="type_product"required>
                          <option selected disabled>---Silahkan pilih tipe produk---</option>
                          <option value="Ready Stok">Ready Stok</option>
                          <option value="PO">PO</option>
                        </select>
                        <span id="row_dim" style="color: red"><b>*Silahkan input stok lebih banyak</b></div>
                        </div>
                        
                        <div class="form-group">
                          <label for="inputDescription">Deskripsi Produk</label>
                          <textarea id="inputDescription" class="form-control" rows="4" name="deskripsi_produk"></textarea>
                        </div>

                        <div class="form-group">
                          <label for="inputName">Berat</label><span style="color: red"> contoh: 0.xx</span>
                          <input type="text" id="inputName" class="form-control" name="berat"required>
                        </div>

                        <div class="form-group">
                          <label for="inputDescription">Gambar Produk</label>
                          <input type="file" class="form-control" name="img" required>
                        </div>

                        <table class="table table-bordered">
                          <thead>
                            <tr>
                              <th>Size</th>
                              <th>Stok</th>
                              <th>Price</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td><input type="text" class="form-control" name="size[]"required></td>
                              <td><input type="number" class="form-control" name="stok[]"required></td>
                              <td><input type="number" class="form-control" name="price[]"required></td>
                            </tr>
                          </tbody>
                        </table>

                        <div class="form-group">
                          <label for="inputStatus">Status</label>
                          <select id="inputStatus" class="form-control custom-select" name="status" required>
                            <option selected disabled>---Pilih Status---</option>
                            <option value="Publish">Publish</option>
                            <option value="Unpublish">Unpublish</option>
                          </select>
                        </div>
                        <div class="d-flex justify-content-between">
                          <button type="button" class="btn btn-primary" id="add-row">Tambah Ukuran</button>
                          <button type="submit" class="btn btn-success">Insert Produk</button>
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

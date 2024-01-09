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

  <script src="https://cdn.tiny.cloud/1/3m2ggekyc02yk5n2gkgkor3ctoxya9w6dulhtl2vfezzjjfx/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
  <script>
    tinymce.init({
      selector: '#inputDescription'
    });
  </script>
</head>
<body class="hold-transition sidebar-mini">
  <div class="wrapper">
<?php $page = isset($_GET['page']) ? $_GET['page'] : 1; ?>
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
                 <h3>Edit Product</h3>
                 <?php 
                 include "../config/conn.php";
                 $id = $_GET['id'];

                 $result = mysqli_query($conn, "SELECT * FROM products WHERE id='$id'");
                 while ($data = mysqli_fetch_array($result)) {
               		
                  $name = $data['name'];
                  $link_katalog = $data['link_katalog'];
               		$diskon_produk = $data['diskon_produk'];
               		$deskripsi = $data['deskripsi'];
                  $type_product = $data['type_product'];
                  $status = $data['status'];
               		$berat = $data['berat'];
               		$gambar_produk = $data['photo'];

               	 } ?>

                 <form action="proses/proses_edit.php?page=<?php echo $page ?>" method="post" enctype="multipart/form-data">
                 	<input type="hidden" name="id" value="<?php echo $id ?>">
                   <div id="item-form">
                    <br>
                    <div class="form-group">
                      <label for="inputName">Nama Produk</label>
                      <input type="text" id="inputName" class="form-control" name="name_produk" value="<?php echo $name ?>" required>
                    </div>
                    <div class="form-group">
                      <label for="inputName">Link Katalog</label>
                      <input type="text" id="inputName" class="form-control" name="link_katalog" value="<?php echo $link_katalog ?>"required>
                    </div>
                    <div class="form-group">
                      <label for="inputName">Diskon Produk</label><span style="color: red"> Dalam %</span>
                      <input type="text" id="inputName" class="form-control" name="diskon_produk" value="<?php echo $diskon_produk ?>"required>
                    </div>
                    <div class="form-group">
                    	<label for="inputStatus">Brand</label>
                    	<select id="inputStatus" class="form-control custom-select" name="brand"required>
                    		<option selected disabled>---Silahkan pilih brand---</option>
                    		<?php
                    		include "../config/conn.php";
                    		$id = $_GET['id'];
                    		$query = "SELECT b.id, b.name FROM products p JOIN brands b ON p.brand_id = b.id WHERE p.id = $id";
                    		$result = mysqli_query($conn, $query);
                    		$row = mysqli_fetch_assoc($result);
                    		$selectedBrand = $row['id'];
                    		$brandName = $row['name'];
                    		$resultBrand = mysqli_query($conn,"SELECT * FROM brands");
                    		while($rowBrand = $resultBrand->fetch_assoc()) { 
                    			if($selectedBrand == $rowBrand['id']) {
                    				echo "<option value='".$rowBrand['id']."' selected>".$rowBrand['name']."</option>";
                    			} else {
                    				echo "<option value='".$rowBrand['id']."'>".$rowBrand['name']."</option>";
                    			}
                    		}
                    		?>
                    	</select>
                    </div>

                    <div class="form-group">
                    	<label for="inputStatus">Tipe Produk</label>
                    	<select id="inputStatus" class="form-control custom-select" name="type_product"required>
                    		<option disabled>---Silahkan pilih tipe produk---</option>
                    		<option value="Ready Stok" <?php echo ($type_product == "Ready Stok") ? "selected" : ""; ?>>Ready Stok</option>
                    		<option value="PO" <?php echo ($type_product == "PO") ? "selected" : ""; ?>>PO</option>
                    	</select>
                    </div>

                    <div class="form-group">
                    	<label for="inputDescription">Deskripsi Produk</label>
                    	<textarea id="inputDescription" class="form-control" rows="4" name="deskripsi_produk"><?php echo $deskripsi ?></textarea>
                    </div>

                    <div class="form-group">
                      <label for="inputName">Berat</label>
                      <input type="text" id="inputName" class="form-control" name="berat" value="<?php echo $berat ?>"required>
                    </div>

                    <!-- <div class="form-group">
                      <label for="inputDescription">Gambar Produk</label>
                      <input type="file" class="form-control" name="img">
                    </div> -->

                    <div class="form-group">
                    	<label for="inputDescription">Gambar Produk</label><br>
                    	<?php if(!empty($gambar_produk)): ?>
                    		<img src="fotoproduk/<?php echo $gambar_produk ?>" width="200" height="200">
                    	<?php endif; ?>
                    	<br>
                    	<input type="file" class="form-control" name="img">
                    	<input type="hidden" name="old_img" value="<?php echo $gambar_produk ?>">
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
                    		<?php
                    		$result = mysqli_query($conn, "SELECT * FROM product_sizes WHERE product_id='$id'");
                    		while ($data = mysqli_fetch_array($result)) {
                    			$size_arr = explode(",", $data['size']);
                    			$stok_arr = explode(",", $data['stok']);
                    			$price_arr = explode(",", $data['price']);

                    			for ($i = 0; $i < count($size_arr); $i++) {
                    				?>
                    				<tr>
                    					<td><input type="text" readonly class="form-control" name="size[]" value="<?php echo $size_arr[$i]; ?>"required></td>
                    					<td><input type="number" class="form-control" name="stok[]" value="<?php echo $stok_arr[$i]; ?>"required></td>
                    					<td><input type="number" class="form-control" name="price[]" value="<?php echo $price_arr[$i]; ?>"required></td>
                    				</tr>
                    				<?php
                    			}
                    		}
                    		?>
                    	</tbody>
                    </table>

                    <div class="form-group">
                      <label for="inputStatus">Status</label>
                      <select id="inputStatus" class="form-control custom-select" name="status"required>
                        <option disabled>---Pilih Status---</option>
                        <option value="Publish" <?php echo ($status == "Publish") ? "selected" : ""; ?>>Publish</option>
                        <option value="Unpublish" <?php echo ($status == "Unpublish") ? "selected" : ""; ?>>Unpublish</option>
                      </select>
                    </div>
                    
                    <div class="d-flex justify-content-between">
                      <button type="button" class="btn btn-primary" id="add-row">Tambah Ukuran</button>
                      <button type="submit" class="btn btn-success">Update Produk</button>
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

<?php 

session_start();


if ($_SESSION['role'] == 'admin') {
  echo "<script>alert('anda tidak diberikan akses');</script>";
  echo "<script>location='index.php';</script>";
  exit();
}

?>
<?php if (isset($_SESSION['id']) && isset($_SESSION['username'])): ?>
<?php require 'include/linkheader.php' ?>
<body class="hold-transition sidebar-mini">
  <div class="wrapper">



    <?php include "include/sidebar.php" ?>

    <div class="content-wrapper">
      <div class="content">
        <div class="container-fluid"><br>
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <!-- <a class="btn btn-primary" href="#" role="button">Add Member</a> -->
                </div>
                <div class="card-body table-responsive">

                  <?php
                  include "../config/conn.php";

                  $per_page = 5;
                  $page = isset($_GET['page']) ? $_GET['page'] : 1;
                  $start = ($page - 1) * $per_page;

                  if(isset($_POST['filter'])) {
                    $bulan = $_POST['bulan'];
                    $tahun = $_POST['tahun'];
                    $query = "SELECT * FROM orders WHERE MONTH(order_time) = '$bulan' AND YEAR(order_time) = '$tahun' AND order_type='PO' LIMIT $start, $per_page";
                    $total = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM orders WHERE MONTH(order_time) = '$bulan' AND YEAR(order_time) = '$tahun' AND order_type='PO'"));
                  }
                  else {
                    $query = "SELECT * FROM orders WHERE order_type='PO' LIMIT $start, $per_page";
                    $total = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM orders WHERE order_type='PO'"));
                  }

                  $result = mysqli_query($conn, $query);
                  $pages = ceil($total / $per_page);
                  ?>
                  <h4>Data Pre Order</h4>
                  <form method="post">
                    <div class="row">
                      <div class="col-md-4">
                        <select class="form-control" name="bulan" id="bulan">
                          <option value="">--- Silahkan Pilih Bulan ---</option>
                          <option value="01">Januari</option>
                          <option value="02">Februari</option>
                          <option value="03">Maret</option>
                          <option value="04">April</option>
                          <option value="05">Mei</option>
                          <option value="06">Juni</option>
                          <option value="07">Juli</option>
                          <option value="08">Agustus</option>
                          <option value="09">September</option>
                          <option value="10">Oktober</option>
                          <option value="11">November</option>
                          <option value="12">Desember</option>
                        </select>
                      </div>
                      <div class="col-md-4">
                        <select class="form-control" name="tahun" id="tahun">
                          <?php 
                          $year = date("Y");
                          for($i=$year;$i>=2019;$i--) { ?>
                            <option value="<?=$i?>"><?=$i?></option>
                          <?php } ?>
                        </select>
                      </div>
                      <div class="col-md-4">
                        <button type="submit" class="btn btn-primary" name="filter">Filter</button>
                        <a href="order.php" class="btn btn-secondary">Reset</a>
                        <button class="btn btn-success" type="button" onclick="location.href='export/export_excel_order_po.php?bulan=<?php echo $bulan ?>'">Export to Excel</button>
                      </div>
                    </div>
                  </form>
                  <br>


                  <table class="table table-hover text-nowrap">
                    <thead>
                      <tr>
                        <th>Order ID</th>
                        <th>Tanggal</th>
                        <th style="width: 50%">Alamat</th>
                        <th>Konfirmasi</th>
                        <th>No Resi</th>
                        <th>Total</th>
                        <th>Detail</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $total=0; while ($data = mysqli_fetch_array($result)) { ?>
                        <tr>
                          <td>#<?php echo $data['id'] ?></td>
                          <td><?php echo $data['order_time'] ?></td>
                          <td><?php echo $data['address'] ?></td>

                          <?php 
                          $query_bp = "SELECT * FROM confirm_payment WHERE order_id = " . $data['id'];
                          $result_bp = mysqli_query($conn, $query_bp);
                          $row_bp = mysqli_fetch_assoc($result_bp);
                          ?>
                          <?php if ($row_bp){ ?>
                            <td>
                              <a href="../bukti_pembayaran/<?php echo $row_bp['bukti'] ?>" target="_blank">
                                <img src="../bukti_pembayaran/<?=$row_bp['bukti']?>" style="width: 100px">
                              </a>
                            </td>
                          <?php }else{ ?>
                            <td>-</td>
                          <?php } ?>

                          <td><?php echo $data['resi'] ?></td>
                          <td>Rp. <?php echo number_format($data['total'] + $data['ongkir'] - intval($data['voucher'])) ?></td>
                          <td>
                            <a href="detail_order-po.php?id=<?=$data['id']?>" class="btn btn-success btn-sm">Detail Order</a>
                            <button class="btn btn-danger btn-sm" onclick="deleteOrder(<?php echo $data['id']; ?>)">Hapus</button>
                          </td>
                          <?php $amount=$amount+$data['total'] + $data['ongkir'] - intval($data['voucher']); } ?>
                        </tbody>
                        <tr>
                          <td colspan="5">Total</td>
                          <td>Rp. <?=number_format($amount)?></td>
                        </tr>
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
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <aside class="control-sidebar control-sidebar-dark">
          <div class="p-3">
            <h5>Title</h5>
            <p>Sidebar content</p>
          </div>
        </aside>

        <footer class="main-footer">
          <div class="float-right d-none d-sm-inline">
            Anything you want
          </div>
          <strong>Copyright &copy;2023
          </footer>
        </div>


        <script src="assets/plugins/jquery/jquery.min.js"></script>
        <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/dist/js/adminlte.min.js"></script>
        <script>
          function deleteOrder(orderId) {
            if (confirm("Apakah Anda yakin ingin menghapus order ini?")) {
      // Kirim permintaan AJAX ke skrip PHP untuk menghapus order
      $.ajax({
        url: 'delete_order.php',
        type: 'POST',
        data: { orderId: orderId },
        success: function(response) {
          // Tampilkan pesan sukses atau error
          alert(response);
          // Muat ulang halaman setelah menghapus order
          location.reload();
        },
        error: function(xhr, status, error) {
          // Tampilkan pesan error jika terjadi kesalahan
          alert("Terjadi kesalahan saat menghapus order: " + error);
        }
      });
    }
  }
</script>
</body>
</html>
<?php else : ?>
  <script>alert('Silahkan Login terlebih dahulu')</script>
  <script>location='login.php'</script>
<?php endif ?>

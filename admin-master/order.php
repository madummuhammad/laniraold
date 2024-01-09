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
<!--   <!DOCTYPE html>

  <html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DND</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
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
  </head> -->
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
                      $query = "SELECT * FROM orders WHERE MONTH(order_time) = '$bulan' AND YEAR(order_time) = '$tahun' AND order_type='Ready Stok' LIMIT $start, $per_page";
                      $total = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM orders WHERE MONTH(order_time) = '$bulan' AND YEAR(order_time) = '$tahun' AND order_type='Ready Stok'"));
                    }
                    else {
                      $query = "SELECT * FROM orders WHERE order_type='Ready Stok' LIMIT $start, $per_page";
                      $total = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM orders WHERE order_type='Ready Stok'"));
                    }

                    $result = mysqli_query($conn, $query);
                    $pages = ceil($total / $per_page);
                    ?>
                    <h4>Data Order</h4>
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
                          <button class="btn btn-success" type="button" onclick="location.href='export/export_excel_order.php?bulan=<?php echo $bulan ?>'">Export to Excel</button>
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
                            <td><a href="detail_order.php?id=<?=$data['id']?>" class="btn btn-success btn-sm">Detail Order</a></td>
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
        </body>
        </html>
      <?php else : ?>
        <script>alert('Silahkan Login terlebih dahulu')</script>
        <script>location='login.php'</script>
      <?php endif ?>

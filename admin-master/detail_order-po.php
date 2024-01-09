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

      .form-group {
        display: inline-block;
        margin-right: 20px;
        vertical-align: top;
        width: 45%;
      }


    </style>
  </head>
  <body class="hold-transition sidebar-mini">
    <div class="wrapper">


      <?php include "include/sidebar.php" ?>
      <?php
      if(isset($_POST['hapus'])){
        $order_item_id = $_POST['order_item_id'];
        $deleteSql = "DELETE FROM orders_item WHERE id = '$order_item_id'";
        if ($conn->query($deleteSql) === TRUE) {
          $new_total=$_POST['total']-$_POST['price'];
          $order_id=$_GET['id'];
          $updateOrder = "UPDATE orders SET total = '$new_total' WHERE id = '$order_id'";
          if ($conn->query($updateOrder) === TRUE) {
            header('Location:detail_order-po.php?id='.$order_id);
          } else {
            echo "Error: " . $updateOrder . "<br>" . $conn->error;
          }
        } else {
          echo "Terjadi kesalahan saat menghapus data: " . $conn->error;
        }
        $conn->close();
      }
      ?>

      <?php
      if(isset($_POST['updateNote'])){
        $order_id=$_GET['id'];
        $note=$_POST['note'];
        $updateOrderNote = "UPDATE orders SET catatan = '$note' WHERE id = '$order_id'";
        if ($conn->query($updateOrderNote) === TRUE) {
        } else {
          echo 'gagal';
        }
      } 
      ?>
      <?php
      if (isset($_POST['update_qty'])) {
        $order_item_id = $_POST['order_item_id'];
        $qty = $_POST['qty'];
        $get_price_query = $conn->query("SELECT price FROM orders_item WHERE id = '$order_item_id'");
        $current_price = $get_price_query->fetch_assoc()['price'];

        $new_total_price = $current_price * $qty;

        $update_query = "UPDATE orders_item SET qty = '$qty' WHERE id = '$order_item_id'";
        if (mysqli_query($conn, $update_query)) {
          echo "Qty berhasil diubah.";

          $update_total_query = "UPDATE orders SET total = (SELECT SUM(price * qty) FROM orders_item WHERE order_id = '$_GET[id]') WHERE id = '$_GET[id]'";
          if (mysqli_query($conn, $update_total_query)) {
            echo "Total berhasil diubah.";
          } else {
            echo "Terjadi kesalahan saat mengubah Total: " . mysqli_error($conn);
          }
          $update_jumlah_query = "UPDATE confirm_payment SET jumlah = '$new_total_price' WHERE order_id = '$_GET[id]'";
          if (mysqli_query($conn, $update_jumlah_query)) {
            echo "Jumlah berhasil diubah.";
          } else {
            echo "Terjadi kesalahan saat mengubah Jumlah: " . mysqli_error($conn);
          }
        } else {
          echo "Terjadi kesalahan saat mengubah Qty: " . mysqli_error($conn);
        }
      }
      ?>
      <div class="content-wrapper">
        <div class="content">
          <div class="container-fluid"><br>
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <!-- <a class="btn btn-primary" href="#" role="button">Add Member</a> -->
                    <div class="card-tools">
                      <!-- <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                        <div class="input-group-append">
                          <button type="submit" class="btn btn-default">
                            <i class="fas fa-search"></i>
                          </button>
                        </div>
                      </div> -->
                    </div>
                  </div>
                  <div class="card-body table-responsive p-2">
                    <?php 
                    include "../config/conn.php";
                    $ambil = $conn->query("SELECT * FROM orders JOIN members ON orders.member_id = members.id WHERE orders.id = '$_GET[id]'");
                    $detail = $ambil->fetch_assoc();
                    $member = $detail['member_id'];
                    ?>
                    <div class="container">
                      <div class="row">
                        <div class="col-md-4">
                          <strong>Pembelian</strong><br>
                          <?php 
                          $date = date("Ymd", strtotime($detail['order_time']));
                          $id = str_pad($detail['id'], 2, '0', STR_PAD_LEFT);
                          ?>
                          No Pembelian : #<?php echo $_GET['id'];?><br>
                          Tanggal : <?php echo $detail['order_time'] ?><br>
                        </div>

                        <div class="col-md-4">
                          <strong>Pelanggan</strong><br>
                          Nama Penerima : <?php echo $detail['nama_penerima'] ?><br>
                          No Telp : <?php echo $detail['phone'] ?><br>
                          Email : <?php echo $detail['order_email'] ?><br>
                        </div>
                        <?php if($detail['sender_dropship']): ?>
                          <div class="col-md-4">
                            <strong>Dropship </strong><br>
                            <p class="p-0 m-0">Pengirim: <?php echo $detail['sender_dropship'] ?></p>
                            <p class="p-0 m-0">No Hp: <?php echo $detail['phone_dropship'] ?></p>
                          </div>
                        <?php endif ?>
                      </div>
                      <br>
                      <div class="form-group">
                        <form method="POST" action="">
                          <div class="input-group">
                            <select name="confirm_payment" class="form-control">
                              <option value="On Checking" <?php if($detail['confirm_payment'] == "On Checking") echo "selected"; ?>>On Checking</option>
                              <option value="Pesanan diproses" <?php if($detail['confirm_payment'] == "Pesanan diproses") echo "selected"; ?>>Pesanan diproses</option>
                              <option value="Pesanan dikirim" <?php if($detail['confirm_payment'] == "Pesanan dikirim") echo "selected"; ?>>Pesanan dikirim</option>
                            </select>
                            <div class="input-group-append">
                              <button type="submit" name="update_confirm" class="btn btn-primary">Simpan</button>
                            </div>
                          </div>
                          <input type="hidden" name="order_id" value="<?php echo $_GET['id']; ?>">
                        </form>
                      </div>

                      <div class="form-group">
                        <form method="POST" action="">
                          <div class="input-group">
                            <input type="hidden" name="order_id" value="<?=$_GET['id']?>">
                            <?php 
                            $order_id = $_GET['id'];
                            $sql = "SELECT resi FROM orders WHERE id = '$order_id'";
                            $result = mysqli_query($conn, $sql);
                            $row = mysqli_fetch_assoc($result);
                            if($row){
                              $resi = $row['resi'];
                              echo "<input type='text' name='resi' value='$resi' class='form-control' placeholder='Input Resi'>";
                            }else{
                              echo "<input type='text' name='resi' class='form-control' placeholder='Input Resi'>";
                            }
                            ?>
                            <div class="input-group-append">
                              <button type="submit" name="update_resi" class="btn btn-primary">Simpan</button>
                            </div>
                          </div>
                        </form>
                      </div>

                      <?php 
                      if(isset($_POST["update_resi"])){
                        $order_id = $_POST['order_id'];
                        $resi = $_POST['resi'];
                        $sql = "UPDATE orders SET resi = '$resi' WHERE id = '$order_id'";
                        $result = mysqli_query($conn, $sql);
                        if($result){
                          echo "<script>alert('Berhasil');</script>";
                          echo "<script>location='detail_order.php?id=".$_GET['id']."';</script>";
                        }else{
                          echo "Resi gagal diubah";
                        }
                      }
                      ?>

                      <?php if(isset($_POST["update_confirm"])){ ?>
                        <?php 
                        $order_id = $_POST['order_id'];
                        $confirm_payment = $_POST['confirm_payment'];

                        $sql = " UPDATE orders SET confirm_payment = '$confirm_payment' WHERE id = '$order_id' ";
                        $result = mysqli_query($conn, $sql);

                        if($result){
                          echo "<script>alert('Berhasil');</script>";
                          echo "<script>location='detail_order.php?id=".$_GET['id']."';</script>";
                        }else{
                          echo "Status pesanan gagal diubah";
                        }
                        ?>
                      <?php } ?>
                      <div class="d-flex mt-4">
                        <a href="invoice.php?id=<?=$_GET['id']?>" class="btn btn-danger mr-2" target="_blank">Print Invoice</a>
                        <a href="add-order-po.php?order_id=<?=$_GET['id']?>" class="btn btn-secondary">TAMBAH PESANAN</a>
                      </div>
                      <table class="table table-hover text-nowrap">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Produk</th>
                            <th>Size</th>
                            <th>QTY</th>
                            <th>Harga</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php include "../config/conn.php"; $no=1; ?>
                          <?php
                          $order_id = $_GET['id'];
                          $get_query = $conn->query("SELECT oi.*, ps.size, oi.price, p.diskon_produk
                           FROM orders_item oi
                           INNER JOIN product_sizes ps ON oi.product_id = ps.product_id AND oi.size_id = ps.id
                           INNER JOIN products p ON ps.product_id = p.id
                           WHERE oi.order_id = '$_GET[id]'");
                           ?>
                           <?php $total = 0; ?>
                           <?php while($result = $get_query->fetch_assoc()): ?>

                            <tr>
                              <td><?php echo $no; ?></td>
                              <td><?php echo $result['product_name'] ?></td>
                              <td><?php echo $result['size'] ?></td>
                              <td>
                                <form method="POST">
                                  <div class="d-flex justify-content-center" style="width:130px">
                                    <input type="hidden" name="order_item_id" value="<?php echo $result['id']; ?>">
                                    <input type="number" class="form-control" name="qty" value="<?php echo $result['qty']; ?>">
                                    <input type="submit" class="btn btn-sm btn-primary" name="update_qty" value="Update">
                                  </div>
                                </form>
                              </td>
                              <td>Rp. <?php echo number_format($result['price'] * $result['qty']) ?></td>
                              <td>
                                <form action="" method="POST">
                                  <input type="text" hidden name="order_item_id" value="<?php echo $result['id'] ?>">
                                  <input type="text" hidden name="price" value="<?php echo $result['price']*$result['qty'] ?>">
                                  <input type="text" hidden name="total" value="<?php echo $detail['total'] ?>">
                                  <button class="btn btn-sm btn-danger" name="hapus">Hapus</button>
                                </form>
                              </td>
                            </tr>
                            <?php $no++; ?>
                            <?php $total += ($result['price'] * $result['qty']) ?>
                          <?php endwhile; ?>
                          <tr>
                            <td colspan="5"><b>Total</b></td>
                            <td>Rp. <?php echo number_format($detail['total'] + $detail['ongkir'] - intval($detail['voucher'])); ?></td>
                          </tr>
                          <tr>
                            <td colspan="5"><b>Riwayat Transaksi</b></td>
                            <td>
                              <button class="btn btn-outline-secondary btn-sm mb-2" onclick="toggleDetail()">Detail Deposit</button>
                              <div id="detailTransaksi">
                                <table>
                                  <thead>
                                    <tr>
                                      <th>BANK</th>
                                      <th>Deposit</th>
                                      <th>Bukti</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php 
                                    $query = "SELECT * FROM confirm_payment WHERE order_id = '$_GET[id]'";
                                    $result = mysqli_query($conn, $query);
                                    $total_deposit = 0;
                                    $no = 1;
                                    ?>
                                    <?php while ($data = mysqli_fetch_array($result)) { ?>
                                      <tr>
                                        <td><?php echo $data['bank']; ?></td>
                                        <td><?php echo number_format($data['deposit']); ?></td>
                                        <td>
                                          <a href="../bukti_pembayaran/<?php echo $data['bukti'] ?>" target="_blank">
                                            attachment
                                          </a>
                                        </td>
                                      </tr>
                                      <?php 
                                      $total_deposit += $data['deposit'];
                                      $no++;
                                      ?>
                                    <?php } ?>
                                    <tr>
                                      <td colspan="1"><b>Total Deposit</b></td>
                                      <td><b><?php echo number_format($total_deposit); ?></b></td>
                                    </tr>
                                    <tr>
                                      <td colspan="1"><b>Wajib Deposit 30%</b></td>
                                      <td><b><?php echo number_format($detail['total']*30/100); ?></b></td>
                                    </tr>
                                    <tr>
                                      <td colspan="1"><b style="color: red">Sisa Pelunasan</b></td>
                                      <td><b><?php echo number_format($detail['total'] + $detail['ongkir'] - intval($detail['voucher']) - $total_deposit); ?></b></td>
                                    </tr>
                                    <tr>
                                      <td colspan="1"><b>Total Penjualan</b></td>
                                      <td><b><?php echo number_format($detail['total']); ?></b></td>
                                    </tr>
                                  </tbody>
                                </table>
                              </div>
                            </td>
                          </tr>
                          <br>
                          <div id="staticNote">
                            <div>Catatan : <b style="color: red"><?php echo $detail['catatan'] ?></b></div>
                            <button class="btn btn-success mt-2 mb-4 staticNoteButton" id="ubah" onclick="toggleNote()">Ubah Catatan</button>
                          </div>
                          <div id="dinamicNote" style="display: none;">
                            <form action="" method="POST">
                              <div class="form-group">
                                <label for="" class="fw-normal" style="font-weight: normal;">
                                  Catatan :
                                </label>
                                <div class="input-group">
                                  <input type="text" name="note" value="<?php echo $detail['catatan'] ?>" class="form-control">
                                  <div class="input-group-append">
                                    <button class="btn btn-sm btn-success staticNoteButton" id="ubah" name="updateNote">Ubah Catatan</button>
                                  </div>
                                </div>
                              </div>
                            </form>
                          </div>
                          <script>
                            function toggleDetail() {
                              var detailTransaksi = document.getElementById("detailTransaksi");
                              if (detailTransaksi.style.display === "none") {
                                detailTransaksi.style.display = "block";
                              } else {
                                detailTransaksi.style.display = "none";
                              }
                            }
                          </script>
                          <script>
                            function toggleNote() {
                              var dinamicNote = document.getElementById("dinamicNote");
                              var staticNote=document.getElementById("staticNote");
                              if (dinamicNote.style.display === "none") {
                                dinamicNote.style.display = "block";
                              } else {
                                dinamicNote.style.display = "none";
                              }
                              if (staticNote.style.display === "none") {
                                staticNote.style.display = "block";
                              } else {
                                staticNote.style.display = "none";
                              }
                            }
                          </script>
                          <?php 
                          $sisa_pembayaran = $total + $detail['ongkir'] - $total_deposit;
                          ?>
                          <!-- <tr>
                            <td colspan="4"><b>Sisa Pembayaran</b></td>
                            <td><b>Rp. <?php echo number_format($sisa_pembayaran); ?></b></td>
                          </tr> -->
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

      </div>


      <script src="assets/plugins/jquery/jquery.min.js"></script>
      <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
      <script src="assets/dist/js/adminlte.min.js"></script>
    </body>
    </html>
    <?php 
  }else{
    echo "<script>alert('Silahkan Login terlebih dahulu');</script>";
    echo "<script>location='login.php';</script>";
  }
  ?>

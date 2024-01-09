<?php 
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['email'])) {
  ?>
  <!DOCTYPE html>
  <html lang="en">
  <!-- Basic -->

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Site Metas -->
    <title>DND</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="Aulia Ausath">
    <meta name="robots" content="index, follow">

    <!-- Site Icons -->
    <!-- <link rel="shortcut icon" href="imagess/favicon.ico" type="image/x-icon"> -->
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Site CSS -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/custom.css">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

    <link rel="stylesheet" href="carousel/css/owl.carousel.min.css">
    <link rel="stylesheet" href="carousel/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/4.5.6/css/ionicons.min.css">
    <link rel="stylesheet" href="carousel/css/style.css">

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    </head>

    <body>

      <!-- Start Main Top -->
      <header class="main-header">
        <!-- Start Navigation -->
        <?php include "include/header.php" ?>
        <!-- End Navigation -->
      </header>
      <!-- End Main Top -->

      <!-- Start Top Search -->
      <div class="top-search">
        <div class="container">
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-search"></i></span>
            <input type="text" class="form-control" placeholder="Search">
            <span class="input-group-addon close-search"><i class="fa fa-times"></i></span>
          </div>
        </div>
      </div>
      <!-- End Top Search -->

      <!-- Start Categories  -->

      <style>

        .detail-pesanan {
          margin: 20px auto;
          width: 80%;
          border: 2px solid #ddd;
          padding: 20px;
          border-radius: 10px;
          box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
          font-family: Arial, sans-serif;
        }

        .detail-pesanan h2 {
          text-align: center;
          font-size: 32px;
          margin-bottom: 10px;
        }

        .detail-pesanan p {
          font-size: 18px;
          line-height: 1.5;
          margin: 10px 0;
        }

        .detail-pesanan table {
          width: 100%;
          border-collapse: collapse;
          margin: 20px 0;
        }

        .detail-pesanan th {
          background-color: #f2f2f2;
          border: 1px solid #ddd;
          padding: 8px;
          text-align: left;
          font-size: 18px;
        }

        .detail-pesanan td {
          border: 1px solid #ddd;
          padding: 8px;
          font-size: 16px;
        }

        .detail-pesanan tr:nth-child(even) {
          background-color: #f2f2f2;
        }

        .detail-pesanan p:last-child {
          font-weight: bold;
          font-size: 24px;
          margin-top: 20px;
        }


      </style>
      <br><br>
      <?php 
      include "./config/conn.php";
      $ambil = $conn->prepare("SELECT * FROM orders JOIN members ON orders.member_id = members.id WHERE orders.id = ?");
      $ambil->bind_param("s", $_GET['id']);
      $ambil->execute();
      $detail = $ambil->get_result()->fetch_assoc();
      $member = $detail['member_id'];
      ?>
      <div class="detail-pesanan">

        <div class="row">
          <div class="col-md-4">
            <strong>Pembelian</strong><br>
            No Pembelian : #<?php echo $_GET['id'];?><br>
            Tanggal : <?php echo $detail['order_time'] ?><br><strong>
              Jenis Pesanan : Pre Order
            </strong>
            <br>
          </div>

          <div class="col-md-4">
            <strong>Pelanggan</strong><br>
            Nama Penerima : <?php echo $detail['nama_penerima'] ?><br>
            No Telp : <?php echo $detail['phone'] ?><br>
            Email : <?php echo $detail['order_email'] ?><br>
          </div>
        </div>

        <table>
          <tr>
            <th>No</th>
            <th>Produk</th>
            <th>Size</th>
            <th>QTY</th>
            <th>Harga</th>
          </tr>
          <?php $no=1; ?>
          <!-- Menampilkan data pembelian_produk -->
          <?php 
          $get_query = $conn->query("SELECT oi.*, ps.size, ps.price, p.diskon_produk
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
              <td><?php echo $result['qty'] ?></td>
              <td>Rp. <?php echo number_format($result['price'] * $result['qty'] - $result['diskon_produk']) ?></td>
            </tr>
            <?php $no++; ?>
            <?php $total+=($result['price'] * $result['qty'])?>
          <?php endwhile; ?>
          <tr>
            <td colspan="4"><b>Deposit Minimum</b></td>
            <td>Rp. <?php echo number_format(($detail['total'] + $detail['ongkir'] - intval($detail['voucher']))*30/100); ?></td>
          </tr>
          <tr>
            <td colspan="4"><b>Total</b></td>
            <td>Rp. <?php echo number_format($detail['total'] + $detail['ongkir'] - intval($detail['voucher'])); ?></td>
          </tr>


        </table>
        <br>
        <span>Catatan : <?php echo $detail['catatan'] ?></span>
        <div id="detailTransaksi">
          <h2 class="text-center">Pembayaran</h2>
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
                <td colspan="2"><b>Total</b></td>
                <td><b><?php echo number_format($total_deposit); ?></b></td>
              </tr>
              <tr>
                <td colspan="2"><b style="color: red">Sisa</b></td>
                <td><b><?php echo number_format($detail['total'] + $detail['ongkir'] - intval($detail['voucher']) - $total_deposit); ?></b></td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="row" style="display: flex; justify-content: center; align-items: center;">
          <div class="col-md-7">
            <div class="alert alert-info">

              <p>
                Silahkan lakukan pembayaran Rp. <?php echo number_format($detail['total'] + $detail['ongkir'] - intval($detail['voucher'])); ?>,- ke <br>
                <strong>BCA : 1234xxxx A/N : nama pemilik</strong><br>
                <a href="confirm_payment-po.php?id=<?=$_GET['id']?>" class="btn btn-success btn-sm">Konfirmasi Pembayaran</a>
              </p>
            </div>
          </div>
        </div>
      </div>
      <!-- End Categories -->


      <!-- End Products  -->



      <!-- Start copyright  -->
          <!-- <div class="footer-copyright">
            <p class="footer-company">All Rights Reserved. &copy; 2022 <a href="#">K-Grosir</a> Design By :
              <a href="https://html.design/">html design</a></p>
            </div> -->
            <!-- End copyright  -->

            <a href="#" id="back-to-top" title="Back to top" style="display: none;">&uarr;</a>

            <!-- ALL JS FILES -->
            <script src="js/jquery-3.2.1.min.js"></script>
            <script src="js/popper.min.js"></script>
            <script src="js/bootstrap.min.js"></script>
            <!-- ALL PLUGINS -->
            <script src="js/jquery.superslides.min.js"></script>
            <script src="js/bootstrap-select.js"></script>
            <script src="js/inewsticker.js"></script>
            <script src="js/bootsnav.js."></script>
            <script src="js/images-loded.min.js"></script>
            <script src="js/isotope.min.js"></script>
            <script src="js/owl.carousel.min.js"></script>
            <script src="js/baguetteBox.min.js"></script>
            <script src="js/form-validator.min.js"></script>
            <script src="js/contact-form-script.js"></script>
            <!-- <script src="js/custom.js"></script> -->

            <script src="carousel/js/jquery.min.js"></script>
            <script src="carousel/js/popper.js"></script>
            <script src="carousel/js/bootstrap.min.js"></script>
            <script src="carousel/js/owl.carousel.min.js"></script>
            <script src="carousel/js/main.js"></script>

          </body>

          </html>
          <?php 
        }else{
          header("Location: login.php");
          exit();
        }
      ?>
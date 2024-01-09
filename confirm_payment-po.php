<?php include "./config/conn.php" ?>
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
    <link rel="shortcut icon" href="imagesss/favicon.ico" type="image/x-icon">
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
      $ambil = $conn->query("SELECT * FROM orders JOIN members ON orders.member_id = members.id WHERE orders.id = '$_GET[id]'");
      $detail = $ambil->fetch_assoc();
      $order = $detail['total'];
      ?>

      <?php
      $confirm_query = $conn->query("SELECT jumlah, deposit
        FROM confirm_payment
        WHERE order_id = '$_GET[id]'
        ORDER BY id DESC
        LIMIT 1
        ");
      $confirm_result = $confirm_query->fetch_assoc();
      $jumlah = $confirm_result['jumlah'];
      $deposit = $confirm_result['deposit'];

      if (!empty($deposit) && $jumlah == $deposit) {
        echo "<script>
        alert('ID ini sudah lakukan konfirmasi pembayaran');
        window.location.href = 'myorder.php';
        </script>";
      }

      ?>


      <?php 
      $id = $_GET['id'];
      $ambil = $conn->query("SELECT * FROM orders WHERE id='$id'");
      $detpem = $ambil->fetch_assoc();

      $member_id = $detpem['member_id'];
      $session_member_id = $_SESSION['id'];
      ?>

      <div class="detail-pesanan">
        <div class="row">
          <div class="col-md-8">
            <!-- <div class="alert alert-info">Total tagihan anda <strong>Rp. <?= number_format($order + $detail['ongkir']); ?>,-</strong></div> -->
            <h3 class="text-center">Konfirmasi Pembayaran Pre Order</h3>
            <form action="" method="post" enctype="multipart/form-data">
              <div class="form-group">
                <label for="">Nama Pengirim</label>
                <input type="text" class="form-control" name="nama" required>
              </div>
              <div class="form-group">
                <label for="">Bank</label>
                <input type="text" class="form-control" name="bank" required>
              </div>
              <?php
              $total = $detail['total'] + $detail['ongkir'] - intval($detail['voucher']);

              $query = $conn->query("SELECT COALESCE(SUM(deposit), 0) AS total_deposit FROM confirm_payment WHERE order_id='$_GET[id]'");
              $result = $query->fetch_assoc();
              $total_deposit = intval($result['total_deposit']);

              $sisa_pembayaran = $total - $total_deposit;
              ?>
              <div class="form-group">
                <label for="">Deposit <b style="color: red">*Item pre order</b></label>
                <?php if($detail['total'] + $detail['ongkir'] - intval($detail['voucher'])==$sisa_pembayaran): ?>
                  <input type="text" class="form-control" name="deposit" value="<?=($detail['total'] + $detail['ongkir'] - intval($detail['voucher']))*30/100?>">
                  <div class="text-danger">Minimum deposit Rp. <?= number_format(($detail['total'] + $detail['ongkir'] - intval($detail['voucher']))*30/100)?></div>
                <?php else: ?>
                  <input type="text" class="form-control" name="deposit" value="<?php echo $sisa_pembayaran ?>" readonly>
                <?php endif ?>
              </div>
              <div class="form-group">
                <label for="">Jumlah</label>
                <input type="number" class="form-control" name="jumlah" value="<?=$detail['total'] + $detail['ongkir'] - intval($detail['voucher'])?>" readonly>
              </div>

              <div class="form-group">
                <label for="">Sisa Pembayaran</label>
                <input type="number" class="form-control" name="jumlah" value="<?= $sisa_pembayaran ?>" readonly>
              </div>

              <div class="form-group">
                <label for="">Foto Bukti</label>
                <input type="file" class="form-control" name="bukti">
                <span class="text-danger">foto bukti maksimal 2 MB</span>
              </div>
              <div class="alert alert-warning">
                Pesanan Pre Order, Minimal Deposit 30%
              </div>
              <button class="btn btn-primary" name="kirim">Kirim</button>
            </form>

            <?php
            $order_id = $_GET['id'];

            if(isset($_POST['kirim'])){
              $namabukti = $_FILES['bukti']['name'];
              $lokasibukti = $_FILES['bukti']['tmp_name'];
              $namafiks = date('YmdHis').$namabukti;
              move_uploaded_file($lokasibukti, "bukti_pembayaran/$namafiks");

              $nama = $_POST['nama'];
              $bank = $_POST['bank'];
              $jumlah = $_POST['jumlah'];
              $deposit = $_POST['deposit'];
              $tanggal = date('Y-m-d');

              $conn->query("INSERT INTO confirm_payment(order_id, nama, bank, jumlah, deposit, tanggal, bukti) VALUES('$order_id', '$nama', '$bank', '$jumlah', '$deposit', '$tanggal', '$namafiks')");

              $conn->query("UPDATE orders SET confirm_payment='On Checking' WHERE id='$order_id'");

              echo "<script>alert('Terima kasih sudah melakukan pembayaran');</script>";
              echo "<script>location='myorder.php';</script>";
            }
            ?>


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
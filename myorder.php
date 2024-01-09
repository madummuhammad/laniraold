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
    <link rel="shortcut icon" href="imagess/favicon.ico" type="image/x-icon">
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

          <!-- Start Slider -->
          <!-- <div id="slides-shop" class="cover-slides">
            <ul class="slides-container">
              <li class="text-left">
                <img src="images/banner-01.jpg" alt="">
                <div class="container">
                  <div class="row">
                    <div class="col-md-12">
                      <h1 class="m-b-20"><strong>Welcome To <br> K-Grosir</strong></h1>
                      <p class="m-b-40">See how your users experience your website in realtime or view <br> trends to see any changes in performance over time.</p>
                      <p><a class="btn hvr-hover" href="#">Shop New</a></p>
                    </div>
                  </div>
                </div>
              </li>
              <li class="text-center">
                <img src="images/banner-02.jpg" alt="">
                <div class="container">
                  <div class="row">
                    <div class="col-md-12">
                      <h1 class="m-b-20"><strong>Welcome To <br> K-Grosir</strong></h1>
                      <p class="m-b-40">See how your users experience your website in realtime or view <br> trends to see any changes in performance over time.</p>
                      <p><a class="btn hvr-hover" href="#">Shop New</a></p>
                    </div>
                  </div>
                </div>
              </li>
              <li class="text-right">
                <img src="images/banner-03.jpg" alt="">
                <div class="container">
                  <div class="row">
                    <div class="col-md-12">
                      <h1 class="m-b-20"><strong>Welcome To <br> K-Grosir</strong></h1>
                      <p class="m-b-40">See how your users experience your website in realtime or view <br> trends to see any changes in performance over time.</p>
                      <p><a class="btn hvr-hover" href="#">Shop New</a></p>
                    </div>
                  </div>
                </div>
              </li>
            </ul>
            <div class="slides-navigation">
              <a href="#" class="next"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
              <a href="#" class="prev"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
            </div>
          </div> -->
          <!-- End Slider -->

          <!-- Start Categories  -->

          <style>

            /*.detail-pesanan {
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
              font-size: 13px;
            }

            .detail-pesanan td {
              border: 1px solid #ddd;
              padding: 8px;
              font-size: 13px;
            }

            .detail-pesanan tr:nth-child(even) {
              background-color: #f2f2f2;
            }

            .detail-pesanan p:last-child {
              font-weight: bold;
              font-size: 24px;
              margin-top: 20px;
            }*/

            .detail-pesanan table {
              width: 100%;
              border-collapse: collapse;
            }

            .detail-pesanan th, .detail-pesanan td {
              padding: 8px;
              text-align: left;
              border-bottom: 1px solid #ddd;
            }

            .detail-pesanan th {
              background-color: #f2f2f2;
              font-weight: bold;
            }

            @media only screen and (max-width: 600px) {
              .detail-pesanan table {
                font-size: 14px;
              }
              .detail-pesanan th, .detail-pesanan td {
                padding: 6px;
                font-size: 12px;
              }
            }

            
          </style>
          <br><br>
          <div class="detail-pesanan">
            <h3>Pesanan Saya</h3>
            <table>
              <tr>
                <th style="width: 5%">No</th>
                <th>Order ID</th>
                <th>Tanggal</th>
                <th style="width: 50%">Alamat</th>
                <th>Konfirmasi</th>
                <th>No Resi</th>
                <th>Total</th>
                <th>Detail</th>
              </tr>
              <?php 
                include "./config/conn.php";
                $no=1;
                $member_id = $_SESSION['id']; 
              ?>
              <?php $get_query = $conn->query("SELECT * FROM orders WHERE member_id = '$member_id' ORDER BY id DESC"); ?>
              <?php while($result = $get_query->fetch_assoc()): ?>
                <tr>
                  <td><?php echo $no; ?></td>
                  <td>#<?php echo $result['id'] ?></td>
                  <td><?php echo $result['order_time'] ?></td>
                  <td><?php echo $result['address'] ?></td>
                  <td><?php echo $result['confirm_payment'] ?></td>
                  <td><?php echo $result['resi'] ?></td>


                  <?php /*if ($result['distrik'] == 'Jakarta Barat' || $result['distrik'] == 'Jakarta Pusat' || $result['distrik'] == 'Jakarta Selatan' || $result['distrik'] == 'Jakarta Timur' || $result['distrik'] == 'Jakarta Utara' || $result['distrik'] == 'Kepulauan Seribu' || $result['distrik'] == 'Bekasi' || $result['distrik'] == 'Bogor' || $result['distrik'] == 'Depok' || $result['distrik'] == 'Cilegon' || $result['distrik'] == 'Lebak' || $result['distrik'] == 'Pandeglang' || $result['distrik'] == 'Serang' || $result['distrik'] == 'Tangerang' || $result['distrik'] == 'Tangerang Selatan' || $result['distrik'] == 'Badung'){*/ ?>
                  <!-- <td>Rp. <?php echo number_format($result['total']) ?></td> -->
                <?php /*}else{*/ ?>
                  <td>Rp. <?php echo number_format($result['total'] + $result['ongkir'] - intval($result['voucher'])) ?></td>
                <?php /*}*/ ?>


                  <td>
                    <?php if($result['order_type']=='Ready Stok'): ?>
                    <a href="detail_pesanan.php?id=<?=$result['id']?>" class="btn btn-primary btn-sm">Nota</a> |
                    <a href="confirm_payment.php?id=<?=$result['id']?>" class="btn btn-success btn-sm">Konfirmasi</a></td>
                  <?php else: ?>
                    <a href="detail_pesanan-po.php?id=<?=$result['id']?>" class="btn btn-primary btn-sm">Nota</a> |
                    <a href="confirm_payment-po.php?id=<?=$result['id']?>" class="btn btn-success btn-sm">Konfirmasi</a></td>
                  <?php endif ?>
                    
                </tr>
                <?php $no++; ?>
              <?php endwhile; ?>
            </table>

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
          echo "<script>alert('Silahkan Login terlebih dahulu');</script>";
          echo "<script>location='login.php';</script>";
        }
        ?>
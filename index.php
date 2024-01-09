<?php
include "./config/conn.php";
session_start();
if (!isset($_SESSION['id']) && !isset($_SESSION['email'])) {
  header('Location: login.php');
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<!-- Basic -->

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Site Metas -->
  <title>DND</title>
  <meta name="keywords" content="">
  <meta name="description" content="">
  <meta name="author" content="">

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

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    </style>

  </head>

  <body>

    <!-- Start Main Top -->
    <?php include "include/header.php" ?>
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
    <?php include "include/slider.php" ?>
    <!-- End Slider -->

    <div class="categories-shop">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <div class="card card-sm bg-white text-white">
              <div class="card-body text-center">
                <a href="product_po.php" class="btn btn-dark">Pre Order</a>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card card-sm bg-white text-white">
              <div class="card-body text-center">
                <a href="product_ready.php" class="btn btn-dark">Ready Stok</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <style>
      .bg-white {
        background-color: white;
      }
      h3 {
        color: white;
      }
    </style>




    <!-- Start Footer  -->
    <?php include "include/footer.php" ?>
    <!-- End Footer  -->

    <!-- Start copyright  -->
    <div class="footer-copyright">
      <p class="footer-company">All Rights Reserved. &copy; 2018 <a href="#">DND</a> Design By :
        <a href="https://html.design/">html design</a></p>
      </div>
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
      <script src="js/custom.js"></script>
    </body>

    </html>
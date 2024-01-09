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

    <!-- Start Products  -->
    <div class="products-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title-all text-center">
                        <h1>List Of Ready Stok</h1>
                        <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sit amet lacus enim.</p> -->
                    </div>
                </div>
            </div>
            <style>
                /* Styling untuk tampilan desktop */
                .special-list {
                    display: flex;
                    flex-wrap: wrap;
                }

                .special-grid {
                    width: 25%;
                }

                /* mobile version */
                @media only screen and (max-width: 767px) {
                    .special-list {
                        display: block;
                    }

                    .special-grid {
                        width: 50%;
                        float: left;
                    }

                    .type-lb a {
                        font-size: 10px;
                        padding: 5px 10px;
                    }

                    .special-grid .sale {
                        font-size: 12px;
                    }

                    /* style untuk layar ukuran maksimum 767px */
                    .why-text h4 {
                        font-size: 15px;
                    }
                    .why-text h5 {
                        font-size: 10px;
                    }
                }
            </style>
            <div class="row special-list">
              <?php 
              include 'config/conn.php';
              $brandId = $_GET['brand_id'];
              $per_page = 8; 
              $page = isset($_GET['page']) ? $_GET['page'] : 1;
              $start = ($page - 1) * $per_page;
              
              $result = mysqli_query($conn, "SELECT * FROM products WHERE status = 'Publish' AND brand_id = '$brandId' AND type_product = 'Ready Stok' LIMIT $start, $per_page");

              $total = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM products WHERE status = 'Publish' AND brand_id = '$brandId' AND type_product = 'Ready Stok'"));
              $pages = ceil($total / $per_page);
              
              while ($data = mysqli_fetch_array($result)) { ?>
                <div class="col-lg-3 col-md-6 special-grid best-seller">
                  <div class="products-single fix">
                    <div class="box-img-hover">
                      <div class="type-lb">
                        <p class="sale">Sale</p>
                    </div>
                    <a href="shop-detail.php?id=<?php echo $data['id']; ?>"><img src="admin-master/fotoproduk/<?php echo $data['photo']; ?>" class="img-fluid" alt="Image"></a>
                </div>
                <div class="why-text">
                  <h4><a href="shop-detail.php?id=<?php echo $data['id']; ?>"><?php echo $data['name']; ?></a></h4>
              </div>
          </div>
      </div>
  <?php } ?>
</div>
<div class="row">
    <div class="col-12 d-flex justify-content-center">
      <nav aria-label="Page navigation example">
        <ul class="pagination">
          <?php if ($page > 1) { ?>
            <li class="page-item">
              <a class="page-link" href="?brand_id=<?php echo $brandId ?>&page=<?php echo $page - 1 ?>" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
                <span class="sr-only">Previous</span>
            </a>
        </li>
    <?php } ?>

    <?php for ($i = 1; $i <= $pages; $i++) { ?>
        <?php if($i<$page+3 AND $i >$page-3): ?>
          <li class="page-item <?php if ($i == $page) echo 'active' ?>"><a class="page-link" href="?brand_id=<?php echo $brandId ?>&page=<?php echo $i ?>"><?php echo $i ?></a></li>
      <?php endif ?>
  <?php } ?>

  <?php if ($page < $pages) { ?>
    <li class="page-item">
      <a class="page-link" href="?brand_id=<?php echo $brandId ?>&page=<?php echo $page + 1 ?>" aria-label="Next">
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
<!-- End Products  -->

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
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

    <!-- Start All Title Box -->
    <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Shop Detail</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Shop</a></li>
                        <li class="breadcrumb-item active">Shop Detail </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->

    <!-- Start Shop Detail  -->
    <?php
    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }
    else {
        die ("Error. No ID Selected!");    
    }
    include "config/conn.php";
    $query = mysqli_query($conn, "SELECT * FROM products WHERE id='$id'");
    $result = mysqli_fetch_array($query);
    ?>
    <div class="shop-detail-box-main">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 col-lg-5 col-md-6">
                    <div id="carousel-example-1" class="single-product-slider carousel slide" data-ride="carousel">
                        <div class="carousel-inner" role="listbox">
                            <div class="carousel-item active"> <img class="d-block w-100" src="admin-master/fotoproduk/<?=$result['photo']?>" alt="First slide"> </div>
                        </div>
                        <br>
                        <a href="<?php echo $result['link_katalog']; ?>" class="btn btn-primary" target="_blank">Link Katalog</a>

                    </div>
                </div>
                <div class="col-xl-7 col-lg-7 col-md-6">
                    <form action="proses/add_to_cart.php" method="post">
                        <div class="single-product-details">
                            <h2><?php echo $result['name']?></h2>
                            <!-- <h5> <del>$ 60.00</del> $40.79</h5> -->
                            <p>
                                <h4>Short Description:</h4>
                                <p><?=$result['deskripsi']?></p>
                                <ul>
                                    <li>
                                        <div class="form-group size-st">
                                            <label class="size-label">Size</label>
                                            <select class="selectpicker show-tick form-control" id="sizeSelect">
                                                <option value="">Silahkan pilih size</option>
                                                <?php 
                                                $sql1 = "SELECT * FROM product_sizes WHERE product_id = '$id' AND stok != 0";
                                                $result1 = $conn->query($sql1);
                                                while($row = $result1->fetch_assoc()) { ?>
                                                    <option value="<?php echo $row["product_id"] ?>" data-stok="<?php echo $row["stok"] ?>"><?php echo $row["size"] ?></option>
                                                <?php } ?>
                                            </select>
                                            <input type="hidden" name="size" id="selectedSize">
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-group quantity-box">
                                            <label class="control-label">Price</label>
                                            <input type="hidden" name="harga" id="hidden-harga">
                                            <input class="form-control" id="harga" type="text" readonly>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-group quantity-box">
                                            <label class="control-label">Quantity</label>
                                            <input class="form-control" type="number" name="qty" required>
                                            <input class="form-control" type="text" name="type_product" value="<?php echo $result['type_product'] ?>" hidden>
                                        </div>
                                    </li>
                                </ul>
                                <input type="hidden" name="id" value="<?= $result['id']; ?>">
                                <?php if ($result['diskon_produk'] != 0){ ?>
                                    <h3 style="color: red">Potongan Diskon : <?php echo number_format($result['diskon_produk']) ?>%</h3>
                                <?php }else{ ?>
                                    <h3 style="color: red">Potongan Diskon : 0</h3>
                                <?php } ?>
                                <b>Sisa stok : <span id="stok"></span></b>
                                <div class="price-box-bar">
                                    <div class="cart-and-bay-btn">
                                        <input type="submit" name="submit" value="Add to Cart" class="btn hvr-hover" style="color: white;">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
        <!-- End Cart -->

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
        <!-- jQuery Code -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $('#sizeSelect').change(function() {
                var product_id = $(this).val();
                var size = $(this).find(':selected').text();
                var stok = $(this).find(':selected').data('stok');
                $.ajax({
                    url: 'get_price.php',
                    method: 'POST',
                    data: { size: size, product_id: product_id },
                    success: function(data) {
                        $('#harga').val(data);
                        $('#stok').text(stok);
                        $('#selectedSize').val(size);
                        $('#hidden-harga').val(data);
                    }
                });
            });
        </script>

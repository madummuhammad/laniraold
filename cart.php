<?php include "./config/conn.php" ?>
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
                    <h2>Cart</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Shop</a></li>
                        <li class="breadcrumb-item active">Cart</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->

    <!-- Start Cart  -->
    <div class="cart-box-main">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-main table-responsive">
                        <?php 
                        if (!empty($_SESSION["cart"])) { ?>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Images</th>
                                        <th>Product Name</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Product Type</th>
                                        <th>Total</th>
                                        <th>Remove</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $cart_condition=0;
                                    foreach ($_SESSION["cart"] as $key => $cart) {
                                        if($cart['type_product']=='Ready Stok'){
                                        $cart_condition=$cart_condition+$key+1;
                                            $id = $cart['id_produk'];
                                            $query = "SELECT * FROM products WHERE id = '".$id."'";
                                            $result = mysqli_query($conn, $query);
                                            $product = mysqli_fetch_assoc($result);
                                            $subtotal = $cart["harga"] * $cart["jumlah"];
                                            $grandtotal += $subtotal;
                                            ?>
                                            <tr>
                                                <td class="thumbnail-img">
                                                    <a href="#">
                                                        <img class="img-fluid" src="<?php echo $cart['photo'] ?>" alt="" />
                                                    </a>
                                                </td>
                                                <td class="name-pr">
                                                    <a href="#">
                                                        <?php echo $product['name'] ?>, <b>(<?=$cart['size']?>)</b>
                                                    </a>
                                                </td>
                                                <td class="price-pr">
                                                    <p><?php echo $cart['harga'] ?></p>
                                                </td>
                                                <td class="quantity-box"><input readonly type="text" size="4" value="<?php echo $cart['jumlah'] ?>" min="0" step="1" class="c-input-text qty text" style="border:none; background: none;"></td>
                                                <td><?php echo $product['type_product'] ?></td>
                                                <td class="total-pr">
                                                    <p><?php echo $subtotal ?></p>
                                                </td>
                                                <td class="remove-pr">
                                                    <a href="proses/hapus_cart.php?id=<?php echo $key ?>">
                                                        <i class="fas fa-times"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php }} ?>
                                    </tbody>
                                </table>
                                <?php 
                            }
                            if($cart_condition==0){
                                echo "<script>alert('Keranjang kosong, yuk belanja!');</script>";
                                echo "<script>location='index.php';</script>";
                            }

                            ?>
                        </div>
                    </div>
                </div>

            <div class="row my-5">
                <div class="col-lg-8 col-sm-12"></div>
                <div class="col-lg-4 col-sm-12">
                    <div class="order-box">
                        <h3>Order summary</h3>
                        <hr>
                        <div class="d-flex gr-total">
                            <h5>Grand Total</h5>
                            <div class="ml-auto h5"> Rp. <?php echo number_format($grandtotal); ?> </div>
                        </div>
                        <hr> </div>
                    </div>
                    <div class="col-12 d-flex shopping-box"><a href="checkout.php" class="ml-auto btn hvr-hover">Checkout</a> </div>
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
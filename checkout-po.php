<?php include "./config/conn.php" ?>
<?php 
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['email'])) {
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

    <!-- Start All Title Box -->
    <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Checkout Pre Order</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Shop</a></li>
                        <li class="breadcrumb-item active">Checkout Pre Order</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="cart-box-main">
        <div class="container">
            <?php 
            $id = $_SESSION['id'];
            $email = $_SESSION['email'];
            $query = "SELECT * FROM members WHERE id = '$id'";
            $result = mysqli_query($conn, $query);
            $member = mysqli_fetch_assoc($result);
            ?>
            <div class="row">
                <div class="col-sm-6 col-lg-6 mb-3">
                    <div class="checkout-address">
                        <div class="title-left">
                            <h3>Billing address</h3>
                        </div>
                        <form class="needs-validation" action="" method="post">
                            <div class="mb-3">
                                <label for="username">Email *</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="username" placeholder="" value="<?php echo $email; ?>" required readonly>
                                    <div class="invalid-feedback" style="width: 100%;"> Your username is required. </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="email">Nama Penerima *</label>
                                <input type="text" class="form-control" id="email" placeholder="" name="nama_penerima">
                                <div class="invalid-feedback"> Please enter a valid email address for shipping updates. </div>
                            </div>
                            <div class="mb-3">
                                <label for="address">Catatan</label>
                                <input type="text" class="form-control" id="catatan" placeholder="" name="catatan">
                            </div>
                            <div class="mb-3">
                                <label for="address">Telepon *</label>
                                <input type="number" class="form-control" id="phone" placeholder="" name="phone">
                                <div class="invalid-feedback"> Please enter your phone. </div>
                            </div>
                            <div class="mb-3 form-check">
                                <input class="form-check-input" type="checkbox" value="" id="is_dropship">
                                <label class="form-check-label" for="defaultCheck1">
                                    Kirim Sebagai Dropshipper
                                </label>
                            </div>
                            <div id="dropship-content">

                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-6 mb-3">
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="odr-box">
                                    <div class="title-left">
                                        <h3>Shopping cart</h3>
                                    </div>
                                    <?php $total_belanja = 0; ?>
                                    <?php $total_berat = 0; ?>
                                    <?php
                                    $cart_condition=0;
                                    foreach ($_SESSION["cart"] as $key => $cart) {
                                        if($cart['type_product']=='PO'){
                                            $cart_condition=$cart_condition+$key+1;
                                            $id = $cart['id_produk'];
                                            $query = "SELECT * FROM products WHERE id = '".$id."'";
                                            $result = mysqli_query($conn, $query);
                                            $product = mysqli_fetch_assoc($result);
                                            $subtotal = $cart["harga"] * $cart["jumlah"];
                                            $subberat = $product['berat'] * $cart["jumlah"];
                                            $total_berat+=$subberat;
                                            ?>

                                            <div class="rounded p-2 bg-light">
                                                <div class="media mb-2 border-bottom">
                                                    <div class="media-body"><?php echo $product['name'] ?>, <b>Size : <?php echo $cart['size'] ?></b>
                                                        <div class="small text-muted">Price: Rp. <?php echo $cart['harga'] ?> <span class="mx-2">|</span> Qty: <?php echo $cart['jumlah'] ?> <span class="mx-2">|</span> Subtotal: Rp.<?php echo number_format($subtotal) ?></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php $total_belanja+=$subtotal ?>
                                        <?php }} ?>
                                    </div>
                                </div>
                                <input type="hidden" name="total_berat" value="<?php echo $total_berat; ?>">
                                <input type="hidden" name="provinsi">
                                <input type="hidden" name="distrik">
                                <input type="hidden" name="tipe">
                                <input type="hidden" name="kodepos">
                                <input type="hidden" name="ekspedisi">
                                <input type="hidden" name="paket">
                                <input type="hidden" name="estimasi">
                                <div class="col-md-12 col-lg-12">
                                    <div class="order-box">
                                        <div class="title-left">
                                            <h3>Your order</h3>
                                        </div>
                                        <div class="d-flex">
                                            <div class="font-weight-bold">Product</div>
                                            <div class="ml-auto font-weight-bold">Total</div>
                                        </div>
                                        <hr class="my-1">
                                        <div class="d-flex">
                                            <h4>Sub Total</h4>
                                            <div class="ml-auto font-weight-bold1"> Rp. <?php echo number_format($total_belanja); ?> </div>
                                        </div>
                                        <div class="d-flex">
                                            <h4>Shipping Cost</h4>
                                            <div class="ml-auto font-weight-bold"> <input type="text" class="form-control" name="ongkir" style="border:none; background: none; text-align: right; margin-left: 13px;" value="0" readonly> </div>
                                        </div>
                                        <hr>
                                        <div class="d-flex gr-total">
                                            <h5>Grand Total</h5>
                                            <div class="ml-auto font-weight-bold"><div class="total"><?php echo number_format($total_belanja) ?></div></div>
                                        </div>
                                        <hr> </div>
                                    </div>
                                    <div class="col-12 d-flex shopping-box"> 
                                        <button class="ml-auto btn hvr-hover" name="checkout" style="color: white">Checkout</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- End Cart -->

            <!-- proses checkout -->
            <?php
            if(isset($_POST["checkout"])){
                $id = $_SESSION['id'];
                $order_email = $_SESSION['email'];
                $address = $_POST['address'];
                $catatan = $_POST['catatan'];
                $phone = $_POST['phone'];
                $nama_penerima = $_POST['nama_penerima'];


                $query = "SELECT * FROM members WHERE id = '$id'";
                $result = mysqli_query($conn, $query);
                $member = mysqli_fetch_assoc($result);

                $provinsi = $_POST['provinsi'];
                $distrik = $_POST['distrik'];
                $tipe = $_POST['tipe'];
                $ekspedisi = $_POST['ekspedisi'];
                $paket = $_POST['paket'];
                $estimasi = $_POST['estimasi'];
                $ongkir = $_POST['ongkir'];
                $berat = $_POST['total_berat'];
                $sender_dropship=$_POST['sender_dropship'];
                $phone_dropship=$_POST['phone_dropship'];
                $total = $total_belanja;
                $order_email = $member['email'];
                $order_tel = $member['no_wa'];

                $order_type='PO';

                $sql = "INSERT INTO `orders` 
                (
                 `order_time`,
                 `order_status`,
                 `confirm_payment`,
                 `member_id`,
                 `order_email`,
                 `nama_penerima`,
                 `order_tel`,
                 `catatan`,
                 `phone`,
                 `tipe`,
                 `total`,
                 `phone_dropship`,
                 `sender_dropship`,
                 `order_type`
                 ) 
                VALUES 
                (
                 '".date("Y-m-d")."',
                 'order',
                 'Not Uploaded',
                 '$id',
                 '$order_email',
                 '$nama_penerima',
                 '$order_tel',
                 '$catatan',
                 '$phone',
                 '$tipe',
                 '$total',
                 '$phone_dropship',
                 '$sender_dropship',
                 '$order_type'
             )";

             $query=$conn->query($sql);
             if ($query === TRUE) {
                echo "Rekaman baru berhasil dibuat";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            $id_transaksi = mysqli_insert_id($conn);

            foreach ($_SESSION["cart"] as $key => $cart) {

              $query_item = "SELECT * FROM products WHERE id = '".$cart['id_produk']."'";
              $result_item = mysqli_query($conn, $query_item) or die(mysqli_error($conn));
              $product = mysqli_fetch_assoc($result_item);

              $query_options = "SELECT * FROM product_sizes WHERE id = '".$cart['size_id']."'";
              $result_options = mysqli_query($conn, $query_options) or die(mysqli_error($conn));
              $options = mysqli_fetch_assoc($result_options);

              $new_stock = $options['stok'] - $cart["jumlah"];

              $sql_update = "UPDATE product_sizes SET stok = '$new_stock' WHERE id = '$cart[size_id]'";
              $query_update = mysqli_query($conn, $sql_update);

              $name = $product['name'];
              $order_type='PO';

              $sql = "INSERT INTO `orders_item` 
              (
                  `order_id`,
                  `product_id`,
                  `product_name`,
                  `qty`,
                  `price`,
                  `size_id`,
                  `order_type`,
                  `ct_status`
                  ) 
              VALUES 
              (
                  ".$id_transaksi.",
                  '".$cart["id_produk"]."',
                  '$name',
                  '".$cart["jumlah"]."',
                  '".$cart["harga"]."',
                  '".$cart["size_id"]."',
                  '".$order_type."',
                  'order'
              )";
              $query_item = mysqli_query($conn, $sql);
          }


          unset($_SESSION["cart"]);
          echo "<script>window.location.href='detail_pesanan-po.php?id=".$id_transaksi."';</script>";
          die();
      }
      ?>


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
    <?php 
}else{
    echo "<script>alert('Silahkan Login terlebih dahulu');</script>";
    echo "<script>location='login.php';</script>";
}
?>

<script>
    $(document).ready(function(){
      $.ajax({
        type: 'post',
        url: 'rajaongkir/dataprovinsi.php',
        success: function(hasil_provinsi){
          $("select[name=nama_provinsi]").html(hasil_provinsi);
      }
  });

      $("select[name=nama_provinsi]").on("change", function(){
        var id_provinsi_terpilih = $("option:selected", this).attr("id_provinsi");
        $.ajax({
          type: 'post',
          url: 'rajaongkir/datadistrik.php',
          data: 'id_provinsi='+id_provinsi_terpilih,
          success:function(hasil_distrik){
            $("select[name=nama_distrik]").html(hasil_distrik);
        }
    })
    });

      $("#is_dropship").on('change',function(){
        if(this.checked){
            $("#dropship-content").html(
                `<div class="mb-3">
                <label for="address">Nama Pengirim *</label>
                <input type="text" class="form-control" id="phone" placeholder="" required name="sender_dropship">
                <div class="invalid-feedback"> Please enter your phone. </div>
                </div>
                <div class="mb-3">
                <label for="address">Telepon Pengirim *</label>
                <input type="number" class="form-control" id="phone" placeholder="" required name="phone_dropship">
                <div class="invalid-feedback"> Please enter your phone. </div>
                </div>`
                )
        } else {
            $("#dropship-content").html("")
        }
    })

      $.ajax({
        type: 'post',
        url: 'rajaongkir/jasaekspedisi.php',
        success: function(hasil_ekspedisi){
            console.log('hasil_ekspedisi',hasil_ekspedisi);
            $("select[name=nama_ekspedisi]").html(hasil_ekspedisi);
        }
    });

      $("select[name=nama_ekspedisi]").on("change", function(){
        var ekspedisi_terpilih = $("select[name=nama_ekspedisi]").val();
        var distrik_terpilih = $("option:selected", "select[name=nama_distrik]").attr("id_distrik");
        $total_berat = $("input[name=total_berat]").val();
        $.ajax({
          type: 'post',
          url: 'rajaongkir/datapaket.php',
          data: 'ekspedisi='+ekspedisi_terpilih+'&distrik='+distrik_terpilih+'&berat='+$total_berat,
          success: function(hasil_paket){
            console.log('hasil paket',hasil_paket);
            $("select[name=nama_paket]").html(hasil_paket);

            // Meletakkan nama ekspedisi terpilih di input ekspedisi
            $("input[name=ekspedisi]").val(ekspedisi_terpilih);
        }
    })
    });

      var prov;
      var dist;

      $("select[name=nama_distrik]").on("change", function(){
        // var prov = $("option:selected", this).attr('nama_provinsi');
        prov = $("option:selected", this).attr('nama_provinsi');
        // var dist = $("option:selected", this).attr('nama_distrik');
        dist = $("option:selected", this).attr('nama_distrik');
        var tipe = $("option:selected", this).attr('tipe_distrik');
        var kodepos = $("option:selected", this).attr('kodepos');

        $("input[name=provinsi]").val(prov);
        $("input[name=distrik]").val(dist);
        $("input[name=tipe]").val(tipe);
        $("input[name=kodepos]").val(kodepos);
    });

      $("select[name=nama_paket]").on("change", function(){
        var provinsi = prov;
        var distrik = dist;
        var paket = $("option:selected", this).attr("paket");
        var ongkir = $("option:selected", this).attr("ongkir");
        var etd = $("option:selected", this).attr("etd");

        console.log(provinsi);
        console.log(distrik);

        $("input[name=paket]").val(paket);

        /*if(parseFloat($("div.font-weight-bold1").text().replace(/[^0-9]/g, '')) >= 1000000) {
            ongkir = 0;
        }*/

        /*if(distrik === 'Jakarta Barat' || distrik === 'Jakarta Pusat' || distrik === 'Jakarta Selatan' || distrik === 'Jakarta Timur' || distrik === 'Jakarta Utara' || distrik === 'Kepulauan Seribu' || distrik === 'Bekasi' || distrik === 'Bogor' || distrik === 'Depok' || distrik === 'Cilegon' || distrik === 'Lebak' || distrik === 'Pandeglang' || distrik === 'Serang' || distrik === 'Tangerang' || distrik === 'Tangerang Selatan' || provinsi === 'Bali' && parseFloat($("div.font-weight-bold1").text().replace(/[^0-9]/g, '')) >= 1000000) {
            ongkir = 0;
        }*/

        /*var cities = ['Jakarta Barat', 'Jakarta Pusat', 'Jakarta Selatan', 'Jakarta Timur', 'Jakarta Utara', 'Kepulauan Seribu', 'Bekasi', 'Bogor', 'Depok', 'Cilegon', 'Lebak', 'Pandeglang', 'Serang', 'Tangerang', 'Tangerang Selatan'];
        if(provinsi === 'Bali' && parseFloat($("div.font-weight-bold1").text().replace(/[^0-9]/g, '')) >= 1000000) {
            ongkir = 0;
        } else if(cities.includes(distrik)) {
            ongkir = 0;
        }*/
        
        $("input[name=ongkir]").val(ongkir).css("font-weight", "bold");
        $("input[name=estimasi]").val(etd + " Hari");

        var grandtotal = parseInt($(".ml-auto.font-weight-bold1").text().replace(/[^0-9]/g, ''));
        
        if(parseFloat($("div.font-weight-bold1").text().replace(/[^0-9]/g, '')) >= 1000000) {
            $("div.total").text("Rp. " + grandtotal.toLocaleString());
        } else {
            var total = parseFloat(ongkir) + parseFloat(grandtotal)
            $("div.total").text("Rp. " + total.toLocaleString());
        }

        if (total >= 1000000000000000000) {
            console.log("dapet voucher");
            document.querySelector(".dapet_voucher").style.display = "flex";
        } else {
            document.querySelector(".dapet_voucher").style.display = "none";
        }

    })


      $("#btnApplyVoucher").on("click", function() {
        var voucher = $("input[name=voucher]").val();
        var nilai_voucher = $("input[name=nilai_voucher]").val();
        var grandtotal = parseInt($(".ml-auto.font-weight-bold1").text().replace(/[^0-9]/g, ''));
        var ongkir = $("input[name=ongkir]").val();
        var total = parseFloat(ongkir) + parseFloat(grandtotal);

        /*if (voucher === "PROMOMARET") {
            total -= nilai_voucher;
            $("div.total").text("Rp. " + total.toLocaleString());
            alert("Kode voucher berhasil digunakan!");
        } else {
            alert("Kode voucher tidak valid.");
        }*/

        if (voucher === "PROMOMARET" && total >= 200000) {
            total -= 10000;
            $("div.total").text("Rp. " + total.toLocaleString());
            alert("Kode voucher berhasil digunakan!");
        } else if (total < 200000) {
            alert("Total belanja harus minimal Rp. 200.000 untuk dapat menggunakan kode voucher ini.");
        } else {
            alert("Kode voucher tidak valid.");
        }
    });


  });
</script>
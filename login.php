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

    <!-- Start All Title Box -->
    <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Shop</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->

    <!-- Start Cart  -->
    <div class="cart-box-main">
        <div class="container">
            <div class="row new-account-login">
                <div class="col-sm-6 col-lg-6 mb-3">
                    <?php if(isset($_GET['error'])): ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $_GET['error'] ?>
                        </div>
                    <?php endif ?>
                    <h5><a data-toggle="collapse" href="#formLogin" role="button" aria-expanded="false">Klik disini untuk Login</a></h5>
                    <form class="mt-3 collapse review-form-box" id="formLogin" action="proses/process_login.php" method="POST">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                              <label for="InputEmail" class="mb-0">Email Address</label>
                              <input type="email" class="form-control" id="InputEmail" placeholder="Enter Email" name="email"> </div>
                              <div class="form-group col-md-6">
                                <label for="InputPassword" class="mb-0">Password</label>
                                <div class="input-group">

                                    <input type="password" class="form-control" id="InputPassword" placeholder="Password" name="password">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                          <span id="eye" style="cursor:pointer" class="fas fa-eye"></span>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <button type="submit" class="btn hvr-hover">Login</button>
                  </form>
              </div>
              <div class="col-sm-6 col-lg-6 mb-3">
                <h5><a data-toggle="collapse" href="#formRegister" role="button" aria-expanded="false">Klik disini untuk Daftar</a></h5>
                <form class="mt-3 collapse review-form-box" id="formRegister" action="" method="post">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="InputName" class="mb-0">Nama</label>
                            <input type="text" class="form-control" id="InputName" placeholder="Name" name="nama" required> </div>
                            <div class="form-group col-md-6">
                                <label for="InputEmail1" class="mb-0">Email</label>
                                <input type="email" class="form-control" id="InputEmail1" placeholder="Enter Email" name="email" required> </div>
                                <div class="form-group col-md-6">
                                    <label for="InputPassword1" class="mb-0">Password</label>
                                    <div class="input-group">                                            
                                        <input type="password" class="form-control" id="InputPassword1" placeholder="Password" name="password" required>
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span id="eye1" style="cursor:pointer" class="fas fa-eye"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="InputPassword1" class="mb-0">No WhatsApp</label>
                                    <input type="text" class="form-control" id="InputTelepon" placeholder="Telepon" name="no_wa" required> </div>
                                </div>
                                <button type="submit" class="btn hvr-hover" name="register">Daftar</button>
                            </form>
                            <?php
                            include "config/conn.php";

                            if(isset($_POST["register"])){
                                $nama = $_POST['nama'];
                                $email = $_POST['email'];
                                $password = md5($_POST['password']);
                                $no_wa = $_POST['no_wa'];

                                if (!$conn) {
                                    die("Koneksi gagal: " . mysqli_connect_error());
                                }

                                $sql = "INSERT INTO members 
                                (
                                    nama, 
                                    email, 
                                    password, 
                                    no_wa
                                    ) 
                                VALUES 
                                (
                                    '$nama', 
                                    '$email', 
                                    '$password', 
                                    '$no_wa'
                                )";

                                if (mysqli_query($conn, $sql)) {
                                    echo "<script>alert('Pendaftaran berhasil, silahkan login');</script>";
                                    echo "<script>location='login.php';</script>";
                                } else {
                                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                                }

                                mysqli_close($conn);
                            }
                            ?>

                        </div>
                    </div>
                </div>
            </div>


            <!-- Start Footer  -->
            <?php include "include/footer.php" ?>

            <!-- End Footer  -->


            <a href="#" id="back-to-top" title="Back to top" style="display: none;">&uarr;</a>

            <!-- ALL JS FILES -->
            <script src="js/jquery-3.2.1.min.js"></script>
            <script type="text/javascript">
                $("#eye").on('click',function(){
                            // $("#InputPassword").attr('type', 'text');
                            if ($("#InputPassword").attr('type') === 'text') {
                                $("#InputPassword").attr('type', 'password');
                            } else {
                                $("#InputPassword").attr('type', 'text');
                            }
                        });
                $("#eye1").on('click',function(){
                            // $("#InputPassword").attr('type', 'text');
                            if ($("#InputPassword1").attr('type') === 'text') {
                                $("#InputPassword1").attr('type', 'password');
                            } else {
                                $("#InputPassword1").attr('type', 'text');
                            }
                        });
                    </script>
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
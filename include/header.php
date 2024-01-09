<header class="main-header">
    <!-- Start Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-default bootsnav">
        <div class="container">
            <!-- Start Header Navigation -->
            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-menu" aria-controls="navbars-rs-food" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="index.php"><img src="images/logo.png" class="logo" alt=""></a>
            </div>
            <!-- End Header Navigation -->

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="navbar-menu">
                <ul class="nav navbar-nav ml-auto" data-in="fadeInDown" data-out="fadeOutUp">
                    <li class="nav-item active"><a class="nav-link" href="index.php">Home</a></li>
                    <?php if (isset($_SESSION['id']) && isset($_SESSION['email'])) { ?>
                        <li class="nav-item"><a class="nav-link" href="cart.php">Keranjang</a></li>
                        <li class="nav-item"><a class="nav-link" href="cart-po.php">Keranjang PO</a></li>
                        <!-- <li class="nav-item"><a class="nav-link" href="checkout.php">Checkout</a></li> -->
                        <li class="nav-item"><a class="nav-link" href="myorder.php">Pesanan</a></li>
                        <li class="nav-item"><a class="nav-link" href="proses/process_logout.php">Logout</a></li>
                    <?php }else{ ?>
                        <li class="nav-item"><a class="nav-link" href="cart.php">Keranjang</a></li>
                        <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                    <?php } ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
    </nav>
    <!-- End Navigation -->
</header>
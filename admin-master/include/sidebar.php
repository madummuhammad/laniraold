<?php 
include "../config/conn.php";
?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index.php" class="brand-link">
    <img src="assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">DND System</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">Admin</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="member.php" class="nav-link">
            <i class="nav-icon fas fa-user"></i>
            <p>
              Data Member
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="product.php" class="nav-link">
            <i class="nav-icon fas fa-database"></i>
            <p>
              Data Produk
            </p>
          </a>
        </li>

        <?php 
        if ($_SESSION['role'] == 'supervisor'){
          ?>
          <li class="nav-item">
            <a href="order.php" class="nav-link">
              <i class="nav-icon fas fa-database"></i>
              <p>
                Data Order
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="order-po.php" class="nav-link">
              <i class="nav-icon fas fa-database"></i>
              <p>
                Data Order PO
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="sold.php" class="nav-link">
              <i class="nav-icon fas fa-database"></i>
              <p>
                Produk Terjual
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="expedisi.php" class="nav-link">
              <i class="nav-icon fas fa-database"></i>
              <p>
                Pengaturan Expedisi
              </p>
            </a>
          </li>
        <?php } ?>
        <li class="nav-item">
          <a href="slider.php" class="nav-link">
            <i class="nav-icon fas fa-database"></i>
            <p>
             Pengaturan Slider
           </p>
         </a>
       </li>
       <li class="nav-item">
        <a href="footer_admin.php" class="nav-link">
          <i class="nav-icon fas fa-database"></i>
          <p>
           Footer Edit
         </p>
       </a>
     </li>
     <li class="nav-item">
      <a href="proses/process_logout.php" class="nav-link">
        <i class="nav-icon fas fa-sign-out-alt"></i>
        <p>
          Logout
        </p>
      </a>
    </li>
  </ul>
</nav>
<!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
</aside>
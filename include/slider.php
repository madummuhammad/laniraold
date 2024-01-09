<?php  
include "./config/conn.php";
?>
<div id="slides-shop" class="cover-slides">
  <ul class="slides-container">
    <?php 
    include 'config/conn.php';
    $result = mysqli_query($conn, "SELECT * FROM slider");
    while ($data = mysqli_fetch_array($result)) { ?>
      <li class="text-left">
        <img src="admin-master/fotoslider/<?=$data['gambar']?>" class="slider-image">
      </li>
    <?php } ?>
  </ul>
  <div class="slides-navigation">
    <a href="#" class="next"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
    <a href="#" class="prev"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
  </div>
</div>
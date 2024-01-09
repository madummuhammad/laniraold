<?php
  include 'config/conn.php';
  
  $size = $_POST['size'];
  $product_id = $_POST['product_id'];
  
  $query = "SELECT * FROM product_sizes WHERE size = '$size' AND product_id = '$product_id'";
  $result = $conn->query($query);
  
  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo $row['price'];
  } else {
    echo "Harga tidak ditemukan";
  }
  $conn->close();
?>

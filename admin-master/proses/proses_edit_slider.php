<?php
include "../../config/conn.php";

$id = $_POST['id'];
$gambar_produk = $_POST['old_img'];

if(!empty($_FILES['img']['name'])){
    $lokasi_gambar_produk = $_FILES['img']['tmp_name'];
    $nama_gambar_produk = date('YmdHis').$_FILES['img']['name'];
    move_uploaded_file($lokasi_gambar_produk, "../fotoslider/$nama_gambar_produk");

    if(!empty($gambar_produk)){
        unlink("../fotoslider/$gambar_produk");
    }

    $gambar_produk = $nama_gambar_produk;
}

$sql = "UPDATE slider SET gambar='$gambar_produk' WHERE id='$id'";

if (mysqli_query($conn, $sql)) {
  echo "<script>alert('Update slider berhasil!');</script>";
  echo "<script>location='../slider.php';</script>";
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>

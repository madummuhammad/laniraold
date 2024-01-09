<?php 

include "../../config/conn.php";

$gambarproduk = $_FILES['img']['name'];
$lokasigambar = $_FILES['img']['tmp_name'];
$nama_gambar = date('YmdHis').$gambarproduk;
move_uploaded_file($lokasigambar, "../fotoslider/$nama_gambar");

$sql = "INSERT INTO `slider` 
(
    `gambar`
) 
VALUES 
(
    '$nama_gambar'
)";

if (mysqli_query($conn, $sql)) {
  echo "<script>alert('Input slider berhasil!');</script>";
  echo "<script>location='../slider.php';</script>";
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>

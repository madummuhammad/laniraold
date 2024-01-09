<?php 
include "../../config/conn.php";

$nama = $_POST['nama'];
$email = $_POST['email'];
$password = md5($_POST['password']);
$no_wa = $_POST['no_wa'];


$sql = "INSERT INTO `members` 
(
    `nama`,
    `email`,
    `password`,
    `no_wa`
) 
VALUES 
(
    '$nama',
    '$email',
    '$password',
    '$no_wa'
)";


if (mysqli_query($conn, $sql)) {
  echo "<script>alert('Input member berhasil!');</script>";
  echo "<script>location='../member.php';</script>";
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>

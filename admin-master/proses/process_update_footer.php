<?php
include "../../config/conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $about = $_POST["about"];
  $contact = $_POST["contact"];
  $phone = $_POST["phone"];
  $email = $_POST["email"];

  $query = "UPDATE footer_content SET about='$about', contact='$contact', phone='$phone', email='$email'";
  $result = mysqli_query($conn, $query);

  if ($result) {
    echo "<script>alert('Footer content updated successfully.');</script>";
    echo "<script>window.location.href = '../footer_admin.php';</script>";
  } else {
    echo "<script>alert('Failed to update footer content.');</script>";
    echo "<script>window.location.href = '../footer_admin.php';</script>";
  }
}

// Menutup koneksi
mysqli_close($conn);
?>

<?php 
include "../../config/conn.php";
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Perintah SQL untuk menghapus data produk berdasarkan ID
    $query = "DELETE FROM members WHERE id = '$id'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Jika penghapusan berhasil, redirect ke halaman produk atau tampilkan pesan sukses
        header("Location: ../member.php");
        exit();
    } else {
        // Jika terjadi kesalahan, tampilkan pesan error
        echo "Error: " . mysqli_error($conn);
    }
} else {
    // Jika ID tidak ditemukan, tampilkan pesan error atau redirect ke halaman lain
    echo "Invalid ID";
}
?>
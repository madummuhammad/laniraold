<?php
// Koneksi ke database dan impor file conn.php jika belum dilakukan
include "../config/conn.php";

if (isset($_POST['orderId'])) {
  $orderId = $_POST['orderId'];

  // Catat informasi order yang akan dihapus
  $orderInfoQuery = "SELECT * FROM orders WHERE id = $orderId";
  $orderInfoResult = mysqli_query($conn, $orderInfoQuery);
  $orderInfo = mysqli_fetch_assoc($orderInfoResult);

  if ($orderInfo) {
    // Masukkan informasi order ke dalam tabel order_deletes
    $insertQuery = "INSERT INTO order_deletes (order_id, order_time, order_status, confirm_payment, member_id, order_email, nama_penerima, order_tel, address, catatan, phone, provinsi, distrik, tipe, ekspedisi, paket, estimasi, ongkir, berat, voucher, resi, total, phone_dropship, sender_dropship, order_type, user_id) 
    VALUES (
      '" . $orderInfo['id'] . "', 
      '" . $orderInfo['order_time'] . "', 
      '" . $orderInfo['order_status'] . "', 
      '" . $orderInfo['confirm_payment'] . "', 
      '" . $orderInfo['member_id'] . "', 
      '" . $orderInfo['order_email'] . "', 
      '" . $orderInfo['nama_penerima'] . "', 
      '" . $orderInfo['order_tel'] . "', 
      '" . $orderInfo['address'] . "', 
      '" . $orderInfo['catatan'] . "', 
      '" . $orderInfo['phone'] . "', 
      '" . $orderInfo['provinsi'] . "', 
      '" . $orderInfo['distrik'] . "', 
      '" . $orderInfo['tipe'] . "', 
      '" . $orderInfo['ekspedisi'] . "', 
      '" . $orderInfo['paket'] . "', 
      '" . $orderInfo['estimasi'] . "', 
      '" . $orderInfo['ongkir'] . "', 
      '" . $orderInfo['berat'] . "', 
      '" . $orderInfo['voucher'] . "', 
      '" . $orderInfo['resi'] . "', 
      '" . $orderInfo['total'] . "', 
      '" . $orderInfo['phone_dropship'] . "', 
      '" . $orderInfo['sender_dropship'] . "', 
      '" . $orderInfo['order_type'] . "', 
      '" . $_SESSION['id'] . "'
    )";

    if (mysqli_query($conn, $insertQuery)) {
      // Lakukan penghapusan order berdasarkan orderId
      $deleteQuery = "DELETE FROM orders WHERE id = $orderId";
      if (mysqli_query($conn, $deleteQuery)) {
        echo "Order berhasil dihapus dan log aktivitas telah dicatat.";
      } else {
        echo "Gagal menghapus order. Error: " . mysqli_error($conn);
      }
    } else {
      echo "Gagal mencatat log aktivitas. Error: " . mysqli_error($conn);
    }
  } else {
    echo "Tidak dapat menemukan informasi order dengan ID yang diberikan.";
  }
} else {
  echo "Permintaan tidak valid. Silakan coba lagi.";
}
?>

<?php
include "../../config/conn.php";

// Set timezone
date_default_timezone_set('Asia/Jakarta');

// Get month filter
$month = isset($_GET['bulan']) ? $_GET['bulan'] : null;

// Prepare filename
$filename = 'pre_order_report_transaksi.csv';

// Set headers for CSV download
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="' . $filename . '"');
header('Pragma: no-cache');
header('Expires: 0');

// Open a stream to output CSV data
$output = fopen('php://output', 'w');

// Write CSV header row
fputcsv($output, array('Order ID', 'Tanggal', 'Alamat', 'Nomor Resi', 'Total'));

$sql = "SELECT * FROM orders WHERE order_type='PO'";

if ($month && !empty($month)) {
  $sql .= " AND MONTH(order_time) = '$month'";
}

$sql .= " ORDER BY order_time DESC";

// Execute SQL query and fetch data
$result = mysqli_query($conn, $sql);
$total = 0;
while ($row = mysqli_fetch_assoc($result)) {
  $total += $row['total'];

  // Format date to dd/mm/yyyy
  $order_time = date('d/m/Y', strtotime($row['order_time']));

  // Write CSV row
  fputcsv($output, array($row['id'], $order_time, $row['address'], $row['resi'], $row['total']));
}

// Write total row
fputcsv($output, array('Total', '', '', '', $total));

// Close the stream
fclose($output);

exit;
?>

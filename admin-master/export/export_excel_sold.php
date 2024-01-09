<?php
include "../../config/conn.php";

// Set timezone
date_default_timezone_set('Asia/Jakarta');

// Get search filter
$search = isset($_GET['search']) ? $_GET['search'] : null;

// Prepare filename
$filename = 'report_terjual.csv';

// Set headers for CSV download
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="' . $filename . '"');
header('Pragma: no-cache');
header('Expires: 0');

// Open a stream to output CSV data
$output = fopen('php://output', 'w');

// Write CSV header row
fputcsv($output, array('Produk Name', 'Size', 'Terjual'));

$query = "SELECT oi.product_name, ps.size, SUM(oi.qty) AS total_sold
FROM orders_item oi
JOIN product_sizes ps ON oi.size_id = ps.id
JOIN orders o ON oi.order_id = o.id
JOIN members m ON o.member_id = m.id";

if ($search && !empty($search)) {
  $query .= " WHERE oi.product_name LIKE '%$search%'";
}

$query .= " GROUP BY oi.product_name, ps.size
ORDER BY total_sold DESC";

// Execute SQL query and fetch data
$result = mysqli_query($conn, $query);

while ($row = mysqli_fetch_assoc($result)) {
  // Write CSV row
  fputcsv($output, array($row['product_name'], $row['size'], $row['total_sold']));
}

// Close the stream
fclose($output);

exit;
?>

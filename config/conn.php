<?php
error_reporting(0);
session_start();
$servername = "localhost";
	// $username = "ykbgddrh_dnd";
	// $password = "fL1?084sl";
$username = "root";
$password = "";
$dbname = "ykbgddrh_dnd";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
	die("Koneksi gagal: " . $conn->connect_error);
}
?>
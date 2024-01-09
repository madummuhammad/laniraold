<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require('libs/fpdf181/fpdf.php');
include "../config/conn.php";

class Invoice extends FPDF
{
	private $conn;

	public function __construct($conn)
	{
		parent::__construct();
		$this->conn = $conn;
	}

	public function GenerateInvoice($id)
	{
		$this->AddPage();
		$this->SetFont('Arial', 'B', 14);

		$query = "SELECT * FROM orders WHERE id = '$id'";
		$result = mysqli_query($this->conn, $query);
		$order = mysqli_fetch_assoc($result);

		$this->SetFont('Arial', 'B', 16);
		$this->Cell(40, 10, 'Invoice', 0, 1);
		$this->Ln();


		$this->SetFont('Arial', '', 12);
		$this->Cell(40, 10, 'Order ID:', 0, 0);
		$this->SetFont('Arial', 'B', 12);
		$this->Cell(40, 10, str_repeat('#', 1) . $order['id'], 0, 0);
		$this->SetFont('Arial', '', 12);
		$this->Cell(40, 10, 'Tanggal:', 0, 0);
		$this->Cell(40, 10, $order['order_time'], 0, 1);

		$this->SetFont('Arial', '', 12);
		$this->Cell(40, 10, 'Nama Penerima:', 0, 0);
		$this->SetFont('Arial', 'B', 12);
		$this->Cell(40, 10, $order['nama_penerima'], 0, 0);
		$this->SetFont('Arial', '', 12);
		$this->Cell(40, 10, 'No Telp:', 0, 0);
		$this->Cell(40, 10, $order['phone'], 0, 1);

		$this->SetFont('Arial', '', 12);
		$this->Cell(40, 10, 'Alamat Pengiriman:', 0, 0);
		$this->SetFont('Arial', 'B', 10);
		$this->MultiCell(0, 10, $order['address'] . ', ' . $order['distrik'] . ', ' . $order['provinsi'], 0, 'L');
		$this->Ln();

		$this->SetFont('Arial', 'B', 10);
		$this->Cell(40, 10, 'Detail Pesanan:', 0, 1);
		$this->Cell(60, 10, 'Nama Produk', 1, 0, 'C');
		$this->Cell(20, 10, 'Harga', 1, 0, 'C');
		$this->Cell(20, 10, 'Size', 1, 0, 'C');
		$this->Cell(20, 10, 'Jumlah', 1, 0, 'C');
		$this->Cell(40, 10, 'Total', 1, 1, 'C');

		$this->SetFont('Arial', '', 10);
		$query_produk = "SELECT oi.product_name, oi.price, ps.size, oi.qty
		FROM orders_item oi
		JOIN product_sizes ps ON oi.size_id = ps.id
		WHERE oi.order_id = '$id'";
		$result_produk = mysqli_query($this->conn, $query_produk);
		$total_harga_produk = 0;

		while ($produk = mysqli_fetch_assoc($result_produk)) {
			$this->Cell(60, 10, $produk['product_name'], 1, 0, 'L');
			$this->Cell(20, 10, number_format($produk['price']), 1, 0, 'R');
			$this->Cell(20, 10, $produk['size'], 1, 0, 'C');
			$this->Cell(20, 10, $produk['qty'], 1, 0, 'C');
			$subtotal = $produk['price'] * $produk['qty'];
			$total_harga_produk += $subtotal;
			$this->Cell(40, 10, number_format($subtotal), 1, 1, 'R');
		}
		$this->Ln();

		$confirm_payment = "SELECT * FROM confirm_payment WHERE order_id = '".$_GET['id']."'";
		$result_deposit = mysqli_query($this->conn, $confirm_payment);
		$total_deposit = 0;
		while ($data_deposit = mysqli_fetch_array($result_deposit)){
			$total_deposit += $data_deposit['deposit'];
		}

		$this->SetFont('Arial', 'B', 10);
		$this->SetDrawColor(255, 255, 255);
		$this->Cell(120, 10, 'Wajib Deposit 30%:', 1, 0, 'R');
		$this->Cell(40, 10, number_format($total_harga_produk*30/100), 1, 1, 'R');

		$this->Cell(120, 10, 'Customer Deposit:', 1, 0, 'R');
		$this->Cell(40, 10, number_format($total_deposit), 1, 1, 'R');

		// $this->Cell(120, 10, 'Sisa Pelunasan:', 1, 0, 'R');
		// $this->Cell(40, 10, number_format($total_harga_produk-$total_deposit), 1, 1, 'R');

		$this->Cell(120, 10, 'Total Harga Produk:', 1, 0, 'R');
		$this->Cell(40, 10, number_format($total_harga_produk-$total_deposit), 1, 1, 'R');


		$this->Cell(120, 10, 'Ongkir:', 1, 0, 'R');
		$this->Cell(40, 10, number_format($order['ongkir']), 1, 1, 'R');

		$this->Cell(120, 10, 'Total:', 1, 0, 'R');
		$this->Cell(40, 10, number_format($total_harga_produk + $order['ongkir']), 1, 1, 'R');
		$this->Ln();



			/*$this->SetFont('Arial', 'B', 12);
			$this->Cell(40, 10, 'Detail Pesanan:', 0, 1);
			$this->SetFont('Arial', 'B', 10);
			$this->Cell(40, 10, 'Nama Ekspedisi', 1, 0, 'C');
			$this->Cell(40, 10, 'Paket', 1, 0, 'C');
			$this->Cell(40, 10, 'Estimasi', 1, 0, 'C');
			$this->Cell(40, 10, 'Ongkir', 1, 1, 'C');

			$this->SetFont('Arial', '', 10);
			$this->Cell(40, 10, $order['ekspedisi'], 1, 0);
			$this->Cell(40, 10, $order['paket'], 1, 0);
			$this->Cell(40, 10, $order['estimasi'], 1, 0);
			$this->Cell(40, 10, $order['ongkir'], 1, 1);
			$this->Ln();*/

			$this->Output();
		}


	}

	$invoice = new Invoice($conn);
	$invoice->GenerateInvoice($_GET['id']);

?>
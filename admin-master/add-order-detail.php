<?php 
include '../config/conn.php';
?>
<style>
	.form-group label{
		font-size: 16px;
		display: block;
		text-align: left;
	}
</style>
<?php session_start() ?>
<?php if (isset($_SESSION['id']) && isset($_SESSION['username'])): ?>
<?php 
include "config/conn.php";
$id=$_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM products WHERE id='$id'");
$result = mysqli_fetch_array($query);

$sql1 = "SELECT * FROM product_sizes WHERE product_id = '$id' AND stok != 0";
$result1 = $conn->query($sql1);

if(isset($_POST['tambah'])){
	$order_id = $_GET['order_id'];
	$order_detail_sql = "SELECT * FROM orders WHERE id = '$order_id'";
	$order_detail = mysqli_fetch_array($conn->query($order_detail_sql));
	$product_id = $_GET['id'];
	$product_name = $result['name'];
	$qty = $_POST['quantity'];
	$price = $_POST['price']-($_POST['price']*$result['diskon_produk']/100);
	$order_type = "PO";
	$size_id = $_POST['selectedSize'];
	$ct_status = "order";
	$new_total=$order_detail['total']+($price*$qty);
	$sql = "INSERT INTO orders_item (order_id, product_id, product_name, qty, price, order_type, size_id, ct_status)
	VALUES ('$order_id', '$product_id', '$product_name', '$qty', '$price', '$order_type', '$size_id', '$ct_status')";

	if ($conn->query($sql) === TRUE) {
		$sql = "UPDATE orders SET total = '$new_total' WHERE id = '$order_id'";
		if ($conn->query($sql) === TRUE) {
			header("Location:detail_order-po.php?id=".$order_id);
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	} else {
	}
	$conn->close();
}
?>


<?php require 'include/linkheader.php' ?>
<body class="hold-transition sidebar-mini">
	<div class="wrapper">
		<?php include "include/sidebar.php" ?>
		<div class="content-wrapper">
			<div class="content">
				<div class="container-fluid"><br>
					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-body">
									<div class="mb-3">
										<h4 class="text-left fw-bold"><?php echo $result['name'] ?></h>
										</div>
										<div class="row">
											<div class="col-4">
												<img class="d-block w-100" src="fotoproduk/<?=$result['photo']?>" alt="First slide">
											</div>
											<div class="col-6">
												<form action="" method="POST">
													<div class="form-group">
														<label for="size">Size</label>
														<select name="size" class="form-control" id="size">
															<?php while($row = $result1->fetch_assoc()): ?>
																<option value="<?php echo $row["id"] ?>" data-stok="<?php echo $row["stok"] ?>"><?php echo $row["size"] ?></option>
															<?php endwhile ?>
														</select>
														<input type="text" hidden name="selectedSize" id="selectedSize">
														<input type="text" hidden name="sizeText" id="sizeText">
													</div>
													<div class="form-group">
														<label for="price">Price</label>
														<input type="text" id="price" readonly class="form-control" name="price" required>
													</div>
													<div class="form-group">
														<label for="quantity">Quantity</label>
														<input type="number" id="quantity" class="form-control" name="quantity" required>
													</div>
													<button class="btn btn-primary" name="tambah">Tambah</button>
												</form>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<aside class="control-sidebar control-sidebar-dark">
				<div class="p-3">
					<h5>Title</h5>
					<p>Sidebar content</p>
				</div>
			</aside>

			<footer class="main-footer">
				<div class="float-right d-none d-sm-inline">
					Anything you want
				</div>
				<strong>Copyright &copy;2023
				</footer>
			</div>


			<script src="assets/plugins/jquery/jquery.min.js"></script>
			<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
			<script src="assets/dist/js/adminlte.min.js"></script>
		</body>
		</html>
	<?php else:?>
		<script>alert('Silahkan Login terlebih dahulu')</script>
		<script>location='login.php'</script>
	<?php endif ?>
	<script>
		$(document).ready(function(){

			var product_id =<?php echo $_GET['id'] ?>;
			var sizeid=$("#size").val();
			var size = $(this).find(':selected').text();
			var stok = $(this).find(':selected').data('stok');
			$("#selectedSize").val(sizeid);
			$("#sizeText").val(size);
			$.ajax({
				url: '../get_price.php',
				method: 'POST',
				data: { size: size, product_id: product_id },
				success: function(data) {
					$('#price').val(data);
				}
			});
			$('#size').change(function() {
				var product_id = <?php echo $_GET['id'] ?>;
				var size = $(this).find(':selected').text();
				var stok = $(this).find(':selected').data('stok');
				var sizeid=$(this).val();
				$.ajax({
					url: '../get_price.php',
					method: 'POST',
					data: { size: size, product_id: product_id },
					success: function(data) {
						$("#sizeText").val(size);
						$('#price').val(data);
						$("#selectedSize").val(sizeid);
					}
				});
			});
		})
	</script>
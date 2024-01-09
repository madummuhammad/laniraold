<?php 
include '../config/conn.php';
?>
<?php session_start() ?>
<?php if (isset($_SESSION['id']) && isset($_SESSION['username'])): ?>
<?php 
include 'config/conn.php';
$brandId = $_GET['brand_id'];
$per_page = 8; 
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $per_page;

$result = mysqli_query($conn, "SELECT * FROM products WHERE status = 'Publish' AND type_product = 'PO'");

$total = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM products WHERE status = 'Publish' AND brand_id = '$brandId' AND type_product = 'PO'"));
$pages = ceil($total / $per_page);
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
									<a href="detail_order-po.php?id=<?php echo $_GET['order_id']?>" class="btn btn-secondary">Kembali</a>
									<h4 class="text-center">TAMBAH PESANAN</h>
										<div class="row">
											<?php while ($data = mysqli_fetch_array($result)):?>
												<div class="col-2">
													<div class="card">
														<div class="card-body p-0">
															<div class="products-single fix">
																<div class="box-img-hover">
																	<a href="add-order-detail.php?order_id=<?php echo $_GET['order_id'].'&id='.$data['id']; ?>">
																		<img src="fotoproduk/<?php echo $data['photo']; ?>" class="img-fluid" alt="Image">
																	</a>
																</div>
																<div class="why-text">
																	<h4>
																		<a class="text-dark" href="add-order-detail.php?order_id=<?php echo $_GET['order_id'].'&id='.$data['id']; ?>"><?php echo $data['name']; ?></a>
																	</h4>
																</div>
															</div>
														</div>
													</div>
												</div>
											<?php endwhile ?>
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

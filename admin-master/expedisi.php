<?php 
include '../config/conn.php';
require '../admin-master/function/ExpedisiController.php';
$expedisi=New ExpedisiController();
?>
<?php session_start() ?>
<?php if (isset($_SESSION['id']) && isset($_SESSION['username'])): ?>

<?php if(!empty($_POST)) {
	foreach ($expedisi->get() as $key => $value) {
		$id=$_POST['id_'.$value['rate_name']];
		$status=$_POST[$value['rate_name']];
		if($status){
			$status=1;
		} else {
			$status=0;
		}
		$expedisi->updateStatus($id,$status);
	}
} ?>


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
									<h4 class="text-center">Pengaturan Expedisi</h4>
									<form action="" method="POST">
										<div class="row">											
											<?php foreach ($expedisi->get() as $key => $value):?>
												<div class="col-3">													
													<div class="custom-control custom-switch">
														<input type="text" name="id_<?php echo $value['rate_name'] ?>" value="<?php echo $value['id'] ?>" hidden>
														<input type="checkbox" class="custom-control-input" name="<?php echo $value['rate_name'] ?>" id="<?php echo $value['rate_name'] ?>" <?php if($value['status']==1){echo 'checked';} ?>>
														<label class="custom-control-label" for="<?php echo $value['rate_name'] ?>"><?php echo $value['name'] ?></label>
													</div>
												</div>
											<?php endforeach ?>
										</div>
										<div class="d-flex justify-content-end mt-3">
											<button class="btn btn-primary px-4 mr-5">Kirim</button>
										</div>
									</form>
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

<?php 
require '../admin-master/function/ExpedisiController.php';

$expedisi=New ExpedisiController();
?>
<option value="">--Pilih ekspedisi--</option>
<?php foreach ($expedisi->getActive() as $key => $value):?>
	<option value="<?php echo $value['rate_name'] ?>"><?php echo $value['name'] ?></option>
	<?php endforeach ?>
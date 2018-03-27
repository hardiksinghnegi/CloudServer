<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// echo base_url("assets/css/bootstrap.css");
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?php echo base_url('/imgs/icons/servTitle.png')?>" type="image/png">

    <title>SecuraStore</title>

    <?= link_tag('assets/css/bootstrap.css')?>
	<?= link_tag('assets/css/loginSuccess.css')?>
	<script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
	<script src="<?= base_url('assets/js/jquery.validate.js') ?>"></script>
	<script src="<?= base_url('assets/js/bootstrap.js') ?>"></script>

</head>

<body >

	<div class="container-fluid">
		<div class="col-md-4"></div>
		<div class="col-md-4 offset-md-4">
			<center>
				<img class="img-responsive" src="<?php echo base_url('/imgs/icons/tick.gif')?>">
				<h1> Successful Sign Up</h1> 
				<?php echo form_open(base_url().'home/loadHome',array('id' => 'frmSuccess')); ?>
				<input type="Submit" id="submitBtn" name="" class="btn btn-primary btn-wide form-control form-button" value="Proceed To Login" style="height:40px" >
				<?php echo form_close();?>  
			</center>
		</div>
	</div>

</body>
</html>
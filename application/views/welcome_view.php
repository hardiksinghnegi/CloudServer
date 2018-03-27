<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?php echo base_url('/imgs/icons/servTitle.png')?>" type="image/png">
    <title>SecuraStore</title>
    <?= link_tag('assets/css/bootstrap.css')?>
    <?= link_tag('assets/css/font-awesome.min.css')?>
    <?= link_tag('assets/css/dashboard.css')?>


    <script src="<?= base_url('assets/js/bootstrap.js') ?>"></script>


</head>
	<div class="logoutClass">

		<?php echo form_open(base_url().'home/logout',array('id' => 'frmLogin')); ?>
				<input type="Submit" id="logoutBtn" value="Logout" >
		<?php echo form_close();?>
	
	</div>
	<div class="container-fluid">
		
		<div class="col-md-4 col-md-offset-4">
			<img class="img-responsive logo" src="<?php echo base_url('/imgs/icons/servTitle.png')?>"  align="left">
               </img>
			<h1>Welcome User,</h1>
			 <?php echo form_open(base_url().'adminDashboard/storageSetup',array('id' => 'welcomeAdmin')); ?>
			 <input type="hidden" id="welcomeConfig" name="isAdmin" value="1">
			 <input type="Submit" id="welcomeBtn" name="welcomeUser" class="btn btn-primary btn-wide form-control form-button" value="Let's Begin" style="height:40px" >
			 <?php echo form_close();?>
		</div>
	</div>





<body >
</body>
</html>
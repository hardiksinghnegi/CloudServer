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
	<?= link_tag('assets/css/onboarding.css')?>
	<script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
	<script src="<?= base_url('assets/js/bootstrap.js') ?>"></script>

</head>

<body >

	<div class="container-fluid">

		
		<div class="col-md-6 text-center">
			<div class="panel panel-primary">
				<div class="panel-heading"><h3>Personal Details</h3></div>
				<div class="panel-body">
					<?php echo form_open(base_url().'home/onboarding',array('id' => 'companyDetail')); ?>
					<div class="panel-form">
						
							<input type="text" class="form-control panel-input" name="firstName" id="inputFirst" placeholder="First Name" autocomplete="off" style="height:50px" >
				
							<input type="text" class="form-control panel-input" name="middleName" id="inputMiddle" placeholder="Middle Name" autocomplete="off" style="height:50px" >

							<input type="text" class="form-control panel-input" name="lastName" id="inputLast" placeholder="Last Name" autocomplete="off" style="height:50px" >
			

					</div>

					<div class="panel-form">
						
							<input type="text" class="form-control panel-input" name="txtEmail" id="inputEmail" placeholder="Email ID" autocomplete="off" style="height:50px" >

							<input type="text" class="form-control panel-input" name="txtId" id="inputId" placeholder="Employee ID" autocomplete="off" style="height:50px" >
			

					</div>

					<div class="panel-form">
						
							<input type="password" class="form-control panel-input" name="txtPassword" id="inputPwd" placeholder="Enter Password" autocomplete="off" style="height:50px" >

							<input type="password" class="form-control panel-input" name="txtConfirm" id="inputConfirm" placeholder="Confirm Password" autocomplete="off" style="height:50px" >
			

					</div>
					
				</div>
			</div>
		</div>
		<img class="img-responsive" width="100px" src="<?php echo base_url('/imgs/icons/servTitle.png')?>">
		<div class="col-md-6 text-center">
			<div class="panel panel-primary">
				<div class="panel-heading"><h3>Company Details</h3></div>
				<div class="panel-body">
					<div class="panel-form">
						 <input type="text" class="form-control panel-input" name="txtCompany" id="inputCompany" placeholder="Company Name" autocomplete="off" style="height:50px">
						 <!-- <input type="button" id="submitBtn" name="" class="btn btn-primary btn-wide" value="Submit" > -->
					</div>

					<div class="panel-form">
						 <input type="text" class="form-control panel-input" name="txtCity" id="inputCity" placeholder="City" autocomplete="off" style="height:50px">
						 <input type="text" class="form-control panel-input" name="txtCountry" id="inputCity" placeholder="Country" autocomplete="off" style="height:50px">
					</div>

					<!-- <div class="panel-form"> -->
						<input type="hidden" id="onboardConfig" name="hideOnboard" value="1">
						<input type="Submit" id="submitBtn" name="" class="btn btn-primary btn-wide form-control panel-button" style="height:50px" value="Submit" > 
					<!-- </div> -->
					<?php echo form_close();?>
				</div>
			</div>
		</div>
		

	</div>

</body>

<script type="text/javascript">
	$("#submitBtn").click(function(){
		// $('#userDetail').submit();
		$('#companyDetail').submit();
	});
</script>


</html>
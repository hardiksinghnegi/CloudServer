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
	<script src="<?= base_url('assets/js/jquery.validate.js') ?>"></script>
	<script src="<?= base_url('assets/js/bootstrap.js') ?>"></script>

</head>

<body >

	<div class="container-fluid">
		
		<div class="col-md-12 text-center">
			<div class="panel panel-primary">
				<div class="panel-heading"><h3>Admin User Setup</h3></div>
				<div class="panel-body">
					<?php echo form_open(base_url().'home/onboarding',array('id' => 'companyDetail')); ?>
					<div class="panel-form">
							
						<label id="inputfirst-error" class="col-md-4 validate" for="inputFirst"></label>
						<label id="inputmiddle-error" class="col-md-4"></label>
						<label id="inputlast-error" class="col-md-4" for="inputLast"></label>

					</div>

					<div class="panel-form">
							
							<input type="text" class="form-control panel-input" name="firstName" id="inputFirst" placeholder="First Name" style="height:50px" maxlength="20">

							<input type="text" class="form-control panel-input" name="middleName" id="inputMiddle" placeholder="Middle Name" autocomplete="on" style="height:50px" maxlength="20">

							<input type="text" class="form-control panel-input" name="lastName" id="inputLast" placeholder="Last Name" autocomplete="on" style="height:50px" maxlength="20">
			

					</div>

					<div class="panel-form">
							
						<label id="inputemail-error" class="col-md-6" for="inputEmail"></label>
					
						<label id="inputid-error" class="col-md-6" for="inputId"></label>

					</div>

					<div class="panel-form">
						
							<input type="email" class="form-control panel-input" name="txtEmail" id="inputEmail" placeholder="Email ID" autocomplete="off" style="height:50px" >

							<input type="text" class="form-control panel-input" name="txtId" id="inputId" placeholder="Employee ID" autocomplete="off" style="height:50px" >
			

					</div>

					<div class="panel-form">
							
						<label id="inputpwd-error" class="col-md-6" for="inputPwd"></label>
					
						<label id="inputconfirm-error" class="col-md-6" for="inputConfirm"></label>

					</div>

					<div class="panel-form">
						
							<input type="password" class="form-control panel-input" name="txtPassword" id="inputPwd" placeholder="Enter Password" autocomplete="off" style="height:50px" >

							<input type="password" class="form-control panel-input" name="txtConfirm" id="inputConfirm" placeholder="Confirm Password" autocomplete="off" style="height:50px" >
		
					</div>

					<div class="panel-form">
							
						<label id="inputcompany-error" class="col-md-6" for="inputPwd"></label>
					
						<label id="inputurl-error" class="col-md-6" for="inputUrl"></label>

					</div>

					<div class="panel-form">
						 <input type="text" class="form-control panel-input" name="txtCompany" id="inputCompany" placeholder="Company Name" autocomplete="on" style="height:50px">
						 <input type="url" class="form-control panel-input" name="txtUrl" id="inputUrl" placeholder="Company URL" autocomplete="on" style="height:50px">
					
					</div>

					<div class="panel-form">
							
						<label id="inputcity-error" class="col-md-4" for="inputCity"></label>
						<label id="inputstate-error" class="col-md-4" for="inputState"></label>
						<label id="inputcountry-error" class="col-md-4" for="inputCountry"></label>

					</div>

					<div class="panel-form">
						 <input type="text" class="form-control panel-input" name="txtCity" id="inputCity" placeholder="City" autocomplete="on" style="height:50px">
						  <input type="text" class="form-control panel-input" name="txtState" id="inputState" placeholder="State" autocomplete="on" style="height:50px" >
						 <input type="text" class="form-control panel-input" name="txtCountry" id="inputCountry" placeholder="Country" autocomplete="on" style="height:50px" >
					</div>

						<input type="hidden" id="onboardConfig" name="hideOnboard" value="1">
					
					<div class="panel-form">
						<input type="reset" id="submitBtn" name="" class="btn btn-primary btn-wide form-control panel-button panel-input" style="height:50px" value="Reset" >
						<input type="Submit" id="submitBtn" name="" class="btn btn-primary btn-wide form-control panel-button panel-input" style="height:50px" value="Submit" >
					</div>
					<?php echo form_close();?>
					
				</div>
			</div>
		</div>

	</div>

</body>

<script type="text/javascript">
	
  $(document).ready(function(){
    $("#companyDetail").validate({
    		 errorPlacement: function(error, element) {
    		 	// errorElement: 'label',
     			// error.insertBefore($(element).parent('div'));
     			if(element.attr("name")=="firstName")
     				error.appendTo('#inputfirst-error');
     			else if(element.attr("name")=="lastName")
     				error.appendTo('#inputlast-error');
     			else if(element.attr("name")=="txtEmail")
     				error.appendTo('#inputemail-error');
     			else if(element.attr("name")=="txtId")
     				error.appendTo('#inputid-error');
     			else if(element.attr("name")=="txtPassword")
     				error.appendTo('#inputpwd-error');
     			else if(element.attr("name")=="txtConfirm")
     				error.appendTo('#inputconfirm-error');
     			else if(element.attr("name")=="txtCompany")
     				error.appendTo('#inputcompany-error');
     			else if(element.attr("name")=="txtUrl")
     				error.appendTo('#inputurl-error');
     			else if(element.attr("name")=="txtCity")
     				error.appendTo('#inputcity-error');
     			else if(element.attr("name")=="txtState")
     				error.appendTo('#inputstate-error');
     			else if(element.attr("name")=="txtCountry")
     				error.appendTo('#inputcountry-error');
     			else
     				error.insertAfter(element);
  			 },
           // to show validation if field is skipped
           onfocusout: function(el) {
            if (!this.checkable(el)){
              this.element(el);
            }
            $(el).valid();
          },
          rules:{
            firstName:{
              required:true
              
            },
            lastName:{
              required:true
            },
            txtEmail:{
              required:true,
              email:true
            },
            designation:{
              required:true,
              maxlength:50
            },
            txtPassword:{
              required:true,
              minlength:6,
              pwcheck:true
            },
            txtConfirm:{
              required:true,
              equalTo:"#txtPassword"
            },
            txtCity:{
              required:true
            },
            txtState:{
            	required:true
            },
            txtCompany:{
            	required:true
            },
            txtCountry:{
            	required:true
            },
            txtUrl:{
              required:true,
              url:true
            },
            txtId:{
            	required: true
            }

          },
          messages:{
            txtPassword:{
              minlength:"Minimum length is 6",
              pattern:"Password must contain lower case, upper case and symbol"
            },
            txtConfirm:{
              equalTo:"Password must be same"
            },
            txtUrl:{
              url:"Enter Appropriate Link"
            }

          },
          submitHandler:function(form){          
            form.submit();
            return false;
          }
        });

  });

</script>


</html>
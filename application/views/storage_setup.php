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
    <?= link_tag('assets/css/onboarding.css')?>


   	<script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
	<script src="<?= base_url('assets/js/jquery.validate.js') ?>"></script>
	<script src="<?= base_url('assets/js/bootstrap.js') ?>"></script>


</head>
<body>
	
	<div class="container-fluid">
		
		<div class="col-md-12 text-center">
			<div class="panel panel-primary">
				<div class="panel-heading"><h2>Storage Onboarding</h2></div>
				<div class="panel-body">

					<?php echo form_open(base_url().'adminDashboard/mgmtSetup',array('id' => 'storageConfig')); ?>
					<div class="panel-form">
							
						<label id="inputtag-error" class="col-md-6" for="inputTag"></label>
					
						<label id="inputip-error" class="col-md-6" for="inputIp"></label>

					</div>

					<div class="panel-form">
							
							<input type="text" class="form-control panel-input" name="assetTag" id="inputTag" placeholder="Storage Tag" style="height:50px" maxlength="50" value="<?php echo set_value('assetTag');?>">

							<input type="text" class="form-control panel-input" name="assetIP" id="inputIp" placeholder="Storage IP" autocomplete="on" style="height:50px" maxlength="32" value="<?php echo set_value('assetIP');?>">
			

					</div>

					<div class="panel-form">
							
						<label id="inputmodel-error" class="col-md-6" for="inputModel"></label>
					
						<label id="inputid-error" class="col-md-6" for="inputId"></label>

					</div>

					<div class="panel-form">
						
							<input type="text" class="form-control panel-input" name="assetModel" id="inputModel" placeholder="Storage Model" style="height:50px" maxlength="50" value="<?php echo set_value('assetModel');?>">

							<input type="text" class="form-control panel-input" name="txtId" id="inputId" placeholder="Username" style="height:50px" maxlength="50" value="<?php echo set_value('txtId');?>">
			

					</div>

					<div class="panel-form">
							
						<label id="inputos-error" class="col-md-6" for="inputOS"></label>
					
						<label id="inputpass-error" class="col-md-6" for="inputPass"></label>

					</div>

					<div class="panel-form">
						
							<input type="text" class="form-control panel-input" name="assetOS" id="inputOS" placeholder="Storage OS" style="height:50px" maxlength="50" value="<?php echo set_value('assetOS');?>">

							<input type="password" class="form-control panel-input" name="txtPass" id="inputPass" placeholder="Password" autocomplete="off" style="height:50px" >
		
					</div>

					<div class="panel-form">
							
						<label id="inputspace-error" class="col-md-6" for="inputSpace"></label>
					
						<label id="inputconfirm-error" class="col-md-6" for="inputConfirm"></label>

					</div>

					<div class="panel-form">
						 <input type="number" class="form-control panel-input" name="assetSpace" id="inputSpace" placeholder="Storage Space (MB)" style="height:50px" value="<?php echo set_value('inputSpace');?>">
						 <input type="text" class="form-control panel-input" name="txtPort" id="inputConfirm" placeholder="Connection Port" autocomplete="on" style="height:50px">
					
					</div>

					<div class="panel-form">
							
						<label id="inputkey-error" class="col-md-4" for="inputKey"></label>

					</div>

					<div class="panel-form">
						 <textarea class="form-control" name="txtKey" id="inputKey" form="storageConfig" placeholder="Enter SSH Key" value="<?php echo set_value('txtKey');?>"></textarea>
					</div>

						<input type="hidden" id="onboardConfig" name="hideStorage" value="1">
					
					<div class="panel-form">
						<input type="reset" id="submitBtn" name="" class="btn btn-primary btn-wide form-control panel-button panel-input" style="height:50px" value="Reset" >
						<input type="Submit" id="submitBtn" name="" class="btn btn-primary btn-wide form-control panel-button panel-input" style="height:50px" value="Submit" >
					</div>
					<?php echo form_close();?>
					<div id="php-error" class="error">
						<p><?php echo validation_errors(); ?></p>
					</div>

				</div>
			</div>
			
		</div>

	</div>

</body>

<script type="text/javascript">
	

  	$(document).ready(function(){

  	jQuery.validator.addMethod("IPChecker", function(value, element) {
  		return this.optional(element) || /^(([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\.){3}([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])$|^(([a-zA-Z]|[a-zA-Z][a-zA-Z0-9\-]*[a-zA-Z0-9])\.)*([A-Za-z]|[A-Za-z][A-Za-z0-9\-]*[A-Za-z0-9])$|^\s*((([0-9A-Fa-f]{1,4}:){7}([0-9A-Fa-f]{1,4}|:))|(([0-9A-Fa-f]{1,4}:){6}(:[0-9A-Fa-f]{1,4}|((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3})|:))|(([0-9A-Fa-f]{1,4}:){5}(((:[0-9A-Fa-f]{1,4}){1,2})|:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3})|:))|(([0-9A-Fa-f]{1,4}:){4}(((:[0-9A-Fa-f]{1,4}){1,3})|((:[0-9A-Fa-f]{1,4})?:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:))|(([0-9A-Fa-f]{1,4}:){3}(((:[0-9A-Fa-f]{1,4}){1,4})|((:[0-9A-Fa-f]{1,4}){0,2}:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:))|(([0-9A-Fa-f]{1,4}:){2}(((:[0-9A-Fa-f]{1,4}){1,5})|((:[0-9A-Fa-f]{1,4}){0,3}:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:))|(([0-9A-Fa-f]{1,4}:){1}(((:[0-9A-Fa-f]{1,4}){1,6})|((:[0-9A-Fa-f]{1,4}){0,4}:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:))|(:(((:[0-9A-Fa-f]{1,4}){1,7})|((:[0-9A-Fa-f]{1,4}){0,5}:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:)))(%.+)?\s*$/.test(value);
	}, "Please enter valid IP address");

    $("#storageConfig1").validate({
    		 errorPlacement: function(error, element) {
    		 
     			if(element.attr("name")=="assetTag")
     				error.appendTo('#inputtag-error');
     			else if(element.attr("name")=="assetIP")
     				error.appendTo('#inputip-error');
     			else if(element.attr("name")=="assetModel")
     				error.appendTo('#inputmodel-error');
     			else if(element.attr("name")=="txtId")
     				error.appendTo('#inputid-error');
     			else if(element.attr("name")=="assetOS")
     				error.appendTo('#inputos-error');
     			else if(element.attr("name")=="assetSpace")
     				error.appendTo('#inputspace-error');
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
            assetTag:{
             	required:true
            },
            assetIP:{
            	required:true,
            	IPChecker:true
            },
            assetModel:{
              required:true
            },
            txtId:{
              required:true,
            },
            assetOS:{
              required:true,
              maxlength:50
            },
            assetSpace:{
              required:true
            },
            txtState:{
            	required:true
            }

          },
          submitHandler:function(form){          
            form.submit();
            return false;
          }
        });

  });

  $('html, body').animate({
    scrollTop: $("#php-error").offset().top
	}, 1000);



</script>

</html>
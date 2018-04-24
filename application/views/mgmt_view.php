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
        
        <div class="col-md-4 col-md-offset-4 text-center">
            <div class="panel panel-primary">
                <div class="panel-heading"><h2>User Management</h2></div>
                <div class="panel-body">

                    <?php echo form_open(base_url().'adminDashboard/mgmtDashboard',array('id' => 'userMgmt')); ?>
                   
                    <div>

                        <input type="numeric" class="form-control panel-input" name="userSpace" id="inputSpace" placeholder="Default Space (MB)" style="height:50px" maxlength="50" value="<?php echo set_value('userDef');?>" required>
                   

                        <input type="text" class="form-control panel-input" name="userPerm" id="inputPerm" placeholder="Secure Permissions" style="height:50px" maxlength="50" value="<?php echo set_value('userPerm');?>">  

                        <h4>ENFORCE STRICT HTTPS:
                        <label class="radio-inline"><input type="radio" name="opt" value="Yes" required>Yes</label>
                        <label class="radio-inline"><input type="radio" name="opt" value="No">No</label>
                        </h4>

                    </div>
                        <input type="hidden" id="onboardUser" name="hideUser" value="1">
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
</html>
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
    <?= link_tag('assets/css/background.css')?>


    <script src="<?= base_url('assets/js/bootstrap.js') ?>"></script>


</head>

<body >

        <div class="container-fluid ">
        
            <div class=" col-md-4 col-md-offset-4">
               
                <img class="img-responsive logo wow fadeInLeft" data-wow-delay="0.2s" src="<?php echo base_url('/imgs/icons/servTitle.png')?>"  align="left">
                <h1 align="left">SecuraStore</h1></img>
              
                <?php echo form_open(base_url().'home/loadHome',array('id' => 'frmLogin')); ?>

                <input type="text" class="form-control" name="txtUserName" id="inputEmail" placeholder="Email" autocomplete="off" style="height:50px" >
                
                <input type="password" class="form-control" name="txtPassword" id="inputPwd" placeholder="Password" autocomplete="off" style="height:50px">

                <input type="hidden" id="configField" name="isSubmit" value="1">

                <input type="Submit" id="submitBtn" name="" class="btn btn-primary btn-wide form-control form-button" value="SIGN IN" style="height:40px" >
                <?php echo form_close();?>   

                <?php echo form_open(base_url().'home/forgotPassword',array('id' => 'frmForgot')); ?>
                <input type="Submit" id="forgotPwd" name="" class="btn btn-primary btn-wide form-control form-button" value="FORGOT PASSWORD" style="height:40px">
                <input type="hidden" name="forgotPass" width="10000" id="forgotField"  value="1">
                <?php echo form_close();?>  
            </div> 
        </div>
   
</body>

</html>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="icon" href="<?php echo base_url('/imgs/icons/servTitle.png')?>" type="image/png">
    <title>SecuraStore</title>
    <?= link_tag('assets/css/bootstrap.css') ?>
    <?= link_tag('assets/css/font-awesome.min.css') ?>
    <?= link_tag('assets/css/animate.css') ?>
    <?= link_tag('assets/css/login.css') ?> 
</head>

<body class="body-bg">
    <div class="container-fluid">

                <?php echo form_open(base_url().'home/loadHome',array('id' => 'frmLogin')); ?>
                <div class="col-xs-12 form-container">
                    <div class="form-group email-container">
                        <span class="email-border"></span>
                        <input type="text" class="form-control" name="txtUserName" id="inputEmail" placeholder="Email" autocomplete="off" tabindex="1">
                       
                    </div>
                    <div class="form-group pwd-container">
                        <span class="pwd-border"></span>
                        <input type="password" class="form-control"  name="txtPassword" id="inputPwd" placeholder="Password" autocomplete="off" tabindex="2">
                        <input type="Submit" id="submitBtn" name="" class="btn btn-primary btn-wide pull-right" value="Login" >
                        <input type="hidden" name="hashPwd" id="hashPwd">
                         <input type="hidden" name="isSubmit" value="1">
                        <span class="pull-left" id="forgotPwd"><a class="forgot-pass" href="<?php echo base_url().'/main/forgotPassword';?>">Forgot Password?</a></span>
                    </div>

                </div>
                <?php echo form_close();?>
    </div>
        
   
</body>




</html>
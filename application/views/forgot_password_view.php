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
</head>

<body >

    <div class="container-fluid" >
    	
        <div class="text-center col-md-4 offset-md-4">
           
           	<img class="img-responsive logo" height="100px" width="100px" src="<?php echo base_url('/imgs/icons/servTitle.png')?>"  align="left">
            <h1 align="left">SecuraStore</h1></img>
          
            <?php echo form_open(base_url().'home/loadHome',array('id' => 'frmLogin')); ?>

            <input type="text" class="form-control" name="forgotId" id="inputEmail" placeholder="Email" autocomplete="off" style="height:50px" >

            <input type="hidden" id="forgotField" name="isSubmit" value="1">

            <input type="Submit" id="submitBtn" name="" class="btn btn-primary btn-wide form-control form-button" value="RESET PASSWORD" style="height:40px" >
            <?php echo form_close();?>   

        </div> 
    </div>
   
</body>

</html>
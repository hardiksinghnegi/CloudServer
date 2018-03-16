<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?php echo base_url('/imgs/icons/servTitle.png')?>" type="image/png">
    <link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap.css"); ?>" />
    <title>SecuraStore</title>
    <!-- <?= link_tag('assets/css/bootstrap.css')?> -->
    <?= link_tag('assets/css/background.css')?>
</head>

<body >

<html>

<p> Dashboard</p>

<?php echo form_open(base_url().'home/logout',array('id' => 'frmLogin')); ?>
<input type="Submit" id="logoutBtn" value="Logout" >
<?php echo form_close();?>

</html>
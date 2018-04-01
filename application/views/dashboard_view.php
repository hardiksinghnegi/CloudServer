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
    <?= link_tag('assets/css/bootstrap.css')?> 
    <?= link_tag('assets/css/admin_dashboard.css')?>
</head>

<body >

<html>



<!-- Use any element to open the sidenav -->
<div class="topnav">
<a style="cursor:pointer" onclick="openNav()"><img class="img-responsive side-logo" src="<?php echo base_url('/imgs/icons/servTitle.png')?>"></a>
<a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Hi <?php echo htmlspecialchars($userName);?></a>
<div class="outbutton">
<?php echo form_open(base_url().'home/logout',array('id' => 'frmLogin')); ?>
<input type="Submit" id="logoutBtn" class='form-control' value="Logout" >
<?php echo form_close();?>
</div>
</div>

<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="#">Dashboard</a>
  <a href="#">Analytics</a>
  <a href="#">Management</a>
  <a href="#">Profile</a>
  <a href="#">About</a>
</div>
<!-- Add all page content inside this div if you want the side nav to push page content to the right (not used if you only want the sidenav to sit on top of the page -->
<div id="main">

</div>



<script type="text/javascript">
	function openNav() {
    document.getElementById("mySidenav").style.width = "200px";
    document.getElementById("main").style.marginLeft = "200px";
    // document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    document.getElementById("main").style.marginLeft= "0";
    // document.body.style.backgroundColor = "white";
}
</script>

</html>
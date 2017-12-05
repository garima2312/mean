

<?php
    /*echo "cl_ip".$_SERVER['HTTP_CLIENT_IP'];
    echo $_SERVER['HTTP_X_FORWARDED_FOR'];
    echo $_SERVER['HTTP_X_FORWARDED'];
    echo $_SERVER['HTTP_FORWARDED'];
    echo "ADDR".$_SERVER['REMOTE_ADDR'];*/
?>
<?php
$title= "Profile | PSD2HTML5.CO";
require 'config.php';
include('header.php');
if($logeduserid=="") { header("location:https://www.p2h5.com");} else{ $logeduserid;}
//include('navigation_inner.php');
?>
<?php //echo "bvb<pre>";print_r($_SESSION); ?>
<section class="p2hfeatures gradient-block clearfix" >
	<div style="height:50px;"></div>
	<div class="inner-section order-sec">
				<div class="container">
		    	<div class="order-st-page">
<h1>Welcome to your <?php echo strtoupper('Profile'); ?> </h1>
<?php  if($logeduserid=="") { header("location:https:https://www.p2h5.com");} else{ echo "You are logged in..<br>"; echo "with UseriD:".$logeduserid; } ?>
					</div>
				</div>
	</div>
</section>
<?php include('footer.php'); ?>

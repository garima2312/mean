<?php
$title= "Thank you | PSD2HTML5.CO";
require 'config.php';
include('header.php');
if($logeduserid=="") { header("location:https://www.psd2html5.co/");} else{ $logeduserid;}
//include('navigation_inner.php');
?>
<?php //echo "bvb<pre>";print_r($_SESSION); ?>
<section class="p2hfeatures order-status clearfix" >

	<div class="container">
    	<div class="order-st-page">
    	<h3>Your order status</h3>
   				<table class="order-table" cellspacing="0;" cellpadding="0">
						<thead><tr><th>Order ID</th>
							<th>Status</th><th>Quote Date</th><th>Invoice </th>
							<th>&nbsp;</th></tr>
						</thead>
						<tbody><tr><td>P2H520171004101</td><td>Waiting For Quote</td><td>&nbsp;</td><td>&nbsp;</td>
							<td><a href="order_detail?oid=cDJoNTIwMTcxMDA0MTAx">View Detail</a></td></tr></tbody></table>
			</div>
  </div>

</section>
<script>
$("#Home-Page").addClass('inner');
</script>
<?php include('footer.php'); ?>

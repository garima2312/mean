<?php

require 'config.php';
include('header_inner.php');
//echo $domain; die();
//header('Location:https://www.google.co.in');
if(isset($logeduserid)&&($logeduserid!="")) {
	//echo "logged";
}else{
	//header('Location:https://www.google.co.in', true,303);
	echo '<script type="text/javascript">
           window.location = "http://www.p2h5.com/v2/"
      </script>';
}
//header( "location:index.php");
//echo "df".$logeduserid."test"; die();
//header( "refresh:2;url=".$domain ); die();
 //include('navigation_inner.php'); ?>
<section class="p2hfeatures order-status clearfix">
	<div class="container">
    	<div class="order-st-page">
    	<h3>Your order status </h3>
			<?php
	 			$num_rec_per_page=5;
	 			if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
	 			$start_from = ($page-1) * $num_rec_per_page;
	 		$sql_uid = "SELECT * FROM ph_orders WHERE uid ='$logeduserid' ORDER BY oid DESC LIMIT  $start_from, $num_rec_per_page";
	 			$result_uid = mysqli_query($conn, $sql_uid);
	 			if (mysqli_num_rows($result_uid) > 0) {
	 				echo'<table class="order-table" cellpadding="0" cellspacing="0;"><thead><tr><th>Order ID</th><th>Status</th><th>Quote Date</th><th>Invoice </th><th>&nbsp;</th></tr></thead><tbody>';
	 				while($row_sb = mysqli_fetch_assoc($result_uid)) {
	 					echo'<tr><td>';
	 				  $requestdate = explode( '-', $row_sb['request_date'] ); $tdate = explode( ' ', $requestdate[2] );
	 	     		  echo "P2H5".$requestdate[0].$requestdate[1].$tdate[0].$row_sb["oid"];
	 				   echo'</td><td>';
	 				  echo $row_sb["order_status"];
	 				  echo '</td>';
	 				  $sqlusern ="SELECT * FROM ph_order_quote WHERE oid ='".$row_sb["oid"]."'order by qid desc limit 1";
	 					$resultusern = $conn->query($sqlusern);
	 					if ($resultusern->num_rows > 0) {while($rowusern = $resultusern->fetch_assoc()) {
	 					echo '<td>'.$rowusern["quote_date"].'</td>';
	 					$sql_gcup = "SELECT * FROM ph_use_coupons WHERE order_id='".$row_sb["oid"]."'";
	 			$result_gcup = mysqli_query($conn, $sql_gcup);
	 			if (mysqli_num_rows($result_gcup) > 0) {
	 			while($row_gcup = mysqli_fetch_assoc($result_gcup)) {
	 			 $coupon_code = $row_gcup['coupon_code'];
	 					$sql_gcupm = "SELECT * FROM ph_coupons WHERE coupon_code='$coupon_code'";
	 					$result_gcupm = mysqli_query($conn, $sql_gcupm);
	 						if (mysqli_num_rows($result_gcupm) > 0) {
	 							while($row_gcupm = mysqli_fetch_assoc($result_gcupm)) {
	 							$discount = $row_gcupm['discount'];
	 							$discount_apply = ($discount / 100) * $rowusern["quote_amount"];
	 							$discounted_price = $rowusern["quote_amount"]- round($discount_apply);
	 							echo '<td><strong>$'.number_format((float)$discounted_price, 2, '.', '').'</strong>';
	 							}
	 						}
	 					}
	 					}
	 			else{
	 			echo '<td><strong>$'.number_format((float)$rowusern["quote_amount"], 2, '.', '').'</strong>';
	 			}
	 					if($row_sb["payment_status"]=='Received'){
	 					echo '<a id="'.$row_sb["oid"].'" class="view-rec" data-toggle="modal" data-target="#exampleModal1">View receipt</a>';
	 					}
	 					echo'</td>';
	 					//
	 					}}else {
	 					/*echo "0 results";*/
	 					echo '<td>&nbsp;</td>';
	 					echo '<td>&nbsp;</td>';
	 					}
	 				   echo'<td>';
	 				  $requestdate = explode( '-', $row_sb['request_date'] ); $tdate = explode( ' ', $requestdate[2] );
	 				   echo '<a href="order_detail?oid='.base64_encode("p2h5".$requestdate[0].$requestdate[1].$tdate[0].$row_sb["oid"]).'">View Detail</a>';
	 				  $sqlusern ="SELECT * FROM ph_order_quote WHERE oid ='".$row_sb["oid"]."'order by qid desc limit 1";
	 					$resultusern = $conn->query($sqlusern);
	 					if ($resultusern->num_rows > 0) {while($rowusern = $resultusern->fetch_assoc()) {
	 					if($row_sb["payment_status"]!='Received' && $rowusern["quote_amount"]!=""){
	 					$sqlpay ="SELECT * FROM ph_users WHERE uid ='".$row_sb['uid']."'";
	 						$resultpay = $conn->query($sqlpay);
	 							if ($resultpay->num_rows > 0) {
	 							while($rowpay = $resultpay->fetch_assoc()) {
	 							echo '<a class="mkpaymentmyo" href="payment?oid='.base64_encode("p2h5".$requestdate[0].$requestdate[1].$tdate[0].$row_sb["oid"]).'"><button class="mypay" type="submit">Pay</button></a>';
	 							}
	 							}
	 							}
	 					}}
	 				  echo'</td></tr>';
	 				}
	 				echo "</tbody></table>";
	 			} 
 ?>

   				<!--<table class="order-table" cellspacing="0;" cellpadding="0">
						<thead><tr><th>Order ID</th>
							<th>Status</th><th>Quote Date</th><th>Invoice </th>
							<th>&nbsp;</th></tr>
						</thead>
						<tbody><tr><td>P2H520171004101</td><td>Waiting For Quote</td><td>&nbsp;</td><td>&nbsp;</td>
							<td><a href="order_detail?oid=cDJoNTIwMTcxMDA0MTAx">View Detail</a></td></tr></tbody></table>-->


			</div>
  			<?php $sql_sm = "SELECT * FROM ph_orders WHERE  uid ='$logeduserid'";
			$rs_result = $conn->query($sql_sm);
			$total_records = mysqli_num_rows($rs_result);  //count number of records
			$total_pages = ceil($total_records / $num_rec_per_page); 
			
			if ($total_pages > 1) {
			
				echo '<div class="pagination-bt clearfix"><ul class="pull-right">';
				$active = strval($_GET['page']);
				echo "<li "; if($active== ""){echo"class='active'";}
				echo "><a href='".$domain."/myorders'>1</a></li>";
				
					for ($i=2; $i<=$total_pages; $i++) { 
								echo "<li ";
								if($i== $active){echo "class='active'";}
								echo "><a href='".$domain."/myorders?page=".$i."'>".$i."</a></li>"; 
					}
				
				echo " </ul></div>"; 
			} ?>


<div class="text-center">
 <a href="#" class="common-btn no-hover" data-toggle="modal" data-target="#get-started"><span>lets get started</span></a>
</div>
  </div>
</section>

<?php include('footer.php'); ?>

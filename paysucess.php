<?php 
$title= "Payment Sucess | PSD2HTML5.CO";
//$canonical = "https://www.psd2html5.co/paysucess/";
require 'config.php';
include('header_inner.php');
if($logeduserid=="") { header("location:https://www.psd2html5.co/");} else{$logeduserid;}
 include('navigation_inner.php');
 $order_id= base64_decode($_GET['oid']);
$item_number1 = substr($order_id, 0, 12);
$odid = substr($order_id, 12, 100);
//when payment recive
$payment_date= date("Y-m-d h:i:s");
$odstrt_date= date("Y-m-d");
$sql = "UPDATE ph_orders SET payment_date ='$payment_date' ,payment_status='Received',order_status='Order In Progress',order_start_date='$odstrt_date' WHERE oid='$odid'";
if ($conn->query($sql) === TRUE) {
	/*echo "Record updated successfully";*/
	$sqlpaymethd="SELECT * FROM ph_orders WHERE oid ='".$odid."'";
	$resultpaymethd = $conn->query($sqlpaymethd);
	if ($resultpaymethd->num_rows > 0) {
	while($rowpaymethd = $resultpaymethd->fetch_assoc()) {
	 $payment_option = $rowpaymethd['payment_option'];
	 $sdcard_tranj_info = $rowpaymethd['paypal_or_card_rf'];
	  if($payment_option=="PayPal"){
		$sqlpayo ="SELECT * FROM ph_orders WHERE oid ='".$odid."'";
		$resultpayo = $conn->query($sqlpayo);
			if ($resultpayo->num_rows > 0) {
			while($rowpayo = $resultpayo->fetch_assoc()) {
			$requestdate = explode( '-', $rowpayo['request_date'] ); $tdate = explode( ' ', $requestdate[2] );
			$eorderid = "p2h5".$requestdate[0].$requestdate[1].$tdate[0].$odid; 
			$sqlpayu ="SELECT * FROM ph_users WHERE uid ='".$rowpayo['uid']."'";
			$resultpayu = $conn->query($sqlpayu);
				if ($resultpayu->num_rows > 0) {
				while($rowpayu = $resultpayu->fetch_assoc()) {
				$epayname= $rowpayu['name'].' '.$rowpayu['lname'];
				$epayemail = $rowpayu['email'];
				include('emails/paymentsucessemail.php');
				}
				}
			$sqlusern ="SELECT * FROM ph_order_quote WHERE oid ='".$odid."'order by qid desc limit 1";
			$resultusern = $conn->query($sqlusern);
				if ($resultusern->num_rows > 0) {
				while($rowusern = $resultusern->fetch_assoc()) {
				$estimatedate=$rowusern["estimate_time"]; 
				$sql_gcup = "SELECT * FROM ph_use_coupons WHERE order_id='".$odid."'";
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
						$amountpaids = $rowusern["quote_amount"]- round($discount_apply);
						$amountpaid = number_format((float)$amountpaids, 2, '.', '');
						}
						}
					}
					}else{$amountpaid=number_format((float)$rowusern["quote_amount"], 2, '.', '');} 
				}
				}
			}
			}
echo '<div style="height:50px;"></div><div class="inner-section"><div class="container"><div class="thanks"><h3>Thank <span>you</span></h3><p>Your Payment of $'.$amountpaid.' to psd2html5.co has been processed successfully. We will send you confirmation email shortly and your order started soon. <br/>Your estimated delivery date is '.$tomorrow = date('d-M-Y',strtotime($payment_date . "+".$estimatedate." days")).' For more information please contact us <a href="mailto:support@psd2html5.co" style="color:#1DB0BF;">support@psd2html5.co</a></p></div></div></div>';
		}
		
	}
	}
}
else {/*echo "Error updating record: " . $conn->error;*/}
?>
<!-- Google Code for psd2html5 Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 1035092761;
var google_conversion_language = "en";
var google_conversion_format = "3";
var google_conversion_color = "ffffff";
var google_conversion_label = "_o9OCP3g2V4QmYbJ7QM";
var google_remarketing_only = false;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script><noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/1035092761/?label=_o9OCP3g2V4QmYbJ7QM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>
<!-- Google Code for psd2html5 Conversion END -->
<?php include('footer.php');?>

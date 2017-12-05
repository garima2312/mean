<?php 
$title= "Paypal Failure | PSD2HTML5.CO";
$canonical = "https://www.psd2html5.co/payfailure/";
require 'config.php';include('header.php');
if($logeduserid=="") { header("location:https://www.psd2html5.co/");} else{$logeduserid;}
 include('navigation_inner.php');

$order_id= base64_decode($_GET['oid']);
$item_number1 = substr($order_id, 0, 12);
$odid = substr($order_id, 12, 100);
?>

<?php 
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
$emorderid =base64_encode("p2h5".$requestdate[0].$requestdate[1].$tdate[0].$odid);
include('emails/paymentfailemail.php');
		}
							}
							}
							}

?>

<div style="height:50px;"></div>
<div class="inner-section">
	<div class="container">
    	<div class="thanks">
        	<h3>Payment <span style="color:#CC0000;">failure</span></h3>
            <p>Your Payment is failed against the order ID <?php echo $order_id;?>. Please make payment again. </p>
			
			<?php
		$sql_uid = "SELECT * FROM ph_orders WHERE oid ='$odid'";
			$result_uid = mysqli_query($conn, $sql_uid);
			if (mysqli_num_rows($result_uid) > 0) {
				while($row_sb = mysqli_fetch_assoc($result_uid)) {
				  $requestdate = explode( '-', $row_sb['request_date'] ); $tdate = explode( ' ', $requestdate[2] );
				   $sqlusern ="SELECT * FROM ph_order_quote WHERE oid ='".$row_sb["oid"]."'order by qid desc limit 1";
					$resultusern = $conn->query($sqlusern);
					if ($resultusern->num_rows > 0) {while($rowusern = $resultusern->fetch_assoc()) {
					if($row_sb["payment_status"]!='Received' && $rowusern["quote_amount"]!=""){
					$sqlpay ="SELECT * FROM ph_users WHERE uid ='".$row_sb['uid']."'";
						$resultpay = $conn->query($sqlpay);
							if ($resultpay->num_rows > 0) {
							while($rowpay = $resultpay->fetch_assoc()) {?>
							<form class="payform"  action="<?php echo  $paypal_url;?>" method="post">
<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="business" value="<?php echo $paypal_email; ?>">
<input type="hidden" value="https://www.psd2html5.co/paysucess?oid=<?php echo base64_encode("p2h5".$requestdate[0].$requestdate[1].$tdate[0].$row_sb["oid"]); 
				   ?>" name="return">
<input type="hidden" value="https://www.psd2html5.co/payfailure?oid=<?php echo base64_encode("p2h5".$requestdate[0].$requestdate[1].$tdate[0].$row_sb["oid"]); 
				   ?>" name="cancel_return"> 
<input type="hidden" value="https://www.psd2html5.co/completeListener.php" name="notify_url"> 
<input type="hidden" name="item_name" value="PSD to <?php echo $row_sb["select_options"]; ?>">
<input type="hidden" name="item_number" value="<?php echo "P2H5".$requestdate[0].$requestdate[1].$tdate[0].$row_sb["oid"]; 
				   ?>">
<input type="hidden" value="USD" name="currency_code">
<input type="hidden" name="amount" value="<?php echo $rowusern["quote_amount"];?>">
<input type="hidden" value="1" name="quantity">
<input type="hidden" name="first_name" value="<?php echo $rowpay['name']; ?>">
<input type="hidden" name="last_name" value="<?php echo $rowpay['lname']; ?>">
<input type="hidden" name="address1" value="<?php echo $rowpay['address']; ?>">
<input type="hidden" name="city" value="<?php echo $rowpay['city']; ?>">
<input type="hidden" name="state" value="<?php echo $rowpay['state']; ?>">
<input type="hidden" name="zip" value="<?php echo $rowpay['zipcode']; ?>">
<input type="hidden" name="email" value="<?php echo $rowpay['email']; ?>">
<button class="mypayfail submit-btn" type="submit">Make a payment</button>
</form>
						<?php	}
							}
							}
					}}
				}
			}?>
        </div>
    </div>
    
    
</div>



<?php include('footer.php');?>
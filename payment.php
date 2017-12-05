<?php
$title ="Payment | PSD2HTML5.CO";
$canonical = "https://www.psd2html5.co/";
require 'config.php'; 
include('header_inner.php');
if($logeduserid=="") {$location = $domain.'/login?redirect_to='.$domain.'/payment'; header("location:".$location);} else{$logeduserid;}
include('navigation_inner.php');
$order_id= base64_decode($_GET['oid']);
$item_number1 = substr($order_id, 0, 12);
$odid = substr($order_id, 12, 100);
if(isset($_POST["cupsubmit"])){
		$scuporderid = $_POST["scuporderid"];
        $scupuserid=$_POST["scupuserid"];
        $coupon_code=$_POST["coupon_code"];
        $get_date =date('Y-m-d');
		$sql_cup = "SELECT * FROM ph_coupons WHERE coupon_code='$coupon_code'";
			$result_cup = mysqli_query($conn, $sql_cup);
			if (mysqli_num_rows($result_cup) > 0) {
			while($row_cup = mysqli_fetch_assoc($result_cup)) {
			$start_date = $row_cup['start_date'];
			$end_date = $row_cup['end_date'];
		   	if( $get_date>= $start_date &&  $get_date<= $end_date){
			$sql_cup = "SELECT * FROM ph_use_coupons WHERE order_id='$scuporderid'";
			$result_cup = mysqli_query($conn, $sql_cup);
			if (mysqli_num_rows($result_cup) > 0) {
			$usedcoupon =" This Coupon Already Used";
			}
			else{
			$sqlu = "INSERT INTO ph_use_coupons (order_id,user_id,coupon_code,apply_date) VALUES ('$scuporderid', '$scupuserid','$coupon_code','$get_date')";
	if ($conn->query($sqlu) === TRUE) { $apply_coupon= '<div class="alert alert-success fade in">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Success!</strong> Coupon apply successfully
</div>';$invalid ="Coupon code applied successfully.";}
	else {/*echo "Error: " . $sqlu . "<br>" . $conn->error;*/}
	}
			}
			else{echo $invalid ="Coupon has been expired";}
			}
			}
     else{echo $invalid =" You have entered invalid coupon code.";}
}
if(isset($_POST["cupremvsubmit"])){
		$cuporderid = 	$_POST["cuporderid"];
	$sql = "DELETE FROM ph_use_coupons WHERE order_id='".$cuporderid."'";
if ($conn->query($sql) === TRUE) {  $remove_coupon ='<div class="alert alert-success fade in">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Success!</strong> Coupon removed successfully
</div>';/*echo "Record deleted successfully";*/}
 else {/*echo "Error deleting record: " . $conn->error;*/}
}

?>

<div class="make-payment">
  <h2>Make an payment</h2>
  <p class="paysubhead">Please fill up the form below here</p>
  
   <div class="container">
      <div class="row">
	    <div class="col-md-7 col-md-offset-1">
		<div class="alert alert-danger errormessage hide">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

  </div>
		<?php if(!empty($remove_coupon)){echo $remove_coupon;}?>
	 <?php  	$sqlusecoup ="SELECT * FROM ph_use_coupons WHERE order_id ='".$odid."'";
						$resultusecoup = $conn->query($sqlusecoup);
							if ($resultusecoup->num_rows > 0) {
							echo '<div id="coupon_dev"><form action="" method="post">
<input type = "hidden" name="cuporderid" value="'.$odid.'"/>
<input id="removecup" type="submit" value="Remove coupon" name="cupremvsubmit" class="btn btn-danger pull-right hide"  />
</form></div>';
if(!empty($apply_coupon)){echo $apply_coupon;}


							}else{
							echo '<div class="new-coupons"><div id="coupon_dev" class="hide"><form action="" method="post">
<input type="text" name="coupon_code" class="form-control cup input-bg3" value="" placeholder="Please enter your coupon code"/>
<input type="hidden" name="scuporderid" value="'.$odid.'"/>
<input type="hidden" name="scupuserid" value="'.$logeduserid.'" />
<input id="cupsubmit" type="submit" value="Apply" name="cupsubmit" class="btn btn-primary" />
<input id="cuprmdsubmit" type="button" value="Remove" name="cuprmdsubmit" class="btn btn-primary  btn-danger" onclick="couponrmcode();" />

</form></div>';
							echo '<a id="opencpuon" onclick="couponcode()">Have a coupon code</a>';
							echo '<span class="cupinvalid">'.$invalid.'</span></div>';
							
							}?>
							
							</div>
							</div>
							                        
							</div>
    
                        
						<form id="mkpayement" name="mkpayement" method="post" action="<?php echo $paypal_url;?>">
 <input name="token" type="hidden" value="" />
 										<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="business" value="<?php echo $paypal_email; ?>">
<input type="hidden" value="<?php echo $domain;?>/completeListener.php" name="notify_url"> 
  <div class="container">
      <div class="row">
						<?php $sql_uid = "SELECT *  FROM ph_users WHERE uid ='$logeduserid'";
			$result_uid = mysqli_query($conn, $sql_uid);
			if (mysqli_num_rows($result_uid) > 0) {
				while($row_sb = mysqli_fetch_assoc($result_uid)) {?>
<div class="container">    
<div class="row">
        <div class="col-md-7 col-md-offset-1">
          <div class="row-new">
             <ul class="payment-list">
              <li>
              <input type="text" name="first_name" id="first_name" placeholder="First Name" class="input-bg3" value="<?php echo $row_sb["name"]; ?>" readonly="readonly"></li>
              
              <li><input type="text" name="last_name" id="last_name" placeholder="Last Name" class="input-bg3" value="<?php echo $row_sb["lname"]; ?>"></li>
              
              <li><input type="text" name="email" id="email" placeholder="Enter email address" class="input-bg3" value="<?php echo $row_sb["email"]; ?>"></li>
              
              <li><input type="text" name="phone" id="phone" placeholder="Phone Number" class="input-bg3" value="<?php echo $row_sb["contact_number"]; ?>"></li>
              
              <li><input type="text" name="address1" id="address1" placeholder="Address" class="input-bg3" value="<?php echo $row_sb["address"]; ?>"></li>
              
              <li>
              <input type="text" name="city" id="city" placeholder="City" class="input-bg3" value="<?php echo $row_sb["city"]; ?>">
              </li>
              
              <li><input type="text" name="state" id="state" placeholder="State" class="input-bg3" value="<?php echo $row_sb["state"]; ?>"></li>
              
              <li><input type="text" name="zip" id="zip" placeholder="Zip" class="input-bg3" value="<?php echo $row_sb["zipcode"]; ?>"></li>
              
              <li><select name="country"  class="input-bg3" id="urcountry" > 
<option value=''>--Choose Country--</option>
    <?php
        $array_statecd = array("Afghanistan","Albania","Algeria","American Samoa","Andorra","Angola","Anguilla","Antarctica","Antigua and Barbuda","Argentina","Armenia","Aruba","Australia","Austria","Azerbaijan","Bahamas","Bahrain","Bangladesh","Barbados","Belarus","Belgium","Belize","Benin","Bermuda","Bhutan","Bolivia","Bonaire","Bosnia and Herzegovina","Botswana","Bouvet Island","Brazil","British Indian Ocean Territory","Brunei Darussalam","Bulgaria","Burkina Faso","Burundi","Cambodia","Cameroon","Canada","Cape Verde","Cayman Islands","Central African Republic","Chad","Chile","China","Christmas Island","Cocos (Keeling) Islands","Colombia","Comoros","Congo","Democratic Republic of the Congo","Cook Islands","Costa Rica","Croatia","Cuba","Curacao","Cyprus","Czech Republic","Cote d'Ivoire","Denmark","Djibouti","Dominica","Dominican Republic","Ecuador","Egypt","El Salvador","Equatorial Guinea","Eritrea","Estonia","Ethiopia","Falkland Islands (Malvinas)","Faroe Islands","Fiji","Finland","France","French Guiana","French Polynesia","French Southern Territories","Gabon","Gambia","Georgia","Germany","Ghana","Gibraltar","Greece","Greenland","Grenada","Guadeloupe","Guam","Guatemala","Guernsey","Guinea","Guinea-Bissau","Guyana","Haiti","Heard Island and McDonald Mcdonald Islands","Holy See (Vatican City State)","Honduras","Hong Kong","Hungary","Iceland","India","Indonesia","Islamic Republic of Iran","Iraq","Ireland","Isle of Man","Israel","Italy","Jamaica","Japan","Jersey","Jordan","Kazakhstan","Kenya","Kiribati","Democratic People's Republic of Korea","Republic of Korea","Kuwait","Kyrgyzstan","Lao People's Democratic Republic","Latvia","Lebanon","Lesotho","Liberia","Libya","Liechtenstein","Lithuania","Luxembourg","Macao","Republic of Macedonia the Former Yugoslav","Madagascar","Malawi","Malaysia","Maldives","Mali","Malta","Marshall Islands","Martinique","Mauritania","Mauritius","Mayotte","Mexico","Federated States of Micronesia","Republic of Moldova","Monaco","Mongolia","Montenegro","Montserrat","Morocco","Mozambique","Myanmar","Namibia","Nauru","Nepal","Netherlands","New Caledonia","New Zealand","Nicaragua","Niger","Nigeria","Niue","Norfolk Island","Northern Mariana Islands","Norway","Oman","Pakistan","Palau","State of Palestine","Panama","Papua New Guinea","Paraguay","Peru","Philippines","Pitcairn","Poland","Portugal","Puerto Rico","Qatar","Romania","Russian Federation","Rwanda","Reunion","Saint Barthalemy","Saint Helena","Saint Kitts and Nevis","Saint Lucia","Saint Martin (French part)","Saint Pierre and Miquelon","Saint Vincent and the Grenadines","Samoa","San Marino","Sao Tome and Principe","Saudi Arabia","Senegal","Serbia","Seychelles","Sierra Leone","Singapore","Sint Maarten (Dutch part)","Slovakia","Slovenia","Solomon Islands","Somalia","South Africa","South Georgia and the South Sandwich Islands","South Sudan","Spain","Sri Lanka","Sudan","Suriname","Svalbard and Jan Mayen","Swaziland","Sweden","Switzerland","Syrian Arab Republic","Taiwan Province of China","Tajikistan","United Republic of Tanzania","Thailand","Timor-Leste","Togo","Tokelau","Tonga","Trinidad and Tobago","Tunisia","Turkey","Turkmenistan","Turks and Caicos Islands","Tuvalu","Uganda","Ukraine","United Arab Emirates","United Kingdom","United States","United States Minor Outlying Islands","Uruguay","Uzbekistan","Vanuatu","Venezuela","Viet Nam","British Virgin Islands","US Virgin Islands","Wallis and Futuna","Western Sahara","Yemen","Zambia","Zimbabwe","Aland Islands");
        	foreach( $array_statecd as $value ){
        		$checked = ($row_sb["country"] == $value) ? "selected" : "";
          		echo "<option " . $checked . " value=\"" . $value. "\">".$value."</option>";
       		}
       		unset($value);
        ?>
</select></li>

              <li>
             <input id="pforderid" name="pforderid" type="text" placeholder="Order Request No." class="input-bg3" value="<?php echo $order_id;?>" readonly="readonly" style="text-transform:uppercase;"> 
             </li>
              </ul>

           
          </div>
        
		<?php }
			}		
			?>
            <div class="well col-md-12 clearfix payment_crdt">You can pay by credit or debit card on our paypal page.</div>
      </div>
	   <?php
		$sql_uid = "SELECT * FROM ph_orders WHERE oid ='$odid'";
			$result_uid = mysqli_query($conn, $sql_uid);
			if (mysqli_num_rows($result_uid) > 0) {
			while($row_sb = mysqli_fetch_assoc($result_uid)) {
			?>

<input type="hidden" value="<?php echo $domain;?>/paysucess?oid=<?php $requestdate = explode( '-', $row_sb['request_date'] ); $tdate = explode( ' ', $requestdate[2] );echo base64_encode("p2h5".$requestdate[0].$requestdate[1].$tdate[0].$row_sb["oid"]); 
				   ?>" name="return">
<input type="hidden" value="<?php echo $domain;?>/payfailure?oid=<?php $requestdate = explode( '-', $row_sb['request_date'] ); $tdate = explode( ' ', $requestdate[2] );echo base64_encode("p2h5".$requestdate[0].$requestdate[1].$tdate[0].$row_sb["oid"]); 
				   ?>" name="cancel_return"> 

<input type="hidden" name="item_name" value="PSD to <?php echo $row_sb["select_options"]; ?>">
<input type="hidden" name="item_number" value="<?php $requestdate = explode( '-', $row_sb['request_date'] ); $tdate = explode( ' ', $requestdate[2] );echo "P2H5".$requestdate[0].$requestdate[1].$tdate[0].$row_sb["oid"]; 
				   ?>">
<input type="hidden" value="USD" name="currency_code">
<input type="hidden" value="1" name="quantity">
	 <?php
	   $sqlusern ="SELECT * FROM ph_order_quote WHERE oid ='".$odid."'order by qid desc limit 1";
					$resultusern = $conn->query($sqlusern);
					if ($resultusern->num_rows > 0) {
					while($rowusern = $resultusern->fetch_assoc()) {
					?>
					<div class="col-md-4">
         <div class="psd2html5-order-deatils">
          <h4><i class="fa fa-file-text-o"></i>  Payment Detail</h4> 
          <table width="100%" border="0">
  <tr>
    <th scope="row"><?php echo $order_id;?> </th>
    <td><span>:</span> $<?php echo number_format((float)$rowusern["quote_amount"], 2, '.', '');?></td>
  </tr>
  
  
  
  <?php $sql_gcup = "SELECT * FROM ph_use_coupons WHERE order_id='$odid'";
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
							$discounted_price = $rowusern["quote_amount"]- round($discount_apply);?>
              <input type="hidden" value="<?php echo $discount_apply;?>" name="discount_amount">
	<tr><th scope="row">Coupon Code </th><td><span>:</span>&nbsp;<?php echo "$".number_format((float)round($discount_apply), 2, '.', '');?>&nbsp;<?php echo $coupon_code;?>&nbsp; <i title="Remove coupon" class="fa fa-times" style="color:#ff3c3c;"></i></td></tr>
	<tr>
     <table class="br-class">
     <tr>
    <th scope="row">Total</th>
    <td><span>:</span> $<?php echo number_format((float)round($discounted_price), 2, '.', '');?></td>
    </tr>
    </table>
    </tr>

	
	<input type="hidden" name="amount" value="<?php echo $rowusern["quote_amount"];?>">
	<?php
	}
	}
	}
	}else{?>
		<input type="hidden" name="amount" value="<?php echo $rowusern["quote_amount"];?>">
		<table class="br-class"> <tr><th scope="row">Total</th><td><span>:</span> $<?php echo number_format((float)$rowusern["quote_amount"], 2, '.', '');?></td></tr></table>
	<?php } ?>
  	
</table>

        </div>
        <div class="text-center">
		<input id="payprocess" name="paypprocess" type="submit" value="Proceed to PayPal" class="submit-btn">
		</div>
       </div>
					
	
	<?php
	}
	}?>
	  </div>
    <div class="col-md-12" style=" height:50px">&nbsp;</div>	
	  </div>
	  <?php 
	  }
	  }?>
	  
     </div>
      </div>
	 
  
      </form>
 <?php include('footer.php');?>

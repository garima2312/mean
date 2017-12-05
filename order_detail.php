<style>
.loading_image{background-image:url("img/load.gif");
background-size:auto auto;background-repeat:no-repeat;background-position:center;}
 </style>
<?php
$title= "Order Detail | PSD2HTML5.CO";
require 'config.php';include('header_inner.php');
if(isset($logeduserid)&&($logeduserid!="")) {
	//echo "logged";
}else{
	echo '<script type="text/javascript">
           window.location = "http://www.p2h5.com/v2/"
      </script>';
}
$sqlu = "INSERT INTO ph_testing (message,status,send_by) VALUES ('reply','latest msg order detail','send_by')";
		if ($conn->query($sqlu) === TRUE) { }
		else { }

/***********************
$message='test';
$orderid='6';
$cmuserid='10';
$allattacment='aa';
$sqlu = "INSERT INTO ph_conversation_emails (message,oid,postby,uid,attacment_path,comment_time) VALUES ('$message', '$orderid','user','$cmuserid','$allattacment','12345')";
if ($conn->query($sqlu) === TRUE) { }
else { } */

/* 
$inbox=imap_open("{imap.gmail.com:993/imap/ssl/novalidate-cert/norsh}Inbox", 'message@psd2html5.co', 'message123#') or die('Cannot connect to Gmail: ' . imap_last_error());
$all_emails = imap_search($inbox,'UNSEEN');
if($all_emails) {
	$output = '';
	rsort($emails);
	foreach($emails as $email_number) {
		$overview = imap_fetch_overview($inbox,$email_number,0);
		$message = imap_fetchbody($inbox,$email_number,2);
		$header =  imap_header($inbox, $email_number);
		$orderid='6';
		$cmuserid='10';
		$allattacment='aa';
		$sqlu = "INSERT INTO ph_email_conversation (message,oid,postby,uid,attacment_path) VALUES ('$message', '$orderid','user','$cmuserid','$allattacment')";
			if ($conn->query($sqlu) === TRUE) { }
			else { }

	}
}
close the connection 
imap_close($inbox);*/
/**********************/
if($logeduserid=="") { $redirect_to = $_SERVER['QUERY_STRING']; $location = $domain.'/login?redirect_to='.$domain.'/order_detail?'.$redirect_to; header("location:".$location);} else{$logeduserid;}
 //include('navigation_inner.php');
 function makeClickableLinks($s) {
  return preg_replace('@(https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-]*(\?\S+)?[^\.\s])?)?)@', '<a href="$1" target="_blank">$1</a>', $s);
}
$order_id= base64_decode($_GET['oid']);
$item_number1 = substr($order_id, 0, 12);
$odid = substr($order_id, 12, 100);
//date_default_timezone_set('America/Los_Angeles');
if(isset($_POST["cupsubmit"])){
	      #echo "<pre>";print_r($_POST); die();
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
	if ($conn->query($sqlu) === TRUE) { /* echo "New record src created successfully";*/ }
	else { /* echo "Error: " . $sqlu . "<br>" . $conn->error;*/ }
	}
			}
			else{$invalid ="Coupon has been expired";}
			}
			}
}

// if(isset($_POST["cupremvsubmit"])){
// 		$cuporderid = 	$_POST["cuporderid"];
// $sql = "DELETE FROM ph_use_coupons WHERE order_id='".$cuporderid."'";
// if ($conn->query($sql) === TRUE) {/*echo "Record deleted successfully";*/}
//  else {/*echo "Error deleting record: " . $conn->error;*/}
// }

?>
<?php
		$sql_uid = "SELECT * FROM ph_orders WHERE oid ='$odid'";
			$result_uid = mysqli_query($conn, $sql_uid);
			if (mysqli_num_rows($result_uid) > 0) {
			while($row_sb = mysqli_fetch_assoc($result_uid)) {
			?>
<div style="height:50px;"></div>
<div class="inner-section">
	<div class="container">
    	<div class="order-st-page">
    	<h3> Order Request for <?php $requestdate = explode( '-', $row_sb['request_date'] ); $tdate = explode( ' ', $requestdate[2] );
	     echo "p2h5".$requestdate[0].$requestdate[1].$tdate[0].$odid; ?> </h3>
        <div class="order-detail clearfix">
	<div class="comnt-img pull-left">
    <?php    $sqlcomuim ="SELECT * FROM ph_users WHERE uid ='".$row_sb['uid']."'";
						$resultcomuim = $conn->query($sqlcomuim);
							if ($resultcomuim->num_rows > 0) {
							while($rowcomuim = $resultcomuim->fetch_assoc()) {
							$profilepicim = $rowcomuim['profile_pic'];
											if(!empty($profilepicim)){
											echo '<img src="'.$domain.'/profile_pics/p2h5profile_pic_'.$logeduserid.'/'.$profilepicim.'">';
											echo '<h5>'.$rowcomuim['name'].'</h5>';
											}
											else{
											$gravatar_link = 'https://www.gravatar.com/avatar/' . md5($rowcomuim['email']) .'?d=404&s=200';
											  $headers = @get_headers($gravatar_link);
												if (!preg_match("|200|", $headers[0])) {
													echo '<img src="https://www.psd2html5.co/img/cmt-img.jpg">';
												} else {
													echo '<img src="' . $gravatar_link . '" />';
												}
											echo '<h5>'.$rowcomuim['name'].'</h5>';
										}
							}
							} 	?>
        <p><?php echo $row_sb["request_date"];?></p>
                </div>
                <div class="comment-rt pull-right">
                	<div class="cmnt-inner">

                        <div class="cmt-body">
                        	<h4>Your Request Details</h4>
                        	<div class="cmt-body-inner">
                            	<h3>  PSD to  <?php if(isset($row_sb["select_service"])){
 // echo "czc".$row_sb["select_service"];
																	 $sqll="select * from ph_service where id=".$row_sb["select_service"];
																	 $results = mysqli_query($conn,$sqll);
																	 //print_r($results);
																	 if(mysqli_num_rows($results)>0){
																		 while($fetch=mysqli_fetch_assoc($results)){
																			 //print_r($fetch);
																	 echo strtoupper($fetch['name']);
																		 }
																	 }
															 }  ?></h3>
                                <ul>
                                	<li class="clearfix"><p class="pull-left">Responsive Layout </p> <p class="pull-right"><?php echo $row_sb["responsiveness"];?> </p></li>
                                </ul>
								<?php if($row_sb["shared_link"]!=''){
								 echo '<h5>Shared Link</h5>
                                <p>'.nl2br(makeClickableLinks($row_sb["shared_link"])).'</p>';
								}
								?>
                                <h5>Other Guideline</h5>
                                <p><?php echo nl2br(makeClickableLinks($row_sb["other_guidelines"]));?> </p>
								<?php
			$sqlckassgn ="SELECT * FROM ph_assign_project WHERE projects_id ='".$odid."'";
				$resultckassgn = $conn->query($sqlckassgn);
					if ($resultckassgn->num_rows > 0) {
					while($rowckassgn = $resultckassgn->fetch_assoc()) {
					$assignid = $rowckassgn['tmid'];
						$sqlassgnnm ="SELECT * FROM ph_adminstrator WHERE aid ='".$assignid."'";
						$resultassgnnm = $conn->query($sqlassgnnm);
							if ($resultassgnnm->num_rows > 0) {
							while($rowassgnnm = $resultassgnnm->fetch_assoc()) {
							$assignname = $rowassgnnm['adname'];
							echo '<h5 class="fntassignto">Assign to</h5>';
							echo '<p class="fntassignto">'.$assignname.'</p>';
							}
							}
					}	} ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
             <?php
		   $sqlusern ="SELECT * FROM ph_order_quote WHERE oid ='".$odid."'order by qid desc limit 1";
					$resultusern = $conn->query($sqlusern);
					if ($resultusern->num_rows > 0) {
					while($rowusern = $resultusern->fetch_assoc()) {?>
					<div class="order-detail clearfix">
            	<div class="comment-rt pull-right arrow-none border-blue">
                	<div class="cmnt-inner">
                	<div class="clearfix pay-sec">
                    <h4>Your Quotation Details</h4>
                    <div class="<?php if($row_sb["order_start_date"]!=''){echo "od-det od-det2";}else{echo "od-det od-det1";}?> pull-left">

                <table width="100%" cellspacing="0" cellpadding="0">
                	<tbody><tr>
                     </tr></tbody><thead>
                    	<tr><th>Description</th>
                        <th>Time Estimate</th>
                        <th>Price</th>
						 <?php if($row_sb["order_start_date"]!=''){ ?>
						<th>Start Date</th>
						<th>ETA</th>
						<?php } ?>
                        </tr></thead>

                    <tbody><tr>
                    	<td>PSD to <?php //echo $row_sb["select_options"];

if(isset($row_sb["select_service"])){
 // echo "czc".$row_sb["select_service"];
																	 $sqll="select * from ph_service where id=".$row_sb["select_service"];
																	 $results = mysqli_query($conn,$sqll);
																	 //print_r($results);
																	 if(mysqli_num_rows($results)>0){
																		 while($fetch=mysqli_fetch_assoc($results)){
																			 //print_r($fetch);
																	 echo strtoupper($fetch['name']);
																		 }
	 }
 }
 ?></td>
                        <td><?php echo $rowusern["estimate_time"]; ?>-<?php echo $rowusern["estimate_time"]+1;?> Working Days</td>
                       <td>$<?php echo number_format((float)$rowusern["quote_amount"], 2, '.', '');?></td>
						<?php if($row_sb["order_start_date"]!=''){
							$adddays= $rowusern["estimate_time"]+2;
							$eta = date('d-m-Y',strtotime($row_sb["order_start_date"]. "+$adddays days"));?>
						<td><?php 	echo $row_sb["order_start_date"];?></td>
						<td><?php echo $eta;?></td>
						<?php }?>
                    </tr>
                </tbody></table>

            </div>
            <?php if($row_sb["payment_status"]!='Received'){
           $sql_gcup = "SELECT * FROM ph_use_coupons WHERE order_id='$odid'";
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

							echo '<div class="pro-qout discount pull-left" >
							 <table width="100%" cellspacing="0" cellpadding="0">
                	<thead><tr><th>Quote</th><th>Discount</th><th>Total</th></tr></thead>
                    <tbody><tr><td>$'.number_format((float)$rowusern["quote_amount"], 2, '.', '').'</td><td>$'.number_format((float)round($discount_apply), 2, '.', '').'</td><td>$'.number_format((float)$discounted_price, 2, '.', '').'</td></tr></tbody>
					</table>
						</div>';
							}
						}
					}
					}
			else{
			echo '<div class="pro-qout pull-left">
            	<h6>Your Project Quote is</h6><h3><span>$</span>'.number_format((float)$rowusern["quote_amount"], 2, '.', '').'</h3></div>';
			}
			?>
            <?php $sqlpay ="SELECT * FROM ph_users WHERE uid ='".$row_sb['uid']."'";
						$resultpay = $conn->query($sqlpay);
							if ($resultpay->num_rows > 0) {
							while($rowpay = $resultpay->fetch_assoc()) {
								echo '<a class="mkpaymentordl" href="payment?oid='.base64_encode("p2h5".$requestdate[0].$requestdate[1].$tdate[0].$row_sb["oid"]).'"><button class="pay-btn pull-left" type="submit"><span>Make</span> <br>Payment</button></a>';
							}
							}

							}
							else{
							$sql_gcup = "SELECT * FROM ph_use_coupons WHERE order_id='$odid'";
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
							echo '<div class="pull-left paysucess pro-qout">
							<h6>Discount </h6>';
							echo '<h3>$'.number_format((float)round($discount_apply), 2, '.', '').'</h3>';
							echo'<span class="discount_ccode">CC : '.$coupon_code.'</span>
							 </div>';
							echo '<div class="pull-left paysucess pro-qout">
							<h6>Payment </h6>';
							echo '<h3>$'.number_format((float)$discounted_price, 2, '.', '').'</h3>';
							echo'<a id="'.$odid.'" class="view-rec" data-toggle="modal" data-target="#exampleModal1">View receipt</a>
							 </div>';
							}
						}
					}
					}
			else{
			echo '<div class="pull-left paysucess nt_coupon">
							<h6>Payment Recived</h6>';
			echo '<h3><span>$</span>'.number_format((float)$rowusern["quote_amount"], 2, '.', '').'</h3>';
			echo'<a id="'.$odid.'" class="view-rec" data-toggle="modal" data-target="#exampleModal1">View receipt</a>
							 </div>';
			}
			}
							?>
            </div>
                </div>
                </div>

            </div>

				<?php 	}
					}

				}

			}?>


            <?php 	$sqlcomtal ="SELECT * FROM ph_order_chat WHERE oid ='".$odid."'order by chid ASC";
				$resultcomtal = $conn->query($sqlcomtal);
					if ($resultcomtal->num_rows > 0) {
					while($rowcomtal = $resultcomtal->fetch_assoc()) {	?>
            <div class="order-detail clearfix">
            	<div class="comnt-img pull-left">

<?php 
if($rowcomtal['uid']==0){
				$sqlcomuim ="SELECT * FROM ph_adminstrator WHERE aid ='".$rowcomtal['adid']."'";
						$resultcomuim = $conn->query($sqlcomuim);
							if ($resultcomuim->num_rows > 0) {
							while($rowcomuim = $resultcomuim->fetch_assoc()) {
											if($rowcomuim['adrole']=='team_member'){
											$gravatar_link = 'https://www.gravatar.com/avatar/' . md5($rowcomuim['ademail']) .'?d=404&s=200';
											  $headers = @get_headers($gravatar_link);
												if (!preg_match("|200|", $headers[0])) {
													echo '<img src="'.$domain.'/img/cmt-img3.jpg">';
												} else {
											//echo '<img src="' . $gravatar_link . '" />';
											echo '<img src="https://www.psd2html5.co/img/cmt-img.jpg" >';
												}

											}else{

											$gravatar_link = 'https://www.gravatar.com/avatar/' . md5($rowcomuim['ademail']) .'?d=404&s=200';
											  $headers = @get_headers($gravatar_link);
												if (!preg_match("|200|", $headers[0])) {
													echo '<img src="'.$domain.'/img/cmt-img2.jpg">';
												} else {
										//echo '<img src="' . $gravatar_link . '" />';
										echo '<img src="https://www.psd2html5.co/img/cmt-img.jpg" >';
												}
												}
											echo '<h5>'.$rowcomuim['adname'].'</h5>';
							}
							}


				}
				else{

						$sqlcomuim ="SELECT * FROM ph_users WHERE uid ='".$rowcomtal['uid']."'";
						$resultcomuim = $conn->query($sqlcomuim);
							if ($resultcomuim->num_rows > 0) {
							while($rowcomuim = $resultcomuim->fetch_assoc()) {
							$profilepicim = $rowcomuim['profile_pic'];
											if(!empty($profilepicim)){
											echo '<img src="'.$domain.'/profile_pics/p2h5profile_pic_'.$logeduserid.'/'.$profile_pic.'">';
											echo '<h5>'.$rowcomuim['name'].'</h5>';
											}
											else{
											$gravatar_link = 'https://www.gravatar.com/avatar/' . md5($rowcomuim['email']) .'?d=404&s=200';
											  $headers = @get_headers($gravatar_link);
												if (!preg_match("|200|", $headers[0])) {
													echo '<img src="https://www.psd2html5.co/img/cmt-img.jpg">';
												} else {
													echo '<img src="' . $gravatar_link . '" />';
												}
											echo '<h5>'.$rowcomuim['name'].'</h5>';
											}

							}
							}
					}		?>
                    <p><?php echo $rowcomtal['comment_time'];?></p>
                </div>
                <div class="comment-rt pull-right <?php if($rowcomtal['postby']=='administrator'){echo 'bg-change';}elseif($rowcomtal['postby']=='team_member'){echo 'bgt-change';}else{ echo 'bgc-change';} ?>">
                	<div class="cmnt-inner">
                    	<div class="cmt-header clearfix">
                        	<p><?php $sttr= nl2br(makeClickableLinks($rowcomtal['message']));  echo str_replace("<br>",'',$sttr); ?></p>
			</div>
                    </div>
<?php
if(!empty($rowcomtal['attacment_path'])){
$attachments = explode( ',', $rowcomtal['attacment_path'] );
$attachs = explode(",", $rowcomtal['attacment_path']);
echo '<div class="attchments-file"><h4>Attachments:</h4><ul>';
foreach($attachs as $attach) {
$attach = trim($attach);
$info = new SplFileInfo('comment_attachments/'.$attach);
$extension = $info->getExtension();
if($extension == 'jpg' || $extension == 'jpeg' || $extension == 'svg'){
echo '<li class="clearfix"><img src="'.$domain.'/img/jpg.png"><div class="at-name"><h5>'.$attach.'</h5><a target="_blank" href="'.$domain.'/comment_attachments/'.$attach.'">Download</a></div></li>';
}
elseif($extension == 'pdf'){
echo '<li class="clearfix"><img src="'.$domain.'/img/pdf.png"><div class="at-name"><h5>'.$attach.'</h5><a target="_blank" href="'.$domain.'/comment_attachments/'.$attach.'">Download</a></div></li>';
}
elseif($extension == 'png'){
echo '<li class="clearfix"><img src="'.$domain.'/img/png.png"><div class="at-name"><h5>'.$attach.'</h5><a target="_blank" href="'.$domain.'/comment_attachments/'.$attach.'">Download</a></div></li>';
}
elseif($extension == 'gif'){
echo '<li class="clearfix"><img src="'.$domain.'/img/gif.png"><div class="at-name"><h5>'.$attach.'</h5><a target="_blank" href="'.$domain.'/comment_attachments/'.$attach.'">Download</a></div></li>';
}
elseif($extension == 'zip'){
echo '<li class="clearfix"><img src="'.$domain.'/img/zip.png"><div class="at-name"><h5>'.$attach.'</h5><a target="_blank" href="'.$domain.'/comment_attachments/'.$attach.'">Download</a></div></li>';
}
else{
echo '<li class="clearfix"><div class="at-name"><h5>'.$attach.'</h5><a target="_blank" href="'.$domain.'/comment_attachments/'.$attach.'">Download</a></div></li>';
}
}
   echo'</ul></div>';

}
?>
                </div>


            </div><?php
			}
					}
		   else {/*echo "0 results";*/}
		   ?>
        <div class="order-detail clearfix post_coment">
			<!--<form id="reply" name="reply" method="post" action="" enctype="multipart/form-data">
            	<div class="comment-rt pull-right arrow-none">
                	<textarea name="message" placeholder="Message" id="cmmessage"></textarea>
									<input type="hidden" name="cmorderid" value="<?php echo $odid; ?>" />
									<input type="hidden" name="cmuserid" value="<?php echo $logeduserid; ?>" />
				 					<input type="hidden" name="counterno"  id="counterno" value="0">
									<ul id="cmlist" class="clearfix"></ul>
									<div class="bottom-link">
											<ul> <li class="browse_file"><a class="addcomatch"><img src="https://www.psd2html5.co/img/attch-ico.png"> Add Attachment</a><input id="filesatch0" class="comtatth" name="uploads[]" accept=".png,.jpg,.zip,.pdf,.gif,.jpeg" multiple="" onchange="comentattachments()" type="file"></li>
													 <li class="sd-btn"><input name="xddsubmit" id="xddsubmit" type="hidden"><input name="cmsubmit" class="submit-btn common-btn" value="Send  Now" type="submit">
														 <p class="image_loading">&nbsp;</p></li>
											</ul>
									</div>
							</div>
				    </form>-->
						<form id="reply" name="reply" method="post" action="" enctype="multipart/form-data">
			          <div class="comment-rt pull-right arrow-none">
			          <textarea name="message" placeholder="Message" id="cmmessage"></textarea>
								<input type="hidden" name="cmorderid" value="<?php echo $odid; ?>" />
								<input type="hidden" name="cmuserid" value="<?php echo $logeduserid; ?>" />
			 					<input type="hidden" name="counterno"  id="counterno" value="0">
								<ul id="cmlist" class="clearfix"> </ul>
			                    <div class="bottom-link">
													<ul> <li class="browse_file"><a class="addcomatch"><img src="https://www.psd2html5.co/img/attch-ico.png"> Add Attachment</a><input id="filesatch0" class="comtatth" name="uploads[]" accept=".png,.jpg,.zip,.pdf,.gif,.jpeg" multiple="" onchange="comentattachments()" type="file"></li>
															<li class="sd-btn"><input name="xddsubmit" id="xddsubmit" type="hidden">
														  <input name="cmsubmit" class="submit-btn common-btn" value="Send  Now" type="submit">
														  <p class="image_loading">&nbsp;</p></li>
													</ul>
			                	<!-- <ul>
			                        <li class="browse_file"><a class="addcomatch"><img src="<?php echo $domain;?>/img/attch-ico.png"> Add Attachment</a>
																<input id="filesatch0" class="comtatth" name='uploads[]' type="file" accept=".png,.jpg,.zip,.pdf,.gif,.jpeg" multiple onChange="comentattachments()" ></li>
			                        <li class="sd-btn"><input type="hidden" name="xddsubmit" id="xddsubmit"><input type="submit" name="cmsubmit" class="submit-btn" value="Send  Now"/>
									<p class="image_loading">&nbsp;</p></li>
								</ul> -->
			          </div>
							</div>
			      </form>
				  </div>
			</div>
    </div>
</div>
<?php
			if($_POST['message']){
				//echo "<pre>";print_r($_POST);
			}
			$sql_uid = "SELECT * FROM ph_orders WHERE oid ='$odid'";
			$result_uid = mysqli_query($conn, $sql_uid);
			#echo "<pre>";print_r($result_uid); die();
			if (mysqli_num_rows($result_uid) > 0) {
			while($row_sb = mysqli_fetch_assoc($result_uid)) {
			$current_ostatus = $row_sb["order_status"];
			$currrent_uid = $row_sb["uid"];
			if($current_ostatus=='Order Completed'){
			echo '<div class="feedback-outer">
    	<div class="container">
    		<div class="clearfix">';
			$sql_fedbk = "SELECT * FROM ph_feedback WHERE oid ='$odid'";
			$result_fedbk = mysqli_query($conn, $sql_fedbk);
			if (mysqli_num_rows($result_fedbk) > 0) {
			while($row_fedbk = mysqli_fetch_assoc($result_fedbk)) { ?>
			<div class="feed-done pull-right">
				<div class="done-fb-ico"><img src="<?php echo $domain;?>/img/<?php echo $row_fedbk['feedback'];?>.svg"><span class='<?php echo $row_fedbk['feedback'];?>'><?php echo $row_fedbk['feedback'];?></span></div>
				<div class="feed-con">
					<?php $sql_feeduser = "SELECT * FROM ph_users WHERE uid ='$currrent_uid'";
			$result_feeduser = mysqli_query($conn, $sql_feeduser);
			if (mysqli_num_rows($result_feeduser) > 0) {
			while($row_feeduser = mysqli_fetch_assoc($result_feeduser)) {
			echo '<h5>'.$row_feeduser['name'].' '.$row_feeduser['lname'].'</h5>';
			}
			}?>
					<p><?php echo $row_fedbk['comment'];?></p>

				</div>
    			</div>
		<?php	}
			}
			else{?>
			<div class="feed-right pull-right">
    				<h5>Share your Experience</h5>
					<form id="sendfeed" action="" method="post" name="sendfeed">
    				<ul class="list-inline">
    					<li><label for="poor"><img src="<?php echo $domain; ?>/img/poor.svg"><span>Poor</span></label><input type="radio" id="poor" name="feedback" value="poor" /></li>
    					<li><label for="good"><img src="<?php echo $domain; ?>/img/good.svg"><span>Good</span></label><input type="radio" id="good" name="feedback" value="good" /></li>
    					<li><label for="better"><img src="<?php echo $domain; ?>/img/better.svg"><span>Better</span></label><input type="radio" id="better" name="feedback" value="better" />></li>
						<li><label for="great"><img src="<?php echo $domain; ?>/img/great.svg"><span>Great</span></label><input type="radio" id="great" name="feedback" value="great" /></li>
						<li><label for="awesome"><img src="<?php echo $domain; ?>/img/awesome.svg"><span>Awesome</span></label><input type="radio" id="awesome" name="feedback" value="awesome" /></li>
    				</ul>
    				<div class="text-area-btn">
    					<textarea placeholder="Comment" name="feed_comment" id="feed_comment"></textarea>
						<input type="hidden" name="orderid" value="<?php echo $odid;?>" />
    					<input id="fdsubmit" type="submit" value="submit" name="fdsubmit"  class="submit-btn"/>
						<p class="feed_loading">&nbsp;</p>
    			</div>
			</form>
    			</div>
			<div class="feed-done pull-right"></div>
			<?php
			}
			echo '</div>
    	</div>
    </div>';
			}

			  }
			}
			?>
<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog recept">
    <div class="modal-content view_invoi">

  </div>
  </div>
</div>

<?php include('footer.php'); ?>

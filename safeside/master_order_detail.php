<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
 <h2 class="page-header">Order Details</h2>
  <div class="row">
  <div class="col-sm-12">
		 <div class="col-sm-12">
      <div class="row">
	  <?php
	  function makeClickableLinks($s) {
  return preg_replace('@(https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-]*(\?\S+)?[^\.\s])?)?)@', '<a href="$1" target="_blank">$1</a>', $s);
}
	  $sql_chat_status = "UPDATE ph_order_chat SET status =1 WHERE oid='".$_GET['oid']."'";
  if ($conn->query($sql_chat_status) === TRUE) {/*echo "Record updated successfully";*/}
  else {/*echo "Error updating record: " . $conn->error;*/}
	  $sql_uid = "SELECT * FROM ph_orders WHERE oid='".$_GET['oid']."'";
			$result_uid = mysqli_query($conn, $sql_uid);
			if (mysqli_num_rows($result_uid) > 0) {
				while($row_sb = mysqli_fetch_assoc($result_uid)) {
				$requestdate = explode( '-', $row_sb['request_date'] ); $tdate = explode( ' ', $requestdate[2] );
				?>
        <div class="col-sm-12">
		     <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">Order Detail</h3>
            </div>
            <div class="panel-body order_update">
			<div class="table-responsive">
            <table class="table table-striped table-bordered table-hover dataTable no-footer ">
			<tbody>
			<tr><td><strong>Name</strong></td><td>PSD to  <?php //echo $row_sb["select_service"]; ?>

<?php

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
															 }  ?>


</td><td><strong>ID</strong></td><td><?php echo "p2h5".$requestdate[0].$requestdate[1].$tdate[0].$row_sb["oid"];?></td></tr>
			<tr><td><strong>Request Date</strong></td><td><?php echo $row_sb["request_date"];?></td><td><strong>Responsive Layout</strong></td><td class="trik"><?php echo $row_sb["responsiveness"];?></td></tr>
			
			<tr><?php if($row_sb["dpbx_fld_name"]!=""){?><td><strong>Dropbox Folder</strong></td><td><?php echo  $row_sb["dpbx_fld_name"];?></td><?php }?><?php if($row_sb["shared_link"]!=""){?><td><strong>Shared_link</strong></td><td><?php echo  $row_sb["shared_link"];?></td><?php }?></tr>
			<tr><td><strong>Status</strong></td><td><?php echo $row_sb["order_status"];?></td><?php if($row_sb["order_status"]!="Waiting For Quote"){?>
			<td><strong>Time Estimate</strong></td><td><?php 
				$sqleta ="SELECT * FROM ph_order_quote WHERE oid ='".$row_sb["oid"]."'order by qid desc limit 1";
				$resulteta = $conn->query($sqleta);
				if ($resulteta->num_rows > 0) {
				while($roweta = $resulteta->fetch_assoc()) {	
 echo $roweta["estimate_time"]; ?>-<?php echo $roweta["estimate_time"]+1;?> Working Days
				<?php }
				}?></td>
				<?php }?></tr>
			
				<tr><?php if($row_sb["order_start_date"]!=""){?>
				<td><strong>Order Start date</strong></td><td><?php echo $row_sb["order_start_date"];?>&nbsp;<a data-toggle="modal" data-target="#myModal1">Change date</a></td>
				<?php }?>
				<?php if($row_sb["order_start_date"]!=''){ ?>
				<td><strong>ETA</strong></td><td><?php 
				$sqleta ="SELECT * FROM ph_order_quote WHERE oid ='".$row_sb["oid"]."'order by qid desc limit 1";
				$resulteta = $conn->query($sqleta);
				if ($resulteta->num_rows > 0) {
				while($roweta = $resulteta->fetch_assoc()) {
				$adddays= $roweta["estimate_time"]+2;
				echo $eta = date('d-m-Y',strtotime($row_sb["order_start_date"]. "+$adddays days"));
				}
				}?></td>
				<?php }?>
				</tr>
				<tr><?php if($row_sb["order_status"] =="Order Completed"){?>				
<td><strong>Order Complete date</strong></td><td><?php echo $row_sb["order_complete_date"]; ?></td>
						<?php }?></tr>
					
	</tbody></table>
	</div>
	<div class="table-responsive">
	<table class="table table-striped table-bordered table-hover dataTable no-footer ">
	<thead><tr><th>Other Guideline</th></tr></thead><tbody><tr><td><?php echo nl2br(makeClickableLinks($row_sb["other_guidelines"]));?></td></tr></tbody>
	</table>
	</div>
            </div>		
				<?php if($row_sb["order_status"] =="Order Started Shortly"){?>
			<div class="panel-footer orderst"><a  class="updateorder" data-toggle="modal" data-target="#myModal1">Update Order Status</a></div>
			<?php }?>
			<?php if($row_sb["order_status"] =="Order In Progress"){?>
			<div class="panel-footer orderst"><a id="markcomplete">Mark as Completed</a></div>
			<?php }?>		
          </div>
        </div><!-- /.col-sm-12 -->
      </div>
	  </div><!-- /.col-sm-12 -->
		</div>
		 <div class="col-sm-12">
		 <div class="col-sm-6">
		 <div class="row"><div class="col-sm-12">
		<div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">User Info / Payment Status</h3>
            </div>
            <div class="panel-body">
			<div class="table-responsive"> 
			<table class="table table-striped table-bordered table-hover dataTable no-footer "><tbody>
			<?php 
		 $sqlusern ="SELECT name,email,password,client_ip FROM ph_users WHERE uid ='".$row_sb["uid"]."'";
				$resultusern = $conn->query($sqlusern);
					if ($resultusern->num_rows > 0) {
					while($rowusern = $resultusern->fetch_assoc()) {
					$password =$rowusern["password"];
					function my_decryption($password=null){
					$key = '!@#$%weosalt+_()*&1309^';
					$string = $password;
					$decrypted = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5(base64_encode($key)), base64_decode($string), MCRYPT_MODE_nofb, md5(base64_encode(md5($key)))), "\0");
					return $decrypted;
					}
					$user_password= my_decryption($password);
					echo'<tr><td>Name</td><td>'.$rowusern["name"].'</td></tr>';
					echo'<tr><td>Email</td><td>'. $rowusern["email"].'</td></tr>';
					echo'<tr><td>System ID</td><td>'. $user_password.'</td></tr>';
					if($rowusern["client_ip"]!=""){
					echo'<tr><td>Client IP</td><td>'. $rowusern["client_ip"].'<a class="pull-right" href="http://www.ip2location.com/demo/'. $rowusern["client_ip"].'" target="_blank">Get Location</a></td></tr>';
					}else{
					$sql_lgid = "SELECT *  FROM ph_log_status WHERE uid='".$row_sb["uid"]."' ORDER BY lgid desc limit 1";
					$result_lgid = mysqli_query($conn, $sql_lgid);
					if (mysqli_num_rows($result_lgid) > 0) {
						while($row_lgid = mysqli_fetch_assoc($result_lgid)) {
						echo'<tr><td>Client IP</td><td>'. $row_lgid["client_ip"].'<a class="pull-right" href="http://www.ip2location.com/demo/'. $row_lgid["client_ip"].'" target="_blank">Get Location</a></td></tr>';
					
						}
					}
					}
					}
					}
					else {/*echo "0 results";*/}
				 ?>
					<tr><td>Payment</td><td class="trik2"><?php if($row_sb["payment_status"]=="Received"){ echo '<span style="color:#009900; font-weight:bold">'.$row_sb["payment_status"].'</span>';}else{echo $row_sb["payment_status"];}?></td></tr>
					<?php $sql_gcup = "SELECT * FROM ph_use_coupons WHERE order_id='".$_GET['oid']."'";
			$result_gcup = mysqli_query($conn, $sql_gcup);
			if (mysqli_num_rows($result_gcup) > 0) {
			while($row_gcup = mysqli_fetch_assoc($result_gcup)) {
			$coupon_code = $row_gcup['coupon_code'];
			echo '<tr><td>Coupon code</td><td>'.$coupon_code.'</td></tr>';
					$sql_gcupm = "SELECT * FROM ph_coupons WHERE coupon_code='$coupon_code'";
					$result_gcupm = mysqli_query($conn, $sql_gcupm);
						if (mysqli_num_rows($result_gcupm) > 0) {
							while($row_gcupm = mysqli_fetch_assoc($result_gcupm)) {
							$sqlusern ="SELECT * FROM ph_order_quote WHERE oid ='".$_GET['oid']."'order by qid DESC LIMIT 1";
					$resultusern = $conn->query($sqlusern);
					if ($resultusern->num_rows > 0) {
					while($rowusern = $resultusern->fetch_assoc()) {
							$discount = $row_gcupm['discount'];
							$discount_apply = ($discount / 100) * $rowusern["quote_amount"];
							$discounted_price = $rowusern["quote_amount"]- round($discount_apply);
					echo '<tr><td>Discount</td><td>$'.round($discount_apply).'.00</td></tr>';
					echo '<tr><td>New Amount</td><td>$'.$discounted_price.'.00</td></tr>';		
					}
					}
							}
						}
					}
					} ?>
		   </tbody></table>
		   </div>
             <strong></strong>
            </div>
          </div>
		    </div><!-- /.col-sm-12 -->
			</div></div>
			<div class="col-sm-3">
			<div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">Quotes List</h3>
            </div>
            <div class="panel-body quotelist">
            <?php 

			$sqlusern ="SELECT * FROM ph_order_quote WHERE oid ='".$_GET['oid']."'order by qid ASC";
		echo'<table class="table table-striped table-bordered table-hover dataTable no-footer "><thead><tr><th>Amount</th><th>Date</th></tr></thead><tbody>'; 
					$resultusern = $conn->query($sqlusern);
					if ($resultusern->num_rows > 0) {
					while($rowusern = $resultusern->fetch_assoc()) {
					echo '<tr><td>';
					echo '$'.$rowusern["quote_amount"].'.00';
					echo'</td><td>';
				    echo $rowusern["quote_date"];
					echo'</td></tr>';
					}
					}else {/*echo "0 results";*/}
		echo '</tbody></table>';
			?>
            </div>
			<?php if($row_sb['payment_status']!='Received'){
			echo '<div class="panel-footer"><a  class="newqoute" data-toggle="modal" data-target="#myModal">Add New Quote</a></div>';
			}?>
          </div>
		</div><!-- /.col-sm-3 -->
		 <div class="col-sm-3"><div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">Assign To</h3>
            </div>
            <div class="panel-body assigntx">
			<?php 
		$sql_tml = "SELECT * FROM ph_assign_project WHERE projects_id ='$order_id'";
			$result_tml = mysqli_query($conn, $sql_tml);
			 echo '<table class="table table-striped table-bordered table-hover dataTable no-footer "><tbody>';
			if (mysqli_num_rows($result_tml) > 0) {
				while($row_tml = mysqli_fetch_assoc($result_tml)) {
				$tmid=$row_tml["tmid"];
				$sql_tmln = "SELECT * FROM ph_adminstrator WHERE aid ='$tmid'";
			$result_tmln = mysqli_query($conn, $sql_tmln);
			if (mysqli_num_rows($result_tmln) > 0) {
				while($row_tmln = mysqli_fetch_assoc($result_tmln)) {
				echo '<tr><td>'.$row_tmln["adname"].'</td></tr>';
				
				}
				}
				
				}
			}	echo '</tbody></table>';
			?>			   
            </div>
			<?php 
			if($row_sb['payment_status']=='Received'){
				$sql_tml = "SELECT * FROM ph_assign_project WHERE projects_id ='$order_id'";
					$result_tml = mysqli_query($conn, $sql_tml);
			 	if (mysqli_num_rows($result_tml) <= 0) {?>
			<div class="panel-footer assigncl"><a data-target="#myModal2" data-toggle="modal" class="newqoute">Assign</a></div>
			<?php }   }?>
          </div></div>
		 </div>
	  <?php		
	  	  }
		
			}	
			?>
			
    </div>
	<div class="row">
   <div class="col-sm-12">
   <div class="panel panel-default">
            <div class="panel-heading">
		     <h3 class="panel-title">Order Discussion</h3>
            </div>
            <div class="panel-body">
			<?php 	$sqlcomtal ="SELECT * FROM ph_order_chat WHERE oid ='".$_GET['oid']."'order by chid ASC";
				$resultcomtal = $conn->query($sqlcomtal);
					if ($resultcomtal->num_rows > 0) {
					while($rowcomtal = $resultcomtal->fetch_assoc()) {	?>
            <div class="order-detail clearfix">
            	<div class="comnt-img pull-left">
				<?php if($rowcomtal['uid']==0){
				//if($rowcomtal['postby']=='team_member'){ echo '<img src="../img/cmt-img3.jpg"><h5>Team Member</h5>';}else{	echo '<img src="../img/cmt-img2.jpg"><h5>Support Team</h5>';}
				
				$sqlcomuim ="SELECT * FROM ph_adminstrator WHERE aid ='".$rowcomtal['adid']."'";
						$resultcomuim = $conn->query($sqlcomuim);
							if ($resultcomuim->num_rows > 0) {
							while($rowcomuim = $resultcomuim->fetch_assoc()) {
											if($rowcomuim['adrole']=='team_member'){ 
											 $gravatar_link = 'https://www.gravatar.com/avatar/' . md5($rowcomuim['ademail']) .'?d=404&s=200';
											  $headers = @get_headers($gravatar_link);
												if (!preg_match("|200|", $headers[0])) {
													echo '<img src="../img/cmt-img3.jpg">';
												} else {
													echo '<img src="' . $gravatar_link . '" />';
												}
   												

											}else{
											$gravatar_link = 'https://www.gravatar.com/avatar/' . md5($rowcomuim['ademail']) .'?d=404&s=200';
											  $headers = @get_headers($gravatar_link);
												if (!preg_match("|200|", $headers[0])) {
													echo '<img src="../img/cmt-img.jpg">';
												} else {
													echo '<img src="' . $gravatar_link . '" />';
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
											echo '<img src="../profile_pics/p2h5profile_pic_'.$rowcomuim['uid'].'/'.$profilepicim.'">';
											echo '<h5>'.$rowcomuim['name'].' '.$rowcomuim['lname'].'</h5>';
											}
											else{
											$gravatar_link = 'https://www.gravatar.com/avatar/' . md5($rowcomuim['email']) .'?d=404&s=200';
											  $headers = @get_headers($gravatar_link);
												if (!preg_match("|200|", $headers[0])) {
													echo '<img src="../img/cmt-img.jpg">';
												} else {
													echo '<img src="' . $gravatar_link . '" />';
												}
											
											echo '<h5>'.$rowcomuim['name'].'</h5>';
											}
									
							}
							}
					}?>
                	
                    
                    <p><?php echo $rowcomtal['comment_time'];?></p>
                </div>
                <div class="comment-rt pull-right <?php if($rowcomtal['postby']=='administrator'){echo 'bg-change';}elseif($rowcomtal['postby']=='team_member'){echo 'bgt-change';}else{ echo 'bgc-change';}?>">
                	<div class="cmnt-inner">
                    	<div class="cmt-header clearfix">
						
                        	<p><?php echo nl2br(makeClickableLinks($rowcomtal['message'])); ?></p>
							
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
if($extension == 'jpg' || $extension == 'jpeg' || $extension == 'JPEG' || $extension == 'JPG'){
echo '<li class="clearfix"><img src="../img/jpg.png"><div class="at-name"><h5>'.$attach.'</h5><a target="_blank" href="'.$domain.'/comment_attachments/'.$attach.'">Download</a></div></li>';
}
elseif($extension == 'pdf' || $extension == 'PDF'){
echo '<li class="clearfix"><img src="../img/pdf.png"><div class="at-name"><h5>'.$attach.'</h5><a target="_blank" href="'.$domain.'/comment_attachments/'.$attach.'">Download</a></div></li>';
}
elseif($extension == 'png' || $extension == 'PNG'){
echo '<li class="clearfix"><img src="../img/png.png"><div class="at-name"><h5>'.$attach.'</h5><a target="_blank" href="'.$domain.'/comment_attachments/'.$attach.'">Download</a></div></li>';
}
elseif($extension == 'gif' || $extension == 'GIF'){
echo '<li class="clearfix"><img src="../img/gif.png"><div class="at-name"><h5>'.$attach.'</h5><a target="_blank" href="'.$domain.'/comment_attachments/'.$attach.'">Download</a></div></li>';
}
elseif($extension == 'zip' || $extension == 'ZIP'){
echo '<li class="clearfix"><img src="../img/zip.png"><div class="at-name"><h5>'.$attach.'</h5><a href="'.$domain.'/comment_attachments/'.$attach.'">Download</a></div></li>';
}
else{
echo '<li class="clearfix"><div class="at-name"><h5>'.$attach.'</h5><a href="'.$domain.'/comment_attachments/'.$attach.'">Download</a></div></li>';
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
			<form id="reply" name="reply" method="post" action="" enctype="multipart/form-data">
            	<div class="comment-rt pull-right arrow-none">
                	<textarea name="message" placeholder="Message" id="cmmessage"></textarea>
					<input type="hidden" name="cmorderid" value="<?php echo $_GET['oid']; ?>" />
					<input type="hidden" name="commentby" value="<?php echo $_SESSION["adrole"]; ?>" />
					<input type="hidden" name="adminid" value="<?php echo $adminid; ?>" />
				<input id="filesatch" class="comtatth" name='uploads[]' type="file" accept=".png,.jpg,.zip,.pdf,.gif,.jpeg" multiple onChange="comentattachments()" style="display:none;" >
		<ul id="cmlist"></ul>
                    <div class="bottom-link">
                	<ul>
                        <li><a class="addcomatch"><img src="../img/attch-ico.png"> Add Attachment</a></li>
                        <li class="sd-btn"><input type="submit" name="cmsubmit" class="btn btn-primary" value="Send  Now"/><p class="image_loading">&nbsp;</p></li>
                    </ul>
                </div>
				</div>
                </form>
            </div>
            </div>
          </div>
		  <div class="panel panel-default">
            <div class="panel-heading">
		     <h3 class="panel-title">Feedback</h3>
            </div>
            <div class="panel-body">
  <?php
		$sql_uid = "SELECT * FROM ph_orders WHERE oid ='".$_GET['oid']."'";
			$result_uid = mysqli_query($conn, $sql_uid);
			if (mysqli_num_rows($result_uid) > 0) {
			while($row_sb = mysqli_fetch_assoc($result_uid)) {
			$current_ostatus = $row_sb["order_status"];
			$currrent_uid = $row_sb["uid"];
			if($current_ostatus=='Order Completed'){
			echo '<div class="feedback-outer">
    	<div class="container">
    		<div class="clearfix">';
			$sql_fedbk = "SELECT * FROM ph_feedback WHERE oid ='".$_GET['oid']."'";
			$result_fedbk = mysqli_query($conn, $sql_fedbk);
			if (mysqli_num_rows($result_fedbk) > 0) {
			while($row_fedbk = mysqli_fetch_assoc($result_fedbk)) {?>
			<div class="feed-done">
				<div class="done-fb-ico"><img src="../img/<?php echo $row_fedbk['feedback'];?>.svg"><span class='<?php echo $row_fedbk['feedback'];?>'><?php echo $row_fedbk['feedback'];?></span></div>
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
			echo '</div>
    	</div>
    </div>';
			}
			
			  }
			}
			?>
			</div>
			</div>
<!-- Add new Quote Price Modal popup start-->
<div class="modal fade bs-example-modal-sm" id="myModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close adqclose" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add New Quote</h4>
      </div>
      <div class="modal-body">
        <form id="data" method="post" action="">
		<div class="form-group input-group">
		<span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>
		<input type="text" name="nquote" value="" class="form-control" placeholder="Add New Quote Amount" require />
		<span class="input-group-addon">.00</span>
		</div>
		<div class="form-group">
		<select id="nqtime" name="nqtime" class="form-control">
		<option value="">Add Estimate Time </option>
		<?php for ($x = 1; $x <= 20; $x++) {echo '<option value="'.$x.'">'.$x.'</option>';}?>
		</select>
		</div>
		<input type="hidden" name="orderid" value="<?php echo $order_id; ?>" />
		</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="adqclose btn btn-default" data-dismiss="modal">Close</button>
        <button id="upquote" type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<!--Add new Quote Price Modal pupup end-->
<!-- Update Order Status Modal popup start-->
<div class="modal fade bs-example-modal-sm" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close adqclose" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Update Order Status</h4>
      </div>
      <div class="modal-body">
        <form id="orderdata" method="post" action="">
		<div class="form-group">
   <input type="text" name="orderstatus" value="Order In Progress" class="form-control" placeholder="Order In Progress" require readonly="readonly" />
</div>

    <div class="input-group date">
     <input id="orderstart" type="text" name="orderstart" class="form-control" Placehoder="Start date" require /><span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
    </div>
	
		<input type="hidden" name="orderid" value="<?php echo $order_id; ?>" />
		</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="adqclose btn btn-default" data-dismiss="modal">Close</button>
        <button id="upordstat" type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<!--Update Order Status Modal pupup end-->
<!-- Assign Project Modal popup start-->
<div class="modal fade bs-example-modal-sm" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close adqclose" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Team Member List</h4>
      </div>
      <div class="modal-body">
        <form id="data" method="post" action="">
		<div class="form-group">
		<select id="teammember" name="teammember" class="form-control">
		<option value="">Team Members</option>
		<?php 
		$sql_tm = "SELECT * FROM ph_adminstrator WHERE adrole ='team_member'";
			$result_tm = mysqli_query($conn, $sql_tm);
			if (mysqli_num_rows($result_tm) > 0) {
				while($row_tm = mysqli_fetch_assoc($result_tm)) {
				echo '<option value="'.$row_tm["aid"].'">'.$row_tm["adname"].'</option>';
				}
			}	?>	
		</select>
		</div>
		<div class="form-group"><textarea class="form-control" id="project_detail" name="project_detail"></textarea></div>
		<input type="hidden" name="asorderid" value="<?php echo $order_id; ?>" />
		</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="agnmbrclose btn btn-default" data-dismiss="modal">Close</button>
        <button id="agnmbr" type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<!--Assign Project Modal pupup end-->
   </div>
   </div>
  </div>
  </div>
</div>
<script type="text/javascript">
/* Add Attachment */
$(document).ready(function() {
    $(".addcomatch").on('click', function() {
	   $("#filesatch").click();
    });
});		
function comentattachments() {
			var input = document.getElementById("filesatch");
			var ul = document.getElementById("cmlist");
			//while (ul.hasChildNodes()) {
		//		ul.removeChild(ul.firstChild);
			//}
			for (var i = 0; i < input.files.length; i++) {
				var li = document.createElement("li");
				li.innerHTML = input.files[i].name;
				ul.appendChild(li);
			}
			if(!ul.hasChildNodes()) {
				var li = document.createElement("li");
				li.innerHTML = 'No Files Selected';
				ul.appendChild(li);
			}
		}
$("form#reply").submit(function(){
		//Validate required fields
		var filesuploads= $('#cmmessage').val();
		if (filesuploads==""){
		$('#cmmessage').css('border','1px solid #FF0000');
		return false;
		} else {
		$('#cmmessage').css('border','1px solid #ccc');
		var formData = new FormData($(this)[0]);
		$(document).ajaxStart(function(){
		$('.submit-btn').attr("disabled", "disabled").addClass('loading');
		$('.image_loading').addClass('loading_image').css("display","block");
		}).ajaxStop(function(){
		$('.submit-btn').removeAttr("disabled").removeClass('loading');
		$('.image_loading').removeClass('loading_image').css("display","none");
		});	
	$.ajax({
        url: "add_comment.php",
        type: 'POST',
        data: formData,
        async: true,
        success: function (data) {
		//alert(data);
		$(data).insertBefore( ".post_coment" );
		$("#reply")[0].reset();
		$("#cmlist").html('');
        },
        contentType: false,
        processData: false
    });
	return false;
		}
	});

/* Add New quote */
	 $("#upquote").click(function() {  
			var nquote = $('input[name="nquote"]').val();
			var nqtime = $('select[name="nqtime"]').val();
			var orderid = $('input[name="orderid"]').val();
			if(nquote!="" && nqtime!=""){
			 $('input[name="nquote"]').css('border','1px solid #ccc');
			$(document).ajaxStart(function(){
	$('.adqclose').hide();
	}).ajaxStop(function(){
	$('.adqclose').show();
	});	
	$.ajax({url: "add_quote.php",type:"POST",async:true,data:{nquote: nquote,orderid:orderid,nqtime:nqtime},success: function(response){
	$(".quotelist").html(response);
	$( ".adqclose" ).trigger( "click" );
	$("#data")[0].reset();
	 }});
	 }
	 else{
	 $('input[name="nquote"]').css('border','1px solid #FF0000');
	 $('select[name="nqtime"]').css('border','1px solid #FF0000');
	 }
	}); 
	
	/* Update Order Status  */
	
	    $('.input-group.date').datepicker({
		format: "dd-mm-yyyy",
		startDate: "Today",
        autoclose: true,
        todayHighlight: true,
        toggleActive: true
    });

	 $("#upordstat").click(function() {  
			var orderstatus = $('input[name="orderstatus"]').val();
			//alert(orderstatus);
			var orderid = $('input[name="orderid"]').val();
		//	alert(orderid);
			var orderstart = $('input[name="orderstart"]').val();
		//	alert(orderstart);
			if(orderstatus!="" && orderstart!=""){
			 $('input[name="orderstatus"]').css('border','1px solid #ccc');
			 $('input[name="orderstart"]').css('border','1px solid #ccc');
			$(document).ajaxStart(function(){
	$('.adqclose').hide();
	}).ajaxStop(function(){
	$('.adqclose').show();
	});	
	$.ajax({url: "update_order_status.php",type:"POST",async:true,data:{orderstatus: orderstatus,orderid:orderid,orderstart:orderstart},success: function(response){
	//alert(response);
	$(".order_update").html(response);
	$(".orderst").html('<a id="markcomplete">Mark as Completed</a>');
	$( ".adqclose" ).trigger( "click" );
	$("#orderdata")[0].reset();
	 }});
	 }
	 else{
	 $('input[name="orderstatus"]').css('border','1px solid #FF0000');
	 $('input[name="orderstart"]').css('border','1px solid #FF0000');
	 }
	}); 
	$("a#markcomplete").click(function() {  
			var orderid = $('input[name="orderid"]').val();
			var complete = "completed";
	$.ajax({url: "update_order_status.php",type:"POST",async:true,data:{complete: complete,orderid:orderid},success: function(response){
	$(".order_update").html(response);
	$(".orderst").addClass('hide');
	 }});
	}); 
	
		/* Assign member to project  */
		 $("#agnmbr").click(function() {  
			var teammember = $('select[name="teammember"]').val();
			var project_detail = $('#project_detail').val();
			var asorderid = $('input[name="asorderid"]').val();
			if(teammember!=""&& project_detail!=""){
			 $('select[name="teammember"]').css('border','1px solid #ccc');
			 $('#project_detail').css('border','1px solid #ccc');
			$(document).ajaxStart(function(){
	$('.agnmbrclose').hide();
	}).ajaxStop(function(){
	$('.agnmbrclose').show();
	});	
	$.ajax({url: "assign_member.php",type:"POST",async:false,data:{teammember: teammember,asorderid:asorderid,project_detail:project_detail},success: function(response){
//	alert(response);
$(".assigntx").html(response);
	$( ".agnmbrclose" ).trigger( "click" );
	 }});
	 }
	 else{
	 $('select[name="teammember"]').css('border','1px solid #FF0000');
	 $('#project_detail').css('border','1px solid #FF0000');
	 }
	}); 
		
	</script>

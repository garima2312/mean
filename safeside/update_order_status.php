<?php
include(__DIR__ . '/../config.php'); 
$orderstatus =$_POST['orderstatus'];
 $orderid =$_POST['orderid'];
$odstrt_date= $_POST['orderstart'];
$complete = $_POST['complete'];
$crnt_date = date('m-d-Y');
if(!empty($complete)){
$sql = "UPDATE ph_orders SET order_status ='Order Completed', order_complete_date='$crnt_date' WHERE oid='$orderid'";
  if ($conn->query($sql) === TRUE) {/*echo "Record updated successfully";*/}
  else {/*echo "Error updating record: " . $conn->error;*/}
 $sqlpayo ="SELECT * FROM ph_orders WHERE oid ='".$orderid."'";
						$resultpayo = $conn->query($sqlpayo);
							if ($resultpayo->num_rows > 0) {
							while($rowpayo = $resultpayo->fetch_assoc()) {
							 $requestdate = explode( '-', $rowpayo['request_date'] ); $tdate = explode( ' ', $requestdate[2] );
	     		  $eorderid = "p2h5".$requestdate[0].$requestdate[1].$tdate[0].$orderid; 
$sqlpayu ="SELECT * FROM ph_users WHERE uid ='".$rowpayo['uid']."'";
						$resultpayu = $conn->query($sqlpayu);
							if ($resultpayu->num_rows > 0) {
							while($rowpayu = $resultpayu->fetch_assoc()) {
							$epayname= $rowpayu['name'].' '.$rowpayu['lname'];
							$epayemail = $rowpayu['email'];
					$orderlinkid = base64_encode($eorderid);
include('emails/odercompleteemail.php');
							}
							}
							}
							}
							
	$sql_uid = "SELECT * FROM ph_orders WHERE oid='".$orderid."'";
			$result_uid = mysqli_query($conn, $sql_uid);
			if (mysqli_num_rows($result_uid) > 0) {
				while($row_sb = mysqli_fetch_assoc($result_uid)) {
				$requestdate = explode( '-', $row_sb['request_date'] ); $tdate = explode( ' ', $requestdate[2] );

					echo '<table class="table table-striped table-bordered table-hover dataTable no-footer ">
			<tbody>
			<tr><td><strong>Name</strong></td><td>PSD to  '.$row_sb["select_options"].'</td><td><strong>ID</strong></td><td>';
			  echo 'p2h5'.$requestdate[0].$requestdate[1].$tdate[0].$row_sb["oid"].'</td></tr>
			<tr><td><strong>Request Date</strong></td><td>'.$row_sb["request_date"].'</td><td><strong>Responsive Layout</strong></td><td class="trik">'.$row_sb["responsiveness"].'</td></tr>';
			
			echo '<tr>';
			if($row_sb["dpbx_fld_name"]!=""){echo '<td><strong>Dropbox Folder</strong></td><td>'.$row_sb["dpbx_fld_name"].'</td>';
			 }
			 if($row_sb["shared_link"]!=""){
			echo '<td><strong>Shared_link</strong></td><td>'.$row_sb["shared_link"].'</td>';
			}
			echo '</tr>';
			echo '<tr><td><strong>Status</strong></td><td>'.$row_sb["order_status"].'</td><td><strong>Time Estimate</strong></td><td>';
				$sqleta ="SELECT * FROM ph_order_quote WHERE oid ='".$row_sb["oid"]."'order by qid desc limit 1";
				$resulteta = $conn->query($sqleta);
				if ($resulteta->num_rows > 0) {
				while($roweta = $resulteta->fetch_assoc()) {	
				 echo $roweta["estimate_time"].'-'.$roweta["estimate_time"]+1;?> <?php echo "Working Days";
					}
				}echo '</td></tr>
				<tr><td><strong>Order Start date</strong></td><td>'.$row_sb["order_start_date"].'</td>';
				
				if($row_sb["order_start_date"]!=''){ 
				echo '<td><strong>ETA</strong></td><td>'; 
				$sqleta ="SELECT * FROM ph_order_quote WHERE oid ='".$row_sb["oid"]."'order by qid desc limit 1";
				$resulteta = $conn->query($sqleta);
				if ($resulteta->num_rows > 0) {
				while($roweta = $resulteta->fetch_assoc()) {
				$adddays= $roweta["estimate_time"]+2;
				echo $eta = date('d-m-Y',strtotime($row_sb["order_start_date"]. "+$adddays days"));
				}
				}echo '</td>';
			 }
			 echo '</tr>';
			  if($row_sb["order_status"] =="Order Completed"){
			  echo '<tr>
<td colspan="1"><strong>Order Complete date</strong></td><td>'.$row_sb["order_complete_date"].'</td></tr>';
}						
	echo '</tbody></table>
	<table class="table table-striped table-bordered table-hover dataTable no-footer ">
	<thead><tr><th>Other Guideline</th></tr></thead><tbody><tr><td>'.nl2br($row_sb["other_guidelines"]).'</td></tr></tbody>
	</table>';
	}
	}
		
		

}else{
$sql = "UPDATE ph_orders SET order_status ='$orderstatus', order_start_date='$odstrt_date' WHERE oid='$orderid'";
  if ($conn->query($sql) === TRUE) {echo "Record updated successfully";}
  else {echo "Error updating record: " . $conn->error;}
 $sqlpayo ="SELECT * FROM ph_orders WHERE oid ='".$orderid."'";
						$resultpayo = $conn->query($sqlpayo);
							if ($resultpayo->num_rows > 0) {
							while($rowpayo = $resultpayo->fetch_assoc()) {
							 $requestdate = explode( '-', $rowpayo['request_date'] ); $tdate = explode( ' ', $requestdate[2] );
	     		  $eorderid = "p2h5".$requestdate[0].$requestdate[1].$tdate[0].$orderid; 
$sqlpayu ="SELECT * FROM ph_users WHERE uid ='".$rowpayo['uid']."'";
						$resultpayu = $conn->query($sqlpayu);
							if ($resultpayu->num_rows > 0) {
							while($rowpayu = $resultpayu->fetch_assoc()) {
							$epayname= $rowpayu['name'].' '.$rowpayu['lname'];
							$epayemail = $rowpayu['email'];
							$sqlusern ="SELECT * FROM ph_order_quote WHERE oid ='".$orderid."'order by qid desc limit 1";
					$resultusern = $conn->query($sqlusern);
					if ($resultusern->num_rows > 0) {
					while($rowusern = $resultusern->fetch_assoc()) {
							$adddays= $rowusern["estimate_time"]+2;
							$eta = date('d-m-Y',strtotime($rowpayo["order_start_date"]. "+$adddays days"));
							
						}
						}
include('emails/oderstartemailemail.php');
							}
							}
							}
							}
							
	$sql_uid = "SELECT * FROM ph_orders WHERE oid='".$orderid."'";
			$result_uid = mysqli_query($conn, $sql_uid);
			if (mysqli_num_rows($result_uid) > 0) {
				while($row_sb = mysqli_fetch_assoc($result_uid)) {
				$requestdate = explode( '-', $row_sb['request_date'] ); $tdate = explode( ' ', $requestdate[2] );
				echo '<table class="table table-striped table-bordered table-hover dataTable no-footer ">
			<tbody>
			<tr><td><strong>Project Name</strong></td><td>PSD to  '.$row_sb["select_options"].'</td><td><strong>Project ID</strong></td><td>';			
	     		  echo 'p2h5'.$requestdate[0].$requestdate[1].$tdate[0].$row_sb["oid"].'</td></tr>
			<tr><td><strong>Request Date</strong></td><td>'.$row_sb["request_date"].'</td><td><strong>Responsive Layout</strong></td><td class="trik">'.$row_sb["responsiveness"].'</td></tr>';
			echo '<tr>';
			if($row_sb["dpbx_fld_name"]!=""){
			echo '<td><strong>Dropbox Folder</strong></td><td>'.$row_sb["dpbx_fld_name"].'</td>';
			 }
			 if($row_sb["shared_link"]!=""){
			echo '<td><strong>Shared_link</strong></td><td>'.$row_sb["shared_link"].'</td>';
			}
			echo '</tr>';
			echo '<tr><td><strong>Status</strong></td><td>'.$row_sb["order_status"].'</td><td><strong>Time Estimate</strong></td><td>';
				$sqleta ="SELECT * FROM ph_order_quote WHERE oid ='".$row_sb["oid"]."'order by qid desc limit 1";
				$resulteta = $conn->query($sqleta);
				if ($resulteta->num_rows > 0) {
				while($roweta = $resulteta->fetch_assoc()) {	
				 echo $roweta["estimate_time"].'-'.$roweta["estimate_time"]+1;?> <?php echo "Working Days";
					}
				}echo '</td></tr>
				<tr><td><strong>Order Start date</strong></td><td>'.$row_sb["order_start_date"].'&nbsp;<a data-toggle="modal" data-target="#myModal1">Change date</a></td>';
				
				if($row_sb["order_start_date"]!=''){ 
				echo '<td><strong>ETA</strong></td><td>'; 
				$sqleta ="SELECT * FROM ph_order_quote WHERE oid ='".$row_sb["oid"]."'order by qid desc limit 1";
				$resulteta = $conn->query($sqleta);
				if ($resulteta->num_rows > 0) {
				while($roweta = $resulteta->fetch_assoc()) {
				$adddays= $roweta["estimate_time"]+2;
				echo $eta = date('d-m-Y',strtotime($row_sb["order_start_date"]. "+$adddays days"));
				}
				}echo '</td>';
			 }
			 echo '</tr>';
			  if($row_sb["order_status"] =="Order Completed"){
			  echo '<tr>
<td colspan="1"><strong>Order Complete date</strong></td><td>'.$row_sb["order_complete_date"].'</td></tr>';
}						
	echo '</tbody></table>
	<table class="table table-striped table-bordered table-hover dataTable no-footer ">
	<thead><tr><th>Other Guideline</th></tr></thead><tbody><tr><td>'.nl2br($row_sb["other_guidelines"]).'</td></tr></tbody>
	</table>';
	}
	}
	}
			?>
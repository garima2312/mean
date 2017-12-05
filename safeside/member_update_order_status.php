<?php
include(__DIR__ . '/../config.php'); 
$orderid =$_POST['orderid'];
$memberid = $_POST['memberid'];
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
							$sql_quet ="SELECT * FROM ph_adminstrator WHERE aid ='".$memberid."' ";
					$result_quet = $conn->query($sql_quet);
					if ($result_quet->num_rows > 0) {
					while($rowquet = $result_quet->fetch_assoc()) {
					$membername = $rowquet['adname'];
                    $orderlinkid = base64_encode($eorderid);
include('emails/memberodercompleteemail.php');
}
}
							}
							}
							}
							}
							
	$sql_uid = "SELECT * FROM ph_orders WHERE oid='".$orderid."'";
			$result_uid = mysqli_query($conn, $sql_uid);
			if (mysqli_num_rows($result_uid) > 0) {
				while($row_sb = mysqli_fetch_assoc($result_uid)) {
				$requestdate = explode( '-', $row_sb['request_date'] ); $tdate = explode( ' ', $requestdate[2] );
			echo '<div class="table-responsive"><table class="table table-striped table-bordered table-hover dataTable no-footer ">
			<tbody>
			<tr><td><strong> Name</strong></td><td colspan="3">PSD to  '.$row_sb["select_options"].'</td></tr>
					<tr><td><strong> ID</strong></td><td>p2h5'.$requestdate[0].$requestdate[1].$tdate[0].$row_sb["oid"].'</td><td colspan="1"><strong>Responsive Layout</strong></td><td>'.$row_sb["responsiveness"].'</td></tr>';
			
			echo '<tr><td colspan="1"><strong>Order Start date</strong></td><td>'.$row_sb["order_start_date"].'</td>';
			if($row_sb["order_status"] =="Order Completed"){
echo '<td><strong>Order Complete date</strong></td><td>'.$row_sb["order_complete_date"].'</td>';
			 }
			 echo '</tr>';

				$sql_quet ="SELECT * FROM ph_order_quote WHERE oid ='".$row_sb["oid"]."'order by qid desc limit 1";
					$result_quet = $conn->query($sql_quet);
					if ($result_quet->num_rows > 0) {
					while($rowquet = $result_quet->fetch_assoc()) {
					 $adddays= $rowquet["estimate_time"]+2;
					$eta = date('d-m-Y',strtotime($row_sb["order_start_date"]. "+$adddays days"));
					echo '<tr><td><strong>ETA</strong></td><td>'.$eta.'</td>';
					echo '<td><strong>Status</strong></td><td>';
					if($row_sb["order_complete_date"]==""){
					$get_date = date("d-m-Y");
					if($get_date == $eta){ echo "Last day";}
					if($get_date > $eta){ echo "In Delay";}
					if($get_date < $eta){ echo "In Progress";}
					}
					else{echo "Completed";}
					echo '</td></tr>';
						}
					}
					else{ echo '<tr><td><strong>ETA</strong></td><td>&nbsp;</td><td><strong>Status</strong></td><td>&nbsp;</td></tr>';}
	echo '</tbody></table></div><div class="table-responsive">
	<table class="table table-striped table-bordered table-hover dataTable no-footer ">
	<thead><tr><th>Client Guideline</th></tr></thead><tbody><tr><td>'.nl2br($row_sb["other_guidelines"]).'</td></tr></tbody>
	</table></div>';
	 $sql_prodet ="SELECT * FROM ph_assign_project WHERE projects_id ='".$orderid."'";
					$result_prodet = $conn->query($sql_prodet);
					if ($result_prodet->num_rows > 0) {
					while($rowprodet = $result_prodet->fetch_assoc()) {
						echo '<div class="table-responsive">
	<table class="table table-striped table-bordered table-hover dataTable no-footer">
	<thead><tr><th>Project Detail</th></tr></thead><tbody><tr><td>'.nl2br($rowprodet["project_detail"]).'</td></tr></tbody>
	</table>
	</div>';
			}
		}
	}
	}
}
?>
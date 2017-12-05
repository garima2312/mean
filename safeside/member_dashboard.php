    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	      	<h2 class="page-header">Member Dashboard</h2>
			<div class="row">
			
	<div class="col-sm-12">
	<div class="panel panel-primary">
            <div class="panel-heading">
              <h4 class="dashboard-title">Latest Assign Orders </h4>
            </div>
            <div class="panel-body">
			<?php
$sql_tmid = "SELECT * FROM ph_assign_project Where tmid ='$adminid' ORDER BY aspj DESC LIMIT 5";
			$result_tmid = mysqli_query($conn, $sql_tmid);
				echo'<table class="table table-striped table-bordered table-hover dataTable no-footer "><thead><tr><th>Order ID</th><th>Client Name</th><th>Dropbox Folder</th><th>Start Date</th><th>ETA</th><th>Status</th></tr></thead><tbody>'; 

			if (mysqli_num_rows($result_tmid) > 0) {
				while($row_tmid = mysqli_fetch_assoc($result_tmid)) {
$project_id= $row_tmid["projects_id"];
$sql_uid = "SELECT * FROM ph_orders Where oid ='$project_id'";
			$result_uid = mysqli_query($conn, $sql_uid);
			if (mysqli_num_rows($result_uid) > 0) {
				while($row_sb = mysqli_fetch_assoc($result_uid)) {
				echo '<tr><td>';
				 $requestdate = explode( '-', $row_sb['request_date'] ); $tdate = explode( ' ', $requestdate[2] );
	     		  echo '<a href="order_detail.php?oid='.$row_sb["oid"].'">p2h5'.$requestdate[0].$requestdate[1].$tdate[0].$row_sb["oid"].'</a>'; 
					echo'</td><td>';
					$sqlusern ="SELECT name FROM ph_users WHERE uid ='".$row_sb["uid"]."'";
					$resultusern = $conn->query($sqlusern);
					if ($resultusern->num_rows > 0) {while($rowusern = $resultusern->fetch_assoc()) {echo $rowusern["name"];}}else {/*echo "0 results";*/}
					echo'</td><td>';
				    echo $row_sb["dpbx_fld_name"];
					echo'</td><td>';
				     echo $row_sb["order_start_date"];
					echo'</td>';
					$sql_quet ="SELECT * FROM ph_order_quote WHERE oid ='".$row_sb["oid"]."'order by qid desc limit 1";
					$result_quet = $conn->query($sql_quet);
					if ($result_quet->num_rows > 0) {
					while($rowquet = $result_quet->fetch_assoc()) {
					 $adddays= $rowquet["estimate_time"]+2;
					$eta = date('d-m-Y',strtotime($row_sb["order_start_date"]. "+$adddays days"));
					echo '<td>'.$eta.'</td>';
					echo '<td>';
					if($row_sb["order_complete_date"]==""){
					 $get_date = strtotime(date("d-m-Y"));
					 $ceta = strtotime($eta);
					if($get_date == $ceta){ echo "Last day";}
					if($get_date > $ceta){ echo "In Delay";}
					if($get_date < $ceta){ echo "In Progress";}
					}
					else{echo "Completed";}
					echo'</td>';
					}
					}
					else{ echo '<td></td><td></td>';}
					echo'</tr>';
					define("Paydate", $row_sb["payment_date"], true);
				}
				
				}
				}
				}
				else{echo '<tr><td colspan="6">No Order Assign yet</td></tr>';}
				echo "</tbody></table>";
				?>
            </div>
			<div class="panel-footer">Total Assigned Order : <?php $sql_uid = "SELECT * FROM ph_assign_project Where tmid ='$adminid'";
			$result_uid = mysqli_query($conn, $sql_uid);
			if (mysqli_num_rows($result_uid) > 0) {
			echo mysqli_num_rows($result_uid);
			}	?></div>
          </div>
	</div>
	<div class="col-sm-12">
	       <div class="panel panel-primary">
            <div class="panel-heading">
              <h4 class="dashboard-title">Latest Comments On Orders  </h4>
            </div>
            <div class="panel-body">
         <?php 
 $sqlcomtal ="SELECT DISTINCT oid ,MAX(comment_time) FROM ph_order_chat WHERE status =0 AND (postby ='user' OR postby ='team_member' ) GROUP BY oid ORDER BY MAX(comment_time) DESC,oid LIMIT 5";
				$resultcomtal = $conn->query($sqlcomtal);
				$page  = $_GET["page"];
				$count=1;
				echo'<table class="table table-striped table-bordered table-hover dataTable">
                            <thead><tr><th>SNo.</th><th>Comment on Order</th><th>Comment</th></tr></thead><tbody>'; 
					if ($resultcomtal->num_rows > 0) {
					
					while($rowcomtal = $resultcomtal->fetch_assoc()) {
					$sql_tmidn = "SELECT * FROM ph_assign_project WHERE tmid ='$adminid' AND projects_id='".$rowcomtal["oid"]."'";
			$result_tmidn = mysqli_query($conn, $sql_tmidn);
		if (mysqli_num_rows($result_tmidn) > 0) {
		$nocomments = 'no';
				while($row_tmidn = mysqli_fetch_assoc($result_tmidn)) {
				
				$project_id = $row_tmidn['projects_id'];
				$order_id = $rowcomtal["oid"];
				if($project_id == $order_id){
					$sql_uid = "SELECT * FROM ph_orders Where oid ='".$rowcomtal["oid"]."'";
			$result_uid = mysqli_query($conn, $sql_uid);
				echo '<tr><td>'.$count.'</td><td>';
				$sql_uid = "SELECT * FROM ph_orders Where oid ='".$rowcomtal["oid"]."'";
			$result_uid = mysqli_query($conn, $sql_uid);
			if (mysqli_num_rows($result_uid) > 0) {
				while($row_sb = mysqli_fetch_assoc($result_uid)) {
		  $requestdate = explode( '-', $row_sb['request_date'] ); $tdate = explode( ' ', $requestdate[2] );
	      echo '<a href="order_detail.php?oid='.$rowcomtal["oid"].'#reply">p2h5'.$requestdate[0].$requestdate[1].$tdate[0].$rowcomtal["oid"].'</a>'; 
				}
				}
				echo '</td><td>';
				//$sqlcomntal ="SELECT count(status) as newcomment from ph_order_chat WHERE status =0 AND oid=".$rowcomtal["oid"]." AND (postby ='user' OR postby ='team_member')";
				$sqlcomntal ="SELECT status from ph_order_chat WHERE status =0 AND oid=".$rowcomtal["oid"]." AND (postby ='user' OR postby ='team_member')";
				$resultcomntal = $conn->query($sqlcomntal);
				$rowcount=mysqli_num_rows($resultcomntal);
					if ($resultcomntal->num_rows > 0) {
					echo 'New Comments&nbsp;<span class="badge">'.$rowcount. '</span>';
					}
					else{echo "No New Comments";}
				echo '</td></tr>';
					$count++;
					}
					
					}
					}
					if($nocomments==''){echo '<tr><td colspan="3">No Latest Comments</td></tr>';}
					}
					}
					else{echo '<tr><td colspan="3">No Latest Comments</td></tr>';}
				echo "</tbody></table>";?>
            </div>
			<div class="panel-footer">Total Comments  : <?php $sql_uid = "SELECT ph_assign_project.projects_id, ph_assign_project.timestamp, ph_order_chat.oid, ph_order_chat.message, ph_order_chat.uid, ph_order_chat.adid, ph_order_chat.postby, ph_order_chat.comment_time FROM ph_assign_project, ph_order_chat WHERE ph_assign_project.tmid ='$adminid' AND ph_order_chat.oid = ph_assign_project.projects_id AND (ph_order_chat.postby = 'user' OR ph_order_chat.postby = 'administrator') AND  ph_order_chat.comment_time > ph_assign_project.timestamp";
			$result_uid = mysqli_query($conn, $sql_uid);
			if (mysqli_num_rows($result_uid) > 0) {
			echo mysqli_num_rows($result_uid);
		}	?></div>
          </div>
	</div>
	</div>
	   </div>
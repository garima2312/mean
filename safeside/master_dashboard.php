<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	      	<h2 class="page-header">Dashboard</h2>
			<div class="row">
			
	<div class="col-sm-6">
	<div class="panel panel-primary">
            <div class="panel-heading">
              <h4 class="dashboard-title">Unpaid Requests</h4>
            </div>
            <div class="panel-body" style="max-height:200px; overflow-y:scroll;">
             <?php
$sql_uid = "SELECT * FROM ph_orders Where order_status ='Quote Sent' ORDER BY oid DESC LIMIT 10";
			$result_uid = mysqli_query($conn, $sql_uid);
			if (mysqli_num_rows($result_uid) > 0) {
				echo'<div class="table-responsive"><table class="table table-striped table-bordered table-hover dataTable no-footer "><thead><tr><th>Order ID</th><th>User name</th><th>Dropbox Folder</th></tr></thead><tbody>'; 
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
					echo'</td></tr>';
				}
				echo "</tbody></table></div>";
				}
				else
				{
				echo'<div class="table-responsive"><table class="table table-striped table-bordered table-hover dataTable no-footer "><thead><tr><th>Order ID</th><th>User name</th><th>Dropbox Folder</th></tr></thead><tbody>'; 
				echo '<tr><td colspan="3">No Latest Request Yet</td></tr>';
				echo "</tbody></table></div>";
				}
				?>
            </div>
			<div class="panel-footer">Total Requests : <?php $sql_uid = "SELECT * FROM ph_orders Where order_status ='Quote Sent'";
			$result_uid = mysqli_query($conn, $sql_uid);
			if (mysqli_num_rows($result_uid) > 0) {
			echo mysqli_num_rows($result_uid);
			}	?></div>
          </div>
	</div>
	<div class="col-sm-6">
	       <div class="panel panel-primary">
            <div class="panel-heading">
              <h4 class="dashboard-title">Latest Comments On Orders</h4>
            </div>
            <div class="panel-body">
          <?php 	$sqlcomtal ="SELECT DISTINCT oid ,MAX(comment_time) FROM ph_order_chat WHERE status =0 AND (postby ='user' OR postby ='team_member' ) GROUP BY oid ORDER BY MAX(comment_time) DESC,oid LIMIT 5";
				$resultcomtal = $conn->query($sqlcomtal);
				$count=1;
				echo'<table class="table table-striped table-bordered table-hover dataTable">
                            <thead><tr><th>SNo.</th><th>Comment on Order</th><th>Comment</th></tr></thead><tbody>'; 
					if ($resultcomtal->num_rows > 0) {
					
					while($rowcomtal = $resultcomtal->fetch_assoc()) {
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
		   else {echo '<tr><td colspan="3">No Latest Comments</td></tr>';}
		   echo "</tbody></table>";
		   ?>
            </div>
			<div class="panel-footer">Total Comments  : <?php $sql_uid = "SELECT *  FROM ph_order_chat WHERE postby ='user' OR postby ='team_member'";
			$result_uid = mysqli_query($conn, $sql_uid);
			if (mysqli_num_rows($result_uid) > 0) {
			echo mysqli_num_rows($result_uid);
			}	?></div>
          </div>
	</div>
	</div>
	<div class="row">
	<div class="col-sm-6">
	       <div class="panel panel-primary">
            <div class="panel-heading">
              <h4 class="dashboard-title">Latest Request</h4>
            </div>
            <div class="panel-body">
             <?php
$sql_uid = "SELECT * FROM ph_orders Where order_status ='Waiting For Quote' ORDER BY oid DESC LIMIT 5";
			$result_uid = mysqli_query($conn, $sql_uid);
			if (mysqli_num_rows($result_uid) > 0) {
				echo'<div class="table-responsive"><table class="table table-striped table-bordered table-hover dataTable no-footer "><thead><tr><th>Order ID</th><th>User name</th><th>Dropbox Folder</th></tr></thead><tbody>'; 
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
					echo'</td></tr>';
				}
				echo "</tbody></table></div>";
				}
				else
				{
				echo'<div class="table-responsive"><table class="table table-striped table-bordered table-hover dataTable no-footer "><thead><tr><th>Order ID</th><th>User name</th><th>Dropbox Folder</th></tr></thead><tbody>'; 
				echo '<tr><td colspan="3">No Latest Request Yet</td></tr>';
				echo "</tbody></table></div>";
				}
				?>
            </div>
			<div class="panel-footer">Total Requests : <?php $sql_uid = "SELECT * FROM ph_orders Where order_status ='Waiting for Quote'";
			$result_uid = mysqli_query($conn, $sql_uid);
			if (mysqli_num_rows($result_uid) > 0) {
			echo mysqli_num_rows($result_uid);
			}	?></div>
          </div>
	</div>
	<div class="col-sm-6">
	<div class="panel panel-primary">
            <div class="panel-heading">
              <h4 class="dashboard-title">Latest Orders Running</h4>
            </div>
            <div class="panel-body">
              <?php
$sql_uid = "SELECT * FROM ph_orders Where order_status ='Order In Progress' AND payment_status='Received' LIMIT 5";
			$result_uid = mysqli_query($conn, $sql_uid);
			if (mysqli_num_rows($result_uid) > 0) {
				echo'<table class="table table-striped table-bordered table-hover dataTable no-footer "><thead><tr><th>Order ID</th><th>User name</th><th>Dropbox folder name</th></tr></thead><tbody>'; 
				while($row_sb = mysqli_fetch_assoc($result_uid)) {
				echo '<tr><td>';
				 $requestdate = explode( '-', $row_sb['request_date'] ); $tdate = explode( ' ', $requestdate[2] );
	     		  	echo '<a class="btn btn-xs btn-primary">p2h5'.$requestdate[0].$requestdate[1].$tdate[0].$row_sb["oid"].'</a>';
					echo'</td><td>';
					$sqlusern ="SELECT name FROM ph_users WHERE uid ='".$row_sb["uid"]."'";
					$resultusern = $conn->query($sqlusern);
					if ($resultusern->num_rows > 0) {while($rowusern = $resultusern->fetch_assoc()) {echo $rowusern["name"];}}else {/*echo "0 results";*/}
					echo'</td><td>';
				    echo $row_sb["dpbx_fld_name"];
					echo'</td></tr>';
				}
				echo "</tbody></table>";
				}
				else{
				echo'<table class="table table-striped table-bordered table-hover dataTable no-footer "><thead><tr><th>Order ID</th><th>User name</th><th>Dropbox folder name</th></tr></thead><tbody>'; 
				echo '<tr><td>NO</td><td>ORDER</td><td>RUNNING</td></tr>';
				echo "</tbody></table>";
				}
				?>
            </div>
			
          </div>
	</div>
	</div>
	    </div>

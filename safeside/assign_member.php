<?php
include(__DIR__ . '/../config.php'); 
$teammember =$_POST['teammember'];
$asorderid =$_POST['asorderid'];
$project_detail =$_POST['project_detail'];
$project_details=mysqli_real_escape_string($conn,$project_detail);

$sqlu = "INSERT INTO ph_assign_project (tmid,projects_id,project_detail) VALUES ('$teammember', '$asorderid','$project_details')";
	if ($conn->query($sqlu) === TRUE) {/*echo "New record src created successfully";*/}
	else {/*echo "Error: " . $sqlu . "<br>" . $conn->error;*/}

			$sql_tmln = "SELECT * FROM ph_adminstrator WHERE aid ='$teammember'";
			$result_tmln = mysqli_query($conn, $sql_tmln);
			if (mysqli_num_rows($result_tmln) > 0) {
				while($row_tmln = mysqli_fetch_assoc($result_tmln)) {
				$team_member = $row_tmln["adname"];
				$member_email = $row_tmln["ademail"];
				$sql_ord = "SELECT * FROM ph_orders WHERE oid ='$asorderid'";
			$result_ord = mysqli_query($conn, $sql_ord);
			if (mysqli_num_rows($result_ord) > 0) {
				while($row_ord = mysqli_fetch_assoc($result_ord)) {
				$uid = $row_ord["uid"];
				$oid = $row_ord["oid"];
				$project_name = 'PSD to '.$row_ord["select_options"];
				$sql_ema = "SELECT * FROM ph_users WHERE uid ='$uid'";
			$result_ema = mysqli_query($conn, $sql_ema);
			if (mysqli_num_rows($result_ema) > 0) {
				while($row_ema = mysqli_fetch_assoc($result_ema)) {
				$name = $row_ema["name"].' '.$row_ema["lname"];
				$uemail = $row_ema["email"];
				include('emails/assignmemberemail.php');
				}
				}
				}
				}
				
				
				}
				}
				

						
		$sql_tml = "SELECT * FROM ph_assign_project WHERE projects_id ='$asorderid'";
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
			echo '<script type="text/javascript">$(".assigncl").hide();</script>';
			?>
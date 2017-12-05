<?php  
session_start();
error_reporting(E_ALL^E_NOTICE);
$user_name=$_SESSION["adname"];
$adminid=$_SESSION["aid"];
		
if($adminid=="") {
	header("location:index.php");
} 
else { 
	include(__DIR__ . '/../config.php'); 
	
	include('header.php');
	include('navigation.php');
	include('sidebar.php');
   ?>		
	    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	      	<h2 class="page-header">All Ordres</h2>
		  	<div class="table-responsive">
	      <?php
		  $num_rec_per_page=30;
			if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
			$start_from = ($page-1) * $num_rec_per_page; 
$sql_tmid = "SELECT ph_assign_project.projects_id, ph_orders.oid, ph_orders.uid, ph_orders.dpbx_fld_name, ph_orders.order_start_date, ph_orders.order_complete_date, ph_orders.request_date FROM ph_assign_project, ph_orders WHERE ph_assign_project.tmid ='$adminid' AND ph_orders.oid =ph_assign_project.projects_id ORDER BY ph_assign_project.aspj DESC LIMIT $start_from, $num_rec_per_page";
			$result_tmid = mysqli_query($conn, $sql_tmid);
				echo'<table class="table table-striped table-bordered table-hover dataTable no-footer "><thead><tr><th>Order ID</th><th>Client Name</th><th>Dropbox Folder</th><th>Start Date</th><th>ETA</th><th>Status</th><th>Detail</th></tr></thead><tbody>'; 

			if (mysqli_num_rows($result_tmid) > 0) {
				while($row_tmid = mysqli_fetch_assoc($result_tmid)) {
				echo '<tr><td>';
				 $requestdate = explode( '-', $row_tmid['request_date'] ); $tdate = explode( ' ', $requestdate[2] );
	     		  echo '<a href="order_detail.php?oid='.$row_tmid["oid"].'">p2h5'.$requestdate[0].$requestdate[1].$tdate[0].$row_tmid["oid"].'</a>'; 
					echo'</td><td>';
					$sqlusern ="SELECT name FROM ph_users WHERE uid ='".$row_tmid["uid"]."'";
					$resultusern = $conn->query($sqlusern);
					if ($resultusern->num_rows > 0) {while($rowusern = $resultusern->fetch_assoc()) {echo $rowusern["name"];}}else {/*echo "0 results";*/}
					echo'</td><td>';
				    echo $row_tmid["dpbx_fld_name"];
					echo'</td><td>';
				     echo $row_tmid["order_start_date"];
					
					echo'</td>';
					$sql_quet ="SELECT * FROM ph_order_quote WHERE oid ='".$row_tmid["oid"]."'order by qid desc limit 1";
					$result_quet = $conn->query($sql_quet);
					if ($result_quet->num_rows > 0) {
					while($rowquet = $result_quet->fetch_assoc()) {
					 $adddays= $rowquet["estimate_time"]+2;
					$eta = date('d-m-Y',strtotime($row_tmid["order_start_date"]. "+$adddays days"));
					echo '<td>'.$eta.'</td>';
					echo '<td>';
					if($row_tmid["order_complete_date"]==""){
					$get_date = date("d-m-Y");
					if($get_date == $eta){ echo "Last day";}
					if($get_date > $eta){ echo "In Delay";}
					if($get_date < $eta){ echo "In Progress";}
					}
					else{echo "Completed";}
					echo'</td>';
					}
					}
					else{ echo '<td></td><td></td>';}
					echo '<td>';
					echo '<a href="order_detail.php?oid='.$row_tmid["oid"].'" class="btn btn-info btn-xs">Order Detail</a>';
					echo '</td></tr>';
				
				}
				}else{
				echo '<tr><td colspan="7">No Order Assign yet</td></tr>';
				}
				echo "</tbody></table>";
								  
			$sql_sm = "SELECT ph_assign_project.projects_id, ph_orders.oid, ph_orders.uid, ph_orders.dpbx_fld_name, ph_orders.order_start_date, ph_orders.order_complete_date, ph_orders.request_date FROM ph_assign_project, ph_orders WHERE ph_assign_project.tmid ='$adminid' AND ph_orders.oid =ph_assign_project.projects_id";
			
			$rs_result = $conn->query($sql_sm);
			$total_records = mysqli_num_rows($rs_result);  //count number of records
			$total_pages = ceil($total_records / $num_rec_per_page); 
			
			if ($total_pages > 1) {
				echo '<nav><ul class="pagination">';
				$active = strval($_GET['page']);
				echo " <li ";
				if($active== ""){
					echo"class='disabled'";
				}
				if($surb!=""){
					echo "><a href='assigned_orders_list.php'>".'<span aria-hidden="true">&laquo;</span><span class="sr-only">Previous</span>'."</a></li>"; // Goto 1st page  
				}else{
					echo "><a href='assigned_orders_list.php'>".'<span aria-hidden="true">&laquo;</span><span class="sr-only">Previous</span>'."</a></li>"; // Goto 1st page  
				}
				echo "<li "; if($active== ""){echo"class='active'";}
				echo "><a href='assigned_orders_list.php'>1</a></li>";
				
					for ($i=2; $i<=$total_pages; $i++) { 
								echo "<li ";
								if($i== $active){echo "class='active'";}
								echo "><a href='assigned_orders_list.php?page=".$i."'>".$i."</a></li>"; 
					}
				
				echo "<li ";
				if($active == $total_pages){echo "class='disabled'";}
				echo "> <a href='assigned_orders_list.php?page=$total_pages'>".'<span aria-hidden="true">&raquo;</span><span class="sr-only">Next</span>'."</a> "; // Goto last page
				echo " </ul></nav>"; 
			} ?>
	    	</div>
	    </div>
	</div><!--end row-->
</div><!--end container-fluid-->
<?php
	include('footer.php');
} 
?>

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
	      	<h2 class="page-header">All Usres</h2>
	      	 	<div class="table-responsive">
	      	<?php
			$num_rec_per_page=40;
			if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
			$start_from = ($page-1) * $num_rec_per_page; 
			$sql_uid = "SELECT *  FROM ph_users ORDER BY uid ASC LIMIT $start_from, $num_rec_per_page";
			$result_uid = mysqli_query($conn, $sql_uid);
			if (mysqli_num_rows($result_uid) > 0) {
				echo'<table class="table table-striped table-bordered table-hover dataTable"><thead><tr><th>ID</th><th>Name</th><th>Email</th><th>Last Login</th></tr></thead><tbody>'; 
				while($row_sb = mysqli_fetch_assoc($result_uid)) {
					echo '<tr><td>';
					echo '<a class="btn btn-xs btn-primary">'.$row_sb["uid"].'</a>';
					echo'</td><td>';
					echo $row_sb["name"];
					echo'</td><td>';
					echo $row_sb["email"];
					echo'</td>';
					$sql_lgid = "SELECT *  FROM ph_log_status WHERE uid='".$row_sb["uid"]."' ORDER BY lgid desc limit 1";
			$result_lgid = mysqli_query($conn, $sql_lgid);
			if (mysqli_num_rows($result_lgid) > 0) {
				while($row_lgid = mysqli_fetch_assoc($result_lgid)) {
				echo '<td>'.$row_lgid["timestamp"].'</td>';
				echo '<td>'.$row_lgid["client_ip"].'</td>';
				}
				}
				else{
				echo '<td></td>';
				echo '<td></td>';
				}
					
					echo '</tr>';
				}
				echo "</tbody></table>";
				
			}					  
			$sql_sm = "SELECT * FROM ph_users";
			
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
					echo "><a href='users.php'>".'<span aria-hidden="true">&laquo;</span><span class="sr-only">Previous</span>'."</a></li>"; // Goto 1st page  
				}else{
					echo "><a href='users.php'>".'<span aria-hidden="true">&laquo;</span><span class="sr-only">Previous</span>'."</a></li>"; // Goto 1st page  
				}
				echo "<li "; if($active== ""){echo"class='active'";}
				if($surb!=""){
					echo "><a href='users.php'>1</a></li>";
				}else{
					echo "><a href='users.php'>1</a></li>";
				}

			for ($i=2; $i<=$total_pages; $i++) { 
								echo "<li ";
								if($i== $active){echo "class='active'";}
								echo "><a href='users.php?page=".$i."'>".$i."</a></li>"; 
					}

				echo "<li ";
				if($active == $total_pages){echo "class='disabled'";}
				if($surb!=""){
					echo "> <a href='users.php?page=$total_pages'>".'<span aria-hidden="true">&raquo;</span><span class="sr-only">Next</span>'."</a> "; // Goto last page
				}else{
					echo "> <a href='users.php?page=$total_pages'>".'<span aria-hidden="true">&raquo;</span><span class="sr-only">Next</span>'."</a> "; // Goto last page
				}
				echo " </ul></nav>"; 
			} ?>
	    	</div>
	    </div>
	
<?php
	include('footer.php');
} 
?>

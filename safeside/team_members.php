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
	      	<h2 class="page-header">All Team Members</h2>
		  	<div class="table-responsive">
	      	<?php
			$num_rec_per_page=10;
			if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
			$start_from = ($page-1) * $num_rec_per_page; 
		$sql_uid = "SELECT * FROM ph_adminstrator WHERE adrole ='team_member' ORDER BY aid DESC LIMIT  $start_from, $num_rec_per_page";
			$result_uid = mysqli_query($conn, $sql_uid);
			if (mysqli_num_rows($result_uid) > 0) {
				echo'<table class="table table-striped table-bordered table-hover dataTable"><thead><tr><th>ID</th><th>Name</th><th>Email</th><th>Assigned Orders</th><th>Action</th></tr></thead><tbody>'; 
				while($row_sb = mysqli_fetch_assoc($result_uid)) {
					echo '<tr><td>';
					 echo $row_sb["aid"];
					echo'</td><td>';
				    echo $row_sb["adname"];
					echo'</td><td>';
					echo $row_sb["ademail"];
					echo'</td>';
					 $sqlasprj ="SELECT * FROM ph_assign_project WHERE tmid ='".$row_sb["aid"]."'";
		 			$resultasprj = $conn->query($sqlasprj);
					if ($resultasprj->num_rows > 0) {
					echo '<td>';
					while($rowasprj = $resultasprj->fetch_assoc()) {
 					 $orderid = $rowasprj["projects_id"];
					 
					$sql_tsd = "SELECT * FROM ph_orders WHERE oid='".$orderid."'";
			$result_tsd = mysqli_query($conn, $sql_tsd);
			if (mysqli_num_rows($result_tsd) > 0) {
			
				while($row_tsb = mysqli_fetch_assoc($result_tsd)) {
				echo 'PSD to  '.$row_tsb["select_options"].', ';
				}
				}
				}
				echo '</td><td><a class="btn btn-info btn-xs" href="edit_team_member.php?userid='.$row_sb["aid"].'"><i class="fa fa-edit"></i> Edit</a></td>';
				}else{echo '<td></td><td><a class="btn btn-info btn-xs" href="edit_team_member.php?userid='.$row_sb["aid"].'"><i class="fa fa-edit"></i> Edit</a>/<button id="'.$row_sb["aid"].'" class="delt btn btn-xs btn-danger" data-title="Are you sure to Delete?" data-toggle="confirmation" data-btn-ok-label="yes" data-btn-ok-icon="glyphicon glyphicon-share-alt" data-btn-ok-class="btn-success" data-btn-cancel-label="No" data-btn-cancel-icon="glyphicon glyphicon-ban-circle" data-btn-cancel-class="btn-danger" data-on-confirm="myConfirm"><i class="fa fa-trash"></i> Delete</button></td>';}
				

					echo '</tr>';
				}
				echo "</tbody></table>";
			}					  
			$sql_sm = "SELECT * FROM ph_team_member";
			
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
					echo "><a href='team_members.php'>".'<span aria-hidden="true">&laquo;</span><span class="sr-only">Previous</span>'."</a></li>"; // Goto 1st page  
				}else{
					echo "><a href='team_members.php'>".'<span aria-hidden="true">&laquo;</span><span class="sr-only">Previous</span>'."</a></li>"; // Goto 1st page  
				}
				echo "<li "; if($active== ""){echo"class='active'";}
				echo "><a href='team_members.php'>1</a></li>";
				
					for ($i=2; $i<=$total_pages; $i++) { 
								echo "<li ";
								if($i== $active){echo "class='active'";}
								echo "><a href='team_members.php?page=".$i."'>".$i."</a></li>"; 
					}
				
				echo "<li ";
				if($active == $total_pages){echo "class='disabled'";}
				echo "> <a href='team_members.php?page=$total_pages'>".'<span aria-hidden="true">&raquo;</span><span class="sr-only">Next</span>'."</a> "; // Goto last page
				echo " </ul></nav>"; 
			} ?>
	    	</div>
	    </div>
	</div><!--end row-->
</div><!--end container-fluid-->
<script>
  $('button.delt').confirmation();
  function myConfirm()
{
var aid=$(this).attr('id');
$.ajax({
  		url: "delete_member.php",
        type: 'POST',
        data:{aid: aid},
        async: true,
        success: function (data) {
		location.reload();
		
		},
    });
}
</script>
<?php
	include('footer.php');
} 
?>
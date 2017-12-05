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
	date_default_timezone_set('America/Los_Angeles');
	$get_date =date('Y-m-d');
   ?>		
	    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	      	<h2 class="page-header">All Coupons</h2>
			<div class="alert alert-success notselect hide" role="alert"><strong>Coupon </strong>delete Successfully.</div>
		  	<div class="table-responsive">
	      	<?php
			$num_rec_per_page=40;
			if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
			$start_from = ($page-1) * $num_rec_per_page; 
		$sql_uid = "SELECT * FROM ph_coupons ORDER BY coupon_id ASC LIMIT  $start_from, $num_rec_per_page";
		
			$result_uid = mysqli_query($conn, $sql_uid);
			if (mysqli_num_rows($result_uid) > 0) {
				echo'<table class="table table-striped table-bordered table-hover dataTable"><thead><tr><th>ID</th><th>Coupon Code</th><th>Discount</th><th>Start Date </th><th>End Date</th><th>Status</th><th>Used</th><th>Action</th></tr></thead><tbody>'; 
				while($row_sb = mysqli_fetch_assoc($result_uid)) {
					echo '<tr><td>';
					echo $row_sb["coupon_id"];
					echo'</td><td>';
					 echo $row_sb["coupon_code"];
					echo'</td><td>';
					 echo $row_sb["discount"]."%";
					echo'</td><td>';
				    echo $row_sb["start_date"];
					echo'</td><td>';
					echo $row_sb["end_date"];
					echo'</td><td>';
					if($row_sb["start_date"]<$get_date && $row_sb["end_date"]<$get_date){echo "Expired";}
					elseif($row_sb["start_date"]<=$get_date && $row_sb["end_date"]>=$get_date){echo "Running";}
					elseif($row_sb["start_date"]>$get_date && $row_sb["end_date"]>$get_date){echo "Open shortly";}
					echo'</td><td>';
					$sql_gcup = "SELECT * FROM ph_use_coupons WHERE coupon_code='".$row_sb["coupon_code"]."'";
			$result_gcup = mysqli_query($conn, $sql_gcup);
			if (mysqli_num_rows($result_gcup) > 0) {
			echo "Used";
			}
			else{
			echo "Not used";
			}
					echo'</td><td>';
					echo '<a href="'.$domain.'/safeside/edit_coupons.php?edit='.$row_sb['coupon_id'].'"><button class="btn btn-xs btn-info" type="button">Edit</button></a>&nbsp;/&nbsp;<button id="'.$row_sb['coupon_id'].'" class="delt btn btn-xs btn-danger" data-title="Are you sure to Delete Coupon?" data-toggle="confirmation" data-btn-ok-label="yes" data-btn-ok-icon="glyphicon glyphicon-share-alt" data-btn-ok-class="btn-success" data-btn-cancel-label="No" data-btn-cancel-icon="glyphicon glyphicon-ban-circle" data-btn-cancel-class="btn-danger" data-on-confirm="myConfirm">Delete</button>';
					echo '</td></tr>';
				}
				echo "</tbody></table>";
			}					  
			$sql_sm = "SELECT * FROM ph_coupons";
			
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
					echo "><a href='coupons.php'>".'<span aria-hidden="true">&laquo;</span><span class="sr-only">Previous</span>'."</a></li>"; // Goto 1st page  
				}else{
					echo "><a href='coupons.php'>".'<span aria-hidden="true">&laquo;</span><span class="sr-only">Previous</span>'."</a></li>"; // Goto 1st page  
				}
				echo "<li "; if($active== ""){echo"class='active'";}
				echo "><a href='coupons.php'>1</a></li>";
				
					for ($i=2; $i<=$total_pages; $i++) { 
								echo "<li ";
								if($i== $active){echo "class='active'";}
								echo "><a href='coupons.php?page=".$i."'>".$i."</a></li>"; 
					}
				
				echo "<li ";
				if($active == $total_pages){echo "class='disabled'";}
				echo "> <a href='coupons.php?page=$total_pages'>".'<span aria-hidden="true">&raquo;</span><span class="sr-only">Next</span>'."</a> "; // Goto last page
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
var coupon_id =$(this).attr("id");
$.ajax({
  		url: "delete_coupun.php",
        type: 'POST',
        data:{coupon_id: coupon_id},
        async: true,
        success: function (data) {
		//alert(data);
		$('.notselect').fadeIn().removeClass('hide').delay(3000).fadeOut();
		location.reload();
		},
    });
}
</script>
<?php
	include('footer.php');
} 
?>

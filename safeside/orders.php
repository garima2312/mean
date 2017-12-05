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
	 $listorder=$_GET['order'];
   ?>		
	    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	      	<h2 class="page-header">All Ordres </h2>
			<div class="row">
  <div class="col-lg-3 pull-right" style="margin-bottom:10px;">
         <select class="pull-right clearfix form-control" id="sort">
			<option value="" <?php if($listorder=='') {echo 'selected="selected" ';}?>>All Ordres</option>
			<option value="?order=progress" <?php if($listorder=='progress') {echo 'selected="selected" ';}?>>Order In Progress</option>
			<option value="?order=completed" <?php if($listorder=='completed') {echo 'selected="selected" ';}?>>Order Completed</option>
			<option value="?order=quote_waiting" <?php if($listorder=='quote_waiting') {echo 'selected="selected" ';}?>>Waiting For Quote</option>
			<option value="?order=quote_sent" <?php if($listorder=='quote_sent') {echo 'selected="selected" ';}?>>Quote Sent</option>
			</select>

</div>
</div>
		  	<div class="table-responsive">
	      	<?php
			$num_rec_per_page=40;
			if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
			$start_from = ($page-1) * $num_rec_per_page; 
			if($listorder=="progress"){
		$sql_uid = "SELECT * FROM ph_orders WHERE order_status='Order In Progress' ORDER BY oid DESC LIMIT  $start_from, $num_rec_per_page";
		}
			elseif($listorder=="completed"){
		$sql_uid = "SELECT * FROM ph_orders WHERE order_status='Order Completed' ORDER BY oid DESC LIMIT  $start_from, $num_rec_per_page";
		}
			elseif($listorder=="quote_waiting"){
		$sql_uid = "SELECT * FROM ph_orders WHERE order_status='Waiting For Quote' ORDER BY oid DESC LIMIT  $start_from, $num_rec_per_page";
		}
			elseif($listorder=="quote_sent"){
		$sql_uid = "SELECT * FROM ph_orders WHERE order_status='Quote Sent' ORDER BY oid DESC LIMIT  $start_from, $num_rec_per_page";
		}
			else{
		$sql_uid = "SELECT * FROM ph_orders ORDER BY oid DESC LIMIT  $start_from, $num_rec_per_page";
		}
		
			$result_uid = mysqli_query($conn, $sql_uid);
			if (mysqli_num_rows($result_uid) > 0) {
				echo'<table class="table table-striped table-bordered table-hover dataTable"><thead><tr><th>ID</th><th>User name</th><th class="sort">Dropbox Folder / Shared link</th><th>Order Status</th><th>Quote Price</th><th>Quote Date</th><th>ETA</th><th>Payment Status</th><th>Detail</th></tr></thead><tbody>'; 
				while($row_sb = mysqli_fetch_assoc($result_uid)) {
					echo '<tr><td>';
					$requestdate = explode( '-', $row_sb['request_date'] ); $tdate = explode( ' ', $requestdate[2] );
					echo '<a href="order_detail.php?oid='.$row_sb["oid"].'" class="btn btn-info btn-xs">p2h5'.$requestdate[0].$requestdate[1].$tdate[0].$row_sb["oid"].'</a>';
					echo'</td><td>';
					$sqlusern ="SELECT name FROM ph_users WHERE uid ='".$row_sb["uid"]."'";
					$resultusern = $conn->query($sqlusern);
					if ($resultusern->num_rows > 0) {while($rowusern = $resultusern->fetch_assoc()) {echo $rowusern["name"];}}else {/*echo "0 results";*/}
					echo'</td><td>';
				        echo $row_sb["dpbx_fld_name"];echo " ";
					echo $row_sb["shared_link"];
					echo'</td><td>';
					echo $row_sb["order_status"];
					echo'</td>';
					$sqlusern ="SELECT * FROM ph_order_quote WHERE oid ='".$row_sb["oid"]."'order by qid desc limit 1";
					$resultusern = $conn->query($sqlusern);
					if ($resultusern->num_rows > 0) {while($rowusern = $resultusern->fetch_assoc()) {
					echo '<td>$'.$rowusern["quote_amount"].'.00</td>';
					$newdate =explode("-",$rowusern["quote_date"]);
					$newdate2=explode(" ",$newdate[2]);
					echo '<td>'.$newdate[0].'-'.$newdate[1].'-'.$newdate2[0].'</td>';
					}}else {
					/*echo "0 results";*/
					echo '<td></td>';
					echo '<td></td>';
					}

$sqleta ="SELECT * FROM ph_order_quote WHERE oid ='".$row_sb["oid"]."'order by qid desc limit 1";
					$resulteta = $conn->query($sqleta);
					if ($resulteta->num_rows > 0) {
					while($roweta = $resulteta->fetch_assoc()) {
							$adddays= $roweta["estimate_time"]+2;
							echo '<td>'.date('d-m-Y',strtotime($row_sb["order_start_date"]. "+$adddays days")).'</td>';
						}
						}else{echo "<td></td>";}
					echo'<td>';
					echo $row_sb["payment_status"];
					echo'</td><td>';
					echo '<a href="order_detail.php?oid='.$row_sb["oid"].'" class="btn btn-info btn-xs">Order Detail</a>';
					echo'</td>'; 
					echo '</tr>';
				}
				echo "</tbody></table>";
			}		
			
						if($listorder=="progress"){
		$sql_sm = "SELECT * FROM ph_orders WHERE order_status='Order In Progress'";
		}
			elseif($listorder=="completed"){
		$sql_sm = "SELECT * FROM ph_orders WHERE order_status='Order Completed'";
		}
			elseif($listorder=="quote_waiting"){
		$sql_sm = "SELECT * FROM ph_orders WHERE order_status='Waiting For Quote'";
		}
			elseif($listorder=="quote_sent"){
		$sql_sm = "SELECT * FROM ph_orders WHERE order_status='Quote Sent'";
		}
			else{
		$sql_sm = "SELECT * FROM ph_orders";
		}			  
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
					echo "><a href='orders.php'>".'<span aria-hidden="true">&laquo;</span><span class="sr-only">Previous</span>'."</a></li>"; // Goto 1st page  
				}else{
					echo "><a href='orders.php'>".'<span aria-hidden="true">&laquo;</span><span class="sr-only">Previous</span>'."</a></li>"; // Goto 1st page  
				}
				echo "<li "; if($active== ""){echo"class='active'";}
				echo "><a href='orders.php'>1</a></li>";
				
					for ($i=2; $i<=$total_pages; $i++) { 
								echo "<li ";
								if($i== $active){echo "class='active'";}
								echo "><a href='orders.php?page=".$i."'>".$i."</a></li>"; 
					}
				
				echo "<li ";
				if($active == $total_pages){echo "class='disabled'";}
				echo "> <a href='orders.php?page=$total_pages'>".'<span aria-hidden="true">&raquo;</span><span class="sr-only">Next</span>'."</a> "; // Goto last page
				echo " </ul></nav>"; 
			} ?>
	    	</div>
	    </div>
	</div><!--end row-->
</div><!--end container-fluid-->
<script type="text/javascript">
(function($){
$(document).ready(function() {
   $('#sort').change(function(e){
    var locAppend = $(this).find('option:selected').val(),
        locSnip   = window.location.href.split('?')[0];
window.location.href = locSnip + locAppend;
    //alert("Redirecting to: " + locSnip + locAppend);
});
});		
})(jQuery);
</script>
<?php
	include('footer.php');
} 
?>

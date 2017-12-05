<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	      	<h2 class="page-header">All Comments</h2>
	      	 	<div class="table-responsive">
 <?php 	$num_rec_per_page=20;
			if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
			$start_from = ($page-1) * $num_rec_per_page; 
 $sqlcomtal ="SELECT DISTINCT oid ,MAX(comment_time) FROM ph_order_chat WHERE (postby ='user' OR postby ='team_member' ) GROUP BY oid ORDER BY MAX(comment_time) DESC,oid LIMIT $start_from, $num_rec_per_page";
				$resultcomtal = $conn->query($sqlcomtal);
				$page  = $_GET["page"];
				if($page >1){$count=10*($page-1)+1;}else{
				$count=1;}
					if ($resultcomtal->num_rows > 0) {
					echo'<table class="table table-striped table-bordered table-hover dataTable">
                            <thead><tr><th>SNo.</th><th>Comment on Order</th><th>Comment</th></tr></thead><tbody>'; 
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
		   else {/*echo "0 results";*/}
		   echo "</tbody></table>";
		   
		   $sql_sm = "SELECT DISTINCT oid FROM ph_order_chat WHERE status =0 AND (postby ='user' OR postby ='team_member')";
			
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
					echo "><a href='comments.php'>".'<span aria-hidden="true">&laquo;</span><span class="sr-only">Previous</span>'."</a></li>"; // Goto 1st page  
				}else{
					echo "><a href='comments.php'>".'<span aria-hidden="true">&laquo;</span><span class="sr-only">Previous</span>'."</a></li>"; // Goto 1st page  
				}
				echo "<li "; if($active== ""){echo"class='active'";}
				if($surb!=""){
					echo "><a href='comments.php'>1</a></li>";
				}else{
					echo "><a href='comments.php'>1</a></li>";
				}

			for ($i=2; $i<=$total_pages; $i++) { 
								echo "<li ";
								if($i== $active){echo "class='active'";}
								echo "><a href='comments.php?page=".$i."'>".$i."</a></li>"; 
					}

				echo "<li ";
				if($active == $total_pages){echo "class='disabled'";}
				if($surb!=""){
					echo "> <a href='comments.php?page=$total_pages'>".'<span aria-hidden="true">&raquo;</span><span class="sr-only">Next</span>'."</a> "; // Goto last page
				}else{
					echo "> <a href='comments.php?page=$total_pages'>".'<span aria-hidden="true">&raquo;</span><span class="sr-only">Next</span>'."</a> "; // Goto last page
				}
				echo " </ul></nav>"; 
			} ?>
		   
		   </div>
	    </div>
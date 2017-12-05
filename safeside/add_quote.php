<?php
include(__DIR__ . '/../config.php'); 
$nquote =$_POST['nquote'];
$nqtime =$_POST['nqtime'];
$orderid =$_POST['orderid'];
$enqtime =$nqtime+1;

$sqlu = "INSERT INTO ph_order_quote (quote_amount,oid,estimate_time) VALUES ('$nquote', '$orderid','$nqtime')";
	if ($conn->query($sqlu) === TRUE) {/*echo "New record src created successfully";*/}
	else {/*echo "Error: " . $sqlu . "<br>" . $conn->error;*/}
$sql = "UPDATE ph_orders SET order_status ='Quote Sent', payment_status='Unpaid' WHERE oid='$orderid'";
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
include('emails/addquoteemail.php');
							}
							}
							}
							}
							
	$sqlusern ="SELECT * FROM ph_order_quote WHERE oid ='".$orderid."'order by qid ASC";
		echo'<table class="table table-striped table-bordered table-hover dataTable no-footer "><thead><tr><th>Amount</th><th>Date</th></tr></thead><tbody>'; 
					$resultusern = $conn->query($sqlusern);
					if ($resultusern->num_rows > 0) {
					while($rowusern = $resultusern->fetch_assoc()) {
					echo '<tr><td>';
					echo '$'.$rowusern["quote_amount"].'.00';
					echo'</td><td>';
				    echo $rowusern["quote_date"];
					echo'</td></tr>';
					}
					}else {/*echo "0 results";*/}
		echo '</tbody></table>';
echo '<script>$(document).ready(function() {$(".trik").text("Quote Sent");$(".trik2").text("Unpaid"); });</script>';
			?>
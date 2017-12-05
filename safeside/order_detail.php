<?php session_start();
error_reporting(E_ALL^E_NOTICE);
$user_name=$_SESSION["adname"];
$adminid=$_SESSION["aid"];
if($adminid=="") {
include(__DIR__ . '/../config.php'); 
//header("location:index");
echo $redirect_to = $_SERVER['QUERY_STRING']; $location = $domain.'/safeside?redirect_to='.$domain.'/safeside/order_detail?'.$redirect_to; header("location:".$location);
} 
else { 
	include(__DIR__ . '/../config.php'); 
	
	include('header.php');
	include('navigation.php');
	include('sidebar.php');
	 $order_id=$_GET['oid'];
	 if($_SESSION["adrole"]=='team_member'){ include('member_order_detail.php');}else{ include('master_order_detail.php');}
	 
	include('footer.php');
} // $id null
?>


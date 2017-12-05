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
	if($_SESSION["adrole"]=='team_member'){ include('member_comments.php');}else{	include('master_comments.php');}

	include('footer.php');
} 
?>
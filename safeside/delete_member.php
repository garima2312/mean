<?php
include(__DIR__ . '/../config.php'); 
 $aid =$_POST['aid'];
 $sql = "DELETE FROM ph_adminstrator WHERE aid='$aid'";
if ($conn->query($sql) === TRUE) {echo "Record deleted successfully";}
 else {echo "Error deleting record: " . $conn->error;}	 	
		   ?>
           
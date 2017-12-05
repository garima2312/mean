<?php
require 'config.php';
$techId=$_GET['techID'];
$sql="SELECT *
FROM ph_service
WHERE technology_id = $techId";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
	    while($row_sb1 = mysqli_fetch_assoc($result)) {
echo '<label><input type="radio" value="'.$row_sb1['id'].'" name="service" ><span></span> '.strtoupper($row_sb1['name']).'</label>';
	    }
	}
?>

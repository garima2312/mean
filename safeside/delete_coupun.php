<?php
include(__DIR__ . '/../config.php'); 
$coupon_id = $_POST['coupon_id'];
$sql = "DELETE FROM ph_coupons WHERE coupon_id='".$coupon_id."'";

if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . $conn->error;
}
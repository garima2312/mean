<?php
include('config.php'); 
 $currpass =$_POST['currpass'];
 $newpass =$_POST['newpass'];
 $cutuser =$_POST['cutuser'];
function my_sign_encryption($currpass=null){
    $key = '!@#$%weosalt+_()*&1309^';
    $string = $currpass;
    $encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5(base64_encode($key)), $string, MCRYPT_MODE_nofb, md5(base64_encode(md5($key)))));
    return $encrypted;
}
  $check_pass = my_sign_encryption($currpass);

function my_new_encryption($newpass=null){
    $key = '!@#$%weosalt+_()*&1309^';
    $string = $newpass;
    $encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5(base64_encode($key)), $string, MCRYPT_MODE_nofb, md5(base64_encode(md5($key)))));
    return $encrypted;
}
$chang_pass = my_new_encryption($newpass);

$sqlusern ="SELECT * FROM ph_users WHERE uid ='".$cutuser."'";
			$resultusern = $conn->query($sqlusern);
					if ($resultusern->num_rows > 0) {
					while($rowusern = $resultusern->fetch_assoc()) {
					 $oidpass = $rowusern["password"];
					 $pchnpemail = $rowusern["email"];
					 $pchnpname = $rowusern["name"];
						if($check_pass==$oidpass){
					$sql = "UPDATE ph_users SET password ='$chang_pass' WHERE uid='$cutuser'";
					  if ($conn->query($sql) === TRUE) {/*echo "Record updated successfully";*/}
					  else {/*echo "Error updating record: " . $conn->error;*/}
					  include('emails/changepassemail.php');
					  echo "Password Updated Sucessfully";
					}
					else{
					echo "Current Password Don't Match";
					}
					}
					}

			?>
<?php  
session_start();
$user_name=$_SESSION["adname"];
$adminid=$_SESSION["aid"];
		
if($adminid=="") {
	header("location:index.php");
} 
else { 
	include(__DIR__ . '/../config.php'); 
	$userid = $_GET['user'];
	$sql_uid = "SELECT * FROM ph_adminstrator WHERE aid ='$userid'";
			$result_uid = mysqli_query($conn, $sql_uid);
			if (mysqli_num_rows($result_uid) > 0) {
			while($row_sb = mysqli_fetch_assoc($result_uid)) {
			$adname = $row_sb["adname"];
			$ademail = $row_sb["ademail"];
			$adpassword = $row_sb["adpass"];
			function my_decryption($adpassword=null){
$key = '!@#$%weosalt+_()*&1309^';
$string = $adpassword;
$decrypted = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5(base64_encode($key)), base64_decode($string), MCRYPT_MODE_nofb, md5(base64_encode(md5($key)))), "\0");
return $decrypted;
}
$user_password= my_decryption($adpassword);
			
			}
			}
 if (isset($_POST['submit'])) {
	 echo $name = $_POST["name"];
   echo $email = $_POST["user_name"];
   echo $user = $_POST["user"];
   echo $newpass = $_POST["pass_word"];
	function my_user_encryption($newpass=null){
		$key = '!@#$%weosalt+_()*&1309^';
		$string = $newpass;
		$encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5(base64_encode($key)), $string, MCRYPT_MODE_nofb, md5(base64_encode(md5($key)))));
		return $encrypted;
	}
	$passwordad= my_user_encryption($newpass);
	$sql = "UPDATE ph_adminstrator SET adname='$name',ademail='$email',adpass='$passwordad' WHERE aid='$user'";
  if ($conn->query($sql) === TRUE) {/*echo "Record updated successfully";*/include('emails/resetpassemail.php');$locatoin = 'profile.php?user='.$user.'&edit=true';}
  else {/*echo "Error updating record: " . $conn->error;*/$locatoin = 'profile.php?user='.$user.'&edit=false';}
header("location:".$locatoin);
}
include('header.php');
	include('navigation.php');
	include('sidebar.php');
?>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
      <h2 class="page-header">Edit Your Profile</h2>
	  
<div class="col-sm-6 ">
<?php 
	 if($_REQUEST['edit']=='true'){
      echo '<div class="alert alert-success"><strong>Profile Update! </strong> Successfully.</div>';
	}
elseif($_REQUEST['edit']=='false'){
      echo '<div class="alert alert-danger"><strong> Unable! </strong> to Update Profile.</div>';
	}
?>
     
	 <form id="editnuser" action="" method="post">
                            <fieldset>
                          	<div class="input-group form-group">
						  <span class="input-group-addon" id="basic-addon1"><span aria-hidden="true" class="glyphicon glyphicon-envelope"></span></span>
							<input type="email" name="user_name" class="form-control cemail" id="user_name" placeholder="Email address" value="<?php echo $ademail; ?>" required/>
						</div>
						<div class="input-group  form-group">
						  <span class="input-group-addon" id="basic-addon1"><span aria-hidden="true" class="glyphicon glyphicon-user"></span></span>
							  <input type="text" name="name" id="name" class="form-control" placeholder="Name" value="<?php echo $adname; ?>" required/> 
						</div>
						<div class="input-group  form-group">
						  <span class="input-group-addon" id="basic-addon1"><span aria-hidden="true" class="glyphicon glyphicon-lock"></span></span>
							 <input  id="pass_word" name="pass_word" type="password" class="form-control password-strength2"  placeholder="Password" value="<?php echo $user_password; ?>" required/>
						</div>
						<input type="hidden" name="user" value="<?php echo $userid; ?>" />
	                           <input id="submit" type="submit" name="submit" class="btn btn-primary" value="Update Profile"/>
                            </fieldset>
                        </form>
	 </div>
    </div>
  </div>
</div>
<script src="js/strength.js"></script>
	<script type="text/javascript">
	$(document).ready(function($) {
 $("#pass_word").strength({
    wrapper: true,
    showHideButtonText: 'Show',
    showHideButtonTextToggle: 'Hide'
  });
});
	</script>
<?php
	include('footer.php');
} 
?>

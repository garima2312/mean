<!DOCTYPE html>
<html lang="en">
<head>
 <link href="<?php echo $domain; ?>/v2/dist/css/main.css" rel="stylesheet">
</head>
<?php 
$title= "Rest Password | PSD2HTML5.CO";
$canonical = "https://www.psd2html5.co/reset_password/";

require 'config.php';include('header.php');
 if($logeduserid=="") {

if($_GET['action']=="reset") {
require 'config.php';
	    $encrypt = mysqli_real_escape_string($conn, $_GET['encrypt']);
	    $sqls_uid ="SELECT uid FROM ph_users WHERE md5(1290*3+uid)='$encrypt'";
		$result_uid = $conn->query($sqls_uid);
		if ($result_uid->num_rows > 0) {
			while($row_uid = $result_uid->fetch_assoc()) {
			  $user_id = $row_uid["uid"];
			}
		} 
 }	
if(isset($_POST['submit'])){

   $user_id  = $_POST['user_id'];
	 $password     = $_POST['password'];
	function my_rest_encryption($password=null){
    $key = '!@#$%weosalt+_()*&1309^';
    $string = $password;
    $encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5(base64_encode($key)), $string, MCRYPT_MODE_nofb, md5(base64_encode(md5($key)))));
    return $encrypted;
}
 $pass_word=  my_rest_encryption($password);
			$sqlusern ="SELECT * FROM ph_users where uid='$user_id'";
			$resultusern = $conn->query($sqlusern);
					if ($resultusern->num_rows > 0) {
					while($rowusern = $resultusern->fetch_assoc()) {
					 $oidpass = $rowusern["password"];
					 $prestpemail = $rowusern["email"];
					 $prestpname = $rowusern["name"];
					 if($oidpass != "" ){
		$query = "UPDATE ph_users SET password='".$pass_word."' WHERE uid='$user_id'";
		$conn->query($query);
		include('emails/resetpassemail.php');
		$locatoin = 'reset_password?error=pass';
	} else {
	$locatoin = 'reset_password?error=fail';
            }
					 }
					 }
	header("location:".$locatoin);
} 	?> 
   
  
<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top" class="login-mainpage">
<div class="inner-section order-sec">
	<div class="container">
    	<div class="login-page">
			 <form id="login_form" method="post" action="">
			 <?php 
	  if($_REQUEST['error'] =='pass'){
       echo '<div class="alert alert-success"><strong>Hi user! </strong>Your password changed sucessfully.</div>';
	}
	if($_REQUEST['error'] =='fail'){
      echo '<div class="alert alert-info"><strong>Oh user! </strong>Invalid key please try again.</div>';
	}
?> 
        	<div class="login-inner">
				<a href="<?php echo $domain; ?>"><img width="140" src="<?php echo $domain; ?>/img/logo-dark.svg"></a>
            	<h3>Reset Password</h3>
				<div class="bg-icon">
                	<input type="password" name="password" id="upass" class="login-inpt loc-bg password-strength2" placeholder="New Password" />
                 </div>   
				 <div class="bg-icon">
                 <input type="password" class="login-inpt loc-bg password-strength2" name="pass_word" id="ucpass" placeholder="Confirm Password" />
   
                 </div>   
           	<input type="hidden" value="<?php echo $user_id;?>" name="user_id" />
				<div class="clearfix rem-link">
	
                </div>
                <input id="logsmt" name="submit" type="submit" class="common-btn" value="Send">
				<div class="clearfix rem-link">
                	<div class="frgt pull-right">
                    	<a href="<?php echo $domain; ?>/login">Back to Login</a>
                    </div>
                </div>
            </div>
			     
			</form>
        </div>
    </div>
    
    
</div>

<?php }else{ header("location:myorders");}
//include('footer.php'); ?>
<footer>
	<div class="container text-center">
	    <p>© Copyrights 2017 | <a href="https://www.p2h5.com/beta" title="PSd to HTML5">PSD2HTML5.CO </a> | <a href="https://www.p2h5.com/beta/terms">Terms of use</a> | <a href="https://www.p2h5.com/beta/privacy-policy">Privacy Policy</a> | <a href="https://www.p2h5.com/beta/faq">FAQ</a> </p>
	</div>
</footer>

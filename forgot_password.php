<!DOCTYPE html>
<html lang="en">
<head>
 <link href="<?php echo $domain; ?>/v2/dist/css/main.css" rel="stylesheet">
</head>
<?php 
$title= "Forgot Password | PSD2HTML5.CO";
$canonical = "https://www.psd2html5.co/forgot_password/";
require 'config.php';
//include('header_inner.php');
 if($logeduserid=="") {


if (isset($_POST['submit'])) {
		$email=$_POST['uemail'];
		$forgotuseremail=$_POST['uemail'];
		define("FORGOTUSEREMAIL", $_POST['uemail'], true);
		$sql_f ="SELECT uid, name FROM ph_users WHERE email ='$email'";
$result_f = $conn->query($sql_f);
if ($result_f->num_rows > 0) {
    while($row_f = $result_f->fetch_assoc()) {
	 $user = $row_f['uid'];
	  $name = $row_f['name'];
          $uname=explode(' ',$name);
          $fname = $uname[0];
	$encrypt = md5(1290*3+$row_f['uid']);
include('emails/email-forpass.php');	
			
$locatoin = 'forgot_password?pass=account';

	    }
	} 
	else {
	$locatoin = 'forgot_password?error=account';
	}
header("location:".$locatoin);	
}	?>
  
<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top" class="login-mainpage">
<div class="inner-section order-sec">
	<div class="container">
    	<div class="login-page">
        	
			 <form id="login_form" method="post" action="">
			 <?php 
	  if($_REQUEST['error'] =='account'){
       echo '<div class="alert alert-success"><strong>Oh user! </strong> Account not found please signup now!!.</div>';
	}
	if($_REQUEST['pass'] =='account'){
      echo '<div class="alert alert-info"><strong>An email has been sent to you with a link to rest your password.</strong></div>';// on <strong class="forgotuseremail"></strong>

	}
?>  
        	<div class="login-inner">
        	<a href="<?php echo $domain; ?>"><h3><img width="140" src="<?php echo $domain; ?>/img/logo-dark.svg"></h3></a>
            	<h3>Please enter your email address.</h3>
				 <div class="bg-icon">
	      <input type="text" name="uemail" id="uemail" class="login-inpt ml-icon" placeholder="Email Address" value="<?php echo $_GET['email'];?>">
                    <i class="fa fa-envelope-o"></i>
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

<?php  } else{ header("location:myorders");}
//echo "<pre>";
//print_r($_SERVER);
//echo "</pre>"; ?>
<footer>
	<div class="container text-center">
	    <p>© Copyrights 2017 | <a href="https://www.p2h5.com/beta" title="PSd to HTML5">PSD2HTML5.CO </a> | <a href="https://www.p2h5.com/beta/terms">Terms of use</a> | <a href="https://www.p2h5.com/beta/privacy-policy">Privacy Policy</a> | <a href="https://www.p2h5.com/beta/faq">FAQ</a> </p>
	</div>
</footer>

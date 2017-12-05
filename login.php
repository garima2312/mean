<!DOCTYPE html>
<html lang="en">
<head>
 <link href="<?php echo $domain; ?>/v2/dist/css/main.css" rel="stylesheet">
</head>
<?php  
session_start();
if(isset($_SESSION['uid'])&&($_SESSION['uid']!="")){
 $logeduserid=$_SESSION['uid'];  }else{
 $logeduserid="";
}

ob_start();?>
<?php 
$title= "Login | PSD2HTML5.CO";
$canonical = "https://www.psd2html5.co/login/";
require 'config.php';
//include('header_inner.php');
 if($logeduserid=="") {
if (isset($_POST['submit'])) {
echo "<pre>";print_r($_POST);
$_POST['remember'];
if($_POST['remember']) { $year = time() + 31536000; 
setcookie('remember', $_POST['remember'], $year);
setcookie('username', $_POST['username'], $year);
setcookie('password', $_POST['pass_word'], $year);
}
elseif(!$_POST['remember']) {
if(isset($_COOKIE['remember'])) {
$past = time() - 100;
setcookie('remember', $_POST['remember'], $past);
setcookie('username', $_POST['username'], $past);
setcookie('password', $_POST['pass_word'], $past);
}
}
$pass_word = $_POST['pass_word'];
$email = strtolower($_POST['username']);
$redirect_to = $_POST['redirect_to'];

function get_client_ip() {
    $ipaddress = '';
    if ($_SERVER['HTTP_CLIENT_IP'])
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if($_SERVER['HTTP_X_FORWARDED_FOR'])
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if($_SERVER['HTTP_X_FORWARDED'])
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if($_SERVER['HTTP_FORWARDED_FOR'])
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if($_SERVER['HTTP_FORWARDED'])
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if($_SERVER['REMOTE_ADDR'])
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}
$cleint_ip= get_client_ip();

function my_sign_encryption($pass_word=null){
    $key = '!@#$%weosalt+_()*&1309^';
    $string = $pass_word;
    $encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5(base64_encode($key)), $string, MCRYPT_MODE_nofb, md5(base64_encode(md5($key)))));
    return $encrypted;
}
$check_pass = my_sign_encryption($pass_word);
$sqls ="SELECT * FROM ph_users WHERE email ='$email'";
$result = $conn->query($sqls);
	if ($result->num_rows > 0) {while($row = $result->fetch_assoc()) {
				$row["uid"];
				$row["name"];
				$row["email"];
				$row["password"];
	 if($row["email"] == $email && $row["password"] == $check_pass){ 
	 $year = time() + 31536000; 
	setcookie('user_id', $row["uid"], $year);
				session_start();
				$_SESSION["uid"]=$row["uid"];
				$_SESSION["name"]=$row["name"];
				$client_id=$row["uid"];
	$sql = "INSERT INTO ph_log_status (uid,client_ip) VALUES ('$client_id','$cleint_ip')";
	if ($conn->query($sql) === TRUE) {/*echo "New record usr created successfully";*/}
	else {echo "Error: " . $sql . "<br>" . $conn->error;}
				if(!empty($redirect_to)){$locatoin = $redirect_to;}else{$locatoin = 'myorders';}
		}
		elseif($row["email"]== $email && $row["password"]!= $check_pass){
		           $locatoin = 'login?error=pass&email='.$email;
				   
		}
	 }

}
else{$locatoin = 'login?error=log&email='.$email;}
header("location:".$locatoin);	
}		
?>
   
  
<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top" class="login-mainpage">
<div class="inner-section order-sec">
    	<div class="login-page">
        	
 <form id="login_form" method="post" action="">
<?php 
	  if($_REQUEST['error'] =='pass'){
       echo '<div class="alert alert-danger"><strong>Oh user! </strong> Please Enter valid password.</div>';
	$_GET['email']='';
	}
	if($_REQUEST['error'] =='log'){
      echo '<div class="alert alert-danger">Seems like you entered incorrect details, please check once again.</div>';
	$_GET['email']='';
	}
?>  
        	<div class="login-inner">
            	<h3><a href="<?php echo $domain;?>" title="PSD to Email Template"><img width="140" src="<?php echo $domain; ?>/img/logo-dark.svg" ></a></h3>
				  <div class="bg-icon">
                <input type="text" name="username" id="uemail" class="login-inpt ml-icon" placeholder="Email Address" value="<?php
						echo $_COOKIE['username']; ?><?php if(!empty($_GET['email'])){echo $_GET['email'];} ?>">
						<i class="fa fa-envelope-o"></i>
                </div>
				<div class="bg-icon">
                <input type="password" class="login-inpt loc-bg" name="pass_word" id="upass" placeholder="Password" value="<?php
						echo $_COOKIE['password']; ?>">
						<i class="fa fa-lock"></i>
						</div>
                <div class="clearfix rem-link">
                	<div class="left-li pull-left">
                    	<input  id="c1" type="checkbox" value="Remember Me" name="remember"
										<?php if(isset($_COOKIE['remember'])) {echo 'checked="checked"';}	else {echo '';	}?>>
			            <label for="c1"><span></span>Remember Me</label>
                    </div>
                    <div class="frgt pull-right">
                    	<a id="logforgt" href="<?php echo $domain;?>/forgot_password" title="Forgot Password">Forgot Password?</a>
                    </div>
                </div>
				<input type="hidden" name="redirect_to" value="<?php echo $_GET['redirect_to'];?>"/>
                <input id="logsmt" name="submit" type="submit" class="common-btn" value="Login">
            </div>
			</form>
        </div>
    
</div>

<?php }
else{ 
header("location:myorders");
}
//include('footer.php'); ?>
</body>
<footer>
	<div class="container text-center">
	    <p>© Copyrights 2017 | <a href="https://www.p2h5.com/beta" title="PSd to HTML5">PSD2HTML5.CO </a> | <a href="https://www.p2h5.com/beta/terms">Terms of use</a> | <a href="https://www.p2h5.com/beta/privacy-policy">Privacy Policy</a> | <a href="https://www.p2h5.com/beta/faq">FAQ</a> </p>
	</div>
</footer>
</html>

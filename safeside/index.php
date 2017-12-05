<?php
ob_start();
 include(__DIR__ . '/../config.php'); 

if (isset($_POST['login_sub'])) {
 $user_name=strtolower($_POST['user_email']);
 	$user_pass=$_POST['user_pass'];
	$redirect_to = $_POST['redirect_to'];
	$_POST['remember'];
if($_POST['remember']) { $year = time() + 31536000; 
setcookie('remember', $_POST['remember'], $year);
setcookie('username', $_POST['user_email'], $year);
setcookie('password', $_POST['user_pass'], $year);
}
elseif(!$_POST['remember']) {
if(isset($_COOKIE['remember'])) {
$past = time() - 100;
setcookie('remember', $_POST['remember'], $past);
setcookie('username', $_POST['user_email'], $past);
setcookie('password', $_POST['user_pass'], $past);
}
}
	function my_admin_encryption($user_pass=null){
    $key = '!@#$%weosalt+_()*&1309^';
    $string = $user_pass;
    $encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5(base64_encode($key)), $string, MCRYPT_MODE_nofb, md5(base64_encode(md5($key)))));
    return $encrypted;
}
 $pass_word=  my_admin_encryption($user_pass);

 $sqls_ud ="SELECT * FROM ph_adminstrator WHERE ademail='$user_name'";
$result = $conn->query($sqls_ud);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
	 if($row["ademail"]== $user_name && $row["adpass"]== $pass_word){ 
			        session_start();
					$_SESSION["aid"]=$row["aid"];
					$_SESSION["adname"]=$row["adname"];
					$_SESSION["adrole"]=$row["adrole"];
					if(!empty($redirect_to)){$locatoin = $redirect_to;}else{$locatoin = 'dashboard';}
			 }
		elseif($row["ademail"]== $user_name && $row["adpass"]!= $pass_word){
		           $locatoin = 'index?msg=pass';
				   
			}
			
    }
}
else{
$locatoin = 'index?msg=error';
}
header("location:".$locatoin);
}
include('header.php');
?>

<div class="col-md-4 col-md-offset-4 login-panel">
<?php 
	  if($_REQUEST['msg']=='error'){
      echo '<div class="alert alert-info">
        <strong>Oh user! </strong> Current login info does&prime;t exists.
      </div>';
}
elseif($_REQUEST['msg'] =='pass'){
       echo '<div class="alert alert-danger">
        <strong>Oh user! </strong> Please Enter valid password.
      </div>';
	}
?>
                <div class=" panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
                        <form method="post" action="" role="form">
                            <fieldset>
                          	<div class="input-group form-group">
						  <span class="input-group-addon" id="basic-addon1"><span aria-hidden="true" class="glyphicon glyphicon-envelope"></span></span>
							<input type="email"  class="form-control" name="user_email" placeholder="Email address" value="<?php
						echo $_COOKIE['username']; ?>" required>
						</div>
						<div class="input-group  form-group">
						  <span class="input-group-addon" id="basic-addon1"><span aria-hidden="true" class="glyphicon glyphicon-lock"></span></span>
							 <input type="password" class="form-control" name="user_pass" placeholder="Password" value="<?php
						echo $_COOKIE['password']; ?>" required>
						</div>
                               <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="Remember Me" name="remember"
										<?php if(isset($_COOKIE['remember'])) {echo 'checked="checked"';}	else {echo '';	}?>>Remember Me
                                    </label>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
								<input type="hidden" name="redirect_to" value="<?php echo $_GET['redirect_to'];?>"/>
                                <input type="submit" value="Login" name="login_sub" class="btn btn-lg btn-primary btn-block">
                            </fieldset>
                        </form>
                    </div>
					<div class="panel-footer"><a href="<?php echo $domain; ?>">&laquo; Back to Home</a></div>
                </div>
            </div>
  
<?php include('footer.php');?>
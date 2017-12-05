<?php

$olduser = "";
session_start();
//  /*	$logeduserid=$_SESSION["uid"]; 		ob_start();   */
require 'DropboxClient.php';
//require_once("DropboxClient.php");
require 'config.php';

//  //All data saving and responce in bootstrap model
// 	//POST DATA

	$link=$_POST['shared_link'];
	$responsive=$_POST['responsive'];
	$name=$_POST['name'];
	$email=$_POST['email'];
	$_SESSION['email']=$email;
	$message=$_POST['message'];
	$technology=$_POST['technology'];
	$service=$_POST['service'];
	$lname='';
	$srname=explode(" ",$name);
	if (count($srname)>1)
	{
	 $name=$srname['0'];
	 $lname=$srname['1'];
	}

	//1 client Ip
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

	$sqls ="SELECT * FROM ph_users WHERE email ='$email'";
	$result = $conn->query($sqls);
		if ($result->num_rows > 0) {while($row = $result->fetch_assoc()) {
		$user_id = $row["uid"];
		$olduser ='olduser' ;
		}}
		else {

						//2 encrypted random password
						function randomPassword() {
						    $alphabet = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
						    $pass = array(); //remember to declare $pass as an array
						    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
						    for ($i = 0; $i < 12; $i++) {$n = rand(0, $alphaLength);$pass[] = $alphabet[$n];}
						    return implode($pass); //turn the array into a string
						}
						$randpassword = randomPassword();
						$newpass= $randpassword;
						function my_encryption($newpass=null){
						    $key = '!@#$%weosalt+_()*&1309^';
						    $string = $newpass;
						    $encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5(base64_encode($key)), $string, MCRYPT_MODE_nofb, md5(base64_encode(md5($key)))));
						    return $encrypted;
						}
						 $randpassworddb= my_encryption($newpass);
						//print_r($_POST);
						/** insert data in db ***/
					 $sql = "INSERT INTO ph_users (name,lname,email,password,client_ip) VALUES ('$name', '$lname', '$email', '$randpassworddb','$cleint_ip')";

					if ($conn->query($sql) === TRUE) {/*echo "New user created successfully";*/}
						else {echo "Error: " . $sql . "<br>" . $conn->error;}
}
						$sqlchk ="SELECT * FROM ph_users WHERE email ='$email'";
						$resultchk = $conn->query($sqlchk);
						if ($resultchk->num_rows > 0) { while($row = $resultchk->fetch_assoc()) {$user_id = $row["uid"];
						$year = time() + 31536000;
						setcookie('user_id', $row["uid"], $year);
						session_start();
						$_SESSION["uid"]=$row["uid"];
						}}
	
$message=mysqli_real_escape_string($conn,$message);
$sqlu = "INSERT INTO ph_orders (uid,order_status,shared_link,responsiveness,select_options,select_service,payment_status,other_guidelines) VALUES ('$user_id', 'Waiting For Quote','$link','$responsive','$technology','$service','Not Apply','$message')";
	if ($conn->query($sqlu) === TRUE) { /*echo "New record src created successfully";*/ }
	else { /*echo "Error: " . $sqlu . "<br>" . $connn->error;**/ }

//   //Dropbox upload
	//$eorderid = "p2h5".$order_id;
  $sqloid ="SELECT MAX(oid),request_date FROM ph_orders WHERE uid='$user_id'";
  //$sqls ="SELECT oid FROM ph_orders WHERE uid=$user_id order by oid desc limit 1";
  $resultoid = $conn->query($sqloid);
  	if ($resultoid->num_rows > 0) {
			while($rowoid = $resultoid->fetch_assoc()) {
				$order_id = $rowoid["MAX(oid)"];
				$requestdate = explode( '-', $rowoid['request_date'] );
				$tdate = explode( ' ', $requestdate[2] );
  	    $eorderid = "p2h5".$requestdate[0].$requestdate[1].$tdate[0].$order_id;
  }}
  	else {/*echo "0 results";*/}

  	$dropboxup = array_filter($_FILES['uploads']['name']);
  	if (!empty($dropboxup)) {
      $desg = "p2h5".date("My")."_".$order_id."";
      $sql = "UPDATE ph_orders SET dpbx_fld_name='$desg' WHERE oid='$order_id'";
		if ($conn->query($sql) === TRUE) { /*echo "Record updated successfully";*/ }
      else {/*echo "Error updating record: " . $connn->error;*/}
      }

   //include('emails/registration_orderemail.php');
	 /**  Email template **/
   if($olduser!=""){
	 include('emails/orderemail.php');
   }else{ include('emails/registration_orderemail.php');

 }
  //************************************************************

	// you have to create an app at https://www.dropbox.com/developers/apps and enter details below:
  $dropbox = new DropboxClient(array(
    'app_key' => $drop_app_key,
    'app_secret' => $drop_app_secret,
    'app_full_access' => true,
  ),'en');
   #echo "<pre>";print_r($dropbox); die();
  handle_dropbox_auth($dropbox); // see below
  // // ================================================================================
  // // store_token, load_token, delete_token are SAMPLE functions! please replace with your own!
  function store_token($token, $name)
  {
  	file_put_contents("tokens/$name.token", serialize($token));
  }
  function load_token($name)
  {
  	if(!file_exists("tokens/$name.token")) return null;
  	return @unserialize(@file_get_contents("tokens/$name.token"));
  }

  function delete_token($name)
  {
  	@unlink("tokens/$name.token");
  }
  // // ================================================================================

	function handle_dropbox_auth($dropbox)
	{
		// first try to load existing access token
		$access_token = load_token("access");
		if(!empty($access_token)) {
			$dropbox->SetBearerToken($access_token);
		}
		elseif(!empty($_GET['auth_callback'])) // are we coming from dropbox's auth page?
		{
			 $return_url = "https://".$_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME']."?auth_callback=1";
			//die();
			$_GET['code'];
			// get & store access token, the request token is not needed anymore
			 $access_token = $dropbox->GetBearerToken($_GET['code'],$return_url);
			store_token($access_token, "access");
			delete_token($_GET['oauth_token']);
		}

		// checks if access token is required
		if(!$dropbox->IsAuthorized())
		{
			$return_url = "https://".$_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME']."?auth_callback=1";
			//$return_url = https://www.p2h5.com/v2/register.php?auth_callback=1
		  $auth_url = $dropbox->BuildAuthorizeUrl($return_url);
		//die();
		die("Authentication required. <a href='$auth_url'>Click here.</a>");
		}
	}

  if (!empty($dropboxup)) {
		  foreach ($_FILES['uploads']['name'] as $key => $value) {
		  $xddsubmits = explode(",", $_POST['xddsubmit']);
					  foreach($xddsubmits as $xddsubmit) {
					   $xddsubmit = trim($xddsubmit);
							  if($_FILES['uploads']['name'][$key]==$xddsubmit){
							  	$upload_name = $desg.'/'.$_FILES["uploads"]["name"][$key];
							  	$meta = $dropbox->UploadFile($_FILES["uploads"]["tmp_name"][$key], $upload_name);
							  }
					  }
		  }
  }  ?>

 <!-- Return htm on successfull registration -->
<div class="preloader-p2h" style="height:100px" >
      <div class="pre">
       <div class="pre-rel" >
             <div class="loader-btn"></div>
             </div>
             <span class="bar_precent"></span>
             <div class="loader-cont bfupload" style="display:none;">
               <h4>Uploading In Progress</h4>
              </div>
              <div class="loader-cont" style="display:block;">
               <h4>Your files has been Uploaded Successfully</h4>
               <p>The quote is usually provided within 1-3 business days depending on the project complexity. (For small-sized projects, we deliver the quote within a couple of working hours.)<br><br>To contact us with questions or concerns about your order,
             please use the contact form on Contact us page or please drop a reminder to your manager from your client area section.
             Thank you for your request.<br><br><br><br>
             Click here to go to your <a href="myorders" title="PSD to HTML Responsive">account</a>
              </p>
              </div>
     </div>
</div>

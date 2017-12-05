<?php  
session_start();
$user_name=$_SESSION["adname"];
$adminid=$_SESSION["aid"];
		
if($adminid=="") {
	header("location:index.php");
} 
else { 
	include(__DIR__ . '/../config.php'); 
	
 if (isset($_POST['submit'])) {
	  echo $name = $_POST["name"];
  echo $email = $_POST["user_name"];
  echo  $newpass = $_POST["pass_word"];
	function my_user_encryption($newpass=null){
		$key = '!@#$%weosalt+_()*&1309^';
		$string = $newpass;
		$encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5(base64_encode($key)), $string, MCRYPT_MODE_nofb, md5(base64_encode(md5($key)))));
		return $encrypted;
	}
	$passwordad= my_user_encryption($newpass);
	$sql_uid = "SELECT * FROM ph_adminstrator WHERE ademail ='$email'";
			$result_uid = mysqli_query($conn, $sql_uid);
			if (mysqli_num_rows($result_uid) > 0) {  $locatoin = 'add_team_member.php?add=exist';}
			else{
   $sql_nu = "INSERT INTO ph_adminstrator (adname,ademail, adpass,adrole) VALUES ('$name', '$email', '$passwordad','team_member')";
        if ($conn->query($sql_nu) === TRUE) {
             // echo "New record usr created successfully";
			 $locatoin = 'add_team_member.php?add=true';
        } else {
             //echo "Error: " . $sql . "<br>" . $conn->error;
			  $locatoin = 'add_team_member.php?add=false';
        }
		}
header("location:".$locatoin);
}
include('header.php');
	include('navigation.php');
	include('sidebar.php');
?>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
      <h2 class="page-header">Add Team Member</h2>
	  
<div class="col-sm-6 ">
<?php 
	 if($_REQUEST['add']=='true'){
      echo '<div class="alert alert-success"><strong>Team Member Added! </strong> Successfully.</div>';
	}
elseif($_REQUEST['add']=='false'){
      echo '<div class="alert alert-danger"><strong> Unable! </strong> to Add Team Member.</div>';
	}
	elseif($_REQUEST['add']=='exist'){
      echo '<div class="alert alert-danger"><strong> Team Member! </strong> All ready exist.</div>';
	}
?>
     
	 <form id="addnuser" action="" method="post">
                            <fieldset>
                          	<div class="input-group form-group">
						  <span class="input-group-addon" id="basic-addon1"><span aria-hidden="true" class="glyphicon glyphicon-envelope"></span></span>
							<input type="email" name="user_name" class="form-control cemail" id="user_name" placeholder="Email address" required/>
						</div>
						<div class="input-group  form-group">
						  <span class="input-group-addon" id="basic-addon1"><span aria-hidden="true" class="glyphicon glyphicon-user"></span></span>
							  <input type="text" name="name" id="name" class="form-control" placeholder="Name" required/> 
						</div>
						<div class="input-group  form-group">
						  <span class="input-group-addon" id="basic-addon1"><span aria-hidden="true" class="glyphicon glyphicon-lock"></span></span>
							 <input type="password" name="pass_word" id="pass_word" class="form-control" placeholder="Password" required/> 
						</div>
	                           <input id="submit" type="submit" name="submit" class="btn btn-primary" value="Add new member"/>
                            </fieldset>
                        </form>
	 </div>
    </div>
<?php
	include('footer.php');
} 
?>

<?php 
include('config.php'); 
 $urfname =$_POST['urfname'];
  $urlname =$_POST['urlname'];
 $address=$_POST['uraddress'];
 $urcity=$_POST['urcity'];
 $urstate=$_POST['urstate'];
 $urzipcode=$_POST['urzipcode'];
 $phcontact=$_POST['urphone'];
 $country=$_POST['urcountry'];
 $cutuser=$_POST['eduser'];
 $uremail=$_POST['uremail'];
 $profile_pic_old=$_POST['profile_pic_old'];
 
if(!empty($_FILES["profile_pic"]["name"])){
#echo "<pre>";print_r($_FILES); #die();
$path= $absolutePath.'profile_pics/p2h5profile_pic_'.$cutuser;
$files = glob($absolutePath.'profile_pics/p2h5profile_pic_'.$cutuser.'/*'); // get all file names
foreach($files as $file){ // iterate files
  if(is_file($file))
    unlink($file); // delete file
}
if (!file_exists($path)) {mkdir($path, 0777, true);}
  $filename =$_FILES["profile_pic"]["name"];
if ($pos = strrpos($filename, '.')) { $name = substr($filename, 0, $pos); $ext = substr($filename, $pos);}
	else {$name = $filename;}
    $newpath = $path.'/'.$filename;
    $newname = $filename;
    $counter = 0;
    while (file_exists($newpath)) {$newname = $name .'_'. $counter . $ext;$newpath = $path.'/'.$newname;$counter++;}
	 if(move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $newpath)){
	 // $profilepic =$newname;
	 }
	 else{/*echo "nononono";*/}	
include("resize-class.php");
$imagepathnew= $absolutePath.'profile_pics/p2h5profile_pic_'.$cutuser.'/'.$newname;
$resizeObja = new resize($imagepathnew);
$resizeObja -> resizeImage(140, 140,'crop');
$resizeObja -> saveImage($absolutePath.'profile_pics/p2h5profile_pic_'.$cutuser.'/140_'.$newname, 100);
$profilepic ='140_'.$newname;
$uprofilepic=$profilepic;
}
else{$uprofilepic = $profile_pic_old;}

$sql = "UPDATE ph_users SET name ='$urfname',lname ='$urlname', address='$address', city='$urcity',state='$urstate',zipcode='$urzipcode',country='$country', contact_number='$phcontact', profile_pic='$uprofilepic',email='$uremail' WHERE uid='$cutuser'";
					  if ($conn->query($sql) === TRUE) {/*echo "Record updated successfully";*/}
					  else {/*echo "Error updating record: " . $conn->error;*/}
					  
$sql_uid = "SELECT *  FROM ph_users WHERE uid ='$cutuser'";
			$result_uid = mysqli_query($conn, $sql_uid);
			if (mysqli_num_rows($result_uid) > 0) {
				while($row_sb = mysqli_fetch_assoc($result_uid)) {
				echo '<h3>User  Profile</h3>
            <div class="pro-container clearfix">
            	<div class="pro-img pull-left">';
				$profile_pic =$row_sb["profile_pic"];
					if(empty($profile_pic)){
					$gravatar_link = 'https://www.gravatar.com/avatar/' . md5($row_sb['email']) .'?d=404&s=200';
											  $headers = @get_headers($gravatar_link);
												if (!preg_match("|200|", $headers[0])) {
													echo '<img  src="'.$domain.'/img/upload-pro.jpg">';
												} else {
													echo '<img  src="' . $gravatar_link . '" />';
												}
					}
					else{
					echo '<img src="'.$domain.'/profile_pics/p2h5profile_pic_'.$cutuser.'/'.$profile_pic.'">';
					}
					echo '<div class="edit-link"><a class="edit_pr" href="#" data-toggle="modal" data-target="#exampleModal1">Edit Profile</a></div>
                </div>
                <div class="pro-info pull-left clearfix">
                	<div class="fields pull-left">
                    	<h4>First Name</h4>
                        <p>';
						echo $row_sb["name"];
						echo '</p>
                    </div>
					<div class="fields pull-left">
                    	<h4>Last Name</h4>
                        <p>';
						echo $row_sb["lname"];
						echo '</p>
                    </div>
					<div class="fields pull-left">
                    	<h4>Email Address </h4>
                        <p>';
						echo $row_sb["email"];
						echo '</p>
                    </div>
					<div class="fields pull-left">
                    	<h4>Contact </h4>
                        <p>';
						echo $row_sb["contact_number"];
						echo '</p>
                    </div>
                    <div class="fields pull-left">
                    	<h4>Address</h4>
                        <p>';
						echo $row_sb["address"];
						echo '</p>
                    </div>
					<div class="fields pull-left">
                    	<h4>City</h4>
                        <p>';
						echo $row_sb["city"];
						echo '</p>
                    </div>
					<div class="fields pull-left">
                    	<h4>State</h4>
                        <p>';
						echo $row_sb["state"];
						echo '</p>
                    </div>
					<div class="fields pull-left">
                    	<h4>Zipcode</h4>
                        <p>';
						echo $row_sb["zipcode"];
						echo '</p>
                    </div>
					<div class="fields pull-left">
                    	<h4>Country</h4>
                        <p>';
						echo $row_sb["country"];
						
echo '</p>
		   </div>
                    <div class="ch-pass">
                    	<a href="#" data-toggle="modal" data-target="#exampleModal2"><i class="fa fa-lock"></i> Change Password</a>
                    </div>
                </div>
            </div>';
			echo'<script type="text/javascript">
 (function($){
 $(document).ready(function(){
 $("#tprofile_pic").attr("src","'.$domain.'/profile_pics/p2h5profile_pic_'.$cutuser.'/'.$profile_pic.'");
 });
 })(jQuery);
 </script>';

				}
			}		
			?>

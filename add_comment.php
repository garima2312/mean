 <?php
 
include('config.php'); 
 function makeClickableLinks($s) {
  return preg_replace('@(https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-]*(\?\S+)?[^\.\s])?)?)@', '<a href="$1" target="_blank">$1</a>', $s);
}
$errors = array_filter($_FILES['uploads']['name']);
if (!empty($errors)) {
//echo "<pre>";print_r($errors);
 // die();
foreach ($_FILES['uploads']['name'] as $key => $value) {
$xddsubmits = explode(",", $_POST['xddsubmit']);
foreach($xddsubmits as $xddsubmit) {
 $xddsubmit = trim($xddsubmit);
if($_FILES['uploads']['name'][$key]==$xddsubmit){
//$path= '/home/bsbobyc/public_html/comment_attachments/';
$path='/var/www/Live/p2h5.com/v2/comment_attachments/';
$filename =$_FILES['uploads']['name'][$key];
if ($pos = strrpos($filename, '.')) { $name = substr($filename, 0, $pos); $ext = substr($filename, $pos); }
	else {$name = $filename;}
    $newpath = $path.'/'.$filename;
    $newname = $filename;
    $counter = 0;
    while (file_exists($newpath)) {$newname = $name .'_'. $counter . $ext;$newpath = $path.'/'.$newname;$counter++;}
	 if(move_uploaded_file($_FILES["uploads"]["tmp_name"][$key], $newpath)){
	  $allattacment .= "$newname,";
	  $sendattach = '<a href="'.$domain.'/comment_attachments/'.$newname.'">'.$newname.'</a>';
	  $eattachment .="$sendattach<br/>";}
	 else{/*echo "nononono";*/}	
}
}
}

$allattacment = substr($allattacment, 0, strlen($allattacment) - 1);
$eattachments = substr($eattachment, 0, strlen($eattachment) - 1);
}else{$eattachments="No Attachement";}
 $message = $_POST['message'];
 $cmuserid = $_POST['cmuserid'];
 $orderid = $_POST['cmorderid'];
$messagess = mysqli_real_escape_string($conn,$message);
$sqlu = "INSERT INTO ph_order_chat (message,oid,postby,uid,attacment_path) VALUES ('$messagess', '$orderid','user','$cmuserid','$allattacment')";
	if ($conn->query($sqlu) === TRUE) { /*echo "New record src created successfully";*/ }
	else { /*echo "Error: " . $sqlu . "<br>" . $conn->error;*/ }
	
	 	$sqlcomtal ="SELECT * FROM ph_order_chat WHERE oid ='".$orderid."' AND uid ='".$cmuserid."' order by chid desc limit 1";
				$resultcomtal = $conn->query($sqlcomtal);
					if ($resultcomtal->num_rows > 0) {
					while($rowcomtal = $resultcomtal->fetch_assoc()) {	
            echo '<div class="order-detail clearfix">
            	<div class="comnt-img pull-left">';
						$sqlcomuim ="SELECT * FROM ph_users WHERE uid ='".$cmuserid."'";
						$resultcomuim = $conn->query($sqlcomuim);
							if ($resultcomuim->num_rows > 0) {
							while($rowcomuim = $resultcomuim->fetch_assoc()) {
							$profilepicim = $rowcomuim['profile_pic'];
							$_SESSION["usremail"] =$rowcomuim['email'];
											if(!empty($profilepicim)){
											echo '<img src="'.$domain.'/profile_pics/p2h5profile_pic_'.$cmuserid.'/'.$profilepicim.'">';
											echo '<h5>'.$rowcomuim['name'].'</h5>';
											}
											else{
											$gravatar_link = 'https://www.gravatar.com/avatar/' . md5($rowcomuim['email']) .'?d=404&s=200';
											  $headers = @get_headers($gravatar_link);
										if (!preg_match("|200|", $headers[0])) {
										echo '<img src="'.$domain.'/img/cmt-img.jpg">';
												} else {
										echo '<img src="' . $gravatar_link . '" />';
												}
											echo '<h5>'.$rowcomuim['name'].'</h5>';
										}
							}
							}
                echo '<p>'.$rowcomtal['comment_time'].'</p>
                </div>
                <div class="comment-rt pull-right bgc-change">
                	<div class="cmnt-inner">
                    	<div class="cmt-header clearfix">
                        	<p>'.nl2br(makeClickableLinks($rowcomtal['message'])).'</p>';
											

                        echo '</div>
                        
                    </div>';
					if(!empty($rowcomtal['attacment_path'])){
$attachments = explode( ',', $rowcomtal['attacment_path'] );
$attachs = explode(",", $rowcomtal['attacment_path']);
echo '<div class="attchments-file"><h4>Attachments:</h4><ul>';

foreach($attachs as $attach) {
$attach = trim($attach);
$info = new SplFileInfo('comment_attachments/'.$attach);	
$extension = $info->getExtension();
if($extension == 'jpg' || $extension == 'jpeg'){
echo '<li class="clearfix"><img src="'.$domain.'/img/jpg.png"><div class="at-name"><h5>'.$attach.'</h5><a href="'.$domain.'/comment_attachments/'.$attach.'">Download</a></div></li>';
}
elseif($extension == 'pdf'){
echo '<li class="clearfix"><img src="'.$domain.'/img/pdf.png"><div class="at-name"><h5>'.$attach.'</h5><a href="'.$domain.'/comment_attachments/'.$attach.'">Download</a></div></li>';
}
elseif($extension == 'png'){
echo '<li class="clearfix"><img src="'.$domain.'/img/png.png"><div class="at-name"><h5>'.$attach.'</h5><a href="'.$domain.'/comment_attachments/'.$attach.'">Download</a></div></li>';
}
elseif($extension == 'gif'){
echo '<li class="clearfix"><img src="'.$domain.'/img/gif.png"><div class="at-name"><h5>'.$attach.'</h5><a href="'.$domain.'/comment_attachments/'.$attach.'">Download</a></div></li>';
}
elseif($extension == 'zip'){
echo '<li class="clearfix"><img src="'.$domain.'/img/zip.png"><div class="at-name"><h5>'.$attach.'</h5><a href="'.$domain.'/comment_attachments/'.$attach.'">Download</a></div></li>';
}
else{
echo '<li class="clearfix"><div class="at-name"><h5>'.$attach.'</h5><a href="'.$domain.'/comment_attachments/'.$attach.'">Download</a></div></li>';
}
}
   echo'</ul></div>';

}	
             echo '  </div>
            </div>';	
			 $sqlpayo ="SELECT * FROM ph_orders WHERE oid ='".$orderid."'";
						$resultpayo = $conn->query($sqlpayo);
							if ($resultpayo->num_rows > 0) {
							while($rowpayo = $resultpayo->fetch_assoc()) {
	$requestdate = explode( '-', $rowpayo['request_date'] ); $tdate = explode( ' ', $requestdate[2] );
	$eorderid = "p2h5".$requestdate[0].$requestdate[1].$tdate[0].$orderid; 
				  
			 $sqlasstim ="SELECT * FROM ph_assign_project WHERE projects_id ='".$orderid."'";
			 $resultasstim = $conn->query($sqlasstim);
					if ($resultasstim->num_rows > 0) {
					while($rowasstim = $resultasstim->fetch_assoc()) {
					$assign_time = $rowasstim['timestamp'];
					$tmid = $rowasstim['tmid'];
					
					$sqlasstim ="SELECT * FROM ph_adminstrator WHERE aid ='".$tmid."'";
			 		$resultasstim = $conn->query($sqlasstim);
					if ($resultasstim->num_rows > 0) {
					while($rowasstim = $resultasstim->fetch_assoc()) {
					$ademail = $rowasstim['ademail'];

					}
					}
					
					}
					}
					else{ $ademail='message@psd2html5.co';  }
			
				  }
				  }
			$emessage =nl2br($rowcomtal['message']);
			$adminEmail=$administratorEmail;
			include('emails/usercommentemail.php');
					}
					}
		   ?>
           

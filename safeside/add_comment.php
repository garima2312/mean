<?php
include(__DIR__ . '/../config.php'); 
  function makeClickableLinks($s) {
  return preg_replace('@(https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-]*(\?\S+)?[^\.\s])?)?)@', '<a href="$1" target="_blank">$1</a>', $s);
}
$errors = array_filter($_FILES['uploads']['name']);
if (!empty($errors)) {
foreach ($_FILES['uploads']['name'] as $key => $value) {
$path= '/home/bsbobyc/public_html/comment_attachments/';
  $filename =$_FILES['uploads']['name'][$key];
if ($pos = strrpos($filename, '.')) { $name = substr($filename, 0, $pos); $ext = substr($filename, $pos);}
	else {$name = $filename;}
    $newpath = $path.'/'.$filename;
    $newname = $filename;
    $counter = 0;
    while (file_exists($newpath)) {$newname = $name .'_'. $counter . $ext;$newpath = $path.'/'.$newname;$counter++;}
	 if(move_uploaded_file($_FILES["uploads"]["tmp_name"][$key], $newpath)){
	  $allattacment .= "$newname,";
	  $sendattach = '<a href="'.$domain.'/comment_attachments/'.$newname.'">'.$newname.'</a>';
	  $eattachment .="$sendattach<br/>";}
	 else{echo "nononono";}	
}
$allattacment = substr($allattacment, 0, strlen($allattacment) - 1);
$eattachments = substr($eattachment, 0, strlen($eattachment) - 1);
}

  $message =$_POST['message'];
  $orderid =$_POST['cmorderid'];
   $commentby =$_POST['commentby'];
    $adminid =$_POST['adminid'];
$messagess=mysqli_real_escape_string($conn,$message);

$sqlu = "INSERT INTO ph_order_chat (message,oid,postby,adid,attacment_path) VALUES ('$messagess', '$orderid','$commentby','$adminid','$allattacment')";
	if ($conn->query($sqlu) === TRUE) {/*echo "New record src created successfully";*/}
	else {/*echo "Error: " . $sqlu . "<br>" . $conn->error;*/}
	
	 	$sqlcomtal ="SELECT * FROM ph_order_chat WHERE oid ='".$orderid."' AND uid =0 order by chid desc limit 1";
				$resultcomtal = $conn->query($sqlcomtal);
					if ($resultcomtal->num_rows > 0) {
					while($rowcomtal = $resultcomtal->fetch_assoc()) {	
            echo '<div class="order-detail clearfix">
            	<div class="comnt-img pull-left">';
						$sqlcomuim ="SELECT * FROM ph_adminstrator WHERE aid ='".$adminid."'";
						$resultcomuim = $conn->query($sqlcomuim);
							if ($resultcomuim->num_rows > 0) {
							while($rowcomuim = $resultcomuim->fetch_assoc()) {
											if($rowcomuim['adrole']=='team_member'){ 
											 $gravatar_link = 'https://www.gravatar.com/avatar/' . md5($rowcomuim['ademail']) .'?d=404&s=200';
											  $headers = @get_headers($gravatar_link);
												if (!preg_match("|200|", $headers[0])) {
													echo '<img src="../img/cmt-img3.jpg">';
												} else {
													echo '<img src="' . $gravatar_link . '" />';
												}
   												

											}else{
											$gravatar_link = 'https://www.gravatar.com/avatar/' . md5($rowcomuim['ademail']) .'?d=404&s=200';
											  $headers = @get_headers($gravatar_link);
												if (!preg_match("|200|", $headers[0])) {
													echo '<img src="../img/cmt-img.jpg">';
												} else {
													echo '<img src="' . $gravatar_link . '" />';
												}	
												}
											echo '<h5>'.$rowcomuim['adname'].'</h5>';
							}
							}
                    echo '<p>'.$rowcomuim['adname']." ".$rowcomtal['comment_time'].'</p>
                </div>';
				echo '<div class="comment-rt pull-right ';
				 if($commentby=='administrator'){echo 'bg-change';}elseif($commentby=='team_member'){echo 'bgt-change';}
				 echo '">
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
if($extension == 'jpg' || $extension == 'jpeg' || $extension == 'JPEG' || $extension == 'JPG'){
echo '<li class="clearfix"><img src="../img/jpg.png"><div class="at-name"><h5>'.$attach.'</h5><a href="'.$domain.'/comment_attachments/'.$attach.'">Download</a></div></li>';
}
elseif($extension == 'pdf' || $extension == 'PDF'){
echo '<li class="clearfix"><img src="../img/pdf.png"><div class="at-name"><h5>'.$attach.'</h5><a href="'.$domain.'/comment_attachments/'.$attach.'">Download</a></div></li>';
}
elseif($extension == 'png' || $extension == 'PNG'){
echo '<li class="clearfix"><img src="../img/png.png"><div class="at-name"><h5>'.$attach.'</h5><a href="'.$domain.'/comment_attachments/'.$attach.'">Download</a></div></li>';
}
elseif($extension == 'gif' || $extension == 'GIF'){
echo '<li class="clearfix"><img src="../img/gif.png"><div class="at-name"><h5>'.$attach.'</h5><a href="'.$domain.'/comment_attachments/'.$attach.'">Download</a></div></li>';
}
elseif($extension == 'zip' || $extension == 'ZIP'){
echo '<li class="clearfix"><img src="../img/zip.png"><div class="at-name"><h5>'.$attach.'</h5><a href="c'.$domain.'/omment_attachments/'.$attach.'">Download</a></div></li>';
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
				  $sqlpayu ="SELECT * FROM ph_users WHERE uid ='".$rowpayo['uid']."'";
						$resultpayu = $conn->query($sqlpayu);
							if ($resultpayu->num_rows > 0) {
							while($rowpayu = $resultpayu->fetch_assoc()) {
							$epayname= $rowpayu['name'].' '.$rowpayu['lname'];
							$epayemail = $rowpayu['email'];
			$emessage =nl2br($rowcomtal['message']);
			include('emails/admincommentemail.php');
							}
							}
				  }
				  }
			
			
				}
					}
		   ?>
           

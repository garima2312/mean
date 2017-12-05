<?php 
require (__DIR__ . '/sendgrid/vendor/autoload.php');
require (__DIR__ . '/sendgrid/lib/SendGrid.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require 'config.php';
//{localhost:993/imap/ssl/novalidate-cert/norsh}Inbox

$inbox=imap_open("{imap.gmail.com:993/imap/ssl/novalidate-cert/norsh}INBOX", 'message@psd2html5.co', 'message123#') or die('Cannot connect to Gmail: ' . imap_last_error());

//$inbox=imap_open("{localhost:993/imap/ssl/novalidate-cert/norsh}INBOX", 'message@psd2html5.co', 'message123#') or die('Cannot connect to Gmail: ' . imap_last_error());

/**************** FILERS ***********************/

$emails = imap_search($inbox,'UNSEEN');
#echo "<pre>";print_r($emails); die();
if($emails) {
	/* begin output var */
	$data='';
	/* put the newest emails on top */
	rsort($emails);
	/* for every email... */
	foreach($emails as $email_number) {

	/****** Check Attachment ********/
	$attachments = array();
	$dbattacments='';
	$emailattach='';
	$seperator='';
	$overview = imap_fetch_overview($inbox,$email_number,0);
        $structure = imap_fetchstructure($inbox, $email_number);
	$attach=[];

	/******************* If attachment ************************/
	#echo "<pre>";print_r($matches);  die();
if(isset($structure->parts) && count($structure->parts)) {
	$test=rand(1,1000);
	for($i = 0; $i < count($structure->parts); $i++) {
		#echo "<pre>";print_r($structure->parts); 
		/*$attachments[$i] = array(
			'is_attachment' => false,
			'filename' => '',
			'name' => '',
			'attachment' => ''
		);*/
	if(isset($structure->parts[$i]->parts)){
		if($structure->parts[$i]->parts[$i]->ifdparameters==1){
		#foreach($structure->parts[$i]->parts as $object){
				foreach($structure->parts[$i]->parts[$i]->parameters as $object)
				    {
					
						if(strtolower($object->attribute) == 'name')
						{
						    $attachments[$i]['is_attachment'] = true;
						    echo $attachments[$i]['name'] = $object->value;
						}
				   }	
		
		            foreach($structure->parts[$i]->parts[$i]->dparameters as $object)
		            {
		                if(strtolower($object->attribute) == 'filename')
		                {
		                    $attachments[$i]['is_attachment'] = true;
		                     $attachments[$i]['filename'] = $object->value;
		                }
		            }
		#echo "<pre>";print_r($attachments);
		if($structure->parts[$i]->parts[$i]->encoding == 3)
                    {  // for inline images
			$attachments[$i]['attachment'] = imap_fetchbody($inbox, $email_number, $i+1); //2.2
			/****** content images *****/
			$encodeArr=[];
			$chekbaseEncode = explode('Content-Id: ',$attachments[$i]['attachment']);
			#echo "encoded 3333";
			#echo "<pre>";print_r($chekbaseEncode);
			foreach($chekbaseEncode as $key=>$eachpart){
			 if($key>=1){
				$futherparts=explode(" ", $eachpart);
				foreach($futherparts as $key1=>$eachfpart){
					 if($key1==0){
					$abc=explode('>',$eachfpart);
					//$encoded=$abc('--',$abc[1]);
					$encodeArr[]=$abc['1'];
					$attachment_image = base64_decode($abc['1']);
					#$filename=$email_number.'_'.$test.$key.'_'.$attachments[$i]['filename'];
					$filename=$email_number.'_'.$key.'_'.$attachments[$i]['filename'];
					$attachments[$i]['filename']=preg_replace('/\s+/', '', $attachments[$i]['filename']);
					file_put_contents('/var/www/Live/p2h5.com/v2/comment_attachments/'.$filename, $attachment_image);
					 $dbattacments .= $filename.",";
					 $email_attach = '<a href="'.$domain.'/comment_attachments/'.$filename.'">'.$filename.'</a>';
					  $emailattach .="$email_attach<br/>";
					  }
					}
			 	    }
			} #echo "one is base64"; echo "<pre>";print_r($encodeArr);
                    }
				/*foreach($structure->parts[$i]->parts as $key=>$val){
				echo "______________________encoded";
				echo count($val);
				echo "<pre>";print_r($val); 
				$encode4 = imap_fetchbody($inbox, $email_number, $i+1);
				if($val->encoding == 4){
					echo "4 encoded ";
					echo "<pre>";print_r($encode4);
					$encoded_attach = quoted_printable_decode($encode4);
					echo "4 encoded ENDS";
				$felname=$email_number.'_'.$test.$key.'_'.$attachments[$i]['filename'];
				file_put_contents('/var/www/Live/p2h5.com/v2/comment_attachments/'.$felname, $encoded_attach);
				$dbattacments .= $felname.",";
				$email_attach = '<a href="'.$domain.'/comment_attachments/'.$felname.'">'.$felname.'</a>';
				$emailattach .="$email_attach<br/>";
				}}*/
				#}
		}   // for apple
		}  //mutiparts
		if($structure->parts[$i]->ifdparameters) {
			foreach($structure->parts[$i]->dparameters as $object) {
				if(strtolower($object->attribute) == 'filename') {
					$attachments[$i]['is_attachment'] = true;
					$attachments[$i]['filename'] = $object->value;
				}
			}
		}
		
		if($structure->parts[$i]->ifparameters) {
			foreach($structure->parts[$i]->parameters as $object) {
				if(strtolower($object->attribute) == 'name') {
					$attachments[$i]['is_attachment'] = true;
					$attachments[$i]['name'] = $object->value;
				}
				/*if(strtolower($object->attribute) == 'x-unix-mode') { //X-UNIX-MODE
					$attachments[$i]['is_attachment'] = true;
					$attachments[$i]['name'] = $object->value;
				}*/
				
			}
		}

		if($attachments[$i]['is_attachment']) {
			$attachments[$i]['attachment'] = imap_fetchbody($inbox, $email_number, $i+1);
			if($structure->parts[$i]->encoding == 3) { // 3 = BASE64
$attachments[$i]['attachment'] = base64_decode($attachments[$i]['attachment']);
$attachments[$i]['filename']=preg_replace('/\s+/', '', $attachments[$i]['filename']);
file_put_contents('/var/www/Live/p2h5.com/v2/comment_attachments/'.$email_number.'_'.$test.'_'.$attachments[$i]['filename'], $attachments[$i]['attachment']);

$dbattacments .= $email_number.'_'.$test.'_'.$attachments[$i]['filename'].",";
$email_attach = '<a href="'.$domain.'/comment_attachments/'.$email_number.'_'.$test.'_'.$attachments[$i]['filename'].'">'.$email_number.'_'.$test.'_'.$attachments[$i]['filename'].'</a>';
$emailattach .="$email_attach<br/>";
			}
 if($structure->parts[$i]->encoding == 4)
                    {
$attachments[$i]['attachment'] = quoted_printable_decode($attachments[$i]['attachment']);
file_put_contents('/var/www/Live/p2h5.com/v2/comment_attachments/'.$email_number.'_'.$test.'_'.$attachments[$i]['filename'], $attachments[$i]['attachment']);
$dbattacments .= $email_number.'_'.$test.'_'.$attachments[$i]['filename'].",";
$email_attach = '<a href="'.$domain.'/comment_attachments/'.$email_number.'_'.$test.'_'.$attachments[$i]['filename'].'">'.$email_number.'_'.$test.'_'.$attachments[$i]['filename'].'</a>';
$emailattach .="$email_attach<br/>";
                    }
		}
	}   
	 echo $dbattacments = substr($dbattacments, 0, strlen($dbattacments) - 1);
	#$atacments = substr($emailattach, 0, strlen($emailattach) - 1);
}  #die();
  //echo "<pre>";print_r($attach);   

		/********************* ##ATTACHMENT ***********************/
		$message = imap_fetchbody($inbox,$email_number,2);
		$replyMsg1 = strip_tags($message);

		$day=date('D');
		$divide="On ".$day;
		$latestreplyy=[];
		$latestreplyy = explode($divide,$replyMsg1);
		echo "3 Reply"; print_r($latestreplyy); 
		if (strpos($latestreplyy['0'], 'Apple-Mail') !== false) {
		  $message = imap_fetchbody($inbox,$email_number,2); // case of apple with attachmnent
			#echo "yes APLE"; die('yes apple id');
		}elseif($dbattacments!=''){
			$message = imap_fetchbody($inbox,$email_number,1); //case with attachment no aple mail 	
			#die('NO images');
		}

		
		$otherDetail='';
		//$restData = mysqli_real_escape_string($conn,$message);
		$restData = mysqli_real_escape_string($conn,$message);	//C
		$replyMsg=strip_tags($message);
		#echo "<pre>";print_r($replyMsg);  die('kkkkkkkkkkkkkkkkkkkkk');
		
	/******************** HeaderInformation ************************/
	$header =  imap_header($inbox, $email_number);
	#echo "<pre>";print_r($headers);
	/******Get Id ******/
		 $postBy='';
		 $usersId='';
		 $adminId='';
		 $test='';
		/***** Only from mail needed to check  (admin/user) user identification ******/
				      $fromUserMailId = $header->from['0']->mailbox."@".$header->from['0']->host; 
					echo "2 From email :";echo $fromUserMailId; echo "<br>";
				      $sqlcomuim ="SELECT * FROM ph_users WHERE email ='".$fromUserMailId."'"; 
				      $resultcomuim = $conn->query($sqlcomuim);
				      if ($resultcomuim->num_rows > 0) {
		    			   while($rowcomuim = $resultcomuim->fetch_assoc()) {
		    				        $usersId = $rowcomuim['uid'];
							$postBy = "user";
		    				}
				      }else{
				       $sqlcomuim ="SELECT * FROM ph_adminstrator WHERE ademail ='".$fromUserMailId."'"; 
				       $resultcomuim = $conn->query($sqlcomuim);
				       if ($resultcomuim->num_rows > 0) {
					         while($rowcomuim = $resultcomuim->fetch_assoc()) {
							      $postBy = $rowcomuim['adrole'];
							      $adminId = $rowcomuim['aid']; 
						      }
				     }
				}
	/******************** ###HeaderInformation ************************/

	/********************** Detail & Get Reply *************************************/
	echo "333 Reply"; print_r($replyMsg); #die('complete');
	$day=date('D');
	$divide="On ".$day;
	$latestreply=[];
	$latestreply = explode($divide,$replyMsg);
	#echo "ggg Reply"; print_r($latestreply); die('should nt expld');

	if(!isset($latestreply['1'])){
	    $day = date('d-M-Y');  // On 17-Oct-2017 //g_app
	    $divide="On ".$day; //$divide = "On 17-Oct-2017";
	    $latestreply = explode($divide,$replyMsg);
	    $rep=$latestreply["0"]; 
	}
	if(!isset($latestreply['1'])){
	   $day = date('m/d/Y');  
	    $divide="On ".$day; 
	    $latestreply = explode($divide,$replyMsg);
	   $rep=$latestreply["0"]; #die('should be  in condition');
	}
	
	#die('issue');
	/**** new **/


		if (strpos($latestreply['0'], 'charset=us-ascii') !== false) { //charsetus-ascii
			   $latestreply = explode('us-ascii',$latestreply['0']);
			#echo "<pre>";print_r($latestreply); 
			    $rep=$latestreply["1"];
			    $day = date('d-M-Y');  // On 17-Oct-2017 //g_app//IOS
			    $divide="On ".$day; //$divide = "On 17-Oct-2017";
			    $latestreply = explode($divide,$rep);
			    $rep=$latestreply["0"];
			}else{

					if (strpos($latestreply['0'], ': 7bit') !== false) {
						    $latestreply = explode(': 7bit',$latestreply['0']);
						    $rep=$latestreply["1"];
						}else{
						       if (strpos($latestreply['0'], ': quoted-printable') !== false) {
							    $latestreply = explode('quoted-printable',$latestreply['0']);
							    $rep=$latestreply["1"];
							}else{
							    if (strpos($latestreply['0'], 'UTF-8') !== false) {
							    $latestreply = explode('UTF-8',$latestreply['0']);
							    $rep=$latestreply["1"];
								}else{
								    $rep=$latestreply["0"];	
								}	
							}

						}
		}
	
	/*if (strpos($latestreply['0'], 'UTF-8') !== false) {
	    $day = date('d-M-Y');  // On 17-Oct-2017 //
	    $divide="On ".$day;  //$divide = "On 17-Oct-2017";
	    $latestreply = explode('UTF-8"',$latestreply['0']);
	    $rep=$latestreply["1"];
	}else{
	    $rep=$latestreply["0"];	
	}*/

	
	/*echo "first eliment shoul not";
	echo "<pre>"; print_r($latestreply);
	echo "before 4 COMPLETE REPLY".$rep;  die('REPLYYYY');*/
	/***** New amendments *******/
	
	$rep = str_replace('Sent from Yahoo Mail for iPhone','',$rep);
        $rep = str_replace('Sent from my iPhone','',$rep);
	$rep = str_replace('Sent from my iPad','',$rep);

	$rep = str_replace('----','',$rep);
	$rep = str_replace('=','',$rep); 
        $rep = str_replace('________________________________','',$rep);
	/*****## New amendments *******/

	$outlookstart=$email_title;
	$outlookend="From: ".$fromName;
	if (strpos($rep, $outlookstart) !== false) {
		    $rep = ' ' . $rep;
		    $ini = strpos($rep, $outlookstart);
		    if ($ini == 0) return '';
		    $ini += strlen($outlookstart);
		    $len = strpos($rep, $outlookend, $ini) - $ini;
		    $str= substr($rep, $ini, $len);
		    $rep=trim($str); 
	}
	
       if (strpos($rep, 'From:') !== false) {
		    $srr=explode('From:',$rep);
		    $strn=$srr['0'];
		    $rep=trim($strn); 
	}
	/*********FILTERS (if exists)******* **/
	if (strpos($rep, ': 7bit') !== false) {
		    $latestreply2 = explode(': 7bit',$rep);
		    $rep=$latestreply2["1"];
	}
	
       /*********##Amendments*********/
	echo "4 COMPLETE REPLY".$rep;  #die('REPLYYYY');
		
	/********** reply###### ***********/

	/********** Get Detail ***********/
				#function detail($restData=null){
					/**** Check if last message is html or not ****/
					$resthtml = explode('wrote:',$restData);
					// 2nd step after getting reply
					#echo "<pre>";print_r($resthtml); die();
					#$html=$latestreply1['1'];
					foreach($resthtml as $lastHtml){
						if ( $lastHtml != strip_tags($lastHtml) ){  //if html
							$html=$lastHtml;
						}
					}
					#echo "html----------";
					#print_r($html); die();
					//$html=$reply1;	
					/*************** Loading Html ******************************/
					$document = new \DOMDocument('1.0', 'UTF-8');
					// set error level
					$internalErrors = libxml_use_internal_errors(true);
					// load HTML
					$document->loadHTML($html);
					// Restore error level
					libxml_use_internal_errors($internalErrors);
					$details=[];
					/*************** Loading get details  ************************/
						
						foreach($document->getElementsByTagName('a') as $link) {
							# Show the <a href>
							$info=explode("dat~",stripslashes($link->getAttribute('data')));
							if(isset($info['1'])){
								$details[]=str_replace('"',"",$info['1']);
							}
						} 
						
					if(empty($details)){
						foreach ($document->getElementsByTagName('input') as $link) 
						{
							$info=explode("yhd~",stripslashes($link->getAttribute('value')));
							if(isset($info['1'])){
								$details[]=str_replace('"rn',"",$info['1']);
								#$details[]=str_replace('rn',"",$info['1']);
							}
						}
					}
	
					if(empty($details)){
						$i=0;
						foreach ($document->getElementsByTagName('table') as $link) 
							{
								
								#print_r(stripslashes($link->getAttribute('id')));
								$info=explode(".",stripslashes($link->getAttribute('id')));
								
								if(isset($info['2'])){
									$data=explode('dat~',$info['0']);
									$details['0']=$info['1'];
									$details['1']=$data['1'];
									$details['2']=str_replace('"',"",$info['2']);
										}
								
							$i++;
							} 
					     } 	     
	#echo $rep;
	#echo 'final';
	echo "<pre>";print_r($details); #die();
				 	     
	# echo "5 details<br>"; echo "<pre>";print_r($details); die();
/************* Reply saved in db with all essencial details ******************************************************************/
				//if(!empty($details)){
				   $orderId=str_replace('"','',$details['0']);
				   $eorderid=$details['2'];
				  #$orderId=290;  $eorderid='p2h520171023290';
			/***************** Get email to send mail again *****************/
					 #function getUserEmail($uid,$conn){
					      $sqlcomuimo ="SELECT * FROM ph_orders WHERE oid ='".$orderId."'"; 
					      $resultcomuimo = $conn->query($sqlcomuimo); 
					      if ($resultcomuimo->num_rows > 0) {
						 while($rowcomuimo = $resultcomuimo->fetch_assoc()) {
						      $inmail_userId = $rowcomuimo['uid'];
						 }
					      } 
					      echo "userID should work".$inmail_userId;
					      $sqlcomuim ="SELECT * FROM ph_users WHERE uid ='".$inmail_userId."'"; 
					      $resultcomuim = $conn->query($sqlcomuim); 
					      if ($resultcomuim->num_rows > 0) {
						 while($rowcomuim = $resultcomuim->fetch_assoc()) {
						      $adminEmail = $rowcomuim['email'];
						 }
					      } 
					//if($adminId==''){
					if($fromUserMailId!=$administratorEmail){
						  /* $sqlcomuim ="SELECT * FROM ph_adminstrator WHERE aid ='".$inmail_userId."'"; 
						  $resultcomuim = $conn->query($sqlcomuim);
						  if ($resultcomuim->num_rows > 0) {
						     while($rowcomuim = $resultcomuim->fetch_assoc()) {
						      $adminEmail = $rowcomuim['ademail'];
						     }
						  }*/
						$adminEmail=$administratorEmail; //to send mail to 
				          }
					#} 
			#echo 'adminEmail'.$adminEmail; 
			$adminEmail='weotesting1@gmail.com';
			/******************** ###Get email from Id **************************/
			$rep=str_replace('=C2=A0',"",$rep); $rep=str_replace('mC2A0',"",$rep);$rep=str_replace('C2A0',"",$rep);
			$rep=str_replace('"',"",$rep); $rep=str_replace("'","",$rep); 
			$rep =preg_replace('/--[\s\S]+?-8/', '', $rep);
			$rep=trim($rep); //echo $adminEmail;
			echo $sqlu = "INSERT INTO ph_order_chat (oid,message,uid,postby,attacment_path,adid) VALUES ('$orderId','$rep','$usersId','$postBy','$dbattacments','$adminId')"; 
						if ($conn->query($sqlu) === TRUE) {
						   /******** Send mail To user ********/
						   $cmuserid = $inmail_userId;
						   $emessage = $rep;  //nl2br($rep);
						   $orderid = $orderId;
                                                   $eorderid = $eorderid;
						   //$eattachments =$emailattach;
						   $eattachments = $emailattach;
						   $type=($adminId!='')?'Admin':'User';
						   $ecopyright='ecopyright';
						  include('emails/mailcomment.php');
						   /******************************/
						    echo "Done";
						 }
						else {  }
					#}
/************* finally Reply saved in db with all essencial details### ******************************************************************/

} #end loop

} //end email
/* close the connection */
imap_close($inbox);


?>

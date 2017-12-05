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
	/******************** If attachment ************************/
	#echo "<pre>";print_r($structure->parts);  die();
if(isset($structure->parts) && count($structure->parts)) {
	#echo "<pre>";print_r($structure->parts);
	for($i = 0; $i < count($structure->parts); $i++) {
		$attachments[$i] = array(
			'is_attachment' => false,
			'filename' => '',
			'name' => '',
			'attachment' => ''
		);
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
				if(strtolower($object->attribute) == 'x-unix-mode') { //X-UNIX-MODE
					$attachments[$i]['is_attachment'] = true;
					echo $attachments[$i]['name'] = $object->value;
				}
				
			}
		}
		
		/*
		if($structure->parts[$i]->parts[$i]->ifparameters)
                {
                    foreach($structure->parts[$i]->parts[$i]->parameters as $object)
                    {
                        if(strtolower($object->attribute) == 'name')
                        {
                            $attachments[$i]['is_attachment'] = true;
                             $attachments[$i]['name'] = $object->value;
                        }
                    }
                }*/
#echo "<pre>";print_r($attachments);  
		$test='img';
		if($attachments[$i]['is_attachment']) {
			$attachments[$i]['attachment'] = imap_fetchbody($inbox, $email_number, $i+1);
			if($structure->parts[$i]->encoding == 3) { // 3 = BASE64
$attachments[$i]['attachment'] = base64_decode($attachments[$i]['attachment']);
file_put_contents('/var/www/Live/p2h5.com/v2/comment_attachments/'.$email_number.'_'.$test.'_'.$attachments[$i]['filename'], $attachments[$i]['attachment']);

$dbattacments .= $email_number.'_'.$test.'_'.$attachments[$i]['filename'].",";
$email_attach = '<a href="'.$domain.'/comment_attachments/'.$email_number.'_'.$test.'_'.$attachments[$i]['filename'].'">'.$email_number.'_'.$test.'_'.$attachments[$i]['filename'].'</a>';
			$emailattach .="$email_attach<br/>";
			
			}
		}
	}
	echo $dbattacments = substr($dbattacments, 0, strlen($dbattacments) - 1);
	#$mailAttachments = substr($emailattach, 0, strlen($emailattach) - 1);
}
  //echo "<pre>";print_r($attach);   

		/********************* ##ATTACHMENT ***********************/
		if($dbattacments==''){
			$message = imap_fetchbody($inbox,$email_number,2); //CHANGED
		}else{
			$message = imap_fetchbody($inbox,$email_number,1);
		}
		$otherDetail='';
		//$restData = mysqli_real_escape_string($conn,$message);
		$restData = mysqli_real_escape_string($conn,$message);	//C
		$replyMsg=strip_tags($message);
	/******************** HeaderInformation ************************/
	$header =  imap_header($inbox, $email_number);
	/******Get Id ******/
		 $postBy='';
		 $usersId='';
		 $adminId='';
		 $test='';
		/***** Only from mail needed to check  (admin/user) user identification ******/
		$fromUserMailId = $header->from['0']->mailbox."@".$header->from['0']->host;
				      $sqlcomuim ="SELECT * FROM ph_users WHERE email ='".$fromUserMailId."'"; 
				      $resultcomuim = $conn->query($sqlcomuim);
				      if ($resultcomuim->num_rows > 0) {
		    			   while($rowcomuim = $resultcomuim->fetch_assoc()) {
		    				        $usersId = $rowcomuim['uid'];
							$test=$usersId;
							$postBy = "user";
		    				}
				      }else{
				       $sqlcomuim ="SELECT * FROM ph_adminstrator WHERE ademail ='".$fromUserMailId."'"; 
				       $resultcomuim = $conn->query($sqlcomuim);
				       if ($resultcomuim->num_rows > 0) {
					         while($rowcomuim = $resultcomuim->fetch_assoc()) {
							      $postBy = $rowcomuim['adrole'];
							      $adminId = $rowcomuim['aid']; 
							      $test = $adminId;
						      }
				     }
			}
	/******************** ###HeaderInformation ************************/

	/********************** Detail & Get Reply *************************************/
	$day=date('D');
	$divide="On ".$day;
	$latestreply=[];
	$latestreply = explode($divide,$replyMsg);
	print_r($latestreply); die();
	/**** new **/


if (strpos($latestreply['0'], 'charset=us-ascii') !== false) {
	   $latestreply = explode('us-ascii',$latestreply['0']);
	#echo "<pre>";print_r($latestreply); 
	    $rep=$latestreply["1"];
	    $day = date('d-M-Y');  // On 17-Oct-2017 //g_app//IOS
	    $divide="On ".$day; //$divide = "On 17-Oct-2017";
	    $latestreply = explode($divide,$rep);
	    $rep=$latestreply["0"];
	}else{

			if (strpos($latestreply['0'], ': 7bit') !== false) {
				    $day = date('d-M-Y');  // On 17-Oct-2017 //
				    $divide="On ".$day;  //$divide = "On 17-Oct-2017";
				    $latestreply = explode(': 7bit',$latestreply['0']);
				    $rep=$latestreply["1"];
				}else{
				       if (strpos($latestreply['0'], ': quoted-printable') !== false) {
					    $day = date('d-M-Y'); 
					    $divide="On ".$day; 
					    $latestreply = explode('quoted-printable',$latestreply['0']);
					    $rep=$latestreply["1"];
					}else{
					    if (strpos($latestreply['0'], 'UTF-8') !== false) {
					    $day = date('d-M-Y'); 
					    $divide="On ".$day; 
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

	if(!isset($latestreply['1'])){
	    $day = date('d-M-Y');  // On 17-Oct-2017 //g_app
	    $divide="On ".$day; //$divide = "On 17-Oct-2017";
	    $latestreply = explode($divide,$replyMsg);
	    $rep=$latestreply["0"];
	}

	if(!isset($latestreply['1'])){
	    $day = date('d/m/Y');  // On 17-Oct-2017 //g_appOn 10/26/2017
	    $divide="On ".$day; //$divide = "On 17-Oct-2017";
	    $latestreply = explode($divide,$replyMsg);
	    $rep=$latestreply["0"];
	}
	#echo "<pre>";print_r($replyMsg);  die();
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
	echo "COMPLETE REPLY".$rep; #die();
		
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
		

/************* Reply saved in db with all essencial details ******************************************************************/
				if(!empty($details)){
				    $orderId=str_replace('"','',$details['0']);
				    $inmail_userId=str_replace('"','',$details['1']);
				    $eorderid=$details['2'];
			/***************** Get email to send mail again *****************/
					 #function getUserEmail($uid,$conn){
					      $sqlcomuim ="SELECT * FROM ph_users WHERE uid ='".$inmail_userId."'"; 
					      $resultcomuim = $conn->query($sqlcomuim); 
					      if ($resultcomuim->num_rows > 0) {
						 while($rowcomuim = $resultcomuim->fetch_assoc()) {
						      $adminEmail = $rowcomuim['email'];
						 }
					      } 
					if($adminId==''){
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
			#$adminEmail = getUserEmail($inmail_userId,$conn); //die(); 
			/******************** Get email from Id **************************/
			$rep=str_replace('=C2=A0',"",$rep); $rep=str_replace('mC2A0',"",$rep);$rep=str_replace('C2A0',"",$rep);
			$rep=str_replace('"',"",$rep); $rep=str_replace("'","",$rep); $rep=trim($rep); //echo $adminEmail;
			 $sqlu = "INSERT INTO ph_order_chat (oid,message,uid,postby,attacment_path,adid) VALUES ('$orderId','$rep','$usersId','$postBy','$dbattacments','$adminId')"; 
						if ($conn->query($sqlu) === TRUE) {
						   /******** Send mail To user ********/
						   $cmuserid = $inmail_userId;
						   $emessage = nl2br($rep);
						   $orderid = $orderId;
                                                   $eorderid = $eorderid;
						   $eattachments =$emailattach;
						   $type=($adminId!='')?'Admin':'User';
						   $ecopyright='ecopyright';
						   include('emails/mailcomment.php');
						   /******************************/
						    echo "Done";
						 }
						else {  }
					}
/************* finally Reply saved in db with all essencial details### ******************************************************************/

} #end loop

} //end email
/* close the connection */
imap_close($inbox);


?>

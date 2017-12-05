<!--<script>
window.addEvent('domready',function() {
	var togglers = $$('div.toggler');
	if(togglers.length) var gmail = new Fx.Accordion(togglers,$$('div.body'));
	togglers.addEvent('click',function() { this.addClass('read').removeClass('unread'); });
	togglers[0].fireEvent('click'); //first one starts out read
});
</script>-->

<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//require (__DIR__ . '/../sendgrid/vendor/autoload.php');
//require (__DIR__ . '/../sendgrid/lib/SendGrid.php');

// $hostname = '{imap.gmail.com:993/imap/ssl}INBOX';[Gmail]/All Mail;[Gmail]/Drafts;[Gmail]/Spam
//include('header_inner.php');
require 'config.php';
//{localhost:993/imap/ssl/novalidate-cert/norsh}Inbox
$inbox=imap_open("{imap.gmail.com:993/imap/ssl/novalidate-cert/norsh}INBOX", 'message@psd2html5.co', 'message123#') or die('Cannot connect to Gmail: ' . imap_last_error());
//$inbox=imap_open("{localhost:993/imap/ssl/novalidate-cert/norsh}INBOX", 'message@psd2html5.co', 'message123#') or die('Cannot connect to Gmail: ' . imap_last_error());

//$inbox2=imap_open("{imap.gmail.com:993/imap/ssl/novalidate-cert/norsh}Inbox", 'weotesting2@gmail.com', 'testing@') or die('Cannot connect to Gmail: ' . imap_last_error());
/**************** FILERS ***********************/

$emails = imap_search($inbox,'All');

date_default_timezone_set('Asia/calcutta');
$date = date('Y-m-d h:i:s a', time());
//$MC = imap_check($inbox);

// Fetch an overview for all messages in INBOX
//$result = imap_fetch_overview($inbox,"1:{$MC->Nmsgs}",0);
//foreach ($result as $overview) {
    //echo "#{$overview->msgno} ({$overview->date}) - From: {$overview->from}
    //{$overview->subject}\n";
//}

$htmlArr=[];
$msgdata=[];
$overview=[];
$outlookReplyData=[];

if($emails) {
	/* begin output var */
	$data='';
	/* put the newest emails on top */
	rsort($emails);
	/* for every email... */
	foreach($emails as $email_number) {
		/* get information specific to this email */
		//$overview = imap_fetch_overview($inbox,$email_number,0);
		$message = imap_fetchbody($inbox,$email_number,2);
		//$message_frmt = imap_fetchbody($inbox,$email_number,'');
		//$header =  imap_header($inbox, $email_number,0);
		$otherDetail='';
		$message1=mysqli_real_escape_string($con,$message);
		/*  echo "<h1>header</h1>";
		echo "<pre>";print_r($header);
		$overview[0]->seen;
		$overview[0]->subject;
		$overview[0]->from;
		$overview[0]->date;*/
		//$header =  imap_header($inbox, $email_number); 
		/*echo "<h1>data</h1>";
		echo "<pre>";print_r($overview); 
		echo "<pre>";print_r($header);*/ 
		//$status=$overview[0]->seen;
		//$overview[0]->date;

		$messagePlain=strip_tags($message);
		$msgdata[]=$messagePlain;
		$htmlArr[]=$message1;
		//$outlookReplyData[]=$message_frmt;
		
	}
	//echo "<h1>Render details</h1>";

	#$htmData=current($htmlArr);
	#$otherMethod=current($outlookReplyData);
	// 1 check html format
	#echo "<pre>";print_r($htmData);
	// 2 chk with other method	
	#echo "<pre>";print_r($otherMethod);

	/******* Get Reply **********/
	function reply($msgdata=null){
		$reply=current($msgdata);
		$day=date('D');
		$divide="On ".$day;
		$latestreply = explode($divide,$reply);
		return $reply=strip_tags($latestreply["0"]); 
	} 
	#echo "reply frmt";
	$rep=reply($msgdata); //exit();

	/******* Get Deatails *******/
	function detail($htmlArr=null){
		$reply1=current($htmlArr);
		/**** Check if last message is html or not ****/	

		$latestreply1 = explode('wrote:',$reply1);
		#echo "<pre>";print_r($latestreply1); die();
		//$html=$latestreply1['1'];
		foreach($latestreply1 as $lastHtml){
			if ( $lastHtml != strip_tags($lastHtml) ){
				$html=$lastHtml;
			}
		}
		#print_r($html); exit();
		//$html=$reply1;	
		/*************** Loading Html ************************/
		$document = new \DOMDocument('1.0', 'UTF-8');
		// set error level
		$internalErrors = libxml_use_internal_errors(true);
		// load HTML
		$document->loadHTML($html);
		// Restore error level
		libxml_use_internal_errors($internalErrors);
		$details=[];
		foreach($document->getElementsByTagName('a') as $link) {
			# Show the <a href>
			$info=explode("dat~",stripslashes($link->getAttribute('data')));
			if(isset($info['1'])){
				$details[]=str_replace('"',"",$info['1']);
			}
			echo "<br />";
		} 
		return $details;
	}
		
//$sqlu = "INSERT INTO ph_order_chat (oid,message,uid,status,comment_time,postby) VALUES ('2','$rep','3','','2017-10-11 03:50:48','user')";
	$details=detail($htmlArr);
	#echo "<pre>";print_r($details); die();
		/************* Reply saved in db with all essencial details **************/
		if(!empty($details)){
			$orderId=$details['0'];
			$userId=$details['1'];
			$cmntId=$details['2'];
			$rep=reply($msgdata);
			$date = date('Y-m-d h:i:s a', time());
			$sqlu = "INSERT INTO ph_order_chat (oid,message,uid,status,comment_time,postby) VALUES ('$orderId','$rep','$userId','','2017-10-11 03:50:48','user')";
			if ($con->query($sqlu) === TRUE) {  }
			else {  }
		}
		exit();

} 
/* close the connection */
imap_close($inbox);


/* connect to gmail */
// $hostname = '{imap.gmail.com:993/imap/ssl}INBOX';
// $username = 'davidwalshblog@gmail.com';
// $password = 'davidwalsh';
// '{imap.gmail.com:993/imap/ssl/novalidate-cert}INBOX';
// {mail.domain.com:143/novalidate-cert}INBOX
//$hostname = '{imap.gmail.com:993/imap/ssl}INBOX';

$hostname = "{imap.gmail.com:993/imap/ssl/novalidate-cert/norsh}Inbox";
$username ='message@psd2html5.co';
$password = 'message123#';

/*if (function_exists('imap_open')) {
    echo "IMAP functions are available.<br />\n";
} else {
    echo "IMAP functions are not available.<br />\n";
}*/

/* try to connect 
// $inbox = imap_open($hostname,$username ,$password) or die('Cannot connect to Gmail: ' . imap_last_error());

imap_open($hostname, $username, $password) or die('Cannot connect to Gmail: ' . imap_last_error());

$emails = imap_search($stream, 'UNSEEN');

rsort($emails);
foreach ($emails as $email_id) {
  imap_fetch_overview($stream, $email_id, 0);
}*/





/****






*****/


?>


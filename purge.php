
<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function imap_purge($IP,$user,$pass,$mode){


    $mbox = @imap_open("{".$IP.":143}", $user, $pass);

if($mbox){
    $folders = imap_listmailbox($mbox, "{".$IP.":143}", "*");
    echo "<h1>Headers in INBOX for $user</h1>\n";
    for ($i = 1; $i <= imap_num_msg($mbox); $i++){

        $header = imap_headerinfo($mbox, $i, 80, 80);
        $subject= $header->fetchsubject;
        $date = $header->udate;

        $udate=time();

        //number of days to purge after
        $purge_after = 5;

        $messageBody = imap_body($mbox, $i);

        $age = ($udate - $date)/86400;
        echo  $i.") ".$subject." - Age: ".number_format($age,0)."<br>";

        if($age > $purge_after and $mode == "A"){
            imap_delete($mbox, $i);
            echo "Delete old message $i<br>";


        }


        //delete all spam, even if new.
        if(strstr($subject,"{Spam?}")){
            if($mode == "A")
            imap_delete($mbox, $i);
            echo "Delete spam: $i<br>";
        }

        //if clear mode, delete all mail
        if($mode == "C")
           imap_delete($mbox, $i);

    }

    //except in test mode, expunge the delete files.


    if($mode != "T")
       imap_expunge($mbox);

    imap_close($mbox);
  } else {

   echo "IMAP Access denied<br>";

   }

}

//MODES:  T = Test mode, A = Run mode, C = Clear all messages in box.  Run mode delete messages, test mode lists messages.

imap_purge("76.54.8.220","admin1@fbi.gov","s2oqlg2f28","A");




/* connect to gmail */
// $hostname = '{imap.gmail.com:993/imap/ssl}INBOX';
// $username = 'davidwalshblog@gmail.com';
// $password = 'davidwalsh';
// '{imap.gmail.com:993/imap/ssl/novalidate-cert}INBOX';
//1 $hostname = "{imap.gmail.com:993/imap/ssl/novalidate-cert/norsh}Inbox";
// $username ='message@psd2html5.co';
// $password = 'message123#';
//
// if (function_exists('imap_open')) {
//     echo "IMAP functions are available.<br />\n";
// } else {
//     echo "IMAP functions are not available.<br />\n";
// }

/* 2try to connect */
// $inbox = imap_open($hostname,$username ,$password) or die('Cannot connect to Gmail: ' . imap_last_error());
//
// /* grab emails */
// $emails = imap_search($inbox,'ALL');
//
// /* if emails are returned, cycle through each... */
// if($emails) {
//
//     /* begin output var */
//     $output = '';
//
//     /* put the newest emails on top */
//     rsort($emails);
//
//     /* for every email... */
//     foreach($emails as $email_number) {
//
//         /* get information specific to this email */
//         $overview = imap_fetch_overview($inbox,$email_number,0);
//
//
//         $output.= 'Name:  '.$overview[0]->from.'</br>';
//             $output.= 'Email:  '.$overview[0]->message_id.'</br>';
//
//
//
//     }
//
//     echo $output;
// }
//
// /* close the connection */
// imap_close($inbox);
?>

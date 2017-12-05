<?php 
require (__DIR__ . '/../../sendgrid/vendor/autoload.php'); 
require (__DIR__ . '/../../sendgrid/lib/SendGrid.php'); 
require(__DIR__ . '/../../config.php'); 
$message=<<<eot
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>PSD2HTM5 Email</title>
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700' rel='stylesheet' type='text/css'>
    <style type="text/css">
      body {margin: 10px 0; padding: 0 10px; background: #e7e7e7; font-size: 13px; font-family:'Roboto','Arial';}
      table {border-collapse: collapse;}
      td {font-family:'Roboto' ,'Arial'; font-weight:300; color: #777777;}
	 table td strong{font-weight:bold;}

      @media only screen and (max-width: 480px) {
        body,table,td,p,a,li,blockquote {
          -webkit-text-size-adjust:none !important;
        }
        table {width: 100% !important;}

        .responsive-image img {
          height: auto !important;
          max-width: 100% !important;
          width: 100% !important;
        }
      }
    </style>
  </head>
  <body>
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="background: #e7e7e7;">
	<tr><td style="font-size: 0; line-height: 0;" height="30">&nbsp;</td></tr>      
      <tr>
        <td>
          <table border="0" cellpadding="0" cellspacing="0" align="center" width="640" bgcolor="#FFFFFF">
            <tr>
              <td style="font-size: 0; line-height: 0; padding: 0 20px;" height="140">
                <a href="$domain"><img width="116" height="52" src="$domain/img/pp-logo-dark.jpg"  alt="" /></a>
              </td>
            </tr>
           
            <tr>
              <td style="padding:0px 20px 20px 20px; color:#777777;">
                <div  style="font-size:18px; color:#777777;">
				Hi $team_member <br/> <br/>
You have been assigned for a project $project_name, <a href="$domain/safeside/order_detail?oid=$oid">Click here</a> to check the details.
 <br/>
  <br/>
 <strong>Project Detail </strong><br/><br/>
$project_details
                </div>
              </td>
            </tr>
            
          
            
            <tr>
             <td style="padding: 10px 20px; color:#777777; font-size:18px;">
              Thanks,<br />
PSD2HTM5 Team<br />
            </td> 
           </tr>
 <tr><td style="font-size: 0; line-height: 0;" height="15">&nbsp;</td></tr>           
            <tr>
              <td>
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="background: #e7e7e7;">
                  <tr><td style="font-size: 0; line-height: 0;" height="15">&nbsp;</td></tr>
                  <tr>
                    <td align="center" style="padding: 0 10px; color: #777777; font-size:8px;">
                      $ecopyright <br />113-03, 101 avenue Richmond Hill New York, 11419
                    </td>
                  </tr>
                  <tr><td style="font-size: 0; line-height: 0;" height="15">&nbsp;</td></tr>
                </table>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
  </body>
</html>

eot;
$message2=<<<eot
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>PSD2HTM5 Email</title>
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700' rel='stylesheet' type='text/css'>
    <style type="text/css">
      body {margin: 10px 0; padding: 0 10px; background: #e7e7e7; font-size: 13px; font-family:'Roboto','Arial';}
      table {border-collapse: collapse;}
      td {font-family:'Roboto' ,'Arial'; font-weight:300; color: #777777;}
	 table td strong{font-weight:bold;}

      @media only screen and (max-width: 480px) {
        body,table,td,p,a,li,blockquote {
          -webkit-text-size-adjust:none !important;
        }
        table {width: 100% !important;}

        .responsive-image img {
          height: auto !important;
          max-width: 100% !important;
          width: 100% !important;
        }
      }
    </style>
  </head>
  <body>
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="background: #e7e7e7;">
	<tr><td style="font-size: 0; line-height: 0;" height="30">&nbsp;</td></tr>      
      <tr>
        <td>
          <table border="0" cellpadding="0" cellspacing="0" align="center" width="640" bgcolor="#FFFFFF">
            <tr>
              <td style="font-size: 0; line-height: 0; padding: 0 20px;" height="140">
                <a href="$domain"><img width="116" height="52" src="$domain/img/pp-logo-dark.jpg"  alt="" /></a>
              </td>
            </tr>
           
            <tr>
              <td style="padding:0px 20px 20px 20px; color:#777777;">
                <div  style="font-size:18px; color:#777777;">
				Hi $name <br/> <br/>
Your $project_name has been assigned to $team_member further all the updates will be sent by him.  If you are having any problems while working please do not hesitate to contact us at <a href="mailto:support@psd2html5.co">support@psd2html5.co</a>.
 <br/> <br/>
 Happy working...&#9786;

                </div>
              </td>
            </tr>
            
          
            
            <tr>
             <td style="padding: 10px 20px; color:#777777; font-size:18px;">
              Thanks,<br />
PSD2HTM5 Team<br />
            </td> 
           </tr>
 <tr><td style="font-size: 0; line-height: 0;" height="15">&nbsp;</td></tr>           
            <tr>
              <td>
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="background: #e7e7e7;">
                  <tr><td style="font-size: 0; line-height: 0;" height="15">&nbsp;</td></tr>
                  <tr>
                    <td align="center" style="padding: 0 10px; color: #777777; font-size:8px;">
                      $ecopyright <br />113-03, 101 avenue Richmond Hill New York, 11419
                    </td>
                  </tr>
                  <tr><td style="font-size: 0; line-height: 0;" height="15">&nbsp;</td></tr>
                </table>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
  </body>
</html>

eot;

$to = $member_email;
$to2 = $uemail;
$subject = "A new project assigned to you";
$subject2 = "Your project assigned to a Dedicated Manager";
$sendgrid = new SendGrid($api_user, $api_key);
$email = new SendGrid\Email();
$email2 = new SendGrid\Email();
$email
    ->addTo($to)
	->addBcc('psdhtml5@gmail.com')
   	 ->setFromname('PSD2HTML5')
    ->setFrom('support@psd2html5.co')
    ->setSubject($subject)
    ->setHtml($message);

try {
    $sendgrid->send($email);
} catch(\SendGrid\Exception $e) {
    echo $e->getCode();
    foreach($e->getErrors() as $er) {
        echo $er;
    }
}

$email2
    ->addTo($to2)
	 	 ->addBcc('psdhtml5@gmail.com')
   	 ->setFromname('PSD2HTML5')
    ->setFrom('support@psd2html5.co')
    ->setSubject($subject2)
    ->setHtml($message2);

try {
    $sendgrid->send($email2);
} catch(\SendGrid\Exception $e) {
    echo $e->getCode();
    foreach($e->getErrors() as $er) {
        echo $er;
    }
}

?>
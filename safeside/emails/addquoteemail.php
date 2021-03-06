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
                <div style="font-size:16px; color:#777777;">Hi!  $epayname</div>
                 <div>&nbsp;</div>
                 <div style="font-size:16px; color:#777777;">You have recieved a quotations against your resent request $eorderid </div>
                <br />
              </td>
            </tr>
            <tr>
            	<td style="padding:0px 20px 20px 20px; color:#777777; font-size:16px;">
                	<strong>Total Amount: </strong>$$nquote.00
                    <br/><br/>
					<strong>Estimate Time: </strong>$nqtime - $enqtime Working Days<br/><br/>
					<a href="$domain/myorders" style="font-size:16px; background-color:#00bcd4; color:#ffffff; font-size:16px; padding:10px 20px;border-radius:4px; text-decoration:none;">Make a Payment</a>
                </td>
               
                	
               
            </tr>
          <tr>
              <td style="padding:0px 20px 20px 20px; color:#777777;">
               
                <div  style="font-size:16px; color:#777777;">
				Please make sure you have made the payment for your order $eorderid. Thus we will be able to take on your project immediately without any delay.
				<br /><br />
				You are welcome to use the following payment button if you did not manage to settle the payment.
				<br />
				<br />
				<a href="$domain/myorders" style="font-size:16px; background-color:#00bcd4; color:#ffffff; font-size:16px; padding:10px 20px;border-radius:4px; text-decoration:none;">Make a Payment</a>
<br /><br />
     You will have an opportunity to pay either via your credit card or your PayPal account, if you have it.<br />
<br />
Our support team is ready to help you from Mon - Fri, 9:00AM – 7:00PM IST.
<br />
<br />
If you have any question regarding this quote please <a href="$domain/myorders">click here </a> to reply a message to your Project manager.




                </div>
              </td>
            </tr>
            
            <tr>
             <td style="padding: 10px 20px; color:#777777; font-size:16px;">
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
$to = $epayemail;
$subject = "You have recieved a quotations on request ".$eorderid."";
$sendgrid = new SendGrid($api_user, $api_key);
$email = new SendGrid\Email();
$email
    ->addTo($to)
	 ->addBcc('psdhtml5@gmail.com')
   	 ->setFromname('PSD2HTMT5')
    ->setFrom('support@psd2htm5.co')
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
?>

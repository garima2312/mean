<?php 
require (__DIR__ . '/../sendgrid/vendor/autoload.php'); 
require (__DIR__ . '/../sendgrid/lib/SendGrid.php'); 
require(__DIR__ . '/../config.php'); 

$message=<<<eot
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>PSD2HTML5 Email</title>
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
                <div style="font-size:16px; color:#777777;">Hi $customer_name[1]!</div>
                 <div>&nbsp;</div>
                <div  style="font-size:16px; color:#777777;">
Your payment has been successfully received with the following details. Please quote your transaction reference number and sale Reference Number for any queries relating to this request.               </div>
              </td>
            </tr>
			<tr>
            	<td style="padding:0px 20px;">
                
                <table  cellpadding="0" cellspacing="0" align="left" width="100%" style="border:1px solid #b4b4b4; padding:20px;">
                <tr>
              <td style="padding:5px 20px 5px 20px; color:#777777;">
                <table style="font-size:16px; color:#777777;"  border="0" cellpadding="0" cellspacing="0" align="left" width="40%"> 
                 	<tr>
                    	<td  style="font-size:16px;">
						 <strong style="font-weight:500;">Transaction Reference<br/> Number : </strong>
                    </td>
                    </tr>
                </table>
                
                <table style="font-size:16px; color:#777777;"  border="0" cellpadding="0" cellspacing="0" align="left" width="55%">
                 	<tr>
                    	<td  style="font-size:16px;">
                     		$txn_id
                    </td>
                    </tr>
                </table>
              </td>
              
              
              </tr>
              
              
              <tr>
              <td style="padding:5px 20px 5px 20px; color:#777777;">
                <table style="font-size:16px; color:#777777;"  border="0" cellpadding="0" cellspacing="0" align="left" width="40%"> 
                 	<tr>
                    	<td  style="font-size:16px;">
                     <strong style="font-weight:500;">Sale Reference Number : </strong>
                    </td>
                    </tr>
                </table>
                
                <table style="font-size:16px; color:#777777;"  border="0" cellpadding="0" cellspacing="0" align="left" width="55%">
                 	<tr>
                    	<td  style="font-size:16px;">
                     		$sale_id[1]
                    </td>
                    </tr>
                </table>
              </td>
              
              
              </tr>
              
              <tr>
              <td style="padding:5px 20px 5px 20px; color:#777777;">
                <table style="font-size:16px; color:#777777;"  border="0" cellpadding="0" cellspacing="0" align="left" width="40%"> 
                 	<tr>
                    	<td  style="font-size:16px;">
                     <strong style="font-weight:500;">Order ID :</strong>
                    </td>
                    </tr>
                </table>
                
                <table style="font-size:16px; color:#777777;"  border="0" cellpadding="0" cellspacing="0" align="left" width="55%">
                 	<tr>
                    	<td  style="font-size:16px;">
                     		$vendor_order_id[1]
                    </td>
                    </tr>
                </table>
              </td>
              
              
              </tr>
              <tr>
              <td style="padding:5px 20px 5px 20px; color:#777777;">
                <table style="font-size:16px; color:#777777;"  border="0" cellpadding="0" cellspacing="0" align="left" width="40%"> 
                 	<tr>
                    	<td  style="font-size:16px;">
                     <strong style="font-weight:500;">Transaction Date and Time :</strong>
                    </td>
                    </tr>
                </table>
                
                <table style="font-size:16px; color:#777777;"  border="0" cellpadding="0" cellspacing="0" align="left" width="55%">
                 	<tr>
                    	<td  style="font-size:16px;">
                     		$timestamp[1]
                    </td>
                    </tr>
                </table>
              </td>
              
              
              </tr>
			  <tr>
              <td style="padding:5px 20px 5px 20px; color:#777777;">
                <table style="font-size:16px; color:#777777;"  border="0" cellpadding="0" cellspacing="0" align="left" width="40%"> 
                 	<tr>
                    	<td  style="font-size:16px;">
                     <strong style="font-weight:500;">Payment Amount : </strong>
                    </td>
                    </tr>
                </table>
                
                <table style="font-size:16px; color:#777777;"  border="0" cellpadding="0" cellspacing="0" align="left" width="55%">
                 	<tr>
                    	<td  style="font-size:16px;">
                     		$item_list_amount_1[1] $cust_currency[1]
                    </td>
                    </tr>
                </table>
              </td>
              
              
              </tr>
			  <tr>
              <td style="padding:5px 20px 5px 20px; color:#777777;">
                <table style="font-size:16px; color:#777777;"  border="0" cellpadding="0" cellspacing="0" align="left" width="40%"> 
                 	<tr>
                    	<td  style="font-size:16px;">
                     <strong style="font-weight:500;">Billing Information : </strong>
                    </td>
                    </tr>
                </table>
                
                <table style="font-size:16px; color:#777777;"  border="0" cellpadding="0" cellspacing="0" align="left" width="55%">
                 	<tr>
                    	<td  style="font-size:16px;">
                     		$customer_name[1]<br/>
							$customer_email[1]<br/>
							$customer_phone[1]<br/>
							$bill_street_address[1]<br/>
							$bill_city[1],$bill_state[1]$bill_postal_code[1]<br/>
							$bill_country[1]<br/>
                    </td>
                    </tr>
                </table>
              </td>
              
              
              </tr>
			  <tr>
              <td style="padding:5px 20px 5px 20px; color:#777777;">
                <table style="font-size:16px; color:#777777;"  border="0" cellpadding="0" cellspacing="0" align="left" width="40%"> 
                 	<tr>
                    	<td  style="font-size:16px;">
                     <strong style="font-weight:500;">Your Location : </strong>
                    </td>
                    </tr>
                </table>
                
                <table style="font-size:16px; color:#777777;"  border="0" cellpadding="0" cellspacing="0" align="left" width="55%">
                 	<tr>
                    	<td  style="font-size:16px;">
                     		$Ip_address<br/>
							$Ip_location<br/>
                    </td>
                    </tr>
                </table>
              </td>
              
              
              </tr>
               </table>
              </td>
              
            </tr>
            
                         <tr><td style="font-size: 0; line-height: 0;" height="20">&nbsp;</td></tr>

            <tr>
             <td style="padding: 10px 20px; color:#777777; font-size:16px;">
              Thanks,<br />
PSD2HTML5 Team<br />
            </td> 
           </tr>
     <tr><td style="font-size: 0; line-height: 0;" height="15">&nbsp;</td></tr>          
            <tr>
              <td>
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="background: #e7e7e7;">
                  <tr><td style="font-size: 0; line-height: 0;" height="15">&nbsp;</td></tr>
                  <tr>
                    <td align="center" style="padding: 0 10px; color: #777777; font-size:8px;">
                      Copyrights 2016 All Rights Reserved <br />SCF 63, Phase 11 Mohali Punjab (IN)
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
$to = $customer_email;
$subject = "Payment Success against your order ".$vendor_order_id[1]."";
$sendgrid = new SendGrid($api_user, $api_key);
$email = new SendGrid\Email();
$email
    ->addTo($to)
		 ->addBcc('weotesting2@gmail.com')
   	 ->setFromname('PSD2HTML5')
    ->setFrom('donotreply@psd2html5.co')
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

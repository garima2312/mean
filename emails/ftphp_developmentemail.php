<?php 
require (__DIR__ . '/../sendgrid/vendor/autoload.php'); 
require (__DIR__ . '/../sendgrid/lib/SendGrid.php'); 
require(__DIR__ . '/../config.php'); 

$message1=<<<eot
<!DOCTYPE html>
<html dir="ltr">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>PSD2HTML5 Email</title>
</head>
<body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0">
		<div id="wrapper" dir="ltr" style="background-color: #f5f5f5; margin: 0; padding: 70px 0 70px 0; -webkit-text-size-adjust: none !important; width: 100%;">
			<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%"><tr>
<td align="center" valign="top">
						<div id="template_header_image">
							<p style="margin-top: 0;"><img src="$domain/img/pp-logo-dark.png" alt="PSD2HTML5" style="border: none; display: inline; font-size: 14px; font-weight: bold; height: auto; line-height: 100%; outline: none; text-decoration: none; text-transform: capitalize;"></p>						</div>
						<table border="0" cellpadding="0" cellspacing="0" width="600" id="template_container" style="box-shadow: 0 1px 4px rgba(0,0,0,0.1) !important; background-color: #fdfdfd; border: 1px solid #dcdcdc; border-radius: 3px !important;">
<tr>
<td align="center" valign="top">
									<!-- Header -->
									<table border="0" cellpadding="0" cellspacing="0" width="600" id="template_header" style='background-color: #00ACC1; border-radius: 3px 3px 0 0 !important; color: #ffffff; border-bottom: 0; font-weight: bold; line-height: 100%; vertical-align: middle; font-family: "Helvetica Neue", Helvetica, Roboto, Arial, sans-serif;'><tr>
<td id="header_wrapper" style="padding: 10px 25px; display: block;">
												<h1 style='color: #ffffff; font-family: "Helvetica Neue", Helvetica, Roboto, Arial, sans-serif; font-size: 30px; font-weight: 300; line-height: 150%; margin: 0; text-align: left; text-shadow: 0 1px 0 #7797b4; -webkit-font-smoothing: antialiased;'>Thanks for request on PSD2HTML5</h1>
											</td>
										</tr></table>
<!-- End Header -->
</td>
							</tr>
<tr>
<td align="center" valign="top">
									<!-- Body -->
									<table border="0" cellpadding="0" cellspacing="0" width="600" id="template_body"><tr>
<td valign="top" id="body_content" style="background-color: #fdfdfd;">
												<!-- Content -->
												<table border="0" cellpadding="20" cellspacing="0" width="100%"><tr>
<td valign="top" style="padding: 3% 3% 0;">
															<div id="body_content_inner" style='color: #737373; font-family: "Helvetica Neue", Helvetica, Roboto, Arial, sans-serif; font-size: 14px; line-height: 150%; text-align: left;'>

<p style="margin: 0 0 16px;"> Hi!  $uname,</p>
<p style="margin: 0 0 16px;">Welcome to PSD2HTML5 !!</p>
<p style="margin: 0 0 16px;">Thank you for your interest for $usubject, We have received your request and one of our support member will get in touch with you soon.</p>
<p style="margin: 0 0 16px;">we will use your email address <a  style="color:#1aa7bb;">$uemail</a> to notify you about above request.</p>


<p style="margin: 0;">Thanks</p>
<p style="margin: 0 0 16px;">PSD2HTML5 Team</p>

</div>
														</td>
													</tr></table>
<!-- End Content -->
</td>
										</tr></table>
<!-- End Body -->
</td>
							</tr>
<tr>
<td align="center" valign="top">
									<!-- Footer -->
									<table border="0" cellpadding="10" cellspacing="0" width="600" id="template_footer"><tr>
<td valign="top" style="padding: 0; -webkit-border-radius: 6px;">
												<table border="0" cellpadding="10" cellspacing="0" width="100%"><tr>
<td colspan="2" valign="middle" id="credit" style="padding: 0 20px 5px 20px; -webkit-border-radius: 6px; border: 0; color: #99b1c7; font-family: Arial; font-size: 12px; line-height: 125%; text-align: center;">
															<p>$ecopyright <br />113-03, 101 avenue Richmond Hill New York, 11419</p>
														</td>
													</tr></table>
</td>
										</tr></table>
<!-- End Footer -->
</td>
							</tr>
</table>
</td>
				</tr></table>
</div>
	</body>
</html>



eot;

$message2=<<<eot
<!DOCTYPE html>
<html dir="ltr">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>PSD2HTML5 Email</title>
</head>
<body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0">
		<div id="wrapper" dir="ltr" style="background-color: #f5f5f5; margin: 0; padding: 70px 0 70px 0; -webkit-text-size-adjust: none !important; width: 100%;">
			<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%"><tr>
<td align="center" valign="top">
						<div id="template_header_image">
							<p style="margin-top: 0;"><img src="$domain/img/pp-logo-dark.png" alt="PSD2HTML5" style="border: none; display: inline; font-size: 14px; font-weight: bold; height: auto; line-height: 100%; outline: none; text-decoration: none; text-transform: capitalize;"></p>						</div>
						<table border="0" cellpadding="0" cellspacing="0" width="600" id="template_container" style="box-shadow: 0 1px 4px rgba(0,0,0,0.1) !important; background-color: #fdfdfd; border: 1px solid #dcdcdc; border-radius: 3px !important;">
<tr>
<td align="center" valign="top">
									<!-- Header -->
									<table border="0" cellpadding="0" cellspacing="0" width="600" id="template_header" style='background-color: #00ACC1; border-radius: 3px 3px 0 0 !important; color: #ffffff; border-bottom: 0; font-weight: bold; line-height: 100%; vertical-align: middle; font-family: "Helvetica Neue", Helvetica, Roboto, Arial, sans-serif;'><tr>
<td id="header_wrapper" style="padding: 10px 25px; display: block;">
												<h1 style='color: #ffffff; font-family: "Helvetica Neue", Helvetica, Roboto, Arial, sans-serif; font-size: 30px; font-weight: 300; line-height: 150%; margin: 0; text-align: left; text-shadow: 0 1px 0 #7797b4; -webkit-font-smoothing: antialiased;'>Request for $usubject</h1>
											</td>
										</tr></table>
<!-- End Header -->
</td>
							</tr>
<tr>
<td align="center" valign="top">
									<!-- Body -->
									<table border="0" cellpadding="0" cellspacing="0" width="600" id="template_body"><tr>
<td valign="top" id="body_content" style="background-color: #fdfdfd;">
												<!-- Content -->
												<table border="0" cellpadding="20" cellspacing="0" width="100%"><tr>
<td valign="top" style="padding: 3% 3% 0;">
															<div id="body_content_inner" style='color: #737373; font-family: "Helvetica Neue", Helvetica, Roboto, Arial, sans-serif; font-size: 14px; line-height: 150%; text-align: left;'>

<p style="margin: 0 0 16px;"> Hi!  Master,</p>
<p style="margin: 0 0 16px;">New Request on PSD2HTML5 for $usubject !!</p>
<h2 style='color: #00ACC1; display: block; font-family: "Helvetica Neue", Helvetica, Roboto, Arial, sans-serif; font-size: 16px; font-weight: bold; line-height: 130%; margin: 16px 0 8px; text-align: left;'>Here are the details.</h2>
<ul>
<li><strong>Name:</strong> <span class="text" style='color: #505050; font-family: "Helvetica Neue", Helvetica, Roboto, Arial, sans-serif;'>$uname</span></li>
<li><strong>Email:</strong> <span class="text" style='color: #505050; font-family: "Helvetica Neue", Helvetica, Roboto, Arial, sans-serif;'>$uemail</span></li>
<li><strong>Phone:</strong> <span class="text" style='color: #505050; font-family: "Helvetica Neue", Helvetica, Roboto, Arial, sans-serif;'>$uphone</span></li>
<li><strong>Message:</strong> <span class="text" style='color: #505050; font-family: "Helvetica Neue", Helvetica, Roboto, Arial, sans-serif;'>$umassage</span></li>
</ul>
<p style="margin: 0;">Thanks</p>
<p style="margin: 0 0 16px;">PSD2HTML5 Team</p>

</div>
														</td>
													</tr></table>
<!-- End Content -->
</td>
										</tr></table>
<!-- End Body -->
</td>
							</tr>
<tr>
<td align="center" valign="top">
									<!-- Footer -->
									<table border="0" cellpadding="10" cellspacing="0" width="600" id="template_footer"><tr>
<td valign="top" style="padding: 0; -webkit-border-radius: 6px;">
												<table border="0" cellpadding="10" cellspacing="0" width="100%"><tr>
<td colspan="2" valign="middle" id="credit" style="padding: 0 20px 5px 20px; -webkit-border-radius: 6px; border: 0; color: #99b1c7; font-family: Arial; font-size: 12px; line-height: 125%; text-align: center;">
															<p>$ecopyright <br />113-03, 101 avenue Richmond Hill New York, 11419</p>
														</td>
													</tr></table>
</td>
										</tr></table>
<!-- End Footer -->
</td>
							</tr>
</table>
</td>
				</tr></table>
</div>
	</body>
</html>



eot;
$to = $uemail;
$to2 = 'villiamjit@webexpertsonline.info';
//$to2 = 'support@psd2html5.co';
$subject1 = "Thanks for request on PSD2HTML5";
$subject2 = "A new request for ".$usubject."";
$sendgrid = new SendGrid($api_user, $api_key);
$email = new SendGrid\Email();
$email2 = new SendGrid\Email();
$email
    ->addTo($to)
	  ->addBcc('weotesting2@gmail.com')
   	 ->setFromname('PSD2HTML5')
    ->setFrom('support@psd2html5.co')
    ->setSubject($subject1)
    ->setHtml($message1);
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
	 ->addBcc('weotesting2@gmail.com')
   	 ->setFromname('PSD2HTML5')
    ->setFrom($to)
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
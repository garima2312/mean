<?php
//phpinfo();
require 'vendor/autoload.php';
require 'lib/SendGrid.php';

$api_user ='bsboby';
$api_key= 'Monster123#';
$sendgrid = new SendGrid($api_user, $api_key);
$email = new SendGrid\Email();
$message ="<strong>Hello World!</strong>";
$to = 'villiamjit@webexpertsonline.info';
$subject = "New Contact Form Email submission";
$email
    ->addTo($to)
    ->setFrom('me@bar.com')
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

echo "end";
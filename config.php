<?php
/************ Db connection file **********/
$domain ='https://www.p2h5.com/v2';
$servername = 'localhost';
$username = 'beansdb';
$password = 'gfed)9^y12c)n';
$db='beansdb';

//connection to the database
$conn = new mysqli($servername,$username,$password,$db)
 or die('Error connecting to MySQL server.');
//$con = $conn;
// Enter your 2checkout Credentials Below

 $privatekey= '0EB039DC-4472-40A3-8FB6-210E6E55EFDD';
 $publishablekey = '1BAD9B40-4E03-47FE-A09B-D9736D3CFCA9';
 $sellerid = '901305831';
 $mode ='sandbox';
 $hashSecretWord = "villiamjit"; #Input your secret word
 $hashSid = 901305831; #Input your seller ID (2Checkout account number
 //************************************************************/
 //************************************************************
 // Enter your Dropbox Credentials Below
 $drop_app_key = "yome4gf5nhpq5xj";
 $drop_app_secret = "jh6qphszoootuqm";

 //token :HabG7NHgAZAAAAAAAAAFvMFiHuCw0wmZqT7X4fdHEcto_fLqk5I_4OywHRM4EzeU
 //$drop_app_key = "avr1uu9r88t40nh";
 //$drop_app_secret = "ng8ed21jnpfgojj";

 //************************************************************/
 //************************************************************

 // Enter your Sendgrid Credentials Below
 $api_user ='psd2html5';
 $api_key= 'N234s7OJ/MDzwJ';
 //************************************************************

 // Enter your Email Copyright
 $ecopyright ='Copyrights '.date("Y").' All Rights Reserved';
 //echo "connected"; 

 //******************Outlook settings******************************************/ 
 $email_title="PSD2HTML5 Email"; //title
 $fromName="PSD2HTML5";
$administratorEmail='garima@webexpertsonline.info'; //'weotesting1@gmail.com'; //'garima@webexpertsonline.info'; //''; //'webexperts@yahoo.com,rockeyhill718@gmail.com';
//$administratorEmail="james@webexpertsonline.net"; harman@webexpertsonline.biz

//************************************************************
// Enter your Paypal Credentials Below
 $paypal_email = "sandeep@webexpertsonline.info"; 
 $paypal_url = "https://www.sandbox.paypal.com/cgi-bin/webscr";
 
//************************************************************
$absolutePath="/var/www/Live/p2h5.com/v2/";
//***********************************************************
 ?>

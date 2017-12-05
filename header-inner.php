<?php  session_start();
if(isset($_COOKIE['user_id'])){$_COOKIE['user_id'];$logeduserid=$_COOKIE['user_id'];} else{$logeduserid=$_SESSION["uid"]; }ob_start();?>
<!DOCTYPE html>
<html lang="en" >
<head>
<meta charset="utf-8">
<meta property="fb:admins" content="668413254" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $title;?></title>
<meta name="google-site-verification" content="qyhQk_d3kXGRE2RET9B0wXUEFqndseIXL3_F1ehItkc" />
<meta name="description" CONTENT="<?php echo $description;?>"/>
<meta name="keywords" CONTENT="<?php echo $keywords;?>"/>
<meta property="og:locale" content="en_US" />
<meta property="og:type" content="website" />
<meta property="og:title" content="<?php echo $title;?>" />
<meta property="og:description" content="<?php echo $description;?>" />
<meta property="og:url" content="https://www.psd2html5.co/" />
<meta property="og:site_name" content="PSD2HTML5" />
<meta property="fb:app_id" content="802362133212607" />
<meta property="og:image" content="https://www.psd2html5.co/img/social_share.png" />
<meta name="robots" content="index, follow" />
<meta name="Distribution" content="Global">
<meta name="Revisit-after" content="1 Days">
<!--Icons added -->
<link rel="shortcut icon"  href="<?php echo $domain; ?>/img/favicon-16x16.png" sizes="16x16"/>
<link rel="shortcut icon" href="<?php echo $domain; ?>/img/favicon.ico" type="image/x-icon">
<link rel="icon" href="<?php echo $domain; ?>/img/favicon.ico" type="image/x-icon">
<link rel="icon" type="image/png" href="<?php echo $domain; ?>/img/favicon-16x16.png" sizes="16x16">
<link rel="icon" type="image/png" href="<?php echo $domain; ?>/img/favicon-32x32.png" sizes="32x32">
<link rel="icon" type="image/png" href="<?php echo $domain; ?>/img/favicon-96x96.png" sizes="96x96">
<link rel="apple-touch-icon" sizes="57x57" href="<?php echo $domain; ?>/img/apple-touch-icon-57x57.png">
<link rel="apple-touch-icon" sizes="114x114" href="<?php echo $domain; ?>/img/apple-touch-icon-114x114.png">
<link rel="apple-touch-icon" sizes="72x72" href="<?php echo $domain; ?>/img/apple-touch-icon-72x72.png">
<link rel="apple-touch-icon" sizes="144x144" href="<?php echo $domain; ?>/img/apple-touch-icon-144x144.png">
<link rel="apple-touch-icon" sizes="60x60" href="<?php echo $domain; ?>/img/apple-touch-icon-60x60.png">
<link rel="apple-touch-icon" sizes="120x120" href="<?php echo $domain; ?>/img/apple-touch-icon-120x120.png">
<link rel="apple-touch-icon" sizes="76x76" href="<?php echo $domain; ?>/img/apple-touch-icon-76x76.png">
<link rel="apple-touch-icon" sizes="152x152" href="<?php echo $domain; ?>/img/apple-touch-icon-152x152.png">
<?php /*?><link rel="canonical" href="<?php echo $canonical; ?>" /><?php */?>
<!--Style CSS -->
<?php if($_SERVER['REQUEST_URI']== "/beta/about-us" || $_SERVER['REDIRECT_URL']== "/beta/about-us"){?>
<link rel="stylesheet" href="<?php echo $domain; ?>/css/team-css.css">
<?php } ?>
<link href="<?php echo $domain; ?>/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo $domain; ?>/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo $domain; ?>/css/style.css" rel="stylesheet">
<link href="<?php echo $domain; ?>/css/dev.css" rel="stylesheet">
<link href="<?php echo $domain; ?>/css/responsive.css" rel="stylesheet">

<script type="text/javascript" src="<?php echo $domain; ?>/js/skype-uri.js"></script>
<?php if($_SERVER['REQUEST_URI']== "/beta/" ){ //|| $_SERVER['REQUEST_URI']== "/portfolio"?>
<link href="<?php echo $domain; ?>/css/slider.css" rel="stylesheet">
<link href="<?php echo $domain; ?>/css/sass-compiled.css" rel="stylesheet">
<?php } ?>

<?php if($_SERVER['REQUEST_URI']== "/beta/contact" || $_SERVER['REDIRECT_URL']== "/beta/contact"){?>
<script src='https://www.google.com/recaptcha/api.js'></script>
<?php } ?>
</head>
<?php
if(isset($_GET['gclid']) && !empty($_GET['gclid'])){
$gclid = $_GET['gclid'];
$pagename = $_SERVER['PHP_SELF'];
$sqltrack_user = "INSERT INTO ph_track_user (page_name,glick_id) VALUES ('$pagename', '$gclid')";
	if ($conn->query($sqltrack_user) === TRUE) {/*echo "New record src created successfully";*/}
	else {/*echo "Error: " . $sqlu . "<br>" . $conn->error;*/}
}

 ?>
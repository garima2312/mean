<?php 
session_start();
#PRINT_R($_SESSION);
#ECHO "<PRE>";PRINT_R($_COOKIE);
require 'config.php';
 
/*if(isset($_SESSION['uid'])&&($_SESSION['uid']!="")){
 $logeduserid=$_SESSION['uid'];  }else{
    $logeduserid="";
} */

if(isset($_COOKIE['user_id'])){ $_COOKIE['user_id']; $logeduserid=$_COOKIE['user_id']; } else{ $logeduserid=$_SESSION["uid"]; } ob_start(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>PSD2HTML5</title>
    <!-- Custom CSS -->
    <link href="dist/css/main.css" rel="stylesheet">
    <link href="<?php echo $domain; ?>/dist/css/animate.css" rel="stylesheet">
    <!-- <link href="<?php echo $domain; ?>/dist/css/dev.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="dist/css/ammap.css" type="text/css" media="all" />
    <!-- jQuery scripts -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="dist/js/ammap.js"></script>
<script src="<?php echo $domain; ?>/dist/js/worldLow.js"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
<script src="<?php echo $domain; ?>/dist/js/bootstrap.min.js"></script>
</head>
<body id="Home-Page" class="preload" itemscope="Home-Page" itemtype="http://schema.org/WebPage">
<div itemscope itemtype="http://schema.org/LocalBusiness">
<!--Header-->
    <header class="header">
    <!--Navigation-->
    <div class="navigation-outer">
        <nav class="navbar navigation">
          <div class="container-fluid">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="index.php"><img itemprop="image" src="<?php echo $domain; ?>/img/logo-light.svg" height="45" alt="psd2html5"></a>
                <p class="logo-side-text">Best PSD to HTML Conversion agency</p>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
              <ul class="nav navbar-nav navbar-right">
                <li><a href="about.html">About</a></li>
                <li class="drop-down">
                    <a href="#">Services <span></span></a>
                    <div class="dropdwn-outer">
                        <div class="service-category">
                            <ul class="category-main">
                                <li class="active"><a href="#submenu1">Front End Development</a></li>
                                <li><a href="#submenu2">CMS Development</a></li>
                                <li><a href="#submenu3">E-Commerce Development</a></li>
                                <li><a href="#submenu4">Dedicated Team</a></li>
                                <li><a href="#submenu5">UI/UX Design</a></li>
                                <li><a href="#submenu6">PHP Developer</a></li>
                                <li><a href="#submenu7">SEO Executive</a></li>
                            </ul>
                            <div class="dd-sub-category active" id="submenu1">
                                <div class="submenu-outer">
                                    <h4>Psd to HTML </h4>
                                    <ul class="dd-submenu">
                                        <li><a href="#">PSD to HTML Conversion</a></li>
                                        <li><a href="#">PSD to Responsive HTML</a></li>
                                        <li><a href="#">PSD to Email</a></li>
                                        <li><a href="#">PSD to Foundation</a></li>
                                        <li><a href="#">PSD to Bootstrap</a></li>
                                        <li><a href="#">PSD to Materialize</a></li>
                                        <li><a href="#">Sketch to HTML</a></li>
                                        <li><a href="#">Sketch to Responsive HTML</a></li>
                                    </ul>
                                    <ul class="dd-submenu">
                                        <li><a href="#">PSD to HTML Conversion</a></li>
                                        <li><a href="#">PSD to Responsive HTML</a></li>
                                        <li><a href="#">PSD to Email</a></li>
                                        <li><a href="#">PSD to Foundation</a></li>
                                        <li><a href="#">PSD to Bootstrap</a></li>
                                        <li><a href="#">PSD to Materialize</a></li>
                                        <li><a href="#">Sketch to HTML</a></li>
                                        <li><a href="#">Sketch to Responsive HTML</a></li>
                                    </ul>
                                </div>
                                <div class="dd-banner">
                                    <div class="offer-inner">
                                        <div class="offer-img">
                                            <img src="<?php echo $domain; ?>/img/offer-img.jpg" class="img-responsive" width="362" alt="">
                                        </div>
                                        <div class="offer-detail">
                                            <h1 class="percentage">20% <span>DISCOUNT</span></h1>
                                            <h2><span>FOR NEW</span> CUSTOMER</h2>
                                            <p>Please use <strong>"P2H20"</strong> coupon code. </p>
                                            <a href="#" class="common-btn white-btn">order now </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="dd-sub-category" id="submenu2">
                                <div class="submenu-outer">
                                    <h4>CMS Development</h4>
                                    <ul class="dd-submenu">
                                        <li><a href="#">PSD to HTML Conversion</a></li>
                                        <li><a href="#">PSD to Responsive HTML</a></li>
                                        <li><a href="#">PSD to Email</a></li>
                                        <li><a href="#">PSD to Foundation</a></li>
                                        <li><a href="#">PSD to Bootstrap</a></li>
                                        <li><a href="#">PSD to Materialize</a></li>
                                        <li><a href="#">Sketch to HTML</a></li>
                                        <li><a href="#">Sketch to Responsive HTML</a></li>
                                    </ul>
                                    <ul class="dd-submenu">
                                        <li><a href="#">PSD to HTML Conversion</a></li>
                                        <li><a href="#">PSD to Responsive HTML</a></li>
                                        <li><a href="#">PSD to Email</a></li>
                                        <li><a href="#">PSD to Foundation</a></li>
                                        <li><a href="#">PSD to Bootstrap</a></li>
                                        <li><a href="#">PSD to Materialize</a></li>
                                        <li><a href="#">Sketch to HTML</a></li>
                                        <li><a href="#">Sketch to Responsive HTML</a></li>
                                    </ul>
                                </div>
                                <div class="dd-banner">
                                    <div class="offer-inner">
                                        <div class="offer-img">
                                            <img src="<?php echo $domain; ?>/img/offer-img.jpg" class="img-responsive" width="362" alt="">
                                        </div>
                                        <div class="offer-detail">
                                            <h1 class="percentage">20% <span>DISCOUNT</span></h1>
                                            <h2><span>FOR NEW</span> CUSTOMER</h2>
                                            <p>Please use <strong>"P2H20"</strong> coupon code. </p>
                                            <a href="#" class="common-btn white-btn">order now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li><a href="#">Portfolio</a></li>
                <li><a href="#">Blog</a></li>
                <!--<li><a href="#">Contact</a></li>-->

<?php /*$sql_uid = "SELECT *  FROM ph_users WHERE uid ='$logeduserid'";
			$result_uid = mysqli_query($conn, $sql_uid);
			if (mysqli_num_rows($result_uid) > 0) {
				while($row_sb = mysqli_fetch_assoc($result_uid)) {
				$profile_pic =$row_sb["profile_pic"];
					if(empty($profile_pic)){
					$gravatar_link = 'https://www.gravatar.com/avatar/' . md5($row_sb['email']) .'?d=404&s=200';
											  $headers = @get_headers($gravatar_link);
												if (!preg_match("|200|", $headers[0])) {
													echo '<img id="tprofile_pic" src="'.$domain.'/img/user-img.jpg">';
												} else {
													echo '<img id="tprofile_pic"  src="' . $gravatar_link . '" />';
												}
					}
					else{
					echo '<img id="tprofile_pic" src="'.$domain.'/profile_pics/p2h5profile_pic_'.$logeduserid.'/'.$profile_pic.'">';
					}
}
}*/ ?>
                <!--<li class="client-area"><a href="#" class="border-button button">Client area</a></li>-->
              <?php //if($logeduserid!="") { #echo $_SERVER['REQUEST_URI']; ?>
<?php //if($_SERVER['REQUEST_URI']== '/v2/myprofile'){ echo 'client-area'; } ?> 
<?php //if($_SERVER['REQUEST_URI']== '/v2/myorders'){ echo 'client-area'; } ?>
<!--<li><a href="myprofile">My Profile</a></li>
<li class="client-area"><a href="myorders" class="border-button">My Orders</a></li> -->
      <?php if($logeduserid!="") { ?>
<div class="login-user pull-right">
<p  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
<span>
<?php $sql_uid = "SELECT *  FROM ph_users WHERE uid ='$logeduserid'";
			$result_uid = mysqli_query($conn, $sql_uid);
			if (mysqli_num_rows($result_uid) > 0) {
				while($row_sb = mysqli_fetch_assoc($result_uid)) {
				$profile_pic =$row_sb["profile_pic"];
					if(empty($profile_pic)){
					$gravatar_link = 'https://www.gravatar.com/avatar/' . md5($row_sb['email']) .'?d=404&s=200';
											  $headers = @get_headers($gravatar_link);
												if (!preg_match("|200|", $headers[0])) {
													echo '<img id="tprofile_pic" src="'.$domain.'/img/user-img.jpg">';
												} else {
													echo '<img id="tprofile_pic"  src="' . $gravatar_link . '" />';
												}
					}
					else{
					echo '<img id="tprofile_pic" src="'.$domain.'/profile_pics/p2h5profile_pic_'.$logeduserid.'/'.$profile_pic.'">';
					}
}
} ?>
</span>&nbsp;&nbsp;
<i class="fa fa-caret-down"></i></p>
<div class="dropdown-menu" role="menu">
	<ul class="lg-sec">
    	<li><a href="<?php echo $domain; ?>/myorders"><i class="fa fa-bars"></i>&nbsp;My Orders</a></li>
		<li><a href="<?php echo $domain; ?>/myprofile"><i class="fa fa-user"></i> &nbsp;My Profile</a></li>
        <li><a id="logout" href="<?php echo $domain; ?>/logout"><i class="fa fa-sign-out"></i> &nbsp;Logout</a></li>
    </ul>
</div>
</div>
<?php }else{ ?>
<!--<li><a href="logout.php">Logout</a></li> -->
		<li><a href="#">Contact</a></li>
		<li class="client-area"><a href="#" class="border-button">Client area</a></li>
		<a href="mailto:support@psd2html5.co" class="call-btn"><span>Email: support@psd2html5.co</span></a>
                   <?php } ?>

<!-- <li><a href="<?php echo $domain; ?>/myprofile"><i class="fa fa-user"></i> &nbsp;My Profile</a></li> -->
              </ul>
            </div>
          </div>
        </nav>
        </div>
        <div class="hiden-nav"></div>

    </header>

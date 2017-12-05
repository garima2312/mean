<?php session_start();
require 'config.php';
/*if(isset($_SESSION['uid'])&&($_SESSION['uid']!="")){
 $logeduserid=$_SESSION['uid'];  }else{
 $logeduserid="";
}*/
 ?>
<?php  

if(isset($_COOKIE['user_id'])){ $_COOKIE['user_id']; $logeduserid=$_COOKIE['user_id'];} else{$logeduserid=$_SESSION["uid"]; } ob_start(); ?>
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
    <link href="<?php echo $domain; ?>/dist/css/main.css" rel="stylesheet">
    <link href="<?php echo $domain; ?>/dist/css/animate.css" rel="stylesheet">
    <!--<link href="<?php echo $domain; ?>/dist/css/dev.css" rel="stylesheet">-->
    <link rel="stylesheet" href="dist/css/ammap.css" type="text/css" media="all" />
    <!-- jQuery scripts -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyACLN9RVnTKbUhEzBFK9J3d5GEfw8fmLR4">
</script>
<script src="<?php echo $domain; ?>/dist/js/ammap.js"></script>
<script src="<?php echo $domain; ?>/dist/js/worldLow.js"></script>
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
              <a class="navbar-brand" href="index"><img itemprop="image" src="<?php echo $domain; ?>/img/logo-light.svg" height="45" alt="psd2html5"></a>
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
                <li><a href="#">Contact</a></li>
                <!--<li class="client-area"><a href="#" class="border-button button">Client area</a></li>-->
              
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
<?php }else{  ?>
		 <li class="client-area"><a href="login" class="border-button">Client area</a></li>
 <a href="mailto:support@psd2html5.co" class="call-btn"><span>Email: support@psd2html5.co</span></a>
                   <?php  } ?>

              </ul>
            </div>
          </div>
        </nav>
        </div>
        <div class="hiden-nav"></div>

        <div class="main-slider">
            <div id="myCarousel" class="carousel slide myCarousel carousel-fade" data-ride="carousel" data-interval="false" data-pause="false">
              <!-- Indicators -->
              <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <!--<li data-target="#myCarousel" data-slide-to="2"></li>
                <li data-target="#myCarousel" data-slide-to="3"></li>-->
              </ol>

              <!-- Wrapper for slides -->
              <div class="carousel-inner">
                <div class="item active">
                    <div class="slider-inn">
                        <div class="text-anim">
                            <div class="dot">.css</div><div class="dot2">{}</div><div class="dot3">bootstrap</div><div class="dot4">.html</div><div class="dot5"></div><div class="dot6">#</div><div class="dot7"><img src="<?php echo $domain; ?>/img/element-7.png" width="68" alt=""></div><div class="dot8">.less</div><div class="dot9">.scss</div><div class="dot10">html5</div>
                        </div>
                    <div class="container">
                        <div class="slider-content white-text">
                            <div class="row">
                                <div class="col-sm-4 hidden-sm">
                                    <div class="slide-element divider-elem">
                                        <svg width="70" height="70" viewBox="0 0 100 100" class="
                                             sparkle-left">
                                          <g class="group" opacity="0.8">
                                            <g class="large">
                                              <path id="large" d="M41.25,40 L42.5,10 L43.75,40 L45, 41.25 L75,42.5 L45,43.75 L43.75,45 L42.5,75 L41.25,45 L40,43.75 L10,42.5 L40,41.25z " fill="white" />
                                            </g>
                                            <g class="large-2" transform="rotate(45)">
                                              <use xlink:href="#large" />
                                            </g>
                                            <g class="small">
                                              <path id="small" d="M41.25,40 L42.5,25 L43.75,40 L45,41.25 L60,42.5 L45,43.75 L43.75,45 L42.5,60 L41.25,45 L40,43.75 L25,42.5 L40,41.25z" fill="white" />
                                            </g>
                                          </g>
                                        </svg>
                                        <svg width="70" height="70" viewBox="0 0 100 100" class="
                                             sparkle-right">
                                          <g class="group" opacity="0.8">
                                            <g class="sparkle">
                                              <path id="large" d="M41.25,40 L42.5,10 L43.75,40 L45, 41.25 L75,42.5 L45,43.75 L43.75,45 L42.5,75 L41.25,45 L40,43.75 L10,42.5 L40,41.25z " fill="white" />
                                            </g>
                                            <g class="sparkle-2" transform="rotate(45)">
                                              <use xlink:href="#large" />
                                            </g>
                                            <g class="sparkleSmall">
                                              <path id="small" d="M41.25,40 L42.5,25 L43.75,40 L45,41.25 L60,42.5 L45,43.75 L43.75,45 L42.5,60 L41.25,45 L40,43.75 L25,42.5 L40,41.25z" fill="white" />
                                            </g>
                                          </g>
                                        </svg>
                                        <img src="<?php echo $domain; ?>/img/slide-element1.png" alt="" width="320" id="elemnt-1">
                                        <span class="bg-shadow"></span>
                                    </div>
                                </div>
                                <div class="col-md-8 col-sm-12">
                                    <div class="slider-text">
                                        <h2 class="wow fadeIn" data-wow-duration="1s" data-wow-delay="0s">Turn your SKETCH Design to </h2>
                                        <h1 class="wow fadeIn" data-wow-duration="1s" data-wow-delay="0s">Responsive HTML</h1>
                                        <p>100% pixel perfect code with Retina ready.</p>
                                        <a href="#" class="common-btn white-btn wow fadeIn" data-wow-duration="1s" data-wow-delay="0.5s" data-toggle="modal" data-target="#get-started"><span>get started now</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
                <!--<div class="item">
                    <div class="slider-inn">
                    <div class="slider-outer">
                        <div class="slider-content white-text">
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="slide-element">
                                        <img src="<?php echo $domain; ?>/img/slide-element2.png" alt="" width="527">
                                    </div>
                                </div>
                                <div class="col-sm-7">
                                    <div class="slider-text no-pading">
                                        <h1>PSD 2 <strong>responsive Development</strong></h1>
                                        <p>We adapt your website for all devices</p>
                                        <a href="#" class="common-btn white-btn"><span>get started now</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>-->
                <div class="item">
                    <div class="slider-inn">
                    <div class="slider-outer">
                        <div class="text-anim text-anim2">
                            <div class="cmsdot1">Joomla</div><div class="cmsdot2">Wordpress</div><div class="cmsdot3">WooCommerce</div><div class="cmsdot4">Email Template</div><div class="cmsdot5">Magento</div><div class="cmsdot6">.php</div><div class="cmsdot7">Shopify</div>
                        </div>
                        <div class="slider-content white-text slide-3">
                            <div class="row">
                                <div class="col-sm-6 hidden-sm inline-block">
                                    <div class="slide-element slide-elem-3 divider-elem">
                                        <!--<img src="<?php echo $domain; ?>/img/slide-element3.png" alt="" width="500">-->
                                        <div class="cms-anim">
                                            <div class="center-img"><img src="<?php echo $domain; ?>/img/cms-center-img.png" width="187" alt=""><img src="<?php echo $domain; ?>/img/circle-img.png" width="279" class="circle-img" alt=""></div>
                                        <div class="cms-side-img">
                                            <span><img src="<?php echo $domain; ?>/img/cms-icon1.png" width="72" alt=""></span>
                                            <span><img src="<?php echo $domain; ?>/img/cms-icon2.png" width="72" alt=""></span>
                                            <span><img src="<?php echo $domain; ?>/img/cms-icon3.png" width="72" alt=""></span>
                                            <span><img src="<?php echo $domain; ?>/img/cms-icon4.png" width="72" alt=""></span>
                                            <span><img src="<?php echo $domain; ?>/img/cms-icon5.png" width="72" alt=""></span>
                                            <span><img src="<?php echo $domain; ?>/img/cms-icon6.png" width="72" alt=""></span>
                                            <span><img src="<?php echo $domain; ?>/img/cms-icon7.png" width="72" alt=""></span>
                                        </div>
                                    </div>
                                        <div class="slide-2-img">
                                            <img src="<?php echo $domain; ?>/img/slide-element3.png" width="400">
                                        </div>

                                </div>
                                </div><div class="col-md-6 col-sm-12 inline-block">
                                    <div class="slider-text">
                                        <h1 class="wow zoomIn" data-wow-duration="1s" data-wow-delay="0s">PSD to CMS <br>conversion</h1>
                                        <p>SEO friendly code for high ranking. </p>
                                        <a href="#" class="common-btn white-btn wow fadeIn" data-wow-duration="1s" data-wow-delay="0.5s" data-toggle="modal" data-target="#get-started"><span>get started now</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
                <!--<div class="item">
                    <div class="slider-inn">
                    <div class="container">
                        <div class="slider-content white-text">
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="slide-element divider-elem">
                                        <img src="<?php echo $domain; ?>/img/slide-element4.png" alt="" width="410">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="slider-text">
                                        <h2>Turn your PSD 2 Responsive</h2>
                                        <h1><strong>Wordpress</strong></h1>
                                        <p>100% pixel perfect code with Retina ready.</p>
                                        <a href="#" class="common-btn white-btn"><span>get started now</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    </div>-->

              </div>
            </div>
        </div>

    </header>

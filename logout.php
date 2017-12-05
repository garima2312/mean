<?php 
require 'config.php';
include('header.php');
unset($_SESSION["uid"]); 
$_SESSION["uid"]='';
setcookie("user_id", "", -1);
//var_dump($_COOKIE);
session_destroy();
ob_flush();

?>
<div style="height:50px;"></div>
<div class="inner-section">
	<div class="container">
    	<div class="thanks">
        	<h3>Logout <span style="color:#CC0000;">successfully</span></h3>
            <p>You have successfully logged out from PSD2HTML5.CO, Please visit Again :)</p>
        </div>
    </div>
</div>

<?php header( "refresh:2;url=".$domain );?>

<?php include('include/footer.php'); 

echo '<script type="text/javascript">
           window.location = "index"
      </script>';
?>

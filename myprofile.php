<?php 
$title= "My Profile | PSD2HTML5.CO";
$canonical = "https://www.psd2html5.co/myprofile/";
require 'config.php';
include('header_inner.php');
if($logeduserid=="") { header("location:https://www.psd2html5.co");} else{$logeduserid;}
include('navigation_inner.php'); ?>
<?php 
$sql_uid = "SELECT *  FROM ph_users WHERE uid ='$logeduserid'";
$result_uid = mysqli_query($conn, $sql_uid);
if (mysqli_num_rows($result_uid) > 0) {
	while($row_sb = mysqli_fetch_assoc($result_uid)) {
?>

<div class="inner-section order-sec">
	<div class="container">
    	<div class="user-pro">
        <h3>User Profile</h3>
            <div class="pro-container clearfix">
            	<div class="pro-img pull-left">
		<?php 	 $profile_pic = $row_sb["profile_pic"];
					if(empty($profile_pic)){
					$gravatar_link = 'https://www.gravatar.com/avatar/' . md5($row_sb['email']) .'?d=404&s=200';
											  $headers = @get_headers($gravatar_link);
												if (!preg_match("|200|", $headers[0])) {
													echo '<img  src="'.$domain.'/img/user-img.jpg">';
												} else {
													echo '<img  src="' . $gravatar_link . '" />';
												}
					}
					else{
					echo '<img src="'.$domain.'/profile_pics/p2h5profile_pic_'.$logeduserid.'/'.$profile_pic.'">';
					}?>
                    <div class="edit-link"><a class="edit_pr" href="#" data-toggle="modal" data-target="#exampleModal1"><i class="fa fa-pencil fa-fw"></i> Edit Profile</a></div>
                </div>
                <div class="pro-info pull-left clearfix">
                	<div class="fields pull-left">
                    	<h4>First Name</h4>
                        <p><?php echo $row_sb["name"]; ?></p>
                    </div>
					<div class="fields pull-left">
                    	<h4>Last Name</h4>
                        <p><?php echo $row_sb["lname"]; ?></p>
                    </div>
                    
                    <div class="fields pull-left">
                    	<h4>Email Address </h4>
                        <p><?php echo $row_sb["email"]; ?></p>
                    </div>
                    <div class="fields pull-left">
                    	<h4>Phone Number </h4>
                        <p><?php echo $row_sb["contact_number"];?></p>
                    </div>
					
                    <div class="fields pull-left">
                    	<h4>Address</h4>
                        <p><?php echo $row_sb["address"]; ?> </p>
                    </div>
					<div class="fields pull-left">
                    	<h4>City</h4>
                        <p><?php echo $row_sb["city"]; ?> </p>
                    </div>
					<div class="fields pull-left">
                    	<h4>State</h4>
                        <p><?php echo $row_sb["state"]; ?> </p>
                    </div>
					<div class="fields pull-left">
                    	<h4>Zipcode</h4>
                        <p><?php echo $row_sb["zipcode"]; ?> </p>
                    </div>
                    
                    <div class="fields pull-left">
                    	<h4>Country</h4>
                        <p><?php echo $row_sb["country"];?></p>
                    </div>
                    
                    <div class="ch-pass">
                    	<a href="#" data-toggle="modal" data-target="#exampleModal2"><i class="fa fa-lock"></i> Change Password</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog recept">
    <div class="modal-content">
	<form name="p2h5editprofile" id="p2h5editprofile" method="post" action=""  enctype="multipart/form-data">
     	<div class="rec-inner">
        	<div class="res-header clearfix br-ch">
            	<h4>Edit Profile</h4>
            </div>
            <div class="inpt-field clearfix">
            	<div class="fiel-left pull-left">
                	<h5>First Name</h5>
                    <input type="text" class="add-info" id="urfname" name="urfname" value="<?php echo $row_sb["name"]; ?>">
                </div>
				<div class="fiel-left pull-left">
                	<h5>Last Name</h5>
                    <input type="text" class="add-info" id="urlname" name="urlname" value="<?php echo $row_sb["lname"]; ?>">
                </div>
                
                <div class="fiel-left pull-left">
                	<h5>Email Addres</h5>
                    <input type="text" class="add-info" id="uremail" name="uremail" value="<?php echo $row_sb["email"]; ?>">
                </div>
                
                <div class="fiel-left pull-left">
                	<h5>Phone Number</h5>
                    <input type="text" class="add-info" id="urphone" name="urphone" value="<?php echo $row_sb["contact_number"];?>">
                </div>
                <div class="fiel-left pull-left">
                	<h5>Address </h5>
                    <input type="text" class="add-info" name="uraddress" id="uraddress" value="<?php echo $row_sb["address"]; ?>">
                </div>
				<div class="fiel-left pull-left">
                	<h5>City </h5>
                    <input type="text" class="add-info" name="urcity" id="urcity" value="<?php echo $row_sb["city"]; ?>">
                </div>
				<div class="fiel-left pull-left">
                	<h5>State </h5>
                    <input type="text" class="add-info" name="urstate" id="urstate" value="<?php echo $row_sb["state"]; ?>">
                </div>
				<div class="fiel-left pull-left">
                	<h5>Zipcode </h5>
                    <input type="text" class="add-info" name="urzipcode" id="urzipcode" value="<?php echo $row_sb["zipcode"]; ?>">
                </div>
                <div class="fiel-left pull-left">
                	<h5>Country</h5>
					<select name="urcountry"  class="add-info" id="urcountry"> 
<option value=''>--Choose Country--</option>
    <?php
        $array_statecd = array("Afghanistan","Albania","Algeria","American Samoa","Andorra","Angola","Anguilla","Antarctica","Antigua and Barbuda","Argentina","Armenia","Aruba","Australia","Austria","Azerbaijan","Bahamas","Bahrain","Bangladesh","Barbados","Belarus","Belgium","Belize","Benin","Bermuda","Bhutan","Bolivia","Bonaire","Bosnia and Herzegovina","Botswana","Bouvet Island","Brazil","British Indian Ocean Territory","Brunei Darussalam","Bulgaria","Burkina Faso","Burundi","Cambodia","Cameroon","Canada","Cape Verde","Cayman Islands","Central African Republic","Chad","Chile","China","Christmas Island","Cocos (Keeling) Islands","Colombia","Comoros","Congo","Democratic Republic of the Congo","Cook Islands","Costa Rica","Croatia","Cuba","Curacao","Cyprus","Czech Republic","Cote d'Ivoire","Denmark","Djibouti","Dominica","Dominican Republic","Ecuador","Egypt","El Salvador","Equatorial Guinea","Eritrea","Estonia","Ethiopia","Falkland Islands (Malvinas)","Faroe Islands","Fiji","Finland","France","French Guiana","French Polynesia","French Southern Territories","Gabon","Gambia","Georgia","Germany","Ghana","Gibraltar","Greece","Greenland","Grenada","Guadeloupe","Guam","Guatemala","Guernsey","Guinea","Guinea-Bissau","Guyana","Haiti","Heard Island and McDonald Mcdonald Islands","Holy See (Vatican City State)","Honduras","Hong Kong","Hungary","Iceland","India","Indonesia","Islamic Republic of Iran","Iraq","Ireland","Isle of Man","Israel","Italy","Jamaica","Japan","Jersey","Jordan","Kazakhstan","Kenya","Kiribati","Democratic People's Republic of Korea","Republic of Korea","Kuwait","Kyrgyzstan","Lao People's Democratic Republic","Latvia","Lebanon","Lesotho","Liberia","Libya","Liechtenstein","Lithuania","Luxembourg","Macao","Republic of Macedonia the Former Yugoslav","Madagascar","Malawi","Malaysia","Maldives","Mali","Malta","Marshall Islands","Martinique","Mauritania","Mauritius","Mayotte","Mexico","Federated States of Micronesia","Republic of Moldova","Monaco","Mongolia","Montenegro","Montserrat","Morocco","Mozambique","Myanmar","Namibia","Nauru","Nepal","Netherlands","New Caledonia","New Zealand","Nicaragua","Niger","Nigeria","Niue","Norfolk Island","Northern Mariana Islands","Norway","Oman","Pakistan","Palau","State of Palestine","Panama","Papua New Guinea","Paraguay","Peru","Philippines","Pitcairn","Poland","Portugal","Puerto Rico","Qatar","Romania","Russian Federation","Rwanda","Reunion","Saint Barthalemy","Saint Helena","Saint Kitts and Nevis","Saint Lucia","Saint Martin (French part)","Saint Pierre and Miquelon","Saint Vincent and the Grenadines","Samoa","San Marino","Sao Tome and Principe","Saudi Arabia","Senegal","Serbia","Seychelles","Sierra Leone","Singapore","Sint Maarten (Dutch part)","Slovakia","Slovenia","Solomon Islands","Somalia","South Africa","South Georgia and the South Sandwich Islands","South Sudan","Spain","Sri Lanka","Sudan","Suriname","Svalbard and Jan Mayen","Swaziland","Sweden","Switzerland","Syrian Arab Republic","Taiwan Province of China","Tajikistan","United Republic of Tanzania","Thailand","Timor-Leste","Togo","Tokelau","Tonga","Trinidad and Tobago","Tunisia","Turkey","Turkmenistan","Turks and Caicos Islands","Tuvalu","Uganda","Ukraine","United Arab Emirates","United Kingdom","United States","United States Minor Outlying Islands","Uruguay","Uzbekistan","Vanuatu","Venezuela","Viet Nam","British Virgin Islands","US Virgin Islands","Wallis and Futuna","Western Sahara","Yemen","Zambia","Zimbabwe","Aland Islands");
        	foreach( $array_statecd as $value ){
        		$checked = ($row_sb["country"] == $value) ? "selected" : "";
          		echo "<option " . $checked . " value=\"" . $value. "\">".$value."</option>";
       		}
       		unset($value);
        ?>
</select>
                </div>
              
                <div class="fiel-left pull-left full-width">
                	<h5>Upload Pic</h5>
                    <span class="clearfix up-loader"><span class="file-name"><?php echo $row_sb["profile_pic"]; ?></span> <span class="browse-btn-pp pull-right">Browse</span></span>
                    <input id="file-upload1" name="profile_pic" class="file-upload" type="file" accept="image/*"  >
					<input name="profile_pic_old"  type="hidden" value="<?php echo $row_sb["profile_pic"]; ?>" >
					<input type="hidden" name="eduser" value="<?php echo $logeduserid;?>" />
                </div>
                
            </div>
            <p id="edpferoor" style="display:none;">There were errors on the form, please make sure all fields are fill out correctly.</p>
			<p id="edpfsuccess" style="display:none;"></p>
        </div>
        <div class="pp-footer">
        	<ul>
            	<li><button type="submit" id="updprof">Upadate Profile</button><p class="image_loading">&nbsp;</p></li>
                <li><button class="canprof" type="button" data-dismiss="modal" aria-label="Close">Cancel</button>
                </li>
            </ul>
        </div>
	</form>
    </div>
  </div>
</div>
<?php }
			}		
			?>
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog recept">
    <div class="modal-content">
	<form name="p2h5chpass" id="p2h5chpass" method="post" action="">
     	<div class="rec-inner">
        	<div class="res-header clearfix br-ch">
            	<h4>Change Password</h4>
            </div>
			
            <div class="inpt-field clearfix">
            	<div class="fiel-left full-width">
                	<h5>Current Password</h5>
                    <input name="currpass" type="password" class="add-info" placeholder="**************">
                </div>
                
                <div class="fiel-left pull-left">
                	<h5>New Password</h5>
                    <input id="myPassword" type="password" name="newpass" class="add-info password-strength2" placeholder="New Password">
                </div>
                
                <div class="fiel-left pull-left">
                	<h5>Confirm Password </h5>
                    <input type="password" name="conpass" class="add-info" placeholder="Confirm Password">
					<input type="hidden" name="cutuser" value="<?php echo $logeduserid; ?>" />
                </div>
            </div>
           <p class="chresponse"></p>
        </div>
        <div class="pp-footer">
        	<ul>
            	<li><button id="p2h5passub" name="p2h5passub" type="submit" >Upadate Password</button></li>
                <li><button type="button" class="cncpass" data-dismiss="modal" aria-label="Close">Cancel</button></li>
            </ul>
        </div>
		 </form>
    </div>
  </div>
</div>
<style>
.chresponse {
    color: #5db85b;
	text-align:center;
}
</style>
<script >
	$(document).ready(function() {
    $(".browse-btn-pp").on('click', function() {$("#file-upload1").click();});
	$("#file-upload1").on('change', function() {val=$("#file-upload1").val();$(".file-name").text(val);	});
});	
</script>
<?php include('footer.php');?>

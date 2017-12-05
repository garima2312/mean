<?php  require 'config.php'; ?>
<span id='about'> </span>
<style>
#error {
	color:red;
	font-size:20px;
	display:none;
}
.needsfilled {
	background:rgb(247,173,173);
	color:white;
}

.regbutton{background:#5f6267!important;}
.preloader-p2h{height:80%;position:absolute;width:100%;left:0%;bottom:112px;text-align:center;-webkit-transition:height 0.8s;-moz-transition:height 0.8s;transition:height 0.8s;height:0;overflow:hidden;background:#00bcd4;background:-moz-linear-gradient(top, #00bcd4 0%, #58dcab 100%);background:-webkit-gradient(linear, left top, left bottom, color-stop(0%,#00bcd4), color-stop(100%,#58dcab));background:-webkit-linear-gradient(top, #00bcd4 0%,#58dcab 100%);background:-o-linear-gradient(top, #00bcd4 0%,#58dcab 100%);background:-ms-linear-gradient(top, #00bcd4 0%,#58dcab 100%);background:linear-gradient(to bottom, #00bcd4 0%,#58dcab 100%);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#00bcd4', endColorstr='#58dcab',GradientType=0);}
.preloader-p2h.popdiv{height:90%;}
.pre{width:85%;margin:auto;padding-top:5%;}
.progress{height:24px;border-radius:20px;position:relative;-moz-box-shadow:0 0 2px #888;-webkit-box-shadow:0 0 2px #888;box-shadow:0 0 2px #888;}
.progress-bar{background-color:#4feaec}
.loader-btn{background:url(img/loader-btn.png) no-repeat;width:78px;height:78px;position:absolute;top:-28px;}
.pre span{font-family:'Roboto', sans-serif;font-size:14px;font-weight:light;}
.loader-cont h4{font-family:'Roboto', sans-serif;font-size:24px;font-weight:normal;margin-top:30px;}
.loader-cont p, .loader-cont p a{font-family:'Roboto', sans-serif !important;font-size:16px !important;font-weight:light;color:#fff;}
.loader-cont p a{text-decoration:underline;}
.loader-cont p a:hover{text-decoration:none;}
.textTitle{top:0;width:100%;height:100%;display:table;}
.verti-center{display:table-cell;width:100%;height:100%;vertical-align:middle;}

</style>
<footer class="footer">
<div class="container">
    <div class="row">
        <div class="col-md-3 col-xs-4">
            <div class="footer-nav">
                <h4>Frontend <span class="pls pull-right"><i class="fa fa-plus"></i></span></h4>
                <ul>
                    <li><a href="#">PSD to HTML Conversion</a></li>
                    <li><a href="#">PSD to Responsive HTML</a></li>
                    <li><a href="#">PSD to Responsive HTML</a></li>
                    <li><a href="#">PSD to Responsive HTML</a></li>
                    <li><a href="#">PSD to Bootstrap</a></li>
                    <li><a href="#">PSD to Materialize</a></li>
                    <li><a href="#">Sketch to HTML</a></li>
                    <li><a href="#">Sketch to Responsive HTML</a></li>
                </ul>
            </div>
        </div>
        <div class="col-md-3 col-xs-4">
            <div class="footer-nav">
                <h4>CMS <span class="pls pull-right"><i class="fa fa-plus"></i></span></h4>
                <ul>
                    <li><a href="#">PSD to WordPress</a></li>
                    <li><a href="#">PSD to Responsive WP</a></li>
                    <li><a href="#">PSD to Joomla</a></li>
                    <li><a href="#">PSD to Responsive Joomla</a></li>
                    <li><a href="#">PSD to Silverstripe</a></li>
                    <li><a href="#">PSD to Drupal</a></li>
                    <li><a href="#">PSD to TYPO3</a></li>
                    <li><a href="#">HTML to WordPress</a></li>
                </ul>
            </div>
        </div>
        <div class="col-md-3 col-xs-4">
            <div class="footer-nav">
                <h4>Ecommerce <span class="pls pull-right"><i class="fa fa-plus"></i></span></h4>
                <ul>
                    <li><a href="#">PSD to WooCommerce</a></li>
                    <li><a href="#">PSD to Magento</a></li>
                    <li><a href="#">PSD to Prestashop</a></li>
                    <li><a href="#">PSD to Opencart</a></li>
                    <li><a href="#">PSD to Shopify</a></li>
                    <li><a href="#">PSD to BigCommerce</a></li>
                    <li><a href="#">PSD to CS Cart</a></li>
                    <li><a href="#">PSD to Cubecart</a></li>
                </ul>
            </div>
        </div>
        <div class="col-md-3 col-xs-12">
            <div class="footer-nav clearfix">
                <h4>Contact </h4>
                <div class="footer-address">
                    <h5>Sales &amp; Support</h5>
                    <p>113-03 101st avenue, Richmond Hill,<br> New York 11419, USA</p>
                    <p>Phone :<a href="#"> +1-718-303-2041</a></p>
                    <p>Email  : <a href="#">support@psd2html5.co</a></p>
                </div>
                <div class="footer-address">
                    <h5>Development Center</h5>
                    <p>SCF - 63, 2nd Floor, Phase - 11 Mohali<br> (Punjab) INDIA</p>
                </div>
            </div>
        </div>

    </div>
    <div class="footer-bottom text-center">
        <a href="index.html"><img src='img/logo-grey.svg' width="95" alt=""></a>
        <p class="copyright">&copy; Copyrights 2017 All Rights Reserved</p>
        <p><span itemprop="name">PSD2HTML5</span> is a sister company of Web Experts Online <br><a href="#">FAQ?</a><a href="#">Privacy Policy</a><a href="#">Terms of use</a></p>
    </div>

</div>
</footer>

<div id="get-started" class="modal fade" role="dialog" data-backdrop="static">
<div class="modal-dialog">
<!-- Modal content-->
<div class="modal-content">
  <div class="modal-header text-center">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">Ready? Lets Get Started</h4>
  </div>
  <div class="modal-body">
      <form method='post'  id="p2h5"  type="mutipart/form-data" >
        <div class="fileContainer">
            <div class="browse-files">
              <h4>Drag your file or click to upload</h4>
              <h6>Files should be in psd, png, jpg and pdf format, maximum file size should be 25MB for larger file use external link option</h6>
              <input class="filesupload" type="file" name="uploads[]" accept=".jpg,.zip,.psd,.pdf,.jpeg" id="filesupload0"  multiple onChange="makeFileList()" >
               <input type="hidden" name="counterno"  id="counterno" value="0">
            </div>
        </div>
        <ul id="filelist" class="sh-img clearfix"></ul>
        <div class="input-field">
            <input type="text" class="input-text" id="shared_link" name="shared_link" placeholder="Shared Dropbox, Google Drive or External Link">
        </div>
        <div class="input-field">
            <div class="radio-box">
                <h5>Responsive </h5>
                <label><input type="radio" value="1" checked name="responsive"><span></span> Yes</label>
                <label><input type="radio" value="0" name="responsive"><span></span> No</label>
            </div>
            <!-- Technologies-->
            <div class="radio-box pull-right">
              <h5>Select CMS </h5>
            <?php /** TECHNOLOGIES **/
            $sql_uid="select * from ph_technology";
            $result_uid = mysqli_query($con, $sql_uid);
            if (mysqli_num_rows($result_uid) > 0) {
                while($row_sb = mysqli_fetch_assoc($result_uid)) {
                  $check=(($row_sb['id']==1)?'checked="checked"':''); ?>
           <label><input type="radio"  <?php echo $check; ?> value= "<?php echo $row_sb['id']; ?>" name="technology" ><span></span> <?php echo strtoupper($row_sb['name']); ?> </label>
         <?php }
            } ?>
            </div>
        </div>

	<div class="input-field">
		 <div class="radio-box ">
    </div> <!-- Services -->
      <div class="radio-box pull-right">
            <span id="services"></span>
    </div>
	</div>
  <!--
	<div class="input-field">
            <div class="radio-box">
                <h5>Checkbox Fields </h5>
                <label><input type="checkbox" value="c1" name="c1"><span></span> Yes</label>
                <label><input type="checkbox" value="c2" name="c2"><span></span> No</label>
            </div>
          </div>
          <div class="input-field sm-field">
              <select class="input-text select-box">
                  <option>-Select Box-</option>
                  <option>Option 1</option>
                  <option>Option 2</option>
                  <option>Option 3</option>
              </select>
          </div> -->

          <div class="input-field sm-field">
              <input type="text"  class="input-text" placeholder="Name" name="name" id="name"  >
              <input type="text" class="input-text" placeholder="Email Address" name="email"  id="email" >
          </div>
          <div class="input-field">
              <textarea class="input-text text-area" placeholder="Message" name="message"  id="message" onfocus="if(this.value  == 'Please fill out this field.') { this.value = '';  $('#message').removeClass('needsfilled');  } " ></textarea>
          </div>
          <div class="input-field">
						  <input type="hidden" name="xddsubmit" id="xddsubmit">
              <input type="submit" class="common-btn dark-btn submit-btn" name="submit" value="SEND ME QUOTE">
          </div>

                </form>

                <p id="error" style="display:none;">Please type the information for the required fields and resend.<span id="blank_error" style="display:none;">Please uplaod a file or Share Dropbox or Google Drive link </span></p>
                <span id="thanks">
                  <!-- Loader -->
                  <div class="preloader-p2h">
                       <div class="pre">
                        <div class="pre-rel" style="position:relative;">
                  <div class="progress"></div>
                  <div class="loader-btn"></div>
                  </div>
                  <span class="bar_precent"></span>
                  <div class="loader-cont bfupload" style="display:none;">
                    <h4>Uploading In Progress</h4>
                   </div>
                   <div class="loader-cont" style="display:none;">
                    <h4>Your files has been Uploaded Successfully</h4>
                    <p>The quote is usually provided within 1-3 business days depending on the project complexity. (For small-sized projects, we deliver the quote within a couple of working hours.)<br><br>To contact us with questions or concerns about your order,
                  please use the contact form on Contact us page or please drop a reminder to your manager from your client area section.
                  Thank you for your request.<br><br><br><br>
                  Click here to go to your <a href="#" title="PSD to HTML Responsive">account</a>
                   </p>
                   </div>
                      </div>
                    </div><!-- ###Loader -->


                </span>
  </div>
</div>

</div>
</div>



<span itemscope itemtype="http://schema.org/Service">
<meta itemprop="serviceType" content="PSD to HTML"/>
<meta itemprop="serviceType" content="PSD to WordPress"/>
<meta itemprop="serviceType" content="PSD to Joomla"/>
<meta itemprop="serviceType" content="PSD to Magento"/>
<meta itemprop="serviceType" content="PSD to Shopify"/>
<meta itemprop="serviceType" content="PSD to Email"/>
<meta itemprop="serviceType" content="PSD to Responsive HTML"/>
<meta itemprop="serviceType" content="PSD to Foundation"/>
<meta itemprop="serviceType" content="PSD to Bootstrap"/>
<meta itemprop="serviceType" content="PSD to Materialize"/>
<meta itemprop="serviceType" content="Sketch to HTML"/>
<meta itemprop="serviceType" content="Sketch to Responsive HTML"/>
<meta itemprop="serviceType" content="PSD to Responsive WordPress"/>
<meta itemprop="serviceType" content="PSD to Responsive Joomla"/>
<meta itemprop="serviceType" content="PSD to Silverstripe"/>
<meta itemprop="serviceType" content="PSD to Drupal"/>
<meta itemprop="serviceType" content="PSD to TYPO3"/>
<meta itemprop="serviceType" content="PSD to WooCommerce"/>
<meta itemprop="serviceType" content="PSD to Prestashop"/>
<meta itemprop="serviceType" content="PSD to Opencart"/>
<meta itemprop="serviceType" content="PSD to Shopify"/>
<meta itemprop="serviceType" content="PSD to BigCommerce"/>
<meta itemprop="serviceType" content="PSD to CS Cart"/>
<meta itemprop="serviceType" content="Hire Frontend Developer"/>
<meta itemprop="serviceType" content="Hire WordPress Developer"/>
<meta itemprop="serviceType" content="Hire Javascript Developer"/>
<meta itemprop="serviceType" content="Hire Magento Developer"/>
<meta itemprop="serviceType" content="Hire PHP Developer"/>
</span>
<span itemprop="review" itemscope itemtype="http://schema.org/Review">
<span itemprop="author" itemscope itemtype="http://schema.org/Person">
<meta itemprop="name" content="Dima"></span>
<meta itemprop="datePublished" content="2011-04-15">
<span itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating">
<meta itemprop="bestRating" content="5 Star">
<meta itemprop="ratingValue" content="5">
</span>
<meta itemprop="reviewBody" content="I've worked with these guys for many years, they have very competent senior coding staff, they get the job done quickly and their project managers are fantastic to work with - Good communication skills and they keep the project running smoothly without me having to be involved much at all. Great company! ">
</span>

<span itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
<meta itemprop="streetAddress" content="113-03, 101">
<meta itemprop="addressRegion" content="New York">
<meta itemprop="postalCode" content="11419">
<meta itemprop="name" content="PSD2HTML5">
<meta itemprop="telephone" content="+1-718-303-2041">
<meta itemprop="email" content="support@psd2html5.co">
</span>
<meta itemprop="url" content="https://www.psd2html5.co/">
<span itemprop="openingHoursSpecification" itemscope itemtype="http://schema.org/OpeningHoursSpecification">
<meta itemprop="opens" content="9:30">
<meta itemprop="closes" content="19:00"></span>
</div>

<script src="dist/js/script.js"></script>
<script src="dist/js/wow.min.js"></script>
<script>
wow = new WOW(
{
boxClass:     'wow',
animateClass: 'animated',
offset:       0,
mobile:       false,
live:         true
}
)
wow.init();
</script>
<script src="dist/js/jquery.newsTicker.js"></script>
<script>
var nt_example1 = $('#nt-example1').newsTicker({
row_height: 88,
max_rows:3,
duration: 6000,
});
$(window).load(function() {
setTimeout(function(){
    document.body.className="loaded";
},1000);
});
$('.carousel').carousel({
pause: "false",
interval: 18000,
cycle: true
});
</script>

<script>
//Image uploads
function makeFileList() {
			var zix = parseInt($("#counterno").val());
			var input = document.getElementById("filesupload"+zix);
			var ul = document.getElementById("filelist");
			if (input.files.length==1){
		var z =1;
		var f = z+zix;
	  $('#filelist').append('<li id='+zix+'><span>'+input.files[0].name+'</span>&nbsp;<i class="fa fa-times-circle" id='+zix+'></i></li>');
	  $('#counterno').val(f);
	  $('#filesupload0').removeClass("needsfilled");
		$('#shared_link').removeClass("needsfilled");
		$('#shared_link').val('');
		$('#blank_error').css("display","none");
		$('.browse-files').css("border","2px dashed #5ddea8");
	  $('.browse-files').append('<input class="filesupload" type="file" name="uploads[]" accept=".png,.jpg,.zip,.psd" id="filesupload'+f+'" multiple onChange="makeFileList()">');
		}
	else{
			for (var i = 0; i < input.files.length; i++) {
			$('#filelist').append('<li id='+zix+'><span>'+input.files[i].name+'</span>&nbsp;<i class="fa fa-times-circle" id='+zix+'></i></li>');
	zix++;
	$('#counterno').val(zix);
		$('#filesupload0').removeClass("needsfilled");
		$('#shared_link').removeClass("needsfilled");
		$('#shared_link').val('');
		$('#blank_error').css("display","none");
		$('.browse-files').css("border","2px dashed #5ddea8");
		if (i === input.files.length-1){$('.browse-files').append('<input class="filesupload" type="file" name="uploads[]" accept=".png,.jpg,.zip,.psd" id="filesupload'+zix+'" multiple onChange="makeFileList()">');
		}
			}
	}
			if(!ul.hasChildNodes()) {var li = document.createElement("li");li.innerHTML = 'No Files Selected';ul.appendChild(li);}
		}


// Place ID's of all required fields here.
required = ["name", "email","message"];
// If using an ID other than #email or #error then replace it here
email = $("#email");
errornotice = $("#error");
// The text to show up within a field when it is incorrect
emptyerror = "Please fill out this field.";
emailerror = "Please enter a valid e-mail.";
$('.progress').progressbar({ value: 0});

$('#p2h5').submit(function(e){
var formData = new FormData($(this)[0]);
  //alert($('#p2h5').serialize());

  // 1) Validate required fields
	for (i=0;i<required.length;i++) {
    //  alert(required[i]);
		var input = $('#'+required[i]);
		if ((input.val() == "") || (input.val() == emptyerror)) {

			input.addClass("needsfilled");
			input.val(emptyerror);
			errornotice.fadeIn(750);
		} else {
			input.removeClass("needsfilled");
		}
	}

  var val_email = $('input[name=email]').val();
  if( /(.+)@(.+){2,}\.(.+){2,}/.test(val_email) ){
    // valid email
  } else {
    // invalid email
    email.addClass("needsfilled");
    email.val(emailerror);
  }

  // 2 Clears any fields in the form when the user clicks on them
   $(":input").focus(function(){
      if ($(this).hasClass("needsfilled") ) {
   		$(this).val("");
   		$(this).removeClass("needsfilled");
      }
   });


// image nd link validation

var filesuploads= $('#filesupload0').val();
var sharedlink =$('#shared_link').val();
if(filesuploads=="" && sharedlink==""){
    $('#filesupload0').addClass("needsfilled");
    $('#shared_link').addClass("needsfilled");
    $('#shared_link').val(emptyerror);$('#blank_error').css("display","block");
    $('.browse-files').css("border","2px dashed #FF0000");
}
if(filesuploads!="" && sharedlink==""){$('#filesupload0').removeClass("needsfilled");$('#shared_link').removeClass("needsfilled");$('#shared_link').val('');$('#blank_error').css("display","none");$('.browse-files').css("border","2px dashed #5ddea8");}
if(filesuploads=="" && sharedlink!=""){$('#filesupload0').removeClass("needsfilled");$('#shared_link').removeClass("needsfilled");$('#blank_error').css("display","none");$('.browse-files').css("border","2px dashed #5ddea8");}



  // 3 condition  if any inputs on the page have the class 'needsfilled' the form will not submit
  	if ($(":input").hasClass("needsfilled")) {
  		return false;
  	}else if ($("#message").hasClass("needsfilled")) {
  		return false;
  	}
     else {
			 // assign filesupload
			 var liIds = $('#filelist li span').map(function(i,n) {return $(n).html();}).get().join(',');
			 alert(liIds);
			 $('#xddsubmit').val(liIds);

       var formData = new FormData($(this)[0]);
       alert(' done formData');
  		 errornotice.hide();
  		//return true;
      $(document).ajaxStart(function(){
    	//$(window).scrollTop($('#about').offset().top);
			alert('start');
      $('.submit-btn').attr("disabled", "disabled").addClass('regbutton');
      $('.progress').progressbar({ value: 50 });
      $('.loader-btn').css("left","44%");
      $('.bar_precent').html("50% process complete");
      $('.bfupload').css("display","block");
      }).ajaxStop(function(){
			alert('start');
      $('.progress').progressbar({ value: 100 });
      $('.loader-btn').css("left","94%");
      $('.bar_precent').html("100% process completed");
      $('.loader-cont').css("display","block");
      $('.bfupload').css("display","none");
      //$("#p2h5")[0].reset();
      });

      $.ajax({
          url:'register.php',
          type:'POST',
          data: formData ,     //$('#p2h5').serialize(),
          contentType: false, // NEEDED, DON'T OMIT THIS
          processData: false, // NEEDED, DON'T OMIT THIS
          async: true,
          success:function(data){
              alert(data);
						  $('#p2h5').hide();
              $('.modal-title').text('Thank you for registration');
              $('#thanks').html(data);

             // var formData = new FormData($(this)[0]);
              // var delay = 6000;
              // setTimeout(function(){
              // //window.location = 'myorders.php';
              // }, delay);
          },
					error: function(jqxhr) {
					 $("#thanks").text(jqxhr.responseText); // @text = response error, it is will be errors: 324, 500, 404 or anythings else
				 }
      });
     e.preventDefault();
		 //e.getPreventDefault();
		 //e.defaultPrevented();
  	}
});

<!-- Reset values -->
$('#get-started').on('hidden.bs.modal', function () {
    $('#services').hide();
    $(this).find('form').trigger('reset');
});

<!-- DEPENDENT SERVICES OF TECHNOLOGIES -->
$("input[name=technology]:radio").change(function () {
	  var techId=$(this).val();
	  $.ajax({
	      url:'service.php',
	      type:'get',
	      data:{techID:techId},
	      success:function(data){
      		$('#services').show();
      		$('#services').html(data);
	      }
	  });
});


</script>

</body>
</html>

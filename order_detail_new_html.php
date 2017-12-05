<?php
$title= "Thank you | PSD2HTML5.CO";
require 'config.php';
include('header_inner.php');
if($logeduserid=="") { header("location:https://www.psd2html5.co/");} else{ $logeduserid;}
//include('navigation_inner.php');
?>
<?php //echo "bvb<pre>";print_r($_SESSION); ?>
<section class="p2hfeatures order-status clearfix" >

	<div class="container">
    	<div class="order-st-page">
    	<h3> Order Request for p2h520171004101 </h3>
          	<div class="order-detail clearfix">
		      	<div class="comnt-img pull-left">
                		<img src="https://www.psd2html5.co/img/cmt-img.jpg"><h5>ghj</h5>                    <p>2017-10-04 10:03:28</p>
                </div>
                <div class="comment-rt pull-right">
                	<div class="cmnt-inner">
                        <div class="cmt-body">
                        	<h4>Your Request Details</h4>
                        	<div class="cmt-body-inner">
                            	<h3>PSD to  HTML</h3>
                                <ul>
                                	<li class="clearfix"><p class="pull-left">Responsive Layout </p> <p class="pull-right">no </p></li>
                                </ul>
																<h5>Shared Link</h5>
                                <p><a href="http://www.telegraph.co.uk/content/dam/news/2017/10/03/TELEMMGLPICT000142646182_1_trans_NvBQzQNjv4Bqf9PchMOYDecOqJN-sWXmUkUW9jK0rAWQ0Q636PZ8m6Y.jpeg?imwidth=1400" target="_blank">http://www.telegraph.co.uk/content/dam/news/2017/10/03/TELEMMGLPICT000142646182_1_trans_NvBQzQNjv4Bqf9PchMOYDecOqJN-sWXmUkUW9jK0rAWQ0Q636PZ8m6Y.jpeg?imwidth=1400</a></p>                                <h5>Other Guideline</h5>
                                <p>ghjgj </p>
								            </div>
                        </div>
                    </div>
                </div>
  						</div>

  <div class="order-detail clearfix post_coment">
			<form id="reply" name="reply" method="post" action="" enctype="multipart/form-data">
            	<div class="comment-rt pull-right arrow-none">
                	<textarea name="message" placeholder="Message" id="cmmessage"></textarea>
					<input name="cmorderid" value="101" type="hidden">
					<input name="cmuserid" value="79" type="hidden">
 					<input name="counterno" id="counterno" value="0" type="hidden">
		<ul id="cmlist" class="clearfix"></ul>
                    <div class="bottom-link">
                	<ul>
                        <li class="browse_file"><a class="addcomatch"><img src="https://www.psd2html5.co/img/attch-ico.png"> Add Attachment</a><input id="filesatch0" class="comtatth" name="uploads[]" accept=".png,.jpg,.zip,.pdf,.gif,.jpeg" multiple="" onchange="comentattachments()" type="file"></li>
                        <li class="sd-btn"><input name="xddsubmit" id="xddsubmit" type="hidden"><input name="cmsubmit" class="submit-btn common-btn" value="Send  Now" type="submit">
						<p class="image_loading">&nbsp;</p></li>
                    </ul>
                </div>
				</div>
                </form>
    </div>

        </div>
    </div>

</section>
<script>
$(".navigation-outer").addClass('inner');
</script>
<?php include('footer.php'); ?>

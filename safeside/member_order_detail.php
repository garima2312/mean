<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
 <h2 class="page-header">Order Details</h2>
  <div class="row">
		 <div class="col-sm-12">
      <div class="row">
	  <?php
	    function makeClickableLinks($s) {
  return preg_replace('@(https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-]*(\?\S+)?[^\.\s])?)?)@', '<a href="$1" target="_blank">$1</a>', $s);
}
	  $sql_chat_status = "UPDATE ph_order_chat SET status =1 WHERE oid='".$_GET['oid']."'";
  if ($conn->query($sql_chat_status) === TRUE) {/*echo "Record updated successfully";*/}
  else {/*echo "Error updating record: " . $conn->error;*/}
	  $sql_uid = "SELECT * FROM ph_orders WHERE oid='".$_GET['oid']."'";
			$result_uid = mysqli_query($conn, $sql_uid);
			if (mysqli_num_rows($result_uid) > 0) {
				while($row_sb = mysqli_fetch_assoc($result_uid)) {
				$requestdate = explode( '-', $row_sb['request_date'] ); 
				$tdate = explode( ' ', $requestdate[2] );
				?>
        <div class="col-sm-12">
		     <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">Order Detail</h3>
            </div>
            <div class="panel-body order_update">
			<div class="table-responsive">
            <table class="table table-striped table-bordered table-hover dataTable no-footer ">
			<tbody>
			<tr><td><strong> Name</strong></td><td colspan="3">PSD to  <?php echo $row_sb["select_options"]; ?></td></tr>
					<tr><td><strong> ID</strong></td><td><?php echo "p2h5".$requestdate[0].$requestdate[1].$tdate[0].$row_sb["oid"];?></td><td colspan="1"><strong>Responsive Layout</strong></td><td><?php echo $row_sb["responsiveness"];?></td></tr>
				
				<tr><td colspan="1"><strong>Order Start date</strong></td><td><?php echo $row_sb["order_start_date"]; ?></td><?php if($row_sb["order_status"] =="Order Completed"){?>				
<td><strong>Order Complete date</strong></td><td><?php echo $row_sb["order_complete_date"]; ?></td>
						<?php }?></tr>
				<?php
				$sql_quet ="SELECT * FROM ph_order_quote WHERE oid ='".$row_sb["oid"]."'order by qid desc limit 1";
					$result_quet = $conn->query($sql_quet);
					if ($result_quet->num_rows > 0) {
					while($rowquet = $result_quet->fetch_assoc()) {
					 $adddays= $rowquet["estimate_time"]+2;
					$eta = date('d-m-Y',strtotime($row_sb["order_start_date"]. "+$adddays days"));
					echo '<tr><td><strong>ETA</strong></td><td>'.$eta.'</td>';
					echo '<td><strong>Status</strong></td><td>';
					if($row_sb["order_complete_date"]==""){
					$get_date = strtotime(date("d-m-Y"));
					$ceta = strtotime($eta);
					if($get_date == $ceta){ echo "Last day";}
					if($get_date > $ceta){ echo "In Delay";}
					if($get_date < $ceta){ echo "In Progress";}
					}
					else{echo "Completed";}
					echo '</td></tr>';
						}
					}
					else{ echo '<tr><td><strong>ETA</strong></td><td>&nbsp;</td><td><strong>Status</strong></td><td>&nbsp;</td></tr>';}
					?>
					
	</tbody></table>
	</div>
	<div class="table-responsive">
	<table class="table table-striped table-bordered table-hover dataTable no-footer">
	<thead><tr><th>Client Guideline</th></tr></thead><tbody><tr><td><?php echo nl2br(makeClickableLinks($row_sb["other_guidelines"]));?></td></tr></tbody>
	</table>
	</div>
	<?php $sql_prodet ="SELECT * FROM ph_assign_project WHERE projects_id ='".$_GET['oid']."'";
					$result_prodet = $conn->query($sql_prodet);
					if ($result_prodet->num_rows > 0) {
					while($rowprodet = $result_prodet->fetch_assoc()) {?>
						<div class="table-responsive">
	<table class="table table-striped table-bordered table-hover dataTable no-footer">
	<thead><tr><th>Project Detail</th></tr></thead><tbody><tr><td><?php echo nl2br(makeClickableLinks($rowprodet["project_detail"]));?></td></tr></tbody>
	</table>
	</div>

					<?php }
					}?>
            </div>	
			<?php if($row_sb["order_status"] =="Order In Progress"){?>
				<input type="hidden" name="orderid" value="<?php echo $_GET['oid']; ?>" />
				<input type="hidden" name="memberid" value="<?php echo $adminid; ?>" />
				
			<div class="panel-footer orderst"><a id="markcomplete">Mark as Completed</a></div>
			<?php }?>			
          </div>
        </div><!-- /.col-sm-12 -->
		
      </div>
	  <div class="row">
	  <div class="col-sm-6">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">Client Info</h3>
            </div>
            <div class="panel-body">
         <?php 
		 $sqlusern ="SELECT name,email FROM ph_users WHERE uid ='".$row_sb["uid"]."'";
		 echo'<table class="table table-striped table-bordered table-hover dataTable no-footer "><tbody>'; 
					$resultusern = $conn->query($sqlusern);
					if ($resultusern->num_rows > 0) {
					while($rowusern = $resultusern->fetch_assoc()) {
					echo'<tr><td>Name</td><td>'.$rowusern["name"].'</td></tr>';
					echo'<tr><td>Email</td><td>'. $rowusern["email"].'</td></tr>';
					}
					}
					else {/*echo "0 results";*/}
		echo'</tbody></table>';
		 ?>
            </div>
          </div>
        </div><!-- /.col-sm-6 -->
		
      </div>
	  </div><!-- /.col-sm-12 -->
	   
	  <?php	define("Paydate", $row_sb["payment_date"], true);
	  	}
			}	
			?>
			
    </div>
	<div class="row">
   <div class="col-sm-12">
   <div class="panel panel-default">
            <div class="panel-heading">
		     <h4>Order Discussion </h4>
            </div>
            <div class="panel-body">
			 <?php  $sqlasstim ="SELECT * FROM ph_assign_project WHERE projects_id ='".$_GET['oid']."'";
			 $resultasstim = $conn->query($sqlasstim);
					if ($resultasstim->num_rows > 0) {
					while($rowasstim = $resultasstim->fetch_assoc()) {
					$assign_time = $rowasstim['timestamp'];
					}
					}
			 
			 ?>
			<?php $sqlcomtal ="SELECT * FROM ph_order_chat WHERE oid ='".$_GET['oid']."' AND comment_time > '".$assign_time."' order by chid ASC";
				$resultcomtal = $conn->query($sqlcomtal);
					if ($resultcomtal->num_rows > 0) {
					while($rowcomtal = $resultcomtal->fetch_assoc()) {	?>
            <div class="order-detail clearfix">
			
            	<div class="comnt-img pull-left">
				<?php if($rowcomtal['uid']==0){
				$sqlcomuim ="SELECT * FROM ph_adminstrator WHERE aid ='".$rowcomtal['adid']."'";
						$resultcomuim = $conn->query($sqlcomuim);
							if ($resultcomuim->num_rows > 0) {
							while($rowcomuim = $resultcomuim->fetch_assoc()) {
											if($rowcomuim['adrole']=='team_member'){ 
											 $gravatar_link = 'https://www.gravatar.com/avatar/' . md5($rowcomuim['ademail']) .'?d=404&s=200';
											  $headers = @get_headers($gravatar_link);
												if (!preg_match("|200|", $headers[0])) {
													echo '<img src="../img/cmt-img3.jpg">';
												} else {
													echo '<img src="' . $gravatar_link . '" />';
												}
											}else{	
											$gravatar_link = 'https://www.gravatar.com/avatar/' . md5($rowcomuim['ademail']) .'?d=404&s=200';
											  $headers = @get_headers($gravatar_link);
												if (!preg_match("|200|", $headers[0])) {
													echo '<img src="../img/cmt-img2.jpg">';
												} else {
													echo '<img src="' . $gravatar_link . '" />';
												}
											}
											echo '<h5>'.$rowcomuim['adname'].'</h5>';
							}
							}
						}
				else{ 
						$sqlcomuim ="SELECT * FROM ph_users WHERE uid ='".$rowcomtal['uid']."'";
						$resultcomuim = $conn->query($sqlcomuim);
							if ($resultcomuim->num_rows > 0) {
							while($rowcomuim = $resultcomuim->fetch_assoc()) {
							$profilepicim = $rowcomuim['profile_pic'];
											if(!empty($profilepicim)){
											echo '<img src="../profile_pics/p2h5profile_pic_'.$rowcomuim['uid'].'/'.$profilepicim.'">';
											echo '<h5>'.$rowcomuim['name'].'</h5>';
											}
											else{
											$gravatar_link = 'https://www.gravatar.com/avatar/' . md5($rowcomuim['email']) .'?d=404&s=200';
											  $headers = @get_headers($gravatar_link);
												if (!preg_match("|200|", $headers[0])) {
													echo '<img src="../img/cmt-img.jpg">';
												} else {
													echo '<img src="' . $gravatar_link . '" />';
												}
											echo '<h5>'.$rowcomuim['name'].'</h5>';
											}
									
							}
							}
					}?>
                	
                    
                    <p><?php echo $rowcomtal['comment_time'];?></p>
                </div>
                <div class="comment-rt pull-right <?php if($rowcomtal['postby']=='administrator'){echo 'bg-change';}elseif($rowcomtal['postby']=='team_member'){echo 'bgt-change';}else{ echo 'bgc-change';}?>">
                	<div class="cmnt-inner">
                    	<div class="cmt-header clearfix">
                        	<p><?php echo nl2br(makeClickableLinks($rowcomtal['message'])); ?></p>
							
                        </div>
                    </div>
					<?php 
if(!empty($rowcomtal['attacment_path'])){
$attachments = explode( ',', $rowcomtal['attacment_path'] );
$attachs = explode(",", $rowcomtal['attacment_path']);
echo '<div class="attchments-file"><h4>Attachments:</h4><ul>';
foreach($attachs as $attach) {
$attach = trim($attach);
$info = new SplFileInfo('comment_attachments/'.$attach);	
$extension = $info->getExtension();
if($extension == 'jpg' || $extension == 'jpeg' || $extension == 'JPEG' || $extension == 'JPG'){
echo '<li class="clearfix"><img src="../img/jpg.png"><div class="at-name"><h5>'.$attach.'</h5><a target="_blank" href="'.$domain.'/comment_attachments/'.$attach.'">Download</a></div></li>';
}
elseif($extension == 'pdf' || $extension == 'PDF'){
echo '<li class="clearfix"><img src="../img/pdf.png"><div class="at-name"><h5>'.$attach.'</h5><a target="_blank" href="'.$domain.'/comment_attachments/'.$attach.'">Download</a></div></li>';
}
elseif($extension == 'png' || $extension == 'PNG'){
echo '<li class="clearfix"><img src="../img/png.png"><div class="at-name"><h5>'.$attach.'</h5><a target="_blank" href="'.$domain.'/comment_attachments/'.$attach.'">Download</a></div></li>';
}
elseif($extension == 'gif' || $extension == 'GIF'){
echo '<li class="clearfix"><img src="../img/gif.png"><div class="at-name"><h5>'.$attach.'</h5><a target="_blank" href="'.$domain.'/comment_attachments/'.$attach.'">Download</a></div></li>';
}
elseif($extension == 'zip' || $extension == 'ZIP'){
echo '<li class="clearfix"><img src="../img/zip.png"><div class="at-name"><h5>'.$attach.'</h5><a target="_blank" href="'.$domain.'/comment_attachments/'.$attach.'">Download</a></div></li>';
}
else{
echo '<li class="clearfix"><div class="at-name"><h5>'.$attach.'</h5><a target="_blank" href="'.$domain.'/comment_attachments/'.$attach.'">Download</a></div></li>';
}
}
   echo'</ul></div>';

}					
?>
                </div>
				
								  
            </div><?php 
			}
					}
		   else {/*echo "0 results";*/}
		   ?>
           <div class="order-detail clearfix post_coment">
			<form id="reply" name="reply" method="post" action="" enctype="multipart/form-data">
            	<div class="comment-rt pull-right arrow-none">
                	<textarea name="message" placeholder="Message" id="cmmessage"></textarea>
					<input type="hidden" name="cmorderid" value="<?php echo $_GET['oid']; ?>" />
					<input type="hidden" name="commentby" value="<?php echo $_SESSION["adrole"]; ?>" />
					<input type="hidden" name="adminid" value="<?php echo $adminid; ?>" />
				<input id="filesatch" class="comtatth" name='uploads[]' type="file" accept=".png,.jpg,.zip,.pdf,.gif,.jpeg" multiple onChange="comentattachments()" style="display:none;" >
		<ul id="cmlist"></ul>
                    <div class="bottom-link">
                	<ul>
                        <li><a class="addcomatch"><img src="../img/attch-ico.png"> Add Attachment</a></li>
                        <li class="sd-btn"><input type="submit" name="cmsubmit" class="btn btn-primary" value="Send  Now"/><p class="image_loading">&nbsp;</p></li>
                    </ul>
                </div>
				</div>
                </form>
            </div>
            </div>
          </div>
   </div>
   </div>
  </div>
  </div>
</div>
<script type="text/javascript">
/* Add Attachment */
$(document).ready(function() {
    $(".addcomatch").on('click', function() {
	   $("#filesatch").click();
    });
});		
function comentattachments() {
			var input = document.getElementById("filesatch");
			var ul = document.getElementById("cmlist");
			for (var i = 0; i < input.files.length; i++) {
				var li = document.createElement("li");
				li.innerHTML = input.files[i].name;
				ul.appendChild(li);
			}
			if(!ul.hasChildNodes()) {
				var li = document.createElement("li");
				li.innerHTML = 'No Files Selected';
				ul.appendChild(li);
			}
		}
$("form#reply").submit(function(){
		//Validate required fields
		var filesuploads= $('#cmmessage').val();
		if (filesuploads==""){
		$('#cmmessage').css('border','1px solid #FF0000');
		return false;
		} else {
		$('#cmmessage').css('border','1px solid #ccc');
		var formData = new FormData($(this)[0]);
		$(document).ajaxStart(function(){
		$('.image_loading').addClass('loading_image').css("display","block");
		$('.submit-btn').attr("disabled", "disabled").addClass('loading');
		}).ajaxStop(function(){
		$('.image_loading').removeClass('loading_image').css("display","none");
		$('.submit-btn').removeAttr("disabled").removeClass('loading');
		});	
	$.ajax({
        url: "add_comment.php",
        type: 'POST',
        data: formData,
        async: false,
        success: function (data) {
		//alert(data);
		$(data).insertBefore( ".post_coment" );
		$("#reply")[0].reset();
		$("#cmlist").html('');
        },
        contentType: false,
        processData: false
    });
	return false;
		}
	});
	$("a#markcomplete").click(function() {  
			var orderid = $('input[name="orderid"]').val();
			var memberid = $('input[name="memberid"]').val();

			var complete = "completed";
	$.ajax({url: "member_update_order_status.php",type:"POST",async:true,data:{complete: complete,orderid:orderid,memberid:memberid},success: function(response){
	$(".order_update").html(response);
	$(".orderst").addClass('hide');
	 }});
	}); 

	</script>
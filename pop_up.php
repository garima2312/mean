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
                <label><input type="radio" value="Yes" checked name="responsive"><span></span> Yes</label>
                <label><input type="radio" value="No" name="responsive"><span></span> No</label>
            </div>
            <!-- Technologies-->
            <div class="radio-box pull-right">
              <h5>Select CMS </h5>
            <?php /** TECHNOLOGIES **/
            $sql_uid="select * from ph_technology";
            $result_uid = mysqli_query($conn, $sql_uid);
            if (mysqli_num_rows($result_uid) > 0) {
                while($row_sb = mysqli_fetch_assoc($result_uid)) {
                  $check=(($row_sb['id']==1)?'checked="checked"':''); ?>
           <label><input type="radio"  <?php echo $check; ?>  value= "<?php echo $row_sb['id']; ?>" name="technology" ><span></span> <?php echo strtoupper($row_sb['name']); ?> </label>
         <?php }
            } ?>
            </div>
        </div>

	<div class="input-field mt-10">
		 <div class="radio-box ">
    </div> <!-- Services -->
      <div class="radio-box pull-right">
            <span id="services">
	  <?php	
	    $sql_uids="select * from ph_service where technology_id=1";
            $result_uids = mysqli_query($conn, $sql_uids);
            if (mysqli_num_rows($result_uids) > 0) {
                while($row_sb2 = mysqli_fetch_assoc($result_uids)) {
			$check2=(($row_sb2['id']==1)?'checked="checked"':''); ?>
			 <label><input type="radio"  <?php echo $check2; ?> value= "<?php echo $row_sb2['id']; ?>" name="service" ><span></span> <?php echo strtoupper($row_sb2['name']); ?> </label>
		
	<?php	}} 
		?>
	    </span>
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
  <input type="text"  class="input-text" placeholder="Name" name="name" id="name" value="<?php echo (isset($name))? $name :''; ?>" >
 <input type="text" class="input-text" placeholder="Email Address" name="email"  id="email" value="<?php echo (isset($email))? $email :''; ?>" >
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
								<!-- Loader -->
								<div class="loader-outer" style="display:none;">
									<img id="loading" src='img/loading_popup.gif' alt="Loading">
									<p> Processing Request will take a while... </p>
								</div>
								<!-- ###Loader -->
								<span id="thanks" ></span>
  </div>
</div>

</div>
</div>

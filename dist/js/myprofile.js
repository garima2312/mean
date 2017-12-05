/* Change Password */
	 $("#p2h5passub").click(function() {  
			var currpass = $('input[name="currpass"]').val();
			var newpass = $('input[name="newpass"]').val();
			var conpass = $('input[name="conpass"]').val();
			var cutuser = $('input[name="cutuser"]').val();
			if(currpass==""){
			$('input[name="currpass"]').attr("placeholder", "Please Enter Current Password").addClass('val_error');
			 }
			 if(newpass==""){
			 $('input[name="newpass"]').attr("placeholder", "Please Enter New Password").addClass('val_error');
			 }
			 if(conpass==""){
			   $('input[name="conpass"]').attr("placeholder", "Please Enter Confirm Password").addClass('val_error');
			 }
			 if(newpass.length < 8){
			   $('input[name="newpass"]').attr("placeholder", "Please Enter At Least 8 Character Password").addClass('val_error');
			 }
			 else if(newpass!=conpass){
				 $('input[name="newpass"]').val('');
				 $('input[name="conpass"]').val('');
			  $('input[name="newpass"]').attr("placeholder", "Please Re-enter New Password").addClass('val_error');
			  $('input[name="conpass"]').attr("placeholder", "Please Re-enter Confirm Password").addClass('val_error');
			  
			 }
	else if(currpass!="" &&  newpass==conpass && newpass.length > 8){
			$(document).ajaxStart(function(){
	$('.cncpass').hide();
	}).ajaxStop(function(){
	$('.cncpass').show();
	});	
	$.ajax({url: "change_password.php",type:"POST",async:true,data:{currpass: currpass,newpass:newpass,cutuser:cutuser},success: function(response){
	$(".chresponse").html(response);
	$("#p2h5chpass")[0].reset();
	$(".strength_meter div#myPassword").removeClass('veryweak').removeClass('weak').removeClass('medium').removeClass('strong');
	 }});
	 }
	 return false;
	}); 
	 $(".cncpass").click(function() {  
	 $('.chresponse').html('');
	 }); 
	(function($){
$('.edit_pr').click(function(){
	// Place ID's of all required fields here.
	required = ["urfname","urphone","uraddress","urcountry","urcity","urstate","urzipcode"];
	// If using an ID other than #email or #error then replace it here
	email = $("#uremail");
	errornotice = $("#edpferoor");
	//successnotice = $("#consuccess");
	// The text to show up within a field when it is incorrect
	emptyerror = "Please fill out this field.";
	$("form#p2h5editprofile").submit(function(){
		//Validate required fields
		for (i=0;i<required.length;i++) {
			var input = $('#'+required[i]);
			var textarea = $('#'+required[i]);
			if ((input.val() == "") || (input.val() == emptyerror)) {
				input.addClass("needsfilled");
				input.val(emptyerror);
				errornotice.fadeIn(750);
			} else {
				input.removeClass("needsfilled");
			}
		}
		// Validate the e-mail.
		if (!/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(email.val())) {email.addClass("needsfilled");email.val(emailerror);}
		//if any inputs on the page have the class 'needsfilled' the form will not submit
		if ($(":input").hasClass("needsfilled")) {
		return false;
		}
		 else {
	var formData = new FormData($(this)[0]);
	$(document).ajaxStart(function(){
	$('#updprof').attr("disabled", "disabled").addClass('loading');
	$('.image_loading').addClass('loading_image').css("display","block");
	$('.canprof').hide();
	}).ajaxStop(function(){
	$('#updprof').removeAttr("disabled").removeClass('loading');
	$('.image_loading').removeClass('loading_image').css("display","none");
	$('.canprof').show();
	$("#p2h5editprofile")[0].reset();
	$('.file-name').html('');
	});	
	$.ajax({
        url: "edit_profile.php",
        type: 'POST',
        data: formData,
        async: true,
        success: function (data) {
		//alert(data);
		$('.user-pro').html(data);
		$("#p2h5editprofile")[0].reset();
		$("#edpferoor").css("display","none");
		$("#edpfsuccess").html('Profile updated successfully').css("display","block");
		$('.canprof').trigger('click');
		$("#edpfsuccess").html('');
		},
        contentType: false,
        processData: false
    });
	return false;
		}
	});
	// Clears any fields in the form when the user clicks on them
	$(":input").focus(function(){if ($(this).hasClass("needsfilled") ) {$(this).val("");$(this).removeClass("needsfilled");}});
});	
})(jQuery);
$(".canprof").click(function() {  
	 $('.edpfsuccess').html('');
	 }); 
$(document).ready(function($) {
 $("#myPassword").strength({
    wrapper: true,
    showHideButtonText: 'Show',
    showHideButtonTextToggle: 'Hide'
  });
});


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
<!-- Reset values -->
$('#get-started').on('hidden.bs.modal', function () {
    $('#services').hide();
    $(this).find('form').trigger('reset');
});


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





	(function($){
$(document).ready(function(){
	required = ["full_name","other_guidelines"];
	email = $("#email");
	errornotice = $("#error");
	successnotice = $("#success");
	emptyerror = "Please fill out this field.";
	emailerror = "Please enter a valid e-mail.";
$('.progress').progressbar({ value: 0});


	$("form#p2h5").submit(function(){
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
			if ((textarea.val() == "") || (textarea.val() == emptyerror)) {
				textarea.addClass("needsfilled");
				textarea.val(emptyerror);
				errornotice.fadeIn(750);
			} else {
				textarea.removeClass("needsfilled");
			}
		}
		var filesuploads= $('#filesupload0').val();
		var sharedlink =$('#shared_link').val();
		if(filesuploads=="" && sharedlink==""){$('#filesupload0').addClass("needsfilled");$('#shared_link').addClass("needsfilled");
		$('#shared_link').val(emptyerror);$('#blank_error').css("display","block");
		$('.browse-files').css("border","2px dashed #FF0000");}
		if(filesuploads!="" && sharedlink==""){$('#filesupload0').removeClass("needsfilled");$('#shared_link').removeClass("needsfilled");$('#shared_link').val('');$('#blank_error').css("display","none");$('.browse-files').css("border","2px dashed #5ddea8");}
		if(filesuploads=="" && sharedlink!=""){$('#filesupload0').removeClass("needsfilled");$('#shared_link').removeClass("needsfilled");$('#blank_error').css("display","none");$('.browse-files').css("border","2px dashed #5ddea8");}
		if (!/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(email.val())) {email.addClass("needsfilled");email.val(emailerror);}
		if ($(":input").hasClass("needsfilled")) {
		return false;
		}
		else if ($("#other_guidelines").hasClass("needsfilled")) {
		return false;
		} else {
			var liIds = $('#filelist li span').map(function(i,n) {return $(n).html();}).get().join(',');
	$('#xddsubmit').val(liIds);
		$(".preloader-p2h").addClass('popdiv');
		var formData = new FormData($(this)[0]);
	$(document).ajaxStart(function(){
	$(window).scrollTop($('#about').offset().top);
	$('.submit-btn').attr("disabled", "disabled").addClass('regbutton');
	$('.progress').progressbar({ value: 50 });
	$('.loader-btn').css("left","44%");
	$('.bar_precent').html("50% process complete");
	$('.bfupload').css("display","block");
	}).ajaxStop(function(){
	$('.progress').progressbar({ value: 100 });
	$('.loader-btn').css("left","94%");
	$('.bar_precent').html("100% process completed");
	$('.loader-cont').css("display","block");
	$('.bfupload').css("display","none");
	$("#p2h5")[0].reset();
	});
	$.ajax({
        url: "register.php",
        type: 'POST',
        data: formData,
        async: true,
        success: function (data) {
		  //alert(data);
		 //window.setTimeout(function() {window.location.href = 'https://www.psd2html5.co/myorders?vf';}, 5000);
		if(data =='homepage'){window.setTimeout(function() {window.location.href = 'http://www.p2h5.com/beta/myorders?vf';}, 5000);}
			else {window.setTimeout(function() {window.location.href = 'http://www.p2h5.com/beta/myorders';}, 5000);}
        },
        contentType: false,
        processData: false
    });
	return false;
		}
		e.preventDefault();
	});
	$(":input").focus(function(){if ($(this).hasClass("needsfilled") ) {$(this).val("");$(this).removeClass("needsfilled");}});
});
$(document).ready(function(){
$('ul#filelist').on("click","li i", function(){
var id= $(this).attr('id');
$('ul#filelist li#'+id).remove();
});

	$(window).scroll(function() {
    var scroll = $(window).scrollTop();
    if (scroll >= 300) {$(".back-top").addClass("sh-iocn");}
    if (scroll < 300) {$(".back-top").removeClass("sh-iocn");}
   });
	$('.scrollToTop').click(function(){
		$('html, body').animate({scrollTop : 0},'slow');
		return false;
	});
$('.lw-price a, .table-bottom a,.get-btn,.get-btn2,get-btn6').bind('click',function(event){
var $anchor = $(this);
$('html, body').stop().animate({ scrollTop: $($anchor.attr('href')).offset().top }, 1200,'swing');
event.preventDefault();
	});
	$(".navbar-toggle").on('click', function() {
	$(this).toggleClass("open-togle");
	});
$("#mc-embedded-subscribe").click(function(){
var qemail= $('#mce-EMAIL').val();
var name= $('#mce-FNAME').val();
re= /^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/;
if(name=="" && qemail==""){
$('#mce-FNAME').attr("placeholder", "Please Enter Name").addClass('val_error');
$('#mce-EMAIL').attr("placeholder", "Please Enter Your Email Address").addClass('val_error').val('');
	 return false;
}
else if(name=="" && !re.test(qemail))	{
$('#mce-FNAME').attr("placeholder", "Please Enter Name").addClass('val_error');
$('#mce-EMAIL').attr("placeholder", "Please Enter Valid Email Address").addClass('val_error').val('');
	return false;
}
else if(qemail=="" && name!="")
 {
$('#mce-EMAIL').attr("placeholder", "Please Enter Your Email Address").addClass('val_error').val('');
	return false;
} else if(re.test(qemail) && name=="")	{
$('#mce-FNAME').attr("placeholder", "Please Enter Name").addClass('val_error');
	return false;
}
else if(qemail!="" && name=="")
 {
$('#mce-FNAME').attr("placeholder", "Please Enter Name").addClass('val_error');
	return false;
}
else{
	$('#mce-success-response').show().html(" Thanks for subscribed to PSD2HTML5.CO");
		return false;
}
});
});
})(jQuery);

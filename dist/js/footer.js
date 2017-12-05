
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

// image upload
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

//submit

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

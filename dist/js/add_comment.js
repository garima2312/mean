function comentattachments() {
			var zix = parseInt($("#counterno").val());
			var input = document.getElementById("filesatch"+zix);
			var ul = document.getElementById("cmlist");
			//while (ul.hasChildNodes()) {
		//		ul.removeChild(ul.firstChild);
		//	}

		if (input.files.length==1){
		var z =1;
		var f = z+zix;
	$('#cmlist').append('<li id='+zix+'><span>'+input.files[0].name+'</span>&nbsp;<i class="fa fa-times-circle" id='+zix+'></i></li>');
	$('#counterno').val(f);
	$('.browse_file').append('<input id="filesatch'+f+'" class="comtatth" name="uploads[]" type="file" accept=".png,.jpg,.zip,.pdf,.gif,.jpeg" multiple onChange="comentattachments()" >');
		}
	else{
			for (var i = 0; i < input.files.length; i++) {
				$('#cmlist').append('<li id='+zix+'><span>'+input.files[i].name+'</span>&nbsp;<i class="fa fa-times-circle" id='+zix+'></i></li>');
	zix++;
	$('#counterno').val(zix);
	if (i === input.files.length-1){
	$('.browse_file').append('<input id="filesatch'+zix+'" class="comtatth" name="uploads[]" type="file" accept=".png,.jpg,.zip,.pdf,.gif,.jpeg" multiple onChange="comentattachments()" >');
}
			}
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
		var liIds = $('#cmlist li span').map(function(i,n) {return $(n).html();}).get().join(',');
		//alert(liIds);
		$('#xddsubmit').val(liIds);
		$('#cmmessage').css('border','1px solid #ccc');
	 	var formData = new FormData($(this)[0]);
		//loder
		$(document).ajaxStart(function(){
		//console.log('start loading');
		$('.submit-btn').attr("disabled", "disabled").addClass('loading');
		$('.image_loading').addClass('loading_image').css("display","block");
		}).ajaxStop(function(){
		$('.submit-btn').removeAttr("disabled").removeClass('loading');
		$('.image_loading').removeClass('loading_image').css("display","none");
			//console.log('end loading');
		});
		//alert(formData);
		//alert('heyff');
	$.ajax({
        url: "add_comment.php",
        type: 'POST',
        data: formData,
				contentType: false, // NEEDED, DON'T OMIT THIS
				processData: false, // NEEDED, DON'T OMIT THIS
				async: true,
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
$(document).ready(function(){
$('ul#cmlist').on("click","li i", function(){
var id= $(this).attr('id');
$('ul#cmlist li#'+id).remove();
});
});

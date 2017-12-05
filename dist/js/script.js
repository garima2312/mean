$('.drop-down').hover(function(){
    $(this).toggleClass('active');
});
$('.category-main li').hover(function(){
    $(this).siblings().removeClass('active');
    $(this).addClass('active');
});
$('.category-main li a').hover(function(){
    var categ = $(this).attr('href');
    var id = $(categ).attr('id');
    var result = "#"+id;
    if(categ == result){
        $(categ).siblings().removeClass('active');
        $(categ).addClass('active');
    }
});
$(window).scroll(function() {
    var scroll = $(window).scrollTop();
    if (scroll >= 1) {
        $('.navigation-outer').addClass('fixed');
        $('.hiden-nav').addClass('fix-nav');
    } 
    else {
        $('.navigation-outer').removeClass('fixed');
        $('.hiden-nav').removeClass('fix-nav');
    }
}); 

if ($(window).width() < 640) {                      
   $(document).ready(function () {
      $('.footer-nav h4').click(function () {
        $('.footer-nav ul').slideUp('500');
        $('h4').children('span').html('<i class="fa fa-plus"></i>');	
        var text = $(this).parent().children('.footer-nav ul');
        if (text.is(':hidden')) {text.slideDown('500');$(this).children('span').html('<i class="fa fa-minus"></i>');}
        else {text.slideUp('500');$(this).children('span').html('<i class="fa fa-plus"></i>');}
      });
    });
}

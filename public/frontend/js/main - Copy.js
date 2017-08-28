// -------------------------------------------------- Main Slider ------------------------------------------------------------------------//
$('.main-slider').slick({
    dots: true,
	arrows: false,
	autoplay: false,
    autoplaySpeed: 2000,
    pauseOnDotsHover: true,
  });

// --------------------------------------------------Thumb Slider------------------------------------------------------------------------//
 $('.item-slider').slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  arrows: false,
  fade: false,
  asNavFor: '.thumb-slider'
});
$('.thumb-slider').slick({
  slidesToShow: 4,
  slidesToScroll: 1,
  asNavFor: '.item-slider',
  arrows: false,
  centerMode: true,
  focusOnSelect: true,
     responsive: [{
      breakpoint: 767,
      settings: {
        slidesToShow: 2,
      }}]

});
// --------------------------------------------------Clients Carousel------------------------------------------------------------------------//
$('.categories').slick({
	rows: 2,
  slidesToShow:4,
  infinite: true,
  slidesToScroll: 1,
  autoplay: false,
  autoplaySpeed: 4510,
   responsive: [{
      breakpoint: 639,
      settings: {
        slidesToShow: 2,
      }}]
});
// --------------------------------------------------Services Carousel------------------------------------------------------------------------//

$('.homeproduct112').slick({
	
  slidesToShow: 4,
  slidesToScroll: 1,
  autoplay: false,
  autoplaySpeed: 3000,
   responsive: [{
      breakpoint: 639,
      settings: {
        slidesToShow: 1,
      }}]
  
});









/*$('.homeproduct').resize();*/



// --------------------------------------------------Testimonials Carousel------------------------------------------------------------------------//
$('.testimonial').slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  autoplay: true,
  adaptiveHeight: true,
  autoplaySpeed: 2000,
});

$(document).ready(function() {
	if ($('#menu-main-menu-1').onePageNav) {
        $('#menu-main-menu-1').onePageNav();
    }
});


// --------------------------------------------------Toggle Search------------------------------------------------------------------------//

$(document).ready(function(){
  $(".searchtoggle").click(function(){
    $(".searchpanel").slideToggle("slow");
  });
  
  
  
});

// --------------------------------------------------Tabs------------------------------------------------------------------------//

$(document).ready(function() {
   $(".tabs-menu a.tabLink").click(function(event) {
        event.preventDefault();
        $(this).parent().addClass("current");
        $(this).parent().siblings().removeClass("current");
        var tab = $(this).attr("href");
       $(this).parents('ul.tabs-menu').siblings('div.tab').find('.tab-content').not(tab).css("display", "none");
        $(tab).fadeIn();
    });
});
// --------------------------------------------------Tabs Left------------------------------------------------------------------------//
$(document).ready(function() {
    $(".tabs-left a").click(function(event) {
        event.preventDefault();
        $(this).parent().addClass("current");
        $(this).parent().siblings().removeClass("current");
        var tab = $(this).attr("href");
        $(".tabsleft-content").not(tab).css("display", "none");
        $(tab).fadeIn();
    });
});
// --------------------------------------------------Accordion-----------------------------------------------------------------------//
$(document).ready(function(){
  $('.set > a').on("click", function(){
    if($(this).hasClass('active')){
      $(this).removeClass("active");
      $(this).siblings('.content').slideUp(200);
      $(".set > a i").removeClass("fa-minus").addClass("fa-plus");
    }else{
      $(".set > a i").removeClass("fa-minus").addClass("fa-plus");
    $(this).find("i").removeClass("fa-plus").addClass("fa-minus");
    $(".set > a").removeClass("active");
    $(this).addClass("active");
    $('.content').slideUp(200);
    $(this).siblings('.content').slideDown(200);
    } 
  });
});
// --------------------------------------------------Custom Scroll bar------------------------------------------------------------------------//
(function($){
	$(window).on("load",function(){
		$(".customscroll").mCustomScrollbar({
			theme:"minimal"
		});
	});
})(jQuery);
	var $grid =$('.grid').isotope({
	  itemSelector: '.grid-item',
	  masonry: {
    	gutter: 5
	  }
	});	
	// filter items on button click
	$('.filter-button-group').on( 'click', 'button', function() {
	  var filterValue = $(this).attr('data-filter');
	  $grid.isotope({ filter: filterValue });
	  
	});
	
// --------------------------------------------------Responsive Simple Navigation----------------------------------------------//
(function($) {
$.fn.menumaker = function(options) {   
var cssmenu = $(this), settings = $.extend({
title: "Menu",
format: "dropdown",
sticky: false
}, options);
return this.each(function() {
cssmenu.prepend('<div id="menu-button">' + settings.title + '</div>');
$(this).find("#menu-button").on('click', function(){
$(this).toggleClass('menu-opened');
var mainmenu = $(this).next('ul');
if (mainmenu.hasClass('open')) { 
mainmenu.hide().removeClass('open');
}else {
mainmenu.show().addClass('open');
if (settings.format === "dropdown") {
mainmenu.find('ul').show();}}});
cssmenu.find('li ul').parent().addClass('has-sub');
multiTg = function() {
cssmenu.find(".has-sub").prepend('<span class="submenu-button"></span>');
cssmenu.find('.submenu-button').on('click', function() {
$(this).toggleClass('submenu-opened');
if ($(this).siblings('ul').hasClass('open')) {
$(this).siblings('ul').removeClass('open').hide();}
else {$(this).siblings('ul').addClass('open').show();}});};
if (settings.format === 'multitoggle') multiTg();
else cssmenu.addClass('dropdown');
if (settings.sticky === true) cssmenu.css('position', 'fixed');
resizeFix = function() {
if ($( window ).width() > 768) {
cssmenu.find('ul').show();}
if ($(window).width() <= 768) {
cssmenu.find('ul').hide().removeClass('open');}};
resizeFix();
return $(window).on('resize', resizeFix);});};
})(jQuery);
(function($){
$(document).ready(function(){
$(".menu-header").menumaker({
title: "Menu",
format: "multitoggle"
});});})(jQuery);

// --------------------------------------------------Humberg Push Navigation------------------------------------------------------------------------//
(function($){
jQuery(document).ready(function(){
    if(jQuery('.menu-main-menu-container').navAccordion) {
        jQuery('.menu-main-menu-container').navAccordion({
                expandButtonText: '›',  //Text inside of buttons can be HTML
                collapseButtonText: '‹'
            },
            function () {
                console.log('Callback')
            });
    }
});
  $('a#hamburg').on('click',function(e){
    $('html').toggleClass('open-menu');
    return false;
  });
  $('div#hamburg').on('click',function(){
    $('html').removeClass('open-menu');
  })
  $(document).ready(function(){
	$('.nav-cross').click(function(){
		$(this).toggleClass('open');
	});
});
})(jQuery)
/*------------------------------------------- ------- Header Fix---------------------------------------------------------------*/
$(function(){
var shrinkHeader = 200;
$(window).scroll(function() {
var scroll = getCurrentScroll();
  if ( scroll >= shrinkHeader ) {
	   $('.nav').addClass('fixed');}
	else {
		$('.nav').removeClass('fixed');}});
function getCurrentScroll() {
return window.pageYOffset;
}});
/*    ----------------------------------------------- Windows Size -------------------------------------------------------- */
var WindowsSize=function(){
var h=$(window).height(),w=$(window).width();
$("#winSize").html("<p>Width: "+w+"<br>Height: "+h+"</p>");};
$(document).ready(function(){WindowsSize();}); 
$(window).resize(function(){WindowsSize();}); 
/*----------------------------------------------------Back to top---------------------------------------------------------------*/
$(document).ready(function(){$("#back-top").hide();$(function(){$(window).scroll(function(){if($(this).scrollTop()>100){$("#back-top").fadeIn()}else{$("#back-top").fadeOut()}});$("#back-top a").click(function(){$("body,html").animate({scrollTop:0},800);return false})})})















//plugin bootstrap minus and plus
//http://jsfiddle.net/laelitenetwork/puJ6G/
$('.btn-number').click(function(e){
    e.preventDefault();
    
    fieldName = $(this).attr('data-field');
    type      = $(this).attr('data-type');
    var input = $("input[name='"+fieldName+"']");
    var currentVal = parseInt(input.val());
    if (!isNaN(currentVal)) {
        if(type == 'minus') {
            
            if(currentVal > input.attr('min')) {
                input.val(currentVal - 1).change();
            } 
            if(parseInt(input.val()) == input.attr('min')) {
                $(this).attr('disabled', true);
            }

        } else if(type == 'plus') {

            if(currentVal < input.attr('max')) {
                input.val(currentVal + 1).change();
            }
            if(parseInt(input.val()) == input.attr('max')) {
                $(this).attr('disabled', true);
            }

        }
    } else {
        input.val(0);
    }
});
$('.input-number').focusin(function(){
   $(this).data('oldValue', $(this).val());
});
$('.input-number').change(function() {
    
    minValue =  parseInt($(this).attr('min'));
    maxValue =  parseInt($(this).attr('max'));
    valueCurrent = parseInt($(this).val());
    
    name = $(this).attr('name');
    if(valueCurrent >= minValue) {
        $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the minimum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    if(valueCurrent <= maxValue) {
        $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the maximum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    
    
});
$(".input-number").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
             // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) || 
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
	
	
	
	
	
	
	
	
	//plugin bootstrap minus and plus
//http://jsfiddle.net/laelitenetwork/puJ6G/
$('.btn-number1').click(function(e){
    e.preventDefault();
    
    fieldName = $(this).attr('data-field');
    type      = $(this).attr('data-type');
    var input = $("input[name='"+fieldName+"']");
    var currentVal = parseInt(input.val());
    if (!isNaN(currentVal)) {
        if(type == 'minus') {
            
            if(currentVal > input.attr('min')) {
                input.val(currentVal - 1).change();
            } 
            if(parseInt(input.val()) == input.attr('min')) {
                $(this).attr('disabled', true);
            }

        } else if(type == 'plus1') {

            if(currentVal < input.attr('max')) {
                input.val(currentVal + 1).change();
            }
            if(parseInt(input.val()) == input.attr('max')) {
                $(this).attr('disabled', true);
            }

        }
    } else {
        input.val(0);
    }
});
$('.input-number12').focusin(function(){
   $(this).data('oldValue', $(this).val());
});
$('.input-number12').change(function() {
    
    minValue =  parseInt($(this).attr('min'));
    maxValue =  parseInt($(this).attr('max'));
    valueCurrent = parseInt($(this).val());
    
    name = $(this).attr('name');
    if(valueCurrent >= minValue) {
        $(".btn-number[data-type='minus1'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the minimum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    if(valueCurrent <= maxValue) {
        $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the maximum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    
    
});
$(".input-number12").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
             // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) || 
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });



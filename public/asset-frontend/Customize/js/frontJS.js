/* ===== JQUERY I ===== */
$(window).scroll(function(){

	var wScroll = $(this).scrollTop();

/* ===== Logo Handling ===== */
	$('.logo').css({
		'transform' : 'translate(0px, '+ wScroll /5 +'%)'
	});

/* ===== Student-pict Handling ===== */
	$('.student-top').css({
		'transform' : 'translate(0px, '+ wScroll /3 +'%)'
	});

/* ===== Student-pict Handling ===== */
	$('.student-bottom').css({
		'transform' : 'translate(0px, -'+ wScroll /20 +'%)'
	});

/* ===== hr Show-hide ===== */
	$('.hr').removeClass('none').addClass('articles-list');

/* ===== Navbar Show-hide ===== */
	if(wScroll > 500){

		$('nav').each(function(){

			$('nav').removeClass('nav-none').addClass('nav-collapse');

		});

	}else{

		$('nav').each(function(){

			$('nav').removeClass('nav-collapse').addClass('nav-none');

		});

	};

/* ===== Footer Show-hide ===== */
	if(wScroll > 500){

		$('#footer').each(function(){

			$('#footer').removeClass('footer-collapse').addClass('footer-none');

		});

	}else{

		$('#footer').each(function(){

			$('#footer').removeClass('footer-none').addClass('footer-collapse');

		});

	};

/* ===== Sticky Footer Show-hide ===== */
	if(wScroll > 314){

		$('#sticky span').each(function(){

			$('#sticky span').removeClass('sticky-none').addClass('sticky-footer');

		});

	}else{

		$('#sticky span').each(function(){

			$('#sticky span').removeClass('sticky-footer').addClass('sticky-none');

		});

	};

/* ===== Random logo Show-hide ===== */
	if(wScroll > $('.content').offset().top -
		($(window).height() / 5.5)){

		$('.pics-logo figure').each(function(){

			$('.pics-logo figure').removeClass('is').addClass('show');

			$('.hr-1').removeClass('none').addClass('articles-list');

		});

	}

/* ===== Programs Show-hide ===== */
	if(wScroll > $('.content').offset().top -
		($(window).height() / 500)){

		$('.programs').each(function(){

			$('.list-program').removeClass('move-down').addClass('down');

			$('.list-program').removeClass('move-down').addClass('down');

			$('ul .list-program').removeClass('move-left').addClass('moveleft');

			$('.hr-2').removeClass('none').addClass('articles-list');

		});

	}

/* ===== Programs ul Show-hide ===== */
	if(wScroll > $('.pics-logo').offset().top -
		($(window).height() / 5000)){

		$('.programs ul').each(function(){

			$('.list-program').removeClass('move-left').addClass('moveleft');

			$('.hr-2').removeClass('none').addClass('articles-list');

		});

	}

});

/* ===== JQUERY II ===== */
$(document).ready(function(){

/* ===== Sticky Footer handling e ===== */
	$('.sticky').click(function(){

		$('html, body').animate({ scrollTop : 0 },1000);

		return false;

	});

});
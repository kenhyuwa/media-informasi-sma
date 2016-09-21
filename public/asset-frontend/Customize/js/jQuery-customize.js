/* ========== INDEX JAVASCRIPT ========== */
/* ===== JQUERY I ===== */
$(window).scroll(function(){

	var wScroll = $(this).scrollTop();
	var windowWidth = window.innerWidth;

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
	if(windowWidth > 768){
		if(wScroll > 300){

			$('header').each(function(){

				$('header').removeClass('nav-menu').addClass('nav-menu-collapse').css({
					'opacity': '0.99',
					'background-color':'#3c8dbc'
				});
				$('.brands-logo').css({'color':'#f6f6f6','transition':'all 0.3s ease','text-shadow': '0px 3px 2px #35373A'});
				$('span.icon > i.icon').css('color','#f6f6f6');

			});

		}else{

			$('header').each(function(){

				$('header').removeClass('nav-menu-collapse').addClass('nav-menu').css({
					'opacity': '1',
					'background-color':'#fffff9'
				})
				$('.brands-logo').css({'color':'#35373A','transition':'all 0.3s ease','text-shadow': '0px 0px 0px #35373A'});
				$('span.icon > i.icon').css('color','#22A7F0');

			});

		};
	}

	if($('#btn-menu').has('checked')){
		$('header').addClass('nav-menu-collapse');
	}else{
		$('header').removeClass('nav-menu-collapse');
	}
	if(wScroll <= 0){
		$('header').addClass('nav-menu').removeClass('nav-menu-collapse');
	}
/* ===== Random logo Show-hide ===== */
	if(wScroll > $('.content').offset().top -
		($(window).height() / 5.5)){

		$('.pics-logo figure').each(function(){

			$('.pics-logo figure').removeClass('is').addClass('show');

			$('.hr-1').removeClass('none').addClass('articles-list');

		});

	}			

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

/* ===== get window width ===== */
	
	if(windowWidth > 768){
		if(wScroll < 300){
				$('.submenu,.single-menu').mouseenter(function(){
					$(this).find('.icon i.icon').css({
						'transform':'rotate(360deg)','color':'#f6f6f6'});
					$(this).find('.arrow i.fa-chevron-left').css({
						'transform':'rotate(-90deg)','color':'#f6f6f6'});
				});
				$('.submenu,.single-menu').mouseleave(function(){
					$(this).find('.icon i.icon').css({
						'transform':'rotate(0deg)','color':'#22A7F0'});
				});
			}else{
				$('.submenu,.single-menu').mouseenter(function(){
					$(this).find('.icon i.icon').css({
						'transform':'rotate(360deg)','color':'#22A7F0'});
					$(this).find('.arrow i.fa-chevron-left').css({
						'transform':'rotate(-90deg)','color':'#22A7F0'});
				});
				$('.submenu,.single-menu').mouseleave(function(){
					$(this).find('.icon i.icon').css({
						'transform':'rotate(0deg)','color':'#f6f6f6'});
				});
			}
		$('.submenu,.single-menu').mouseenter(function(){
			$(this).css('background-color','#35373A');
			$(this).find('.a-menu').css('color','#00D054');

		});
		$('.submenu,.single-menu').mouseleave(function(){
			$(this).css('background-color','transparent');
			$('.a-menu').css('color','#35373A');
			$('.arrow i.fa-chevron-left').css({'transform':'rotate(0deg)','color':'#35373A'});

		});
	}

/* ===== Programs Show-hide ===== */
	if(wScroll > $('.content').offset().top -
		($(window).height() / 500)){

		$('.programs').each(function(){

			$('.list-program').removeClass('move-down').addClass('down');

			$('.list-program').removeClass('move-down').addClass('down');

			$('ul .list-program').removeClass('move-left').addClass('move-left');

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

/* ===== Sticky Footer event ===== */
	$('.sticky').click(function(){

		$('html, body').animate({ scrollTop : 0 },1000);

		return false;

	});

});

/* ========== HOME JAVASCRIPT ========== */
$(function(){
		$('.submenu').click(function(){
			$(this).children('ul').slideToggle();
			$(this).find('.arrow i.fa-chevron-left').toggleClass('fa-chevron-down');
			// $('html, body').animate({ scrollTop : 1},1000);

			return false;
		});

		$('ul').click(function(p){
			p.stopPropagation();
		});

	var Accordion = function(el, multiple) {
		this.el = el || {};
		this.multiple = multiple || false;

		var links = this.el.find('.link');
		links.on('click', {el: this.el, multiple: this.multiple}, this.dropdown)
	}
	Accordion.prototype.dropdown = function(e){
		 var 	$el = e.data.el;
		 		$this = $(this),
		 		$next = $this.next();
		 $next.slideToggle();
		 $this.parent().toggleClass('open-accordion');

		 if(e.data.multiple){
		 	$el.find('.submenu-accordion').not($next).slideUp().parent().removeClass('open-accordion');
		 };
	}
	var accordion = new Accordion($('#accordion'), true);

	$(document).on('click','#book',function(){
		var form = $('form').serializeArray();
		var user = $('#username').val();
		var email = $('#email').val();
		var pesan = $('#pesan').val();
		$('#guestbook').toggleClass('open-book');
		$.each(form, function(){
	                $('#username').val('');
	                $('#email').val('');
	                $('#pesan').val('');});
	});

	$(document).on('click', '#btn-book', function(){
		var form = $('form').serializeArray();
		var url = $('form').attr('action');
		var user = $('#username').val();
		var email = $('#email').val();
		var pesan = $('#pesan').val();
		if(user ==''){
			$('#user-data').fadeIn(2000, function(){
                $(this).hide();
              });
              $('#user-data').text('Nama tidak boleh kosong !');
              return false;
		}
		if(email ==''){
			$('#email-data').fadeIn(2000, function(){
                $(this).hide();
              });
              $('#email-data').text('Email tidak boleh kosong !');
              return false;
		}
		if(pesan ==''){
			$('#pesan-data').fadeIn(2000, function(){
                $(this).hide();
              });
              $('#pesan-data').text('Isi pesan tidak boleh kosong !');
              return false;
		}
		$.ajax({
			type:'post',
			url:url,
			datatype:'json',
			data:{
				username:user,email:email,pesan:pesan
			},
	          beforeSend:function(xhr){
	            var token = $('meta[name="csrf_token"]').attr('content');

	            if(token){
	              return xhr.setRequestHeader('X-CSRF-TOKEN',token);
	            }
	          },
			success:function(data){
				if(data.success =='true'){
					$('#user-data').fadeIn(2000, function(){
		                $(this).hide();
		              });
	              $('#user-data').text('Pesan terkirim !');
	              //$('#guestbook').toggleClass('open-book'),5000;
	               $.each(form, function(){
	                $('#username').val('');
	                $('#email').val('');
	                $('#pesan').val('');
              });
				}
				if(data.success =='false'){
					$('#user-data').fadeIn(2000, function(){
	                $(this).hide();
	              });
	              $('#user-data').text('Lengkapi pesan Anda !');
				}
			}
		});
	});
});
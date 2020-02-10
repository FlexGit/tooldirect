$(function() {
	$('input[type="tel"]').mask('+7(000)000-00-00', {placeholder: "+7(___)___-__-__"});

	$('.js-product-menu-item').on('click', function() {
		$this = $(this);
		var $row = $this.closest('.product__row');

		$row.find('.js-product-menu-item').removeClass('is-active');
		$this.addClass('is-active');

		$row.find('.js-product-menu-caption').text($this.text());

		$.ajax({
			url: '/local/ajax/section_main.php',
			type: 'POST',
			data: 'section_id=' + $this.data('section_id') + '&section_parent_id=' + $this.data('section_parent_id') + '&section_url=' + $this.data('section_url'),
			cache: true,
			async: true,
			success: function(response){
				//console.log(response);
				$row.find('.js-product-items').html(response);
				$row.find('.product__menu-button').attr('href', $this.data('section_url'));

				$('.product__item').lightGallery({
					selector: '.lightgallery',
					videojs: true
				});
			}
		});
	});

	/*$('.product__row').each(function(){
		$(this).find('.js-product-menu-item:first').trigger('click');
	});*/

	$('.js-tm-slider').owlCarousel({
	    loop: true,
	    margin: 20,
	    nav: true,
	    dots: false,
	    navText: ['&nbsp', '&nbsp'],
	    autoWidth: true,
		/*autoplay: true,
		autoplayTimeout: 3000,
		autoplayHoverPause: true,
		smartSpeed: 3000,*/
		lazyLoad: true,
		items: 6,
		/*responsiveClass: true,
		responsive     : {
			0   : { items: 1 },
			480 : { items: 2 },
			1325: { items: 3 }
		}*/
	});

	$('.js-tm-mslider').owlCarousel({
	    loop: true,
	    margin: 20,
	    nav: true,
	    dots: false,
	    navText: ['', ''],
	    autoWidth: true
	});


	$('.js-mtext-item').on('click', function() {
		$(this).toggleClass('is-opened');
	});

	$('.js-mtext-close-btn').parent().parent().parent().removeClass('is-opened');

	$('.js-mproduct-slider').owlCarousel({
	    loop: true,
	    margin: 20,
	    nav: true,
	    dots: false,
	    center: true,
	    navText: ['', ''],
	    items: 1
	});

	$('.js-mproduct-select-btn').on('click', function() {
		$(this).parent().find('.js-mproduct-select-items').toggleClass('is-opened');
		$(this).toggleClass('is-opened');
	});

	$('.js-mproduct-select-item').on('click', function() {
		$(this).parent().removeClass('is-opened');
		$(this).parent().parent().find('.js-mproduct-select-btn').removeClass('is-opened');
		var text = $(this).text();
		$(this).parent().parent().find('.js-mproduct-select-btn span').text(text);
		$(this).parent().parent().find('.js-mproduct-caption').text(text);

		$(this).parent().parent().find('.js-mproduct-slider-box').removeClass('is-visible');
		var slider = $(this).data('slider');
		$(this).parent().parent().find('.' + slider).addClass('is-visible');
	});


	$('.js-mheader-menu-btn').on('click', function() {
		$('.js-mmenu').addClass('is-opened');
	});

	$('.js-mmenu-close-btn').on('click', function() {
		$('.js-mmenu').removeClass('is-opened');
	});


	$('.js-catmenu-item').on('click', function() {
		$(this).toggleClass('is-opened');
	});


	$('.js-full-cat').on('click', function() {
		$('.js-catmenu').toggleClass('is-opened');
	});

	$('.tooltipster').tooltipster({
		side: 'right',
		delay: 0,
		theme: 'tooltipster-borderless'
	});

	$('.container').lightGallery({
		selector: '.lightgallery',
		videojs: true
	});

	var $body = $('body');

	$body.on('submit', '#dealerModalForm', function(e){
		e.stopPropagation();
		e.preventDefault();

		$this = $(this);

		$('.alert').text('').addClass('hidden');

		var data = $this.serialize();
		$.ajax({
			url: '/local/ajax/dealer.php',
			type: 'POST',
			data: data,
			cache: false,
			async: true,
			success: function(response){
				//console.log(response);
				var data = JSON.parse(response);
				if (data.success === true) {
					$('#dealerModal').find('.modal-body').text(data.msg);
				} else {
					$('.alert').text(data.msg).removeClass('hidden');
				}
			}
		});
	});

	$body.on('submit', '#toolOrderModalForm', function(e){
		e.stopPropagation();
		e.preventDefault();

		$this = $(this);

		$('.alert').text('').addClass('hidden');

		var data = $this.serialize();
		$.ajax({
			url: '/local/ajax/tool.php',
			type: 'POST',
			data: data,
			cache: false,
			async: true,
			success: function(response){
				//console.log(response);
				var data = JSON.parse(response);
				if (data.success === true) {
					$('#toolOrderModal').find('.modal-body').text(data.msg);
				} else {
					$('.alert').text(data.msg).removeClass('hidden');
				}
			}
		});
	});

	$body.on('click', '.js-addcart', function(){
		$this = $(this);
		var product_id = $this.data('product_id');
		var quantity = 1;
		var article = $this.data('article');
		var make = $this.data('make');

		$.ajax({
			url: '/local/ajax/add_cart.php',
			type: 'POST',
			data: 'product_id=' + product_id + '&quantity=' + quantity + '&article=' + article + '&make=' + make,
			cache: false,
			async: true,
			success: function(response){
				//console.log(response);
				var data = JSON.parse(response);
				//console.log(data.success);
				if(data.success === true) {
					$('.num_products').text(data.num);
					$('.total_price').text(data.sum);
					$('#add2cartModal').modal('show');
				}
			}
		});
	});
});
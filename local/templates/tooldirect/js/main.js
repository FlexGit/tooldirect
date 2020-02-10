$(function() {
	var $body = $('body');

	$('input[type="tel"]').mask('+7(000)000-00-00', {placeholder: "+7(___)___-__-__"});

	$(window).scroll(function () {
		if ($(this).scrollTop() > 50) {
			$('.back-to-top').fadeIn();
		} else {
			$('.back-to-top').fadeOut();
		}
	});

	$body.on('click', '.back-to-top', function() {
		$('body,html').animate({
			scrollTop: 0
		}, 400);
		return false;
	});

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

	$body.on('click', '.js-mtext-item', function() {
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

	$body.on('click', '.js-mproduct-select-btn', function() {
		$(this).parent().find('.js-mproduct-select-items').toggleClass('is-opened');
		$(this).toggleClass('is-opened');
	});

	$body.on('click', '.js-mproduct-select-item', function() {
		$(this).parent().removeClass('is-opened');
		$(this).parent().parent().find('.js-mproduct-select-btn').removeClass('is-opened');
		var text = $(this).text();
		$(this).parent().parent().find('.js-mproduct-select-btn span').text(text);
		$(this).parent().parent().find('.js-mproduct-caption').text(text);

		$(this).parent().parent().find('.js-mproduct-slider-box').removeClass('is-visible');
		var slider = $(this).data('slider');
		$(this).parent().parent().find('.' + slider).addClass('is-visible');
	});

	$body.on('click', '.js-mheader-menu-btn', function() {
		$('.js-mmenu').addClass('is-opened');
	});

	$body.on('click', '.js-mmenu-close-btn', function() {
		$('.js-mmenu').removeClass('is-opened');
	});

	$body.on('click', '.js-catmenu-item', function() {
		$(this).toggleClass('is-opened');
	});

	$body.on('click', '.js-full-cat', function() {
		$('.js-catmenu').toggleClass('is-opened');
	});

	$('.tooltipster').tooltipster({
		side: 'right',
		delay: 0,
		theme: 'tooltipster-borderless',
		contentCloning: true,
		maxWidth: 300
	});

	$('.container').lightGallery({
		selector: '.lightgallery',
		videojs: false,
		thumbnail: false,
		counter: true,
		appendSubHtmlTo: '.lg-item',
		download: false
	});

	$body.on('click', '.js-video', function(){
		var $modal = $('#videoModal');
		var id = $(this).data('id');
		var product_id = $(this).attr('data-product_id');
		//var buy_link = $(this).attr('data-buy_link');
		var article = $(this).data('article');
		var make = $(this).data('make');
		var title = $(this).data('title');
		var src = $(this).data('src');
		$('#videoModalLongTitle').text(title);
		$modal.find('video').attr('id', id).attr('src', src);
		$modal.find('source').attr('src', src);
		$modal.find('.js-addcart').data('product_id', product_id).data('article', article).data('make', make).data('name', title).data('edit', 0);
		$modal.modal('show');
		videojs(id).play();
	});

	$body.on('hidden.bs.modal', '#videoModal', function(){
		var id = $(this).find('video').attr('id');
		videojs(id).pause();
		videojs(id).currentTime(0);
	});

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
					$('.alert-success').text(data.msg).removeClass('hidden');
					$('#dealerModal').find('input,textarea').each(function() {
						$(this).val('');
					});
				} else {
					$('.alert-danger').text(data.msg).removeClass('hidden');
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
					$('.alert-success').text(data.msg).removeClass('hidden');
					$('#toolOrderModal').find('input,textarea').each(function() {
						$(this).val('');
					});
				} else {
					$('.alert-danger').text(data.msg).removeClass('hidden');
				}
			}
		});
	});

	$body.on('submit', '#buyModalForm', function(e){
		e.stopPropagation();
		e.preventDefault();

		$this = $(this);

		$('.alert').text('').addClass('hidden');

		var data = $this.serialize();
		$.ajax({
			url: '/local/ajax/buy.php',
			type: 'POST',
			data: data,
			cache: false,
			async: true,
			success: function(response){
				//console.log(response);
				var data = JSON.parse(response);
				if (data.success === true) {
					$('.alert-success').text(data.msg).removeClass('hidden');
					$('#buyModal').find('input,textarea').each(function() {
						$(this).val('');
					});
				} else {
					$('.alert-danger').text(data.msg).removeClass('hidden');
				}
			}
		});
	});

	$body.on('click', '.js-buy-modal', function(){
		var $modal = $('#buyModal');
		var product_id = $(this).attr('data-product_id');
		$modal.find('input[name="product_id"]').val(product_id);
		if ($(this).closest('.js-buy-block').find('input[name="quantity"]').length) {
			var quantity = $(this).closest('.js-buy-block').find('input[name="quantity"]').val();
			$modal.find('input[name="quantity"]').val(quantity);
		}
		$('#videoModal').modal('hide');
		$('.alert').text('').addClass('hidden');
		$modal.modal('show');
	});

	$body.on('click', '.js-product-menu-item', function(){
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

				$('body').on('mouseenter', '.tooltipster:not(.tooltipstered)', function(){
					$(this).tooltipster({
						side: 'right',
						delay: 0,
						theme: 'tooltipster-borderless',
						contentCloning: true,
						maxWidth: 300
					}).tooltipster('open');
				});

				/*$('.product__item').lightGallery({
					selector: '.lightgallery',
					videojs: true
				});*/
			}
		});
	});

	$body.on('keyup', 'input[name="quantity"]', function(){
		//$(this).next('.js-addcart').trigger('click');
		$this = $(this).next('.js-addcart');
		var product_id = $this.data('product_id');
		var quantity = 1;
		if ($this.closest('.product__item').find('input[name="quantity"]').length) {
			quantity = $this.closest('.product__item').find('input[name="quantity"]').val();
		}
		var article = $this.data('article');
		var make = $this.data('make');

		var data = 'product_id=' + product_id + '&quantity=' + quantity + '&article=' + article + '&make=' + make;
		console.log(data);

		$.ajax({
			url: '/local/ajax/edit_cart.php',
			type: 'POST',
			data: data,
			cache: false,
			async: true,
			success: function(response){
				//console.log(response);
				var data = JSON.parse(response);
				//console.log(data.success);
				if(data.success === true) {
					$('.num_products').text(data.num);
					$('.total_price').text(data.sum);
				}
			}
		});
	});

	$body.on('click', '.js-addcart', function(){
		$this = $(this);
		var product_id = $this.data('product_id');
		var quantity = 1;
		if ($this.closest('.product__item').find('input[name="quantity"]').length) {
			quantity = $this.closest('.product__item').find('input[name="quantity"]').val();
		}
		var article = $this.data('article');
		var make = $this.data('make');
		var name = $this.data('name');

		var data = 'product_id=' + product_id + '&quantity=' + quantity + '&article=' + article + '&make=' + make;
		console.log(data);

		$.ajax({
			url: '/local/ajax/add_cart.php',
			type: 'POST',
			data: data,
			cache: false,
			async: true,
			success: function(response){
				//console.log(response);
				var data = JSON.parse(response);
				//console.log(data.success);
				if(data.success === true) {
					$('.num_products').text(data.num);
					$('.total_price').text(data.sum);
					$('.modal-name').text(name);
					$('.modal-quantity').text(quantity + ' шт.');
					$('#add2cartModal').modal('show');
				}
			}
		});
	});
});
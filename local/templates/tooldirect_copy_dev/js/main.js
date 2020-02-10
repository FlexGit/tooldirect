$(function() {
	$('input[type="tel"]').mask('+7(000)000-00-00', {placeholder: "+7(___)___-__-__"});

	/*$('.js-tm-slider').owlCarousel({
	    loop: true,
	    margin: 20,
	    nav: true,
	    dots: false,
	    navText: ['', ''],
	    autoWidth: true
	});*/

	$('.slider-items').slick({
		infinite: true,
		slidesToShow: 4,
		slidesToScroll: 1,
		slide: '.product__item',
		prevArrow: '.owl-prev',
		nextArrow: '.owl-next',
		draggable: true,
		accessibility: false,
		swipeToSlide: true,
		touchMove: true
	});

	$('.slider-items2').slick({
		infinite: true,
		slidesToShow: 4,
		slidesToScroll: 1,
		slide: '.product__item',
		prevArrow: '.owl-prev2',
		nextArrow: '.owl-next2',
		draggable: true,
		accessibility: false,
		swipeToSlide: true,
		touchMove: true
	});

	/*$('.js-tm-mslider').owlCarousel({
	    loop: true,
	    margin: 20,
	    nav: true,
	    dots: false,
	    navText: ['', ''],
	    autoWidth: true
	});*/

	$('.js-mtext-item').on('click', function() {
		$(this).toggleClass('is-opened');
	});

	$('.js-mtext-close-btn').parent().parent().parent().removeClass('is-opened');

	/*$('.js-mproduct-slider').owlCarousel({
	    loop: true,
	    margin: 20,
	    nav: true,
	    dots: false,
	    center: true,
	    navText: ['', ''],
	    items: 1
	});*/

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

	$('#range').on("input", function () {
		$('.output').val(this.value);
	}).trigger("change");
	var options = [];

	$('.dropdown-menu a').on('click', function (event) {
		var $target = $(event.currentTarget),
			val = $target.attr('data-value'),
			$inp = $target.find('input'),
			idx;

		if ((idx = options.indexOf(val)) > -1) {
			options.splice(idx, 1);
			setTimeout(function () {
				$inp.prop('checked', false)
			}, 0);
		} else {
			options.push(val);
			setTimeout(function () {
				$inp.prop('checked', true)
			}, 0);
		}

		$(event.target).blur();

		console.log(options);
		return false;
	});

	$('.tooltipster').tooltipster({
		side: 'bottom',
		delay: 0,
		theme: 'tooltipster-borderless'
	});

	$('.container').lightGallery({
		selector: '.lightgallery',
		videojs: true,
		download: false
	});

	var $body = $('body');

	$body.on('click', '.js-addcart', function(){
		$this = $(this);
		var product_id = $this.data('product_id');
		var quantity = $this.closest('.product__price-box').find('input[name="quantity"]').val();
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

	$body.on('submit', '#orderForm', function(e){
		e.stopPropagation();
		e.preventDefault();

		$this = $(this);

		$('.success').text('').addClass('hidden');
		$('.alert').text('').addClass('hidden');

		var data = $this.serialize();
		$.ajax({
			url: '/local/ajax/order.php',
			type: 'POST',
			data: data,
			cache: false,
			async: true,
			success: function(response){
				//console.log(response);
				var data = JSON.parse(response);
				if (data.success === true) {
					$('.alert-success').html(data.msg).removeClass('hidden');
					$('#orderForm').remove();
					$('.total_price').text('0 руб.');
					$('.num_products').text('0');
				} else {
					$('.alert-danger').html(data.msg).removeClass('hidden');
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
					$('#buyModal').find('.modal-body').text(data.msg);
				} else {
					$('.alert').text(data.msg).removeClass('hidden');
				}
			}
		});
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

	$body.on('click', '.js-buy-modal', function(){
		$('.modal-body input[name="product_id"]').val($(this).data('product_id'));
		$('.modal-body input[name="quantity"]').val($(this).closest('.js-buy-block').find('input[name="quantity"]').val());
		$('.modal-body input[name="article"]').val($(this).data('article'));
		$('.modal-body input[name="make"]').val($(this).data('make'));
	});

	$body.on('click', '.js-smartfilter', function() {
		$this = $(this);

		if ($this.find('.filter_param').hasClass('active')) {
			$this.find('.filter_param').removeClass('active');
			if ($this.attr('data-code') === $('#smart_filter').attr('data-code')) {
				$('#smart_filter').attr('data-code', '').html('');
			}
			return false;
		}

		$('.js-smartfilter').find('.filter_param').removeClass('active');
		$this.find('.filter_param').addClass('active');

		var id = $this.data('id');
		var code = $this.data('code');
		var name = $this.data('name');
		var display_type = $this.data('display_type');
		var value_min = $this.data('value_min');
		var value_max = $this.data('value_max');
		var value_from = parseInt($this.attr('data-value_from'));
		var value_to = parseInt($this.attr('data-value_to'));
		var values = $this.data('values');
		var checked = $this.data('checked');

		var data = {
			"id": id,
			"code": code,
			"name": encodeURIComponent(name),
			"display_type": display_type,
			"value_min": value_min,
			"value_max": value_max,
			"value_from": value_from,
			"value_to": value_to,
			"values": encodeURIComponent(values),
			"checked": checked
		};

		//console.log(data);

		$.ajax({
			url: '/local/ajax/smart_filter.php',
			type: 'POST',
			data: data,
			dataType: 'html',
			cache: false,
			async: true,
			success: function(response){
				//console.log(response);
				$('#smart_filter').attr('data-code', code).html(response);

				if (display_type === 'A') {
					$('.js-range-slider').ionRangeSlider({
						skin: 'big',
						step: 1,
						onFinish: function (data) {
							//console.log(data.from + ' - ' + data.to);
							$this.attr('data-value_from', data.from);
							$this.attr('data-value_to', data.to);

							if (($this.data('value_min') !== data.from) || ($this.data('value_max') !== data.to)) {
								$this.find('.icon-cross').css('display', 'inline-block');
							} else {
								$this.find('.filter_param').removeClass('active');
								$this.find('.icon-cross').css('display', 'none');
							}
							sectionOutput();
						}
					});
				}
			}
		});
	});

	$body.on('click', '.js-smartfilter-chk', function() {
		var code = $(this).data('code');
		var $filter = $('.js-smartfilter[data-code="' + code + '"]');
		var value = $(this).next('label').text().trim();
		var checked = 0;
		if ($(this).prop('checked')) {
			checked = 1;
			if ($('.js-smartfilter-chk:checked').length === $('.js-smartfilter-chk').length) {
				$filter.find('.filter_param').removeClass('active');
				$filter.find('.icon-cross').css('display', 'none');
			}
		} else {
			$filter.find('.filter_param').addClass('active');
			$filter.find('.icon-cross').css('display', 'inline-block');
		}

		var currentCheckedObj = $filter.data('checked');
		currentCheckedObj[value] = checked;
		$filter.attr('data-checked', JSON.stringify(currentCheckedObj));

		sectionOutput();
	});

	$body.on('click', '.icon-cross', function(e) {
		e.stopPropagation();

		$this = $(this);
		$filter = $this.closest('.js-smartfilter');
		let range = $('.js-range-slider').data('ionRangeSlider');
		$this.css('display', 'none');
		$filter.find('.filter_param').removeClass('active');

		if ($filter.data('display_type') === 'A') {
			$filter.attr('data-value_from', $filter.data('value_min'));
			$filter.attr('data-value_to', $filter.data('value_max'));
			if (range !== undefined) {
				range.update({
					from: $filter.data('value_min'),
					to: $filter.data('value_max')
				});
			}
		} else {
			var currentCheckedObj = $filter.data('checked');
			$.each(currentCheckedObj, function(index, value){
				currentCheckedObj[index] = 1;
			});
			$filter.attr('data-checked', JSON.stringify(currentCheckedObj));

			$('.js-smartfilter-chk[data-code="' + $filter.data('code') + '"]').each(function() {
				if (!$(this).is(':checked')) {
					$(this).prop('checked', true);
				}
			});
		}

		if ($filter.data('code') === $('#smart_filter').attr('data-code')) {
			//$('#smart_filter').attr('data-code', '').html('');
		}

		sectionOutput();

		$filter.trigger('click');
	});

	$body.on('click', '#jur_type', function() {
		$('#pay').prop('selectedIndex', 0);
		if ($(this).is(':checked')) {
			$('.jur-type-container').removeClass('hidden');
			$('label[for="company"] span').removeClass('hidden');
			$('#pay option[value=1]').hide();
			$('#pay option[value=7], #pay option[value=8], #pay option[value=9]').show();
			$('#company').prop('required', true);
		} else {
			$('.jur-type-container').addClass('hidden');
			$('label[for="company"] span').addClass('hidden');
			$('#pay option[value=1]').show();
			$('#pay option[value=7], #pay option[value=8], #pay option[value=9]').hide();
			$('#company').prop('required', false);
		}
	});

	$body.on('change', '#delivery', function() {
		if ($(this).val() === '2') {
			$('label[for="address"] span').removeClass('hidden');
			$('#address').prop('required', true);
		} else if ($(this).val() === '3') {
			$('label[for="address"] span').addClass('hidden');
			$('#address').prop('required', false);
		}
	});

	var myMap;
	ymaps.ready(init);

	function init() {
		$body.on('click', '.city-radio', function() {
			$this = $(this);
			var code = $this.data('code');
			var coord = $this.data('coord').split(',');
			//console.log(coord);

			if (myMap) {
				myMap.destroy();
			}

			myMap = new ymaps.Map('map', {
				center: [coord[0], coord[1]],
				zoom: 10
			}, {
				searchControlProvider: 'yandex#search'
			}),
				objectManager = new ymaps.ObjectManager({
					// Чтобы метки начали кластеризоваться, выставляем опцию.
					clusterize: true,
					// ObjectManager принимает те же опции, что и кластеризатор.
					gridSize: 32,
					clusterDisableClickZoom: true
				});

			// Чтобы задать опции одиночным объектам и кластерам,
			// обратимся к дочерним коллекциям ObjectManager.
			objectManager.objects.options.set('preset', 'islands#redDotIcon');
			objectManager.clusters.options.set('preset', 'islands#redClusterIcons');
			myMap.geoObjects.add(objectManager);

			$.ajax({
				url: '/local/ajax/stores.php',
				type: 'POST',
				data: 'city=' + code/*,
				dataType: 'json',
				cache: false,
				async: true*/
			}).done(function(response) {
				console.log(response);
				response = JSON.parse(response);
				//console.log(data.stores);
				$('.stores').html(response.stores);
				objectManager.add(response.map);
			});
		});

		if ($('#city-radio-from').length) {
			$.ajax({
				url: '/local/ajax/cities.php'
			}).done(function(response) {
				console.log(response);
				$('#city-radio-from').html(response);
				$('.city-radio[data-code="moskva"]').trigger('click');
			});
		}
	}

	$body.on('submit', '#cityForm', function(e) {
		e.stopPropagation();
		e.preventDefault();

		console.log(111);

		$this = $(this);

		var data = $this.serialize();
		$.ajax({
			url: '/local/ajax/geo.php',
			type: 'POST',
			data: data,
			cache: false,
			async: true,
			success: function(response){
				response = JSON.parse(response);
				console.log(response);

				if (response.usercity[0] !== 'null') {
					$('.your-city').text(response.usercity[0]);
				}
				if (response.code !== 'null') {
					$('.city-radio').attr('checked', false);
					$('.city-radio[data-code="' + response.code + '"]').click();
				}
			}
		});
	});

	$body.on('click', '.map-geo', function() {
		var options = {
			enableHighAccuracy: true,
			timeout: 5000,
			maximumAge: 0
		};

		function success(pos) {
			console.log(pos);
			var crd = pos.coords;

			$('#coords').val(crd.longitude + ',' + crd.latitude);
			$('#city').val('');
			$('#cityForm').trigger('submit');
		}

		function error(err) {
			//console.warn('ERROR(' + err.code + '): ' + err.message);
			$('.city-radio[data-code="moskva"]').trigger('click');
		}

		navigator.geolocation.getCurrentPosition(success, error, options);
	});


	function sectionOutput() {
	var $section_id = $('#section_id').val();

	var dataAttr = [];
	$('.js-smartfilter').each(function() {
		if ($(this).find('.icon-cross').is(':visible')) {
			var data = $(this).data();
			data.value_from = parseInt($(this).attr('data-value_from'));
			data.value_to = parseInt($(this).attr('data-value_to'));
			//console.log(data);
			dataAttr.push(data);
		}
	});

	//console.log(dataAttr);

	var data = {
		"section_id": $section_id,
		"dataAttr": dataAttr
	};
	//console.log(data);
	$.ajax({
		url: '/local/ajax/section.php',
		type: 'POST',
		data: data,
		dataType: 'html',
		cache: false,
		async: true,
		success: function (response) {
			//console.log(response);
			$('#section').html(response);
		},
		error: function(jqXhr, textStatus, errorThrown) {
			console.log(errorThrown);
		}
	});
}
});

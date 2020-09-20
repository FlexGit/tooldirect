    <div class="footer">
        <div class="container">
            <div class="footer__row">
                <div class="footer__col-1">
                    <div class="footer__logo-box">
                        <img src="<?=SITE_TEMPLATE_PATH?>/images/logo-footer.png" alt="" class="footer__logo">
                        <div class="footer__logo-text">
							<?$APPLICATION->IncludeComponent(
								"bitrix:main.include",
								"",
								Array(
									"AREA_FILE_SHOW" => "file",
									"AREA_FILE_SUFFIX" => "inc",
									"EDIT_TEMPLATE" => "",
									"PATH" => SITE_DIR."include/footer_logo_text.php"
								)
							);?>
                        </div>
                    </div>
                    <div class="footer__contact">
                        <div class="footer__contact-caption">наши контакты</div>
                        <div class="footer__contact-items">
                            <div class="footer__contact-item">
                                <div class="footer__contact-name">Адрес:</div>
                                <div class="footer__contact-value">г. Москва, Иркутская ул. д11 к2</div>
                            </div>
                            <div class="footer__contact-item">
                                <div class="footer__contact-name">Телефон:</div>
                                <div class="footer__contact-value">+7(495) 984-41-55</div>
                            </div>
                            <div class="footer__contact-item">
                                <div class="footer__contact-name">E-mail:</div>
								<div class="footer__contact-value"><a href="mailto:zakaz@tooldirect.ru" class="footer__menu-link">zakaz@tooldirect.ru</a></div>
                            </div>
                        </div>
                    </div>
                </div> <!-- footer__col-1 -->
                <div class="footer__col-2">
                    <?/*<div class="footer__form-caption">Подпишись на рассылку - новости, новинки, поступления!</div>
                    <form action="#" class="footer__form">
                        <input type="text" class="footer__input" placeholder="Введите свой email...">
                        <input type="submit" class="footer__submit" value="подписаться">
                    </form>*/?>
                    <div class="footer__menu-box">
                        <div class="footer__menu">
                            <div class="footer__menu-caption">О нас</div>
							<?$APPLICATION->IncludeComponent(
								"bitrix:menu",
								"bottom-about-menu",
								array(
									"ALLOW_MULTI_SELECT" => "N",
									"CHILD_MENU_TYPE" => "left",
									"DELAY" => "N",
									"MAX_LEVEL" => "1",
									"MENU_CACHE_GET_VARS" => array(
									),
									"MENU_CACHE_TIME" => "36000000",
									"MENU_CACHE_TYPE" => "A",
									"MENU_CACHE_USE_GROUPS" => "Y",
									"ROOT_MENU_TYPE" => "bottom",
									"USE_EXT" => "N",
									"COMPONENT_TEMPLATE" => "bottom-about-menu"
								),
								false
							);?>
                        </div> <!-- footer__menu -->
                        <div class="footer__menu">
                            <div class="footer__menu-caption">каталог</div>
							<?
							global $arrFilterSectionMain;
							$arrFilterSectionMain = Array(
								"=UF_SEO_SECTION" => false,
								"=UF_USER_SECTION" => false,
								"=UF_USER_EXT_SECTION" => false,
							);
							?>
							<?$APPLICATION->IncludeComponent(
								"bitrix:catalog.section.list","footer", Array(
									"SHOW_PARENT_NAME" => "Y",
									"IBLOCK_TYPE" => "catalog",
									"IBLOCK_ID" => CATALOG_BLOCK_ID,
									"SECTION_ID" => "",
									"SECTION_CODE" => "",
									"SECTION_URL" => "",
									"COUNT_ELEMENTS" => "Y",
									"TOP_DEPTH" => "1",
									"SECTION_FIELDS" => "",
									"SECTION_USER_FIELDS" => Array('UF_*'),
									"USE_FILTER" => "Y",
									"FILTER_NAME" => "arrFilterSectionMain",
									"ADD_SECTIONS_CHAIN" => "N",
									"CACHE_TYPE" => "A",
									"CACHE_TIME" => "36000000",
									"CACHE_NOTES" => "",
									"CACHE_GROUPS" => "Y"
								)
							);?>
                        </div> <!-- footer__menu -->
                    </div> <!-- footer__menu-box -->
                </div> <!-- footer__col-2 -->
            </div> <!-- footer__row -->
        </div> <!-- container -->
    </div> <!-- footer -->
	<?$APPLICATION->IncludeComponent(
		"bitrix:main.include",
		"",
		Array(
			"AREA_FILE_SHOW" => "file",
			"AREA_FILE_SUFFIX" => "inc",
			"EDIT_TEMPLATE" => "",
			"PATH" => SITE_DIR."include/modal/video.php"
		)
	);?>
	<?$APPLICATION->IncludeComponent(
		"bitrix:main.include",
		"",
		Array(
			"AREA_FILE_SHOW" => "file",
			"AREA_FILE_SUFFIX" => "inc",
			"EDIT_TEMPLATE" => "",
			"PATH" => SITE_DIR."include/modal/dealer.php"
		)
	);?>
	<?$APPLICATION->IncludeComponent(
		"bitrix:main.include",
		"",
		Array(
			"AREA_FILE_SHOW" => "file",
			"AREA_FILE_SUFFIX" => "inc",
			"EDIT_TEMPLATE" => "",
			"PATH" => SITE_DIR."include/modal/toolorder.php"
		)
	);?>
	<?$APPLICATION->IncludeComponent(
		"bitrix:main.include",
		"",
		Array(
			"AREA_FILE_SHOW" => "file",
			"AREA_FILE_SUFFIX" => "inc",
			"EDIT_TEMPLATE" => "",
			"PATH" => SITE_DIR."include/modal/buy.php"
		)
	);?>
	<?$APPLICATION->IncludeComponent(
		"bitrix:main.include",
		"",
		Array(
			"AREA_FILE_SHOW" => "file",
			"AREA_FILE_SUFFIX" => "inc",
			"EDIT_TEMPLATE" => "",
			"PATH" => SITE_DIR."include/modal/add2cart.php"
		)
	);?>
	<?$APPLICATION->IncludeComponent(
		"bitrix:main.include",
		"",
		Array(
			"AREA_FILE_SHOW" => "file",
			"AREA_FILE_SUFFIX" => "inc",
			"EDIT_TEMPLATE" => "",
			"PATH" => SITE_DIR."include/counters.php"
		)
	);?>
	<?$APPLICATION->IncludeComponent(
		"bitrix:main.include",
		"",
		Array(
			"AREA_FILE_SHOW" => "file",
			"AREA_FILE_SUFFIX" => "inc",
			"EDIT_TEMPLATE" => "",
			"PATH" => SITE_DIR."include/modal/auth.php"
		)
	);?>
	<?$APPLICATION->IncludeComponent(
		"bitrix:main.include",
		"",
		Array(
			"AREA_FILE_SHOW" => "file",
			"AREA_FILE_SUFFIX" => "inc",
			"EDIT_TEMPLATE" => "",
			"PATH" => SITE_DIR."include/modal/reg.php"
		)
	);?>
	<a href="javascript:void(0);" class="btn btn-dark btn-lg back-to-top" role="button"></a>
	<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&apikey=eedee5e2-7f38-4efd-8c07-680bd00a559c" type="text/javascript"></script>
	<script src="<?=SITE_TEMPLATE_PATH?>/js/jquery-3.2.1.min.js"></script>
	<script src="<?=SITE_TEMPLATE_PATH?>/js/tooltipster.bundle.min.js"></script>
	<script src="<?=SITE_TEMPLATE_PATH?>/js/slick.min.js"></script>
	<script src="<?=SITE_TEMPLATE_PATH?>/js/videojs-ie8.min.js"></script>
	<script src="<?=SITE_TEMPLATE_PATH?>/js/video.min.js"></script>
	<script src="<?=SITE_TEMPLATE_PATH?>/js/popper.min.js"></script>
	<script src="<?=SITE_TEMPLATE_PATH?>/js/bootstrap.min.js"></script>
	<script src="<?=SITE_TEMPLATE_PATH?>/js/lightgallery-all.min.js"></script>
	<script src="<?=SITE_TEMPLATE_PATH?>/js/ion.rangeSlider.js"></script>
	<script src="<?=SITE_TEMPLATE_PATH?>/js/jquery.mask.min.js"></script>
	<script src='https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=6LdcebsUAAAAALa4RtfpreMkUDaU0gNjirKVUzoP'></script>
	<script src="<?=SITE_TEMPLATE_PATH?>/js/main.js?v=<?=mktime()?>"></script>
	<script>
		$(function() {
			function sectionOutput() {
				$('.section-preloader').removeClass('hidden');

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

				sectionSortBy = localStorage.getItem('sectionSortBy');
				sectionSortType = localStorage.getItem('sectionSortType');

				var data = {
					"section_id": $section_id,
					"dataAttr": dataAttr,
					"sortBy": sectionSortBy,
					"sortType": sectionSortType
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

						$('.section-preloader').addClass('hidden');
						$('#section').html(response);
					},
					error: function(jqXhr, textStatus, errorThrown) {
						console.log(errorThrown);
					}
				});
			}
			
			<?
			if (!empty($_GET)){
				foreach ($_GET as $k => $v) {
					$values = [];
					?>
					var smartfilter = $('.js-smartfilter[data-code="<?=$k?>"]');
					if (!smartfilter.length) return true;
					
					var makesJs = smartfilter.data('checked');
					console.log(makesJs);
					
					<?$makes = (array)$_GET['MAKE'];?>
					var newMakesJs = {};
					$.each(makesJs, function (index, value) {
						newMakesJs[index] = 0;
						<?foreach ($makes as $make) {?>
						if (index === '<?=$make?>') {
							newMakesJs[index] = 1;
						}
						<?}?>
					});
					console.log(newMakesJs);
					smartfilter.data('checked', newMakesJs);
					smartfilter.find('.icon-cross').css('display', 'inline-block');
					sectionOutput();
					<?
				}
			}
			?>
		});
	</script>
	<script>
		function onloadCallback() {
			grecaptcha.ready(function () {
				grecaptcha.execute('<?=RECAPTCHA_SITE_KEY?>', {action: 'form'}).then(function (token) {
					//console.log(token);
					document.getElementsByName('g-recaptcha-response')[0].value = token;
				});
			});
		}
	</script>
</body>
</html>
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
                                <div class="footer__contact-value"><a href="mailto:info@tooldirect.ru" class="footer__menu-link">info@tooldirect.ru</a></div>
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
									"MENU_CACHE_TIME" => "3600",
									"MENU_CACHE_TYPE" => "N",
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
			"PATH" => SITE_DIR."include/modal/add2cart.php"
		)
	);?>
    <script src="<?=SITE_TEMPLATE_PATH?>/js/jquery-3.2.1.min.js"></script>
	<script src="<?=SITE_TEMPLATE_PATH?>/js/tooltipster.bundle.min.js"></script>
	<?/*<script src="<?=SITE_TEMPLATE_PATH?>/js/popper.min.js"></script>*/?>
	<script src="<?=SITE_TEMPLATE_PATH?>/js/videojs-ie8.min.js"></script>
	<script src="<?=SITE_TEMPLATE_PATH?>/js/video.js"></script>
	<script src="<?=SITE_TEMPLATE_PATH?>/js/bootstrap.min.js"></script>
	<script src="<?=SITE_TEMPLATE_PATH?>/js/owl.carousel.js"></script>
	<script src="<?=SITE_TEMPLATE_PATH?>/js/lightgallery-all.min.js"></script>
	<script src="<?=SITE_TEMPLATE_PATH?>/js/jquery.mask.min.js"></script>
	<script src='https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=6LdcebsUAAAAALa4RtfpreMkUDaU0gNjirKVUzoP'></script>
    <script src="<?=SITE_TEMPLATE_PATH?>/js/main.js?v=1"></script>
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
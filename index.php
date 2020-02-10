<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Купить фрезы, пилы, сверла и другие инструменты с доставкой по всей России.");
$APPLICATION->SetPageProperty("keywords", "купить фрезы, купить фрезы недорого, купить сверла, купить пилы, купить инструменты, где купить фрезы, купить концевые фрезы");
$APPLICATION->SetPageProperty("description", "Интернет-магазин \"Тулдирект\" предлагает широкий ассортимент инструмента для резки и распила различного материала. У нас вы можете купить фрезы для обработки древесины и металла, сверла, пилы, комплектующие и аксессуары.");
?>
<?$APPLICATION->SetTitle("Tooldirect");?>
<?$APPLICATION->IncludeComponent("custom:slider", "makes", Array());?>
<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "inc",
		"EDIT_TEMPLATE" => "",
		"PATH" => SITE_DIR."include/banners.php"
	)
);?>
<?
global $arrFilterSectionMain;
$arrFilterSectionMain = Array(
	"=UF_MAIN_SHOW" => true,
	"=UF_SEO_SECTION" => false,
	"=UF_USER_SECTION" => false,
	"=UF_USER_EXT_SECTION" => false,
);
?>

<?/*=$APPLICATION->get_cookie("siteLayout").' ! '._template;*/?>

<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section.list","index"._template, Array(
		"SHOW_PARENT_NAME" => "Y",
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID" => CATALOG_BLOCK_ID,
		"SECTION_ID" => CATALOG_MAIN_SECTION_ID,
		"SECTION_CODE" => "",
		"SECTION_URL" => "",
		"COUNT_ELEMENTS" => "Y",
		"TOP_DEPTH" => "1",
		"SECTION_FIELDS" => "",
		"SECTION_USER_FIELDS" => Array('UF_*'),
		"USE_FILTER" => "Y",
		"FILTER_NAME" => "arrFilterSectionMain",
		"ADD_SECTIONS_CHAIN" => "Y",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_NOTES" => "",
		"CACHE_GROUPS" => "Y"
	)
);?>

<?/*<div class="mproduct">
<div class="container">
	<div class="mproduct__header">
		<div class="mproduct__new-label">наши новинки2</div>
		<div class="mproduct__caption js-mproduct-caption">фрезы по дереву</div>
	</div>

	<div class="mproduct__sliders">
		<div class="mproduct__slider-box js-mproduct-slider-box slider-01 is-visible">
			<div class="mproduct__slider js-mproduct-slider owl-carousel owl-theme">
				<div class="mproduct__item">
					<div class="mproduct__overlay">
						<a href="#" class="mproduct__link">перейти</a>
					</div>
					<div class="mproduct__discount">10%</div>
					<div class="mproduct__item-row">
						<img src="<?=SITE_TEMPLATE_PATH?>/images/youtube.svg" alt="" class="mproduct__video">
						<div class="mproduct__img-box">
							<img src="<?=SITE_TEMPLATE_PATH?>/images/product-01.jpg" alt="">
						</div>
						<img src="<?=SITE_TEMPLATE_PATH?>/images/product-basket.svg" alt="" class="mproduct__basket">
					</div>
					<div class="mproduct__name">Диск пильный 60х20х2,8/1,8х48 5° TFZ L Pilana, Ламинат, ЛДСП, МДФ</div>
					<div class="mproduct__price-box">
						<div class="mproduct__old-price">130 000</div>
						<div class="mproduct__price">125 500 <span>руб/шт</span></div>
					</div>
				</div> <!-- mproduct__item -->
				<div class="mproduct__item">
					<div class="mproduct__overlay">
						<a href="#" class="mproduct__link">перейти</a>
					</div>
					<div class="mproduct__discount">10%</div>
					<div class="mproduct__item-row">
						<img src="<?=SITE_TEMPLATE_PATH?>/images/youtube.svg" alt="" class="mproduct__video">
						<div class="mproduct__img-box">
							<img src="<?=SITE_TEMPLATE_PATH?>/images/product-01.jpg" alt="">
						</div>
						<img src="<?=SITE_TEMPLATE_PATH?>/images/product-basket.svg" alt="" class="mproduct__basket">
					</div>
					<div class="mproduct__name">Диск пильный 60х20х2,8/1,8х48 5° TFZ L Pilana, Ламинат, ЛДСП, МДФ</div>
					<div class="mproduct__price-box">
						<div class="mproduct__old-price">130 000</div>
						<div class="mproduct__price">125 500 <span>руб/шт</span></div>
					</div>
				</div> <!-- mproduct__item -->
				<div class="mproduct__item">
					<div class="mproduct__overlay">
						<a href="#" class="mproduct__link">перейти</a>
					</div>
					<div class="mproduct__discount">10%</div>
					<div class="mproduct__item-row">
						<img src="<?=SITE_TEMPLATE_PATH?>/images/youtube.svg" alt="" class="mproduct__video">
						<div class="mproduct__img-box">
							<img src="<?=SITE_TEMPLATE_PATH?>/images/product-01.jpg" alt="">
						</div>
						<img src="<?=SITE_TEMPLATE_PATH?>/images/product-basket.svg" alt="" class="mproduct__basket">
					</div>
					<div class="mproduct__name">Диск пильный 60х20х2,8/1,8х48 5° TFZ L Pilana, Ламинат, ЛДСП, МДФ</div>
					<div class="mproduct__price-box">
						<div class="mproduct__old-price">130 000</div>
						<div class="mproduct__price">125 500 <span>руб/шт</span></div>
					</div>
				</div> <!-- mproduct__item -->
				<div class="mproduct__item">
					<div class="mproduct__overlay">
						<a href="#" class="mproduct__link">перейти</a>
					</div>
					<div class="mproduct__discount">10%</div>
					<div class="mproduct__item-row">
						<img src="<?=SITE_TEMPLATE_PATH?>/images/youtube.svg" alt="" class="mproduct__video">
						<div class="mproduct__img-box">
							<img src="<?=SITE_TEMPLATE_PATH?>/images/product-01.jpg" alt="">
						</div>
						<img src="<?=SITE_TEMPLATE_PATH?>/images/product-basket.svg" alt="" class="mproduct__basket">
					</div>
					<div class="mproduct__name">Диск пильный 60х20х2,8/1,8х48 5° TFZ L Pilana, Ламинат, ЛДСП, МДФ</div>
					<div class="mproduct__price-box">
						<div class="mproduct__old-price">130 000</div>
						<div class="mproduct__price">125 500 <span>руб/шт</span></div>
					</div>
				</div> <!-- mproduct__item -->
				<div class="mproduct__item">
					<div class="mproduct__overlay">
						<a href="#" class="mproduct__link">перейти</a>
					</div>
					<div class="mproduct__discount">10%</div>
					<div class="mproduct__item-row">
						<img src="<?=SITE_TEMPLATE_PATH?>/images/youtube.svg" alt="" class="mproduct__video">
						<div class="mproduct__img-box">
							<img src="<?=SITE_TEMPLATE_PATH?>/images/product-01.jpg" alt="">
						</div>
						<img src="<?=SITE_TEMPLATE_PATH?>/images/product-basket.svg" alt="" class="mproduct__basket">
					</div>
					<div class="mproduct__name">Диск пильный 60х20х2,8/1,8х48 5° TFZ L Pilana, Ламинат, ЛДСП, МДФ</div>
					<div class="mproduct__price-box">
						<div class="mproduct__old-price">130 000</div>
						<div class="mproduct__price">125 500 <span>руб/шт</span></div>
					</div>
				</div> <!-- mproduct__item -->
			</div> <!-- mproduct__slider -->
		</div> <!-- mproduct__slider-box -->
		<div class="mproduct__slider-box js-mproduct-slider-box slider-02">
			<div class="mproduct__slider js-mproduct-slider owl-carousel owl-theme">

				<div class="mproduct__item">
					<div class="mproduct__overlay">
						<a href="#" class="mproduct__link">перейти</a>
					</div>
					<div class="mproduct__discount">10%</div>
					<div class="mproduct__item-row">
						<img src="<?=SITE_TEMPLATE_PATH?>/images/youtube.svg" alt="" class="mproduct__video">
						<div class="mproduct__img-box">
							<img src="<?=SITE_TEMPLATE_PATH?>/images/product-02.jpg" alt="">
						</div>
						<img src="<?=SITE_TEMPLATE_PATH?>/images/product-basket.svg" alt="" class="mproduct__basket">
					</div>
					<div class="mproduct__name">Диск пильный Bosch Eco WO 190x20-48T (2608644378), Ламинат, ЛДСП, МДФ</div>
					<div class="mproduct__price-box">
						<div class="mproduct__old-price">70 000</div>
						<div class="mproduct__price">65 500 <span>руб/шт</span></div>
					</div>
				</div> <!-- mproduct__item -->
				<div class="mproduct__item">
					<div class="mproduct__overlay">
						<a href="#" class="mproduct__link">перейти</a>
					</div>
					<div class="mproduct__discount">10%</div>
					<div class="mproduct__item-row">
						<img src="<?=SITE_TEMPLATE_PATH?>/images/youtube.svg" alt="" class="mproduct__video">
						<div class="mproduct__img-box">
							<img src="<?=SITE_TEMPLATE_PATH?>/images/product-02.jpg" alt="">
						</div>
						<img src="<?=SITE_TEMPLATE_PATH?>/images/product-basket.svg" alt="" class="mproduct__basket">
					</div>
					<div class="mproduct__name">Диск пильный Bosch Eco WO 190x20-48T (2608644378), Ламинат, ЛДСП, МДФ</div>
					<div class="mproduct__price-box">
						<div class="mproduct__old-price">70 000</div>
						<div class="mproduct__price">65 500 <span>руб/шт</span></div>
					</div>
				</div> <!-- mproduct__item -->
				<div class="mproduct__item">
					<div class="mproduct__overlay">
						<a href="#" class="mproduct__link">перейти</a>
					</div>
					<div class="mproduct__discount">10%</div>
					<div class="mproduct__item-row">
						<img src="<?=SITE_TEMPLATE_PATH?>/images/youtube.svg" alt="" class="mproduct__video">
						<div class="mproduct__img-box">
							<img src="<?=SITE_TEMPLATE_PATH?>/images/product-02.jpg" alt="">
						</div>
						<img src="<?=SITE_TEMPLATE_PATH?>/images/product-basket.svg" alt="" class="mproduct__basket">
					</div>
					<div class="mproduct__name">Диск пильный Bosch Eco WO 190x20-48T (2608644378), Ламинат, ЛДСП, МДФ</div>
					<div class="mproduct__price-box">
						<div class="mproduct__old-price">70 000</div>
						<div class="mproduct__price">65 500 <span>руб/шт</span></div>
					</div>
				</div> <!-- mproduct__item -->
				<div class="mproduct__item">
					<div class="mproduct__overlay">
						<a href="#" class="mproduct__link">перейти</a>
					</div>
					<div class="mproduct__discount">10%</div>
					<div class="mproduct__item-row">
						<img src="<?=SITE_TEMPLATE_PATH?>/images/youtube.svg" alt="" class="mproduct__video">
						<div class="mproduct__img-box">
							<img src="<?=SITE_TEMPLATE_PATH?>/images/product-02.jpg" alt="">
						</div>
						<img src="<?=SITE_TEMPLATE_PATH?>/images/product-basket.svg" alt="" class="mproduct__basket">
					</div>
					<div class="mproduct__name">Диск пильный Bosch Eco WO 190x20-48T (2608644378), Ламинат, ЛДСП, МДФ</div>
					<div class="mproduct__price-box">
						<div class="mproduct__old-price">70 000</div>
						<div class="mproduct__price">65 500 <span>руб/шт</span></div>
					</div>
				</div> <!-- mproduct__item -->
				<div class="mproduct__item">
					<div class="mproduct__overlay">
						<a href="#" class="mproduct__link">перейти</a>
					</div>
					<div class="mproduct__discount">10%</div>
					<div class="mproduct__item-row">
						<img src="<?=SITE_TEMPLATE_PATH?>/images/youtube.svg" alt="" class="mproduct__video">
						<div class="mproduct__img-box">
							<img src="<?=SITE_TEMPLATE_PATH?>/images/product-02.jpg" alt="">
						</div>
						<img src="<?=SITE_TEMPLATE_PATH?>/images/product-basket.svg" alt="" class="mproduct__basket">
					</div>
					<div class="mproduct__name">Диск пильный Bosch Eco WO 190x20-48T (2608644378), Ламинат, ЛДСП, МДФ</div>
					<div class="mproduct__price-box">
						<div class="mproduct__old-price">70 000</div>
						<div class="mproduct__price">65 500 <span>руб/шт</span></div>
					</div>
				</div> <!-- mproduct__item -->
			</div> <!-- mproduct__slider -->
		</div> <!-- mproduct__slider-box -->
	</div> <!-- mproduct__sliders -->

	<div class="mproduct__select-btn js-mproduct-select-btn"><span>фрезы по дереву</span></div>
	<ul class="mproduct__select-items js-mproduct-select-items">
		<li class="mproduct__select-item js-mproduct-select-item" data-slider="slider-01">фрезы по дереву</li>
		<li class="mproduct__select-item js-mproduct-select-item" data-slider="slider-02">Фрезы концевые</li>
		<li class="mproduct__select-item js-mproduct-select-item" data-slider="slider-01">Фрезы спиральные</li>
		<li class="mproduct__select-item js-mproduct-select-item" data-slider="slider-02">фрезы со сменным ножем</li>
		<li class="mproduct__select-item js-mproduct-select-item" data-slider="slider-01">фрезы долбежные</li>
		<li class="mproduct__select-item js-mproduct-select-item" data-slider="slider-02">фрезы алмазные</li>
		<li class="mproduct__select-item js-mproduct-select-item" data-slider="slider-01">фрезы долбежные</li>
		<li class="mproduct__select-item js-mproduct-select-item" data-slider="slider-02">фрезы долбежные</li>
	</ul>
</div> <!-- container -->
</div> <!-- mproduct -->

<div class="product">
<div class="container">
	<div class="product__row">
		<div class="product__menu">
			<div class="product__menu-header-box">
				<div class="product__menu-header">
					<div class="product__menu-new-label">наши новинки</div>
					<div class="product__menu-caption js-product-menu-caption">фрезы по дереву</div>
				</div>
			</div>
			<div class="product__menu-items">
				<div class="product__menu-item js-product-menu-item is-active" data-product="product-items-01">фрезы по дереву</div>
				<div class="product__menu-item js-product-menu-item" data-product="product-items-02">Фрезы концевые</div>
				<div class="product__menu-item js-product-menu-item" data-product="product-items-01">Фрезы спиральные</div>
				<div class="product__menu-item js-product-menu-item" data-product="product-items-02">фрезы со сменным ножем</div>
				<div class="product__menu-item js-product-menu-item" data-product="product-items-01">фрезы долбежные</div>
				<div class="product__menu-item js-product-menu-item" data-product="product-items-02">фрезы алмазные</div>
				<div class="product__menu-item js-product-menu-item" data-product="product-items-01">фрезы долбежные</div>
				<div class="product__menu-item js-product-menu-item" data-product="product-items-02">фрезы долбежные</div>
			</div> <!-- product__menu-items -->
			<div class="product__menu-button-box">
				<a href="#" class="product__menu-button">в каталог</a>
			</div>
		</div> <!-- product__menu -->
		<div class="product__items-box">
			<div class="product__items js-product-items product-items-01 is-visible">
				<div class="product__item">
					<div class="product__overlay">
						<a href="#" class="product__link">перейти</a>
					</div>
					<div class="product__discount">10%</div>
					<div class="product__item-row">
						<img src="<?=SITE_TEMPLATE_PATH?>/images/youtube.svg" alt="" class="product__video">
						<div class="product__img-box">
							<img src="<?=SITE_TEMPLATE_PATH?>/images/product-01.jpg" alt="">
						</div>
						<img src="<?=SITE_TEMPLATE_PATH?>/images/product-basket.svg" alt="" class="product__basket">
					</div>
					<div class="product__name">Диск пильный 60х20х2,8/1,8х48 5° TFZ L Pilana, Ламинат, ЛДСП, МДФ</div>
					<div class="product__price-box">
						<div class="product__old-price">130 000</div>
						<div class="product__price">125 500 <span>руб/шт</span></div>
					</div>
				</div> <!-- product__item -->
				<div class="product__item">
					<div class="product__overlay">
						<a href="#" class="product__link">перейти</a>
					</div>
					<div class="product__discount">10%</div>
					<div class="product__item-row">
						<img src="<?=SITE_TEMPLATE_PATH?>/images/youtube.svg" alt="" class="product__video">
						<div class="product__img-box">
							<img src="<?=SITE_TEMPLATE_PATH?>/images/product-01.jpg" alt="">
						</div>
						<img src="<?=SITE_TEMPLATE_PATH?>/images/product-basket.svg" alt="" class="product__basket">
					</div>
					<div class="product__name">Диск пильный 60х20х2,8/1,8х48 5° TFZ L Pilana, Ламинат, ЛДСП, МДФ</div>
					<div class="product__price-box">
						<div class="product__old-price">130 000</div>
						<div class="product__price">125 500 <span>руб/шт</span></div>
					</div>
				</div> <!-- product__item -->
				<div class="product__item">
					<div class="product__overlay">
						<a href="#" class="product__link">перейти</a>
					</div>
					<div class="product__discount">10%</div>
					<div class="product__item-row">
						<img src="<?=SITE_TEMPLATE_PATH?>/images/youtube.svg" alt="" class="product__video">
						<div class="product__img-box">
							<img src="<?=SITE_TEMPLATE_PATH?>/images/product-01.jpg" alt="">
						</div>
						<img src="<?=SITE_TEMPLATE_PATH?>/images/product-basket.svg" alt="" class="product__basket">
					</div>
					<div class="product__name">Диск пильный 60х20х2,8/1,8х48 5° TFZ L Pilana, Ламинат, ЛДСП, МДФ</div>
					<div class="product__price-box">
						<div class="product__old-price">130 000</div>
						<div class="product__price">125 500 <span>руб/шт</span></div>
					</div>
				</div> <!-- product__item -->
				<div class="product__item">
					<div class="product__overlay">
						<a href="#" class="product__link">перейти</a>
					</div>
					<div class="product__discount">10%</div>
					<div class="product__item-row">
						<img src="<?=SITE_TEMPLATE_PATH?>/images/youtube.svg" alt="" class="product__video">
						<div class="product__img-box">
							<img src="<?=SITE_TEMPLATE_PATH?>/images/product-01.jpg" alt="">
						</div>
						<img src="<?=SITE_TEMPLATE_PATH?>/images/product-basket.svg" alt="" class="product__basket">
					</div>
					<div class="product__name">Диск пильный 60х20х2,8/1,8х48 5° TFZ L Pilana, Ламинат, ЛДСП, МДФ</div>
					<div class="product__price-box">
						<div class="product__price">125 500 <span>руб/шт</span></div>
					</div>
				</div> <!-- product__item -->
				<div class="product__item">
					<div class="product__overlay">
						<a href="#" class="product__link">перейти</a>
					</div>
					<div class="product__discount">10%</div>
					<div class="product__item-row">
						<img src="<?=SITE_TEMPLATE_PATH?>/images/youtube.svg" alt="" class="product__video">
						<div class="product__img-box">
							<img src="<?=SITE_TEMPLATE_PATH?>/images/product-01.jpg" alt="">
						</div>
						<img src="<?=SITE_TEMPLATE_PATH?>/images/product-basket.svg" alt="" class="product__basket">
					</div>
					<div class="product__name">Диск пильный 60х20х2,8/1,8х48 5° TFZ L Pilana, Ламинат, ЛДСП, МДФ</div>
					<div class="product__price-box">
						<div class="product__price">125 500 <span>руб/шт</span></div>
					</div>
				</div> <!-- product__item -->
				<div class="product__item">
					<div class="product__more-text">
						<div>Хотите больше?</div>
						<div>Фрезы в нашем каталоге</div>
					</div>
					<div class="product__more-items">
						<a href="#" class="product__more-item">#Фрезы-для-дверей</a>
						<a href="#" class="product__more-item">Фрезы для фасадов</a>
						<a href="#" class="product__more-item">Фрезы прямые</a>
						<a href="#" class="product__more-item">Фрезы для ручного фрезера</a>
						<a href="#" class="product__more-item">Фрезы для слэбов</a>
					</div>
				</div> <!-- product__item -->
			</div> <!-- product__items -->
			<div class="product__items js-product-items product-items-02">
				<div class="product__item">
					<div class="product__overlay">
						<a href="#" class="product__link">перейти</a>
					</div>
					<div class="product__discount">10%</div>
					<div class="product__item-row">
						<img src="<?=SITE_TEMPLATE_PATH?>/images/youtube.svg" alt="" class="product__video">
						<div class="product__img-box">
							<img src="<?=SITE_TEMPLATE_PATH?>/images/product-02.jpg" alt="">
						</div>
						<img src="<?=SITE_TEMPLATE_PATH?>/images/product-basket.svg" alt="" class="product__basket">
					</div>
					<div class="product__name">Диск пильный Bosch Eco WO 190x20-48T (2608644378), Ламинат, ЛДСП</div>
					<div class="product__price-box">
						<div class="product__old-price">70 000</div>
						<div class="product__price">65 500 <span>руб/шт</span></div>
					</div>
				</div> <!-- product__item -->
				<div class="product__item">
					<div class="product__overlay">
						<a href="#" class="product__link">перейти</a>
					</div>
					<div class="product__discount">10%</div>
					<div class="product__item-row">
						<img src="<?=SITE_TEMPLATE_PATH?>/images/youtube.svg" alt="" class="product__video">
						<div class="product__img-box">
							<img src="<?=SITE_TEMPLATE_PATH?>/images/product-02.jpg" alt="">
						</div>
						<img src="<?=SITE_TEMPLATE_PATH?>/images/product-basket.svg" alt="" class="product__basket">
					</div>
					<div class="product__name">Диск пильный Bosch Eco WO 190x20-48T (2608644378), Ламинат, ЛДСП</div>
					<div class="product__price-box">
						<div class="product__old-price">70 000</div>
						<div class="product__price">65 500 <span>руб/шт</span></div>
					</div>
				</div> <!-- product__item -->
				<div class="product__item">
					<div class="product__overlay">
						<a href="#" class="product__link">перейти</a>
					</div>
					<div class="product__discount">10%</div>
					<div class="product__item-row">
						<img src="<?=SITE_TEMPLATE_PATH?>/images/youtube.svg" alt="" class="product__video">
						<div class="product__img-box">
							<img src="<?=SITE_TEMPLATE_PATH?>/images/product-02.jpg" alt="">
						</div>
						<img src="<?=SITE_TEMPLATE_PATH?>/images/product-basket.svg" alt="" class="product__basket">
					</div>
					<div class="product__name">Диск пильный Bosch Eco WO 190x20-48T (2608644378), Ламинат, ЛДСП</div>
					<div class="product__price-box">
						<div class="product__old-price">70 000</div>
						<div class="product__price">65 500 <span>руб/шт</span></div>
					</div>
				</div> <!-- product__item -->
				<div class="product__item">
					<div class="product__overlay">
						<a href="#" class="product__link">перейти</a>
					</div>
					<div class="product__discount">10%</div>
					<div class="product__item-row">
						<img src="<?=SITE_TEMPLATE_PATH?>/images/youtube.svg" alt="" class="product__video">
						<div class="product__img-box">
							<img src="<?=SITE_TEMPLATE_PATH?>/images/product-02.jpg" alt="">
						</div>
						<img src="<?=SITE_TEMPLATE_PATH?>/images/product-basket.svg" alt="" class="product__basket">
					</div>
					<div class="product__name">Диск пильный Bosch Eco WO 190x20-48T (2608644378), Ламинат, ЛДСП</div>
					<div class="product__price-box">
						<div class="product__old-price">70 000</div>
						<div class="product__price">65 500 <span>руб/шт</span></div>
					</div>
				</div> <!-- product__item -->
				<div class="product__item">
					<div class="product__overlay">
						<a href="#" class="product__link">перейти</a>
					</div>
					<div class="product__discount">10%</div>
					<div class="product__item-row">
						<img src="<?=SITE_TEMPLATE_PATH?>/images/youtube.svg" alt="" class="product__video">
						<div class="product__img-box">
							<img src="<?=SITE_TEMPLATE_PATH?>/images/product-02.jpg" alt="">
						</div>
						<img src="<?=SITE_TEMPLATE_PATH?>/images/product-basket.svg" alt="" class="product__basket">
					</div>
					<div class="product__name">Диск пильный Bosch Eco WO 190x20-48T (2608644378), Ламинат, ЛДСП</div>
					<div class="product__price-box">
						<div class="product__old-price">70 000</div>
						<div class="product__price">65 500 <span>руб/шт</span></div>
					</div>
				</div> <!-- product__item -->
				<div class="product__item">
					<div class="product__more-text">
						<div>Хотите больше?</div>
						<div>Фрезы в нашем каталоге</div>
					</div>
					<div class="product__more-items">
						<a href="#" class="product__more-item">#Фрезы-для-дверей</a>
						<a href="#" class="product__more-item">Фрезы для фасадов</a>
						<a href="#" class="product__more-item">Фрезы прямые</a>
						<a href="#" class="product__more-item">Фрезы для ручного фрезера</a>
						<a href="#" class="product__more-item">Фрезы для слэбов</a>
					</div>
				</div> <!-- product__item -->
			</div> <!-- product__items -->
		</div> <!-- product__items-box -->

	</div> <!-- product__row -->
</div> <!-- container -->
</div> <!-- product -->

<div class="mproduct">
<div class="container">
	<div class="mproduct__header">
		<div class="mproduct__new-label">наши новинки</div>
		<div class="mproduct__caption js-mproduct-caption">фрезы по дереву</div>
	</div>

	<div class="mproduct__sliders">
		<div class="mproduct__slider-box js-mproduct-slider-box slider-01 is-visible">
			<div class="mproduct__slider js-mproduct-slider owl-carousel owl-theme">
				<div class="mproduct__item">
					<div class="mproduct__overlay">
						<a href="#" class="mproduct__link">перейти</a>
					</div>
					<div class="mproduct__discount">10%</div>
					<div class="mproduct__item-row">
						<img src="<?=SITE_TEMPLATE_PATH?>/images/youtube.svg" alt="" class="mproduct__video">
						<div class="mproduct__img-box">
							<img src="<?=SITE_TEMPLATE_PATH?>/images/product-01.jpg" alt="">
						</div>
						<img src="<?=SITE_TEMPLATE_PATH?>/images/product-basket.svg" alt="" class="mproduct__basket">
					</div>
					<div class="mproduct__name">Диск пильный 60х20х2,8/1,8х48 5° TFZ L Pilana, Ламинат, ЛДСП, МДФ</div>
					<div class="mproduct__price-box">
						<div class="mproduct__old-price">130 000</div>
						<div class="mproduct__price">125 500 <span>руб/шт</span></div>
					</div>
				</div> <!-- mproduct__item -->
				<div class="mproduct__item">
					<div class="mproduct__overlay">
						<a href="#" class="mproduct__link">перейти</a>
					</div>
					<div class="mproduct__discount">10%</div>
					<div class="mproduct__item-row">
						<img src="<?=SITE_TEMPLATE_PATH?>/images/youtube.svg" alt="" class="mproduct__video">
						<div class="mproduct__img-box">
							<img src="<?=SITE_TEMPLATE_PATH?>/images/product-01.jpg" alt="">
						</div>
						<img src="<?=SITE_TEMPLATE_PATH?>/images/product-basket.svg" alt="" class="mproduct__basket">
					</div>
					<div class="mproduct__name">Диск пильный 60х20х2,8/1,8х48 5° TFZ L Pilana, Ламинат, ЛДСП, МДФ</div>
					<div class="mproduct__price-box">
						<div class="mproduct__old-price">130 000</div>
						<div class="mproduct__price">125 500 <span>руб/шт</span></div>
					</div>
				</div> <!-- mproduct__item -->
				<div class="mproduct__item">
					<div class="mproduct__overlay">
						<a href="#" class="mproduct__link">перейти</a>
					</div>
					<div class="mproduct__discount">10%</div>
					<div class="mproduct__item-row">
						<img src="<?=SITE_TEMPLATE_PATH?>/images/youtube.svg" alt="" class="mproduct__video">
						<div class="mproduct__img-box">
							<img src="<?=SITE_TEMPLATE_PATH?>/images/product-01.jpg" alt="">
						</div>
						<img src="<?=SITE_TEMPLATE_PATH?>/images/product-basket.svg" alt="" class="mproduct__basket">
					</div>
					<div class="mproduct__name">Диск пильный 60х20х2,8/1,8х48 5° TFZ L Pilana, Ламинат, ЛДСП, МДФ</div>
					<div class="mproduct__price-box">
						<div class="mproduct__old-price">130 000</div>
						<div class="mproduct__price">125 500 <span>руб/шт</span></div>
					</div>
				</div> <!-- mproduct__item -->
				<div class="mproduct__item">
					<div class="mproduct__overlay">
						<a href="#" class="mproduct__link">перейти</a>
					</div>
					<div class="mproduct__discount">10%</div>
					<div class="mproduct__item-row">
						<img src="<?=SITE_TEMPLATE_PATH?>/images/youtube.svg" alt="" class="mproduct__video">
						<div class="mproduct__img-box">
							<img src="<?=SITE_TEMPLATE_PATH?>/images/product-01.jpg" alt="">
						</div>
						<img src="<?=SITE_TEMPLATE_PATH?>/images/product-basket.svg" alt="" class="mproduct__basket">
					</div>
					<div class="mproduct__name">Диск пильный 60х20х2,8/1,8х48 5° TFZ L Pilana, Ламинат, ЛДСП, МДФ</div>
					<div class="mproduct__price-box">
						<div class="mproduct__old-price">130 000</div>
						<div class="mproduct__price">125 500 <span>руб/шт</span></div>
					</div>
				</div> <!-- mproduct__item -->
				<div class="mproduct__item">
					<div class="mproduct__overlay">
						<a href="#" class="mproduct__link">перейти</a>
					</div>
					<div class="mproduct__discount">10%</div>
					<div class="mproduct__item-row">
						<img src="<?=SITE_TEMPLATE_PATH?>/images/youtube.svg" alt="" class="mproduct__video">
						<div class="mproduct__img-box">
							<img src="<?=SITE_TEMPLATE_PATH?>/images/product-01.jpg" alt="">
						</div>
						<img src="<?=SITE_TEMPLATE_PATH?>/images/product-basket.svg" alt="" class="mproduct__basket">
					</div>
					<div class="mproduct__name">Диск пильный 60х20х2,8/1,8х48 5° TFZ L Pilana, Ламинат, ЛДСП, МДФ</div>
					<div class="mproduct__price-box">
						<div class="mproduct__old-price">130 000</div>
						<div class="mproduct__price">125 500 <span>руб/шт</span></div>
					</div>
				</div> <!-- mproduct__item -->
			</div> <!-- mproduct__slider -->
		</div> <!-- mproduct__slider-box -->
		<div class="mproduct__slider-box js-mproduct-slider-box slider-02">
			<div class="mproduct__slider js-mproduct-slider owl-carousel owl-theme">

				<div class="mproduct__item">
					<div class="mproduct__overlay">
						<a href="#" class="mproduct__link">перейти</a>
					</div>
					<div class="mproduct__discount">10%</div>
					<div class="mproduct__item-row">
						<img src="<?=SITE_TEMPLATE_PATH?>/images/youtube.svg" alt="" class="mproduct__video">
						<div class="mproduct__img-box">
							<img src="<?=SITE_TEMPLATE_PATH?>/images/product-02.jpg" alt="">
						</div>
						<img src="<?=SITE_TEMPLATE_PATH?>/images/product-basket.svg" alt="" class="mproduct__basket">
					</div>
					<div class="mproduct__name">Диск пильный Bosch Eco WO 190x20-48T (2608644378), Ламинат, ЛДСП, МДФ</div>
					<div class="mproduct__price-box">
						<div class="mproduct__old-price">70 000</div>
						<div class="mproduct__price">65 500 <span>руб/шт</span></div>
					</div>
				</div> <!-- mproduct__item -->
				<div class="mproduct__item">
					<div class="mproduct__overlay">
						<a href="#" class="mproduct__link">перейти</a>
					</div>
					<div class="mproduct__discount">10%</div>
					<div class="mproduct__item-row">
						<img src="<?=SITE_TEMPLATE_PATH?>/images/youtube.svg" alt="" class="mproduct__video">
						<div class="mproduct__img-box">
							<img src="<?=SITE_TEMPLATE_PATH?>/images/product-02.jpg" alt="">
						</div>
						<img src="<?=SITE_TEMPLATE_PATH?>/images/product-basket.svg" alt="" class="mproduct__basket">
					</div>
					<div class="mproduct__name">Диск пильный Bosch Eco WO 190x20-48T (2608644378), Ламинат, ЛДСП, МДФ</div>
					<div class="mproduct__price-box">
						<div class="mproduct__old-price">70 000</div>
						<div class="mproduct__price">65 500 <span>руб/шт</span></div>
					</div>
				</div> <!-- mproduct__item -->
				<div class="mproduct__item">
					<div class="mproduct__overlay">
						<a href="#" class="mproduct__link">перейти</a>
					</div>
					<div class="mproduct__discount">10%</div>
					<div class="mproduct__item-row">
						<img src="<?=SITE_TEMPLATE_PATH?>/images/youtube.svg" alt="" class="mproduct__video">
						<div class="mproduct__img-box">
							<img src="<?=SITE_TEMPLATE_PATH?>/images/product-02.jpg" alt="">
						</div>
						<img src="<?=SITE_TEMPLATE_PATH?>/images/product-basket.svg" alt="" class="mproduct__basket">
					</div>
					<div class="mproduct__name">Диск пильный Bosch Eco WO 190x20-48T (2608644378), Ламинат, ЛДСП, МДФ</div>
					<div class="mproduct__price-box">
						<div class="mproduct__old-price">70 000</div>
						<div class="mproduct__price">65 500 <span>руб/шт</span></div>
					</div>
				</div> <!-- mproduct__item -->
				<div class="mproduct__item">
					<div class="mproduct__overlay">
						<a href="#" class="mproduct__link">перейти</a>
					</div>
					<div class="mproduct__discount">10%</div>
					<div class="mproduct__item-row">
						<img src="<?=SITE_TEMPLATE_PATH?>/images/youtube.svg" alt="" class="mproduct__video">
						<div class="mproduct__img-box">
							<img src="<?=SITE_TEMPLATE_PATH?>/images/product-02.jpg" alt="">
						</div>
						<img src="<?=SITE_TEMPLATE_PATH?>/images/product-basket.svg" alt="" class="mproduct__basket">
					</div>
					<div class="mproduct__name">Диск пильный Bosch Eco WO 190x20-48T (2608644378), Ламинат, ЛДСП, МДФ</div>
					<div class="mproduct__price-box">
						<div class="mproduct__old-price">70 000</div>
						<div class="mproduct__price">65 500 <span>руб/шт</span></div>
					</div>
				</div> <!-- mproduct__item -->
				<div class="mproduct__item">
					<div class="mproduct__overlay">
						<a href="#" class="mproduct__link">перейти</a>
					</div>
					<div class="mproduct__discount">10%</div>
					<div class="mproduct__item-row">
						<img src="<?=SITE_TEMPLATE_PATH?>/images/youtube.svg" alt="" class="mproduct__video">
						<div class="mproduct__img-box">
							<img src="<?=SITE_TEMPLATE_PATH?>/images/product-02.jpg" alt="">
						</div>
						<img src="<?=SITE_TEMPLATE_PATH?>/images/product-basket.svg" alt="" class="mproduct__basket">
					</div>
					<div class="mproduct__name">Диск пильный Bosch Eco WO 190x20-48T (2608644378), Ламинат, ЛДСП, МДФ</div>
					<div class="mproduct__price-box">
						<div class="mproduct__old-price">70 000</div>
						<div class="mproduct__price">65 500 <span>руб/шт</span></div>
					</div>
				</div> <!-- mproduct__item -->
			</div> <!-- mproduct__slider -->
		</div> <!-- mproduct__slider-box -->
	</div> <!-- mproduct__sliders -->

	<div class="mproduct__select-btn js-mproduct-select-btn"><span>фрезы по дереву</span></div>
	<ul class="mproduct__select-items js-mproduct-select-items">
		<li class="mproduct__select-item js-mproduct-select-item" data-slider="slider-01">фрезы по дереву</li>
		<li class="mproduct__select-item js-mproduct-select-item" data-slider="slider-02">Фрезы концевые</li>
		<li class="mproduct__select-item js-mproduct-select-item" data-slider="slider-01">Фрезы спиральные</li>
		<li class="mproduct__select-item js-mproduct-select-item" data-slider="slider-02">фрезы со сменным ножем</li>
		<li class="mproduct__select-item js-mproduct-select-item" data-slider="slider-01">фрезы долбежные</li>
		<li class="mproduct__select-item js-mproduct-select-item" data-slider="slider-02">фрезы алмазные</li>
		<li class="mproduct__select-item js-mproduct-select-item" data-slider="slider-01">фрезы долбежные</li>
		<li class="mproduct__select-item js-mproduct-select-item" data-slider="slider-02">фрезы долбежные</li>
	</ul>
</div> <!-- container -->
</div> <!-- mproduct -->

<div class="dealer">
<div class="container">
	<div class="dealer__content">
		<div class="dealer__suptitle">Ищем дилеров в регионах</div>
		<div class="dealer__title">Хотите зарабатывать на продаже инструмента?</div>
		<div class="dealer__text">
			Благодаря контрактам с заводами изготовителями и дистрибьюторами производителей инструмента — мы можем предложить Вам одни из лучших цен на рынке на продукцию заводского уровня качества.
		</div>
		<div class="dealer__buttons">
			<a href="#" class="button button--white dealer__button-1">стать дилером</a>
			<a href="#" class="button button--transparent dealer__button-2">почему мы?</a>
		</div>
	</div> <!-- dealer__content -->
</div> <!-- container -->
</div> <!-- dealer -->

<div class="product">
<div class="container">
	<div class="product__row">
		<div class="product__menu">
			<div class="product__menu-header-box">
				<div class="product__menu-header">
					<div class="product__menu-new-label">наши новинки</div>
					<div class="product__menu-caption js-product-menu-caption">фрезы по дереву</div>
				</div>
			</div>
			<div class="product__menu-items">
				<div class="product__menu-item js-product-menu-item is-active" data-product="product-items-01">фрезы по дереву</div>
				<div class="product__menu-item js-product-menu-item" data-product="product-items-02">Фрезы концевые</div>
				<div class="product__menu-item js-product-menu-item" data-product="product-items-01">Фрезы спиральные</div>
				<div class="product__menu-item js-product-menu-item" data-product="product-items-02">фрезы со сменным ножем</div>
				<div class="product__menu-item js-product-menu-item" data-product="product-items-01">фрезы долбежные</div>
				<div class="product__menu-item js-product-menu-item" data-product="product-items-02">фрезы алмазные</div>
				<div class="product__menu-item js-product-menu-item" data-product="product-items-01">фрезы долбежные</div>
				<div class="product__menu-item js-product-menu-item" data-product="product-items-02">фрезы долбежные</div>
			</div> <!-- product__menu-items -->
			<div class="product__menu-button-box">
				<a href="#" class="product__menu-button">в каталог</a>
			</div>
		</div> <!-- product__menu -->
		<div class="product__items-box">
			<div class="product__items js-product-items product-items-01 is-visible">
				<div class="product__item">
					<div class="product__overlay">
						<a href="#" class="product__link">перейти</a>
					</div>
					<div class="product__discount">10%</div>
					<div class="product__item-row">
						<img src="<?=SITE_TEMPLATE_PATH?>/images/youtube.svg" alt="" class="product__video">
						<div class="product__img-box">
							<img src="<?=SITE_TEMPLATE_PATH?>/images/product-01.jpg" alt="">
						</div>
						<img src="<?=SITE_TEMPLATE_PATH?>/images/product-basket.svg" alt="" class="product__basket">
					</div>
					<div class="product__name">Диск пильный 60х20х2,8/1,8х48 5° TFZ L Pilana, Ламинат, ЛДСП, МДФ</div>
					<div class="product__price-box">
						<div class="product__old-price">130 000</div>
						<div class="product__price">125 500 <span>руб/шт</span></div>
					</div>
				</div> <!-- product__item -->
				<div class="product__item">
					<div class="product__overlay">
						<a href="#" class="product__link">перейти</a>
					</div>
					<div class="product__discount">10%</div>
					<div class="product__item-row">
						<img src="<?=SITE_TEMPLATE_PATH?>/images/youtube.svg" alt="" class="product__video">
						<div class="product__img-box">
							<img src="<?=SITE_TEMPLATE_PATH?>/images/product-01.jpg" alt="">
						</div>
						<img src="<?=SITE_TEMPLATE_PATH?>/images/product-basket.svg" alt="" class="product__basket">
					</div>
					<div class="product__name">Диск пильный 60х20х2,8/1,8х48 5° TFZ L Pilana, Ламинат, ЛДСП, МДФ</div>
					<div class="product__price-box">
						<div class="product__old-price">130 000</div>
						<div class="product__price">125 500 <span>руб/шт</span></div>
					</div>
				</div> <!-- product__item -->
				<div class="product__item">
					<div class="product__overlay">
						<a href="#" class="product__link">перейти</a>
					</div>
					<div class="product__discount">10%</div>
					<div class="product__item-row">
						<img src="<?=SITE_TEMPLATE_PATH?>/images/youtube.svg" alt="" class="product__video">
						<div class="product__img-box">
							<img src="<?=SITE_TEMPLATE_PATH?>/images/product-01.jpg" alt="">
						</div>
						<img src="<?=SITE_TEMPLATE_PATH?>/images/product-basket.svg" alt="" class="product__basket">
					</div>
					<div class="product__name">Диск пильный 60х20х2,8/1,8х48 5° TFZ L Pilana, Ламинат, ЛДСП, МДФ</div>
					<div class="product__price-box">
						<div class="product__old-price">130 000</div>
						<div class="product__price">125 500 <span>руб/шт</span></div>
					</div>
				</div> <!-- product__item -->
				<div class="product__item">
					<div class="product__overlay">
						<a href="#" class="product__link">перейти</a>
					</div>
					<div class="product__discount">10%</div>
					<div class="product__item-row">
						<img src="<?=SITE_TEMPLATE_PATH?>/images/youtube.svg" alt="" class="product__video">
						<div class="product__img-box">
							<img src="<?=SITE_TEMPLATE_PATH?>/images/product-01.jpg" alt="">
						</div>
						<img src="<?=SITE_TEMPLATE_PATH?>/images/product-basket.svg" alt="" class="product__basket">
					</div>
					<div class="product__name">Диск пильный 60х20х2,8/1,8х48 5° TFZ L Pilana, Ламинат, ЛДСП, МДФ</div>
					<div class="product__price-box">
						<div class="product__price">125 500 <span>руб/шт</span></div>
					</div>
				</div> <!-- product__item -->
				<div class="product__item">
					<div class="product__overlay">
						<a href="#" class="product__link">перейти</a>
					</div>
					<div class="product__discount">10%</div>
					<div class="product__item-row">
						<img src="<?=SITE_TEMPLATE_PATH?>/images/youtube.svg" alt="" class="product__video">
						<div class="product__img-box">
							<img src="<?=SITE_TEMPLATE_PATH?>/images/product-01.jpg" alt="">
						</div>
						<img src="<?=SITE_TEMPLATE_PATH?>/images/product-basket.svg" alt="" class="product__basket">
					</div>
					<div class="product__name">Диск пильный 60х20х2,8/1,8х48 5° TFZ L Pilana, Ламинат, ЛДСП, МДФ</div>
					<div class="product__price-box">
						<div class="product__price">125 500 <span>руб/шт</span></div>
					</div>
				</div> <!-- product__item -->
				<div class="product__item">
					<div class="product__more-text">
						<div>Хотите больше?</div>
						<div>Фрезы в нашем каталоге</div>
					</div>
					<div class="product__more-items">
						<a href="#" class="product__more-item">#Фрезы-для-дверей</a>
						<a href="#" class="product__more-item">Фрезы для фасадов</a>
						<a href="#" class="product__more-item">Фрезы прямые</a>
						<a href="#" class="product__more-item">Фрезы для ручного фрезера</a>
						<a href="#" class="product__more-item">Фрезы для слэбов</a>
					</div>
				</div> <!-- product__item -->
			</div> <!-- product__items -->
			<div class="product__items js-product-items product-items-02">
				<div class="product__item">
					<div class="product__overlay">
						<a href="#" class="product__link">перейти</a>
					</div>
					<div class="product__discount">10%</div>
					<div class="product__item-row">
						<img src="<?=SITE_TEMPLATE_PATH?>/images/youtube.svg" alt="" class="product__video">
						<div class="product__img-box">
							<img src="<?=SITE_TEMPLATE_PATH?>/images/product-02.jpg" alt="">
						</div>
						<img src="<?=SITE_TEMPLATE_PATH?>/images/product-basket.svg" alt="" class="product__basket">
					</div>
					<div class="product__name">Диск пильный Bosch Eco WO 190x20-48T (2608644378), Ламинат, ЛДСП</div>
					<div class="product__price-box">
						<div class="product__old-price">70 000</div>
						<div class="product__price">65 500 <span>руб/шт</span></div>
					</div>
				</div> <!-- product__item -->
				<div class="product__item">
					<div class="product__overlay">
						<a href="#" class="product__link">перейти</a>
					</div>
					<div class="product__discount">10%</div>
					<div class="product__item-row">
						<img src="<?=SITE_TEMPLATE_PATH?>/images/youtube.svg" alt="" class="product__video">
						<div class="product__img-box">
							<img src="<?=SITE_TEMPLATE_PATH?>/images/product-02.jpg" alt="">
						</div>
						<img src="<?=SITE_TEMPLATE_PATH?>/images/product-basket.svg" alt="" class="product__basket">
					</div>
					<div class="product__name">Диск пильный Bosch Eco WO 190x20-48T (2608644378), Ламинат, ЛДСП</div>
					<div class="product__price-box">
						<div class="product__old-price">70 000</div>
						<div class="product__price">65 500 <span>руб/шт</span></div>
					</div>
				</div> <!-- product__item -->
				<div class="product__item">
					<div class="product__overlay">
						<a href="#" class="product__link">перейти</a>
					</div>
					<div class="product__discount">10%</div>
					<div class="product__item-row">
						<img src="<?=SITE_TEMPLATE_PATH?>/images/youtube.svg" alt="" class="product__video">
						<div class="product__img-box">
							<img src="<?=SITE_TEMPLATE_PATH?>/images/product-02.jpg" alt="">
						</div>
						<img src="<?=SITE_TEMPLATE_PATH?>/images/product-basket.svg" alt="" class="product__basket">
					</div>
					<div class="product__name">Диск пильный Bosch Eco WO 190x20-48T (2608644378), Ламинат, ЛДСП</div>
					<div class="product__price-box">
						<div class="product__old-price">70 000</div>
						<div class="product__price">65 500 <span>руб/шт</span></div>
					</div>
				</div> <!-- product__item -->
				<div class="product__item">
					<div class="product__overlay">
						<a href="#" class="product__link">перейти</a>
					</div>
					<div class="product__discount">10%</div>
					<div class="product__item-row">
						<img src="<?=SITE_TEMPLATE_PATH?>/images/youtube.svg" alt="" class="product__video">
						<div class="product__img-box">
							<img src="<?=SITE_TEMPLATE_PATH?>/images/product-02.jpg" alt="">
						</div>
						<img src="<?=SITE_TEMPLATE_PATH?>/images/product-basket.svg" alt="" class="product__basket">
					</div>
					<div class="product__name">Диск пильный Bosch Eco WO 190x20-48T (2608644378), Ламинат, ЛДСП</div>
					<div class="product__price-box">
						<div class="product__old-price">70 000</div>
						<div class="product__price">65 500 <span>руб/шт</span></div>
					</div>
				</div> <!-- product__item -->
				<div class="product__item">
					<div class="product__overlay">
						<a href="#" class="product__link">перейти</a>
					</div>
					<div class="product__discount">10%</div>
					<div class="product__item-row">
						<img src="<?=SITE_TEMPLATE_PATH?>/images/youtube.svg" alt="" class="product__video">
						<div class="product__img-box">
							<img src="<?=SITE_TEMPLATE_PATH?>/images/product-02.jpg" alt="">
						</div>
						<img src="<?=SITE_TEMPLATE_PATH?>/images/product-basket.svg" alt="" class="product__basket">
					</div>
					<div class="product__name">Диск пильный Bosch Eco WO 190x20-48T (2608644378), Ламинат, ЛДСП</div>
					<div class="product__price-box">
						<div class="product__old-price">70 000</div>
						<div class="product__price">65 500 <span>руб/шт</span></div>
					</div>
				</div> <!-- product__item -->
				<div class="product__item">
					<div class="product__more-text">
						<div>Хотите больше?</div>
						<div>Фрезы в нашем каталоге</div>
					</div>
					<div class="product__more-items">
						<a href="#" class="product__more-item">#Фрезы-для-дверей</a>
						<a href="#" class="product__more-item">Фрезы для фасадов</a>
						<a href="#" class="product__more-item">Фрезы прямые</a>
						<a href="#" class="product__more-item">Фрезы для ручного фрезера</a>
						<a href="#" class="product__more-item">Фрезы для слэбов</a>
					</div>
				</div> <!-- product__item -->
			</div> <!-- product__items -->
		</div> <!-- product__items-box -->

	</div> <!-- product__row -->
</div> <!-- container -->
</div> <!-- product -->

<div class="mproduct">
<div class="container">
	<div class="mproduct__header">
		<div class="mproduct__new-label">наши новинки</div>
		<div class="mproduct__caption js-mproduct-caption">фрезы по дереву</div>
	</div>

	<div class="mproduct__sliders">
		<div class="mproduct__slider-box js-mproduct-slider-box slider-01 is-visible">
			<div class="mproduct__slider js-mproduct-slider owl-carousel owl-theme">
				<div class="mproduct__item">
					<div class="mproduct__overlay">
						<a href="#" class="mproduct__link">перейти</a>
					</div>
					<div class="mproduct__discount">10%</div>
					<div class="mproduct__item-row">
						<img src="<?=SITE_TEMPLATE_PATH?>/images/youtube.svg" alt="" class="mproduct__video">
						<div class="mproduct__img-box">
							<img src="<?=SITE_TEMPLATE_PATH?>/images/product-01.jpg" alt="">
						</div>
						<img src="<?=SITE_TEMPLATE_PATH?>/images/product-basket.svg" alt="" class="mproduct__basket">
					</div>
					<div class="mproduct__name">Диск пильный 60х20х2,8/1,8х48 5° TFZ L Pilana, Ламинат, ЛДСП, МДФ</div>
					<div class="mproduct__price-box">
						<div class="mproduct__old-price">130 000</div>
						<div class="mproduct__price">125 500 <span>руб/шт</span></div>
					</div>
				</div> <!-- mproduct__item -->
				<div class="mproduct__item">
					<div class="mproduct__overlay">
						<a href="#" class="mproduct__link">перейти</a>
					</div>
					<div class="mproduct__discount">10%</div>
					<div class="mproduct__item-row">
						<img src="<?=SITE_TEMPLATE_PATH?>/images/youtube.svg" alt="" class="mproduct__video">
						<div class="mproduct__img-box">
							<img src="<?=SITE_TEMPLATE_PATH?>/images/product-01.jpg" alt="">
						</div>
						<img src="<?=SITE_TEMPLATE_PATH?>/images/product-basket.svg" alt="" class="mproduct__basket">
					</div>
					<div class="mproduct__name">Диск пильный 60х20х2,8/1,8х48 5° TFZ L Pilana, Ламинат, ЛДСП, МДФ</div>
					<div class="mproduct__price-box">
						<div class="mproduct__old-price">130 000</div>
						<div class="mproduct__price">125 500 <span>руб/шт</span></div>
					</div>
				</div> <!-- mproduct__item -->
				<div class="mproduct__item">
					<div class="mproduct__overlay">
						<a href="#" class="mproduct__link">перейти</a>
					</div>
					<div class="mproduct__discount">10%</div>
					<div class="mproduct__item-row">
						<img src="<?=SITE_TEMPLATE_PATH?>/images/youtube.svg" alt="" class="mproduct__video">
						<div class="mproduct__img-box">
							<img src="<?=SITE_TEMPLATE_PATH?>/images/product-01.jpg" alt="">
						</div>
						<img src="<?=SITE_TEMPLATE_PATH?>/images/product-basket.svg" alt="" class="mproduct__basket">
					</div>
					<div class="mproduct__name">Диск пильный 60х20х2,8/1,8х48 5° TFZ L Pilana, Ламинат, ЛДСП, МДФ</div>
					<div class="mproduct__price-box">
						<div class="mproduct__old-price">130 000</div>
						<div class="mproduct__price">125 500 <span>руб/шт</span></div>
					</div>
				</div> <!-- mproduct__item -->
				<div class="mproduct__item">
					<div class="mproduct__overlay">
						<a href="#" class="mproduct__link">перейти</a>
					</div>
					<div class="mproduct__discount">10%</div>
					<div class="mproduct__item-row">
						<img src="<?=SITE_TEMPLATE_PATH?>/images/youtube.svg" alt="" class="mproduct__video">
						<div class="mproduct__img-box">
							<img src="<?=SITE_TEMPLATE_PATH?>/images/product-01.jpg" alt="">
						</div>
						<img src="<?=SITE_TEMPLATE_PATH?>/images/product-basket.svg" alt="" class="mproduct__basket">
					</div>
					<div class="mproduct__name">Диск пильный 60х20х2,8/1,8х48 5° TFZ L Pilana, Ламинат, ЛДСП, МДФ</div>
					<div class="mproduct__price-box">
						<div class="mproduct__old-price">130 000</div>
						<div class="mproduct__price">125 500 <span>руб/шт</span></div>
					</div>
				</div> <!-- mproduct__item -->
				<div class="mproduct__item">
					<div class="mproduct__overlay">
						<a href="#" class="mproduct__link">перейти</a>
					</div>
					<div class="mproduct__discount">10%</div>
					<div class="mproduct__item-row">
						<img src="<?=SITE_TEMPLATE_PATH?>/images/youtube.svg" alt="" class="mproduct__video">
						<div class="mproduct__img-box">
							<img src="<?=SITE_TEMPLATE_PATH?>/images/product-01.jpg" alt="">
						</div>
						<img src="<?=SITE_TEMPLATE_PATH?>/images/product-basket.svg" alt="" class="mproduct__basket">
					</div>
					<div class="mproduct__name">Диск пильный 60х20х2,8/1,8х48 5° TFZ L Pilana, Ламинат, ЛДСП, МДФ</div>
					<div class="mproduct__price-box">
						<div class="mproduct__old-price">130 000</div>
						<div class="mproduct__price">125 500 <span>руб/шт</span></div>
					</div>
				</div> <!-- mproduct__item -->
			</div> <!-- mproduct__slider -->
		</div> <!-- mproduct__slider-box -->
		<div class="mproduct__slider-box js-mproduct-slider-box slider-02">
			<div class="mproduct__slider js-mproduct-slider owl-carousel owl-theme">

				<div class="mproduct__item">
					<div class="mproduct__overlay">
						<a href="#" class="mproduct__link">перейти</a>
					</div>
					<div class="mproduct__discount">10%</div>
					<div class="mproduct__item-row">
						<img src="<?=SITE_TEMPLATE_PATH?>/images/youtube.svg" alt="" class="mproduct__video">
						<div class="mproduct__img-box">
							<img src="<?=SITE_TEMPLATE_PATH?>/images/product-02.jpg" alt="">
						</div>
						<img src="<?=SITE_TEMPLATE_PATH?>/images/product-basket.svg" alt="" class="mproduct__basket">
					</div>
					<div class="mproduct__name">Диск пильный Bosch Eco WO 190x20-48T (2608644378), Ламинат, ЛДСП, МДФ</div>
					<div class="mproduct__price-box">
						<div class="mproduct__old-price">70 000</div>
						<div class="mproduct__price">65 500 <span>руб/шт</span></div>
					</div>
				</div> <!-- mproduct__item -->
				<div class="mproduct__item">
					<div class="mproduct__overlay">
						<a href="#" class="mproduct__link">перейти</a>
					</div>
					<div class="mproduct__discount">10%</div>
					<div class="mproduct__item-row">
						<img src="<?=SITE_TEMPLATE_PATH?>/images/youtube.svg" alt="" class="mproduct__video">
						<div class="mproduct__img-box">
							<img src="<?=SITE_TEMPLATE_PATH?>/images/product-02.jpg" alt="">
						</div>
						<img src="<?=SITE_TEMPLATE_PATH?>/images/product-basket.svg" alt="" class="mproduct__basket">
					</div>
					<div class="mproduct__name">Диск пильный Bosch Eco WO 190x20-48T (2608644378), Ламинат, ЛДСП, МДФ</div>
					<div class="mproduct__price-box">
						<div class="mproduct__old-price">70 000</div>
						<div class="mproduct__price">65 500 <span>руб/шт</span></div>
					</div>
				</div> <!-- mproduct__item -->
				<div class="mproduct__item">
					<div class="mproduct__overlay">
						<a href="#" class="mproduct__link">перейти</a>
					</div>
					<div class="mproduct__discount">10%</div>
					<div class="mproduct__item-row">
						<img src="<?=SITE_TEMPLATE_PATH?>/images/youtube.svg" alt="" class="mproduct__video">
						<div class="mproduct__img-box">
							<img src="<?=SITE_TEMPLATE_PATH?>/images/product-02.jpg" alt="">
						</div>
						<img src="<?=SITE_TEMPLATE_PATH?>/images/product-basket.svg" alt="" class="mproduct__basket">
					</div>
					<div class="mproduct__name">Диск пильный Bosch Eco WO 190x20-48T (2608644378), Ламинат, ЛДСП, МДФ</div>
					<div class="mproduct__price-box">
						<div class="mproduct__old-price">70 000</div>
						<div class="mproduct__price">65 500 <span>руб/шт</span></div>
					</div>
				</div> <!-- mproduct__item -->
				<div class="mproduct__item">
					<div class="mproduct__overlay">
						<a href="#" class="mproduct__link">перейти</a>
					</div>
					<div class="mproduct__discount">10%</div>
					<div class="mproduct__item-row">
						<img src="<?=SITE_TEMPLATE_PATH?>/images/youtube.svg" alt="" class="mproduct__video">
						<div class="mproduct__img-box">
							<img src="<?=SITE_TEMPLATE_PATH?>/images/product-02.jpg" alt="">
						</div>
						<img src="<?=SITE_TEMPLATE_PATH?>/images/product-basket.svg" alt="" class="mproduct__basket">
					</div>
					<div class="mproduct__name">Диск пильный Bosch Eco WO 190x20-48T (2608644378), Ламинат, ЛДСП, МДФ</div>
					<div class="mproduct__price-box">
						<div class="mproduct__old-price">70 000</div>
						<div class="mproduct__price">65 500 <span>руб/шт</span></div>
					</div>
				</div> <!-- mproduct__item -->
				<div class="mproduct__item">
					<div class="mproduct__overlay">
						<a href="#" class="mproduct__link">перейти</a>
					</div>
					<div class="mproduct__discount">10%</div>
					<div class="mproduct__item-row">
						<img src="<?=SITE_TEMPLATE_PATH?>/images/youtube.svg" alt="" class="mproduct__video">
						<div class="mproduct__img-box">
							<img src="<?=SITE_TEMPLATE_PATH?>/images/product-02.jpg" alt="">
						</div>
						<img src="<?=SITE_TEMPLATE_PATH?>/images/product-basket.svg" alt="" class="mproduct__basket">
					</div>
					<div class="mproduct__name">Диск пильный Bosch Eco WO 190x20-48T (2608644378), Ламинат, ЛДСП, МДФ</div>
					<div class="mproduct__price-box">
						<div class="mproduct__old-price">70 000</div>
						<div class="mproduct__price">65 500 <span>руб/шт</span></div>
					</div>
				</div> <!-- mproduct__item -->
			</div> <!-- mproduct__slider -->
		</div> <!-- mproduct__slider-box -->
	</div> <!-- mproduct__sliders -->

	<div class="mproduct__select-btn js-mproduct-select-btn"><span>фрезы по дереву</span></div>
	<ul class="mproduct__select-items js-mproduct-select-items">
		<li class="mproduct__select-item js-mproduct-select-item" data-slider="slider-01">фрезы по дереву</li>
		<li class="mproduct__select-item js-mproduct-select-item" data-slider="slider-02">Фрезы концевые</li>
		<li class="mproduct__select-item js-mproduct-select-item" data-slider="slider-01">Фрезы спиральные</li>
		<li class="mproduct__select-item js-mproduct-select-item" data-slider="slider-02">фрезы со сменным ножем</li>
		<li class="mproduct__select-item js-mproduct-select-item" data-slider="slider-01">фрезы долбежные</li>
		<li class="mproduct__select-item js-mproduct-select-item" data-slider="slider-02">фрезы алмазные</li>
		<li class="mproduct__select-item js-mproduct-select-item" data-slider="slider-01">фрезы долбежные</li>
		<li class="mproduct__select-item js-mproduct-select-item" data-slider="slider-02">фрезы долбежные</li>
	</ul>
</div> <!-- container -->
</div> <!-- mproduct -->

<div class="product">
<div class="container">
	<div class="product__row">
		<div class="product__menu">
			<div class="product__menu-header-box">
				<div class="product__menu-header">
					<div class="product__menu-new-label">наши новинки</div>
					<div class="product__menu-caption js-product-menu-caption">фрезы по дереву</div>
				</div>
			</div>
			<div class="product__menu-items">
				<div class="product__menu-item js-product-menu-item is-active" data-product="product-items-01">фрезы по дереву</div>
				<div class="product__menu-item js-product-menu-item" data-product="product-items-02">Фрезы концевые</div>
				<div class="product__menu-item js-product-menu-item" data-product="product-items-01">Фрезы спиральные</div>
				<div class="product__menu-item js-product-menu-item" data-product="product-items-02">фрезы со сменным ножем</div>
				<div class="product__menu-item js-product-menu-item" data-product="product-items-01">фрезы долбежные</div>
				<div class="product__menu-item js-product-menu-item" data-product="product-items-02">фрезы алмазные</div>
				<div class="product__menu-item js-product-menu-item" data-product="product-items-01">фрезы долбежные</div>
				<div class="product__menu-item js-product-menu-item" data-product="product-items-02">фрезы долбежные</div>
			</div> <!-- product__menu-items -->
			<div class="product__menu-button-box">
				<a href="#" class="product__menu-button">в каталог</a>
			</div>
		</div> <!-- product__menu -->
		<div class="product__items-box">
			<div class="product__items js-product-items product-items-01 is-visible">
				<div class="product__item">
					<div class="product__overlay">
						<a href="#" class="product__link">перейти</a>
					</div>
					<div class="product__discount">10%</div>
					<div class="product__item-row">
						<img src="<?=SITE_TEMPLATE_PATH?>/images/youtube.svg" alt="" class="product__video">
						<div class="product__img-box">
							<img src="<?=SITE_TEMPLATE_PATH?>/images/product-01.jpg" alt="">
						</div>
						<img src="<?=SITE_TEMPLATE_PATH?>/images/product-basket.svg" alt="" class="product__basket">
					</div>
					<div class="product__name">Диск пильный 60х20х2,8/1,8х48 5° TFZ L Pilana, Ламинат, ЛДСП, МДФ</div>
					<div class="product__price-box">
						<div class="product__old-price">130 000</div>
						<div class="product__price">125 500 <span>руб/шт</span></div>
					</div>
				</div> <!-- product__item -->
				<div class="product__item">
					<div class="product__overlay">
						<a href="#" class="product__link">перейти</a>
					</div>
					<div class="product__discount">10%</div>
					<div class="product__item-row">
						<img src="<?=SITE_TEMPLATE_PATH?>/images/youtube.svg" alt="" class="product__video">
						<div class="product__img-box">
							<img src="<?=SITE_TEMPLATE_PATH?>/images/product-01.jpg" alt="">
						</div>
						<img src="<?=SITE_TEMPLATE_PATH?>/images/product-basket.svg" alt="" class="product__basket">
					</div>
					<div class="product__name">Диск пильный 60х20х2,8/1,8х48 5° TFZ L Pilana, Ламинат, ЛДСП, МДФ</div>
					<div class="product__price-box">
						<div class="product__old-price">130 000</div>
						<div class="product__price">125 500 <span>руб/шт</span></div>
					</div>
				</div> <!-- product__item -->
				<div class="product__item">
					<div class="product__overlay">
						<a href="#" class="product__link">перейти</a>
					</div>
					<div class="product__discount">10%</div>
					<div class="product__item-row">
						<img src="<?=SITE_TEMPLATE_PATH?>/images/youtube.svg" alt="" class="product__video">
						<div class="product__img-box">
							<img src="<?=SITE_TEMPLATE_PATH?>/images/product-01.jpg" alt="">
						</div>
						<img src="<?=SITE_TEMPLATE_PATH?>/images/product-basket.svg" alt="" class="product__basket">
					</div>
					<div class="product__name">Диск пильный 60х20х2,8/1,8х48 5° TFZ L Pilana, Ламинат, ЛДСП, МДФ</div>
					<div class="product__price-box">
						<div class="product__old-price">130 000</div>
						<div class="product__price">125 500 <span>руб/шт</span></div>
					</div>
				</div> <!-- product__item -->
				<div class="product__item">
					<div class="product__overlay">
						<a href="#" class="product__link">перейти</a>
					</div>
					<div class="product__discount">10%</div>
					<div class="product__item-row">
						<img src="<?=SITE_TEMPLATE_PATH?>/images/youtube.svg" alt="" class="product__video">
						<div class="product__img-box">
							<img src="<?=SITE_TEMPLATE_PATH?>/images/product-01.jpg" alt="">
						</div>
						<img src="<?=SITE_TEMPLATE_PATH?>/images/product-basket.svg" alt="" class="product__basket">
					</div>
					<div class="product__name">Диск пильный 60х20х2,8/1,8х48 5° TFZ L Pilana, Ламинат, ЛДСП, МДФ</div>
					<div class="product__price-box">
						<div class="product__price">125 500 <span>руб/шт</span></div>
					</div>
				</div> <!-- product__item -->
				<div class="product__item">
					<div class="product__overlay">
						<a href="#" class="product__link">перейти</a>
					</div>
					<div class="product__discount">10%</div>
					<div class="product__item-row">
						<img src="<?=SITE_TEMPLATE_PATH?>/images/youtube.svg" alt="" class="product__video">
						<div class="product__img-box">
							<img src="<?=SITE_TEMPLATE_PATH?>/images/product-01.jpg" alt="">
						</div>
						<img src="<?=SITE_TEMPLATE_PATH?>/images/product-basket.svg" alt="" class="product__basket">
					</div>
					<div class="product__name">Диск пильный 60х20х2,8/1,8х48 5° TFZ L Pilana, Ламинат, ЛДСП, МДФ</div>
					<div class="product__price-box">
						<div class="product__price">125 500 <span>руб/шт</span></div>
					</div>
				</div> <!-- product__item -->
				<div class="product__item">
					<div class="product__more-text">
						<div>Хотите больше?</div>
						<div>Фрезы в нашем каталоге</div>
					</div>
					<div class="product__more-items">
						<a href="#" class="product__more-item">#Фрезы-для-дверей</a>
						<a href="#" class="product__more-item">Фрезы для фасадов</a>
						<a href="#" class="product__more-item">Фрезы прямые</a>
						<a href="#" class="product__more-item">Фрезы для ручного фрезера</a>
						<a href="#" class="product__more-item">Фрезы для слэбов</a>
					</div>
				</div> <!-- product__item -->
			</div> <!-- product__items -->
			<div class="product__items js-product-items product-items-02">
				<div class="product__item">
					<div class="product__overlay">
						<a href="#" class="product__link">перейти</a>
					</div>
					<div class="product__discount">10%</div>
					<div class="product__item-row">
						<img src="<?=SITE_TEMPLATE_PATH?>/images/youtube.svg" alt="" class="product__video">
						<div class="product__img-box">
							<img src="<?=SITE_TEMPLATE_PATH?>/images/product-02.jpg" alt="">
						</div>
						<img src="<?=SITE_TEMPLATE_PATH?>/images/product-basket.svg" alt="" class="product__basket">
					</div>
					<div class="product__name">Диск пильный Bosch Eco WO 190x20-48T (2608644378), Ламинат, ЛДСП</div>
					<div class="product__price-box">
						<div class="product__old-price">70 000</div>
						<div class="product__price">65 500 <span>руб/шт</span></div>
					</div>
				</div> <!-- product__item -->
				<div class="product__item">
					<div class="product__overlay">
						<a href="#" class="product__link">перейти</a>
					</div>
					<div class="product__discount">10%</div>
					<div class="product__item-row">
						<img src="<?=SITE_TEMPLATE_PATH?>/images/youtube.svg" alt="" class="product__video">
						<div class="product__img-box">
							<img src="<?=SITE_TEMPLATE_PATH?>/images/product-02.jpg" alt="">
						</div>
						<img src="<?=SITE_TEMPLATE_PATH?>/images/product-basket.svg" alt="" class="product__basket">
					</div>
					<div class="product__name">Диск пильный Bosch Eco WO 190x20-48T (2608644378), Ламинат, ЛДСП</div>
					<div class="product__price-box">
						<div class="product__old-price">70 000</div>
						<div class="product__price">65 500 <span>руб/шт</span></div>
					</div>
				</div> <!-- product__item -->
				<div class="product__item">
					<div class="product__overlay">
						<a href="#" class="product__link">перейти</a>
					</div>
					<div class="product__discount">10%</div>
					<div class="product__item-row">
						<img src="<?=SITE_TEMPLATE_PATH?>/images/youtube.svg" alt="" class="product__video">
						<div class="product__img-box">
							<img src="<?=SITE_TEMPLATE_PATH?>/images/product-02.jpg" alt="">
						</div>
						<img src="<?=SITE_TEMPLATE_PATH?>/images/product-basket.svg" alt="" class="product__basket">
					</div>
					<div class="product__name">Диск пильный Bosch Eco WO 190x20-48T (2608644378), Ламинат, ЛДСП</div>
					<div class="product__price-box">
						<div class="product__old-price">70 000</div>
						<div class="product__price">65 500 <span>руб/шт</span></div>
					</div>
				</div> <!-- product__item -->
				<div class="product__item">
					<div class="product__overlay">
						<a href="#" class="product__link">перейти</a>
					</div>
					<div class="product__discount">10%</div>
					<div class="product__item-row">
						<img src="<?=SITE_TEMPLATE_PATH?>/images/youtube.svg" alt="" class="product__video">
						<div class="product__img-box">
							<img src="<?=SITE_TEMPLATE_PATH?>/images/product-02.jpg" alt="">
						</div>
						<img src="<?=SITE_TEMPLATE_PATH?>/images/product-basket.svg" alt="" class="product__basket">
					</div>
					<div class="product__name">Диск пильный Bosch Eco WO 190x20-48T (2608644378), Ламинат, ЛДСП</div>
					<div class="product__price-box">
						<div class="product__old-price">70 000</div>
						<div class="product__price">65 500 <span>руб/шт</span></div>
					</div>
				</div> <!-- product__item -->
				<div class="product__item">
					<div class="product__overlay">
						<a href="#" class="product__link">перейти</a>
					</div>
					<div class="product__discount">10%</div>
					<div class="product__item-row">
						<img src="<?=SITE_TEMPLATE_PATH?>/images/youtube.svg" alt="" class="product__video">
						<div class="product__img-box">
							<img src="<?=SITE_TEMPLATE_PATH?>/images/product-02.jpg" alt="">
						</div>
						<img src="<?=SITE_TEMPLATE_PATH?>/images/product-basket.svg" alt="" class="product__basket">
					</div>
					<div class="product__name">Диск пильный Bosch Eco WO 190x20-48T (2608644378), Ламинат, ЛДСП</div>
					<div class="product__price-box">
						<div class="product__old-price">70 000</div>
						<div class="product__price">65 500 <span>руб/шт</span></div>
					</div>
				</div> <!-- product__item -->
				<div class="product__item">
					<div class="product__more-text">
						<div>Хотите больше?</div>
						<div>Фрезы в нашем каталоге</div>
					</div>
					<div class="product__more-items">
						<a href="#" class="product__more-item">#Фрезы-для-дверей</a>
						<a href="#" class="product__more-item">Фрезы для фасадов</a>
						<a href="#" class="product__more-item">Фрезы прямые</a>
						<a href="#" class="product__more-item">Фрезы для ручного фрезера</a>
						<a href="#" class="product__more-item">Фрезы для слэбов</a>
					</div>
				</div> <!-- product__item -->
			</div> <!-- product__items -->
		</div> <!-- product__items-box -->

	</div> <!-- product__row -->
</div> <!-- container -->
</div> <!-- product -->

<div class="mproduct">
<div class="container">
	<div class="mproduct__header">
		<div class="mproduct__new-label">наши новинки</div>
		<div class="mproduct__caption js-mproduct-caption">фрезы по дереву</div>
	</div>

	<div class="mproduct__sliders">
		<div class="mproduct__slider-box js-mproduct-slider-box slider-01 is-visible">
			<div class="mproduct__slider js-mproduct-slider owl-carousel owl-theme">
				<div class="mproduct__item">
					<div class="mproduct__overlay">
						<a href="#" class="mproduct__link">перейти</a>
					</div>
					<div class="mproduct__discount">10%</div>
					<div class="mproduct__item-row">
						<img src="<?=SITE_TEMPLATE_PATH?>/images/youtube.svg" alt="" class="mproduct__video">
						<div class="mproduct__img-box">
							<img src="<?=SITE_TEMPLATE_PATH?>/images/product-01.jpg" alt="">
						</div>
						<img src="<?=SITE_TEMPLATE_PATH?>/images/product-basket.svg" alt="" class="mproduct__basket">
					</div>
					<div class="mproduct__name">Диск пильный 60х20х2,8/1,8х48 5° TFZ L Pilana, Ламинат, ЛДСП, МДФ</div>
					<div class="mproduct__price-box">
						<div class="mproduct__old-price">130 000</div>
						<div class="mproduct__price">125 500 <span>руб/шт</span></div>
					</div>
				</div> <!-- mproduct__item -->
				<div class="mproduct__item">
					<div class="mproduct__overlay">
						<a href="#" class="mproduct__link">перейти</a>
					</div>
					<div class="mproduct__discount">10%</div>
					<div class="mproduct__item-row">
						<img src="<?=SITE_TEMPLATE_PATH?>/images/youtube.svg" alt="" class="mproduct__video">
						<div class="mproduct__img-box">
							<img src="<?=SITE_TEMPLATE_PATH?>/images/product-01.jpg" alt="">
						</div>
						<img src="<?=SITE_TEMPLATE_PATH?>/images/product-basket.svg" alt="" class="mproduct__basket">
					</div>
					<div class="mproduct__name">Диск пильный 60х20х2,8/1,8х48 5° TFZ L Pilana, Ламинат, ЛДСП, МДФ</div>
					<div class="mproduct__price-box">
						<div class="mproduct__old-price">130 000</div>
						<div class="mproduct__price">125 500 <span>руб/шт</span></div>
					</div>
				</div> <!-- mproduct__item -->
				<div class="mproduct__item">
					<div class="mproduct__overlay">
						<a href="#" class="mproduct__link">перейти</a>
					</div>
					<div class="mproduct__discount">10%</div>
					<div class="mproduct__item-row">
						<img src="<?=SITE_TEMPLATE_PATH?>/images/youtube.svg" alt="" class="mproduct__video">
						<div class="mproduct__img-box">
							<img src="<?=SITE_TEMPLATE_PATH?>/images/product-01.jpg" alt="">
						</div>
						<img src="<?=SITE_TEMPLATE_PATH?>/images/product-basket.svg" alt="" class="mproduct__basket">
					</div>
					<div class="mproduct__name">Диск пильный 60х20х2,8/1,8х48 5° TFZ L Pilana, Ламинат, ЛДСП, МДФ</div>
					<div class="mproduct__price-box">
						<div class="mproduct__old-price">130 000</div>
						<div class="mproduct__price">125 500 <span>руб/шт</span></div>
					</div>
				</div> <!-- mproduct__item -->
				<div class="mproduct__item">
					<div class="mproduct__overlay">
						<a href="#" class="mproduct__link">перейти</a>
					</div>
					<div class="mproduct__discount">10%</div>
					<div class="mproduct__item-row">
						<img src="<?=SITE_TEMPLATE_PATH?>/images/youtube.svg" alt="" class="mproduct__video">
						<div class="mproduct__img-box">
							<img src="<?=SITE_TEMPLATE_PATH?>/images/product-01.jpg" alt="">
						</div>
						<img src="<?=SITE_TEMPLATE_PATH?>/images/product-basket.svg" alt="" class="mproduct__basket">
					</div>
					<div class="mproduct__name">Диск пильный 60х20х2,8/1,8х48 5° TFZ L Pilana, Ламинат, ЛДСП, МДФ</div>
					<div class="mproduct__price-box">
						<div class="mproduct__old-price">130 000</div>
						<div class="mproduct__price">125 500 <span>руб/шт</span></div>
					</div>
				</div> <!-- mproduct__item -->
				<div class="mproduct__item">
					<div class="mproduct__overlay">
						<a href="#" class="mproduct__link">перейти</a>
					</div>
					<div class="mproduct__discount">10%</div>
					<div class="mproduct__item-row">
						<img src="<?=SITE_TEMPLATE_PATH?>/images/youtube.svg" alt="" class="mproduct__video">
						<div class="mproduct__img-box">
							<img src="<?=SITE_TEMPLATE_PATH?>/images/product-01.jpg" alt="">
						</div>
						<img src="<?=SITE_TEMPLATE_PATH?>/images/product-basket.svg" alt="" class="mproduct__basket">
					</div>
					<div class="mproduct__name">Диск пильный 60х20х2,8/1,8х48 5° TFZ L Pilana, Ламинат, ЛДСП, МДФ</div>
					<div class="mproduct__price-box">
						<div class="mproduct__old-price">130 000</div>
						<div class="mproduct__price">125 500 <span>руб/шт</span></div>
					</div>
				</div> <!-- mproduct__item -->
			</div> <!-- mproduct__slider -->
		</div> <!-- mproduct__slider-box -->
		<div class="mproduct__slider-box js-mproduct-slider-box slider-02">
			<div class="mproduct__slider js-mproduct-slider owl-carousel owl-theme">

				<div class="mproduct__item">
					<div class="mproduct__overlay">
						<a href="#" class="mproduct__link">перейти</a>
					</div>
					<div class="mproduct__discount">10%</div>
					<div class="mproduct__item-row">
						<img src="<?=SITE_TEMPLATE_PATH?>/images/youtube.svg" alt="" class="mproduct__video">
						<div class="mproduct__img-box">
							<img src="<?=SITE_TEMPLATE_PATH?>/images/product-02.jpg" alt="">
						</div>
						<img src="<?=SITE_TEMPLATE_PATH?>/images/product-basket.svg" alt="" class="mproduct__basket">
					</div>
					<div class="mproduct__name">Диск пильный Bosch Eco WO 190x20-48T (2608644378), Ламинат, ЛДСП, МДФ</div>
					<div class="mproduct__price-box">
						<div class="mproduct__old-price">70 000</div>
						<div class="mproduct__price">65 500 <span>руб/шт</span></div>
					</div>
				</div> <!-- mproduct__item -->
				<div class="mproduct__item">
					<div class="mproduct__overlay">
						<a href="#" class="mproduct__link">перейти</a>
					</div>
					<div class="mproduct__discount">10%</div>
					<div class="mproduct__item-row">
						<img src="<?=SITE_TEMPLATE_PATH?>/images/youtube.svg" alt="" class="mproduct__video">
						<div class="mproduct__img-box">
							<img src="<?=SITE_TEMPLATE_PATH?>/images/product-02.jpg" alt="">
						</div>
						<img src="<?=SITE_TEMPLATE_PATH?>/images/product-basket.svg" alt="" class="mproduct__basket">
					</div>
					<div class="mproduct__name">Диск пильный Bosch Eco WO 190x20-48T (2608644378), Ламинат, ЛДСП, МДФ</div>
					<div class="mproduct__price-box">
						<div class="mproduct__old-price">70 000</div>
						<div class="mproduct__price">65 500 <span>руб/шт</span></div>
					</div>
				</div> <!-- mproduct__item -->
				<div class="mproduct__item">
					<div class="mproduct__overlay">
						<a href="#" class="mproduct__link">перейти</a>
					</div>
					<div class="mproduct__discount">10%</div>
					<div class="mproduct__item-row">
						<img src="<?=SITE_TEMPLATE_PATH?>/images/youtube.svg" alt="" class="mproduct__video">
						<div class="mproduct__img-box">
							<img src="<?=SITE_TEMPLATE_PATH?>/images/product-02.jpg" alt="">
						</div>
						<img src="<?=SITE_TEMPLATE_PATH?>/images/product-basket.svg" alt="" class="mproduct__basket">
					</div>
					<div class="mproduct__name">Диск пильный Bosch Eco WO 190x20-48T (2608644378), Ламинат, ЛДСП, МДФ</div>
					<div class="mproduct__price-box">
						<div class="mproduct__old-price">70 000</div>
						<div class="mproduct__price">65 500 <span>руб/шт</span></div>
					</div>
				</div> <!-- mproduct__item -->
				<div class="mproduct__item">
					<div class="mproduct__overlay">
						<a href="#" class="mproduct__link">перейти</a>
					</div>
					<div class="mproduct__discount">10%</div>
					<div class="mproduct__item-row">
						<img src="<?=SITE_TEMPLATE_PATH?>/images/youtube.svg" alt="" class="mproduct__video">
						<div class="mproduct__img-box">
							<img src="<?=SITE_TEMPLATE_PATH?>/images/product-02.jpg" alt="">
						</div>
						<img src="<?=SITE_TEMPLATE_PATH?>/images/product-basket.svg" alt="" class="mproduct__basket">
					</div>
					<div class="mproduct__name">Диск пильный Bosch Eco WO 190x20-48T (2608644378), Ламинат, ЛДСП, МДФ</div>
					<div class="mproduct__price-box">
						<div class="mproduct__old-price">70 000</div>
						<div class="mproduct__price">65 500 <span>руб/шт</span></div>
					</div>
				</div> <!-- mproduct__item -->
				<div class="mproduct__item">
					<div class="mproduct__overlay">
						<a href="#" class="mproduct__link">перейти</a>
					</div>
					<div class="mproduct__discount">10%</div>
					<div class="mproduct__item-row">
						<img src="<?=SITE_TEMPLATE_PATH?>/images/youtube.svg" alt="" class="mproduct__video">
						<div class="mproduct__img-box">
							<img src="<?=SITE_TEMPLATE_PATH?>/images/product-02.jpg" alt="">
						</div>
						<img src="<?=SITE_TEMPLATE_PATH?>/images/product-basket.svg" alt="" class="mproduct__basket">
					</div>
					<div class="mproduct__name">Диск пильный Bosch Eco WO 190x20-48T (2608644378), Ламинат, ЛДСП, МДФ</div>
					<div class="mproduct__price-box">
						<div class="mproduct__old-price">70 000</div>
						<div class="mproduct__price">65 500 <span>руб/шт</span></div>
					</div>
				</div> <!-- mproduct__item -->
			</div> <!-- mproduct__slider -->
		</div> <!-- mproduct__slider-box -->
	</div> <!-- mproduct__sliders -->

	<div class="mproduct__select-btn js-mproduct-select-btn"><span>фрезы по дереву</span></div>
	<ul class="mproduct__select-items js-mproduct-select-items">
		<li class="mproduct__select-item js-mproduct-select-item" data-slider="slider-01">фрезы по дереву</li>
		<li class="mproduct__select-item js-mproduct-select-item" data-slider="slider-02">Фрезы концевые</li>
		<li class="mproduct__select-item js-mproduct-select-item" data-slider="slider-01">Фрезы спиральные</li>
		<li class="mproduct__select-item js-mproduct-select-item" data-slider="slider-02">фрезы со сменным ножем</li>
		<li class="mproduct__select-item js-mproduct-select-item" data-slider="slider-01">фрезы долбежные</li>
		<li class="mproduct__select-item js-mproduct-select-item" data-slider="slider-02">фрезы алмазные</li>
		<li class="mproduct__select-item js-mproduct-select-item" data-slider="slider-01">фрезы долбежные</li>
		<li class="mproduct__select-item js-mproduct-select-item" data-slider="slider-02">фрезы долбежные</li>
	</ul>
</div> <!-- container -->
</div> <!-- mproduct -->

<div class="product">
<div class="container">
	<div class="product__row">
		<div class="product__menu">
			<div class="product__menu-header-box">
				<div class="product__menu-header">
					<div class="product__menu-new-label">наши новинки</div>
					<div class="product__menu-caption js-product-menu-caption">фрезы по дереву</div>
				</div>
			</div>
			<div class="product__menu-items">
				<div class="product__menu-item js-product-menu-item is-active" data-product="product-items-01">фрезы по дереву</div>
				<div class="product__menu-item js-product-menu-item" data-product="product-items-02">Фрезы концевые</div>
				<div class="product__menu-item js-product-menu-item" data-product="product-items-01">Фрезы спиральные</div>
				<div class="product__menu-item js-product-menu-item" data-product="product-items-02">фрезы со сменным ножем</div>
				<div class="product__menu-item js-product-menu-item" data-product="product-items-01">фрезы долбежные</div>
				<div class="product__menu-item js-product-menu-item" data-product="product-items-02">фрезы алмазные</div>
				<div class="product__menu-item js-product-menu-item" data-product="product-items-01">фрезы долбежные</div>
				<div class="product__menu-item js-product-menu-item" data-product="product-items-02">фрезы долбежные</div>
			</div> <!-- product__menu-items -->
			<div class="product__menu-button-box">
				<a href="#" class="product__menu-button">в каталог</a>
			</div>
		</div> <!-- product__menu -->
		<div class="product__items-box">
			<div class="product__items js-product-items product-items-01 is-visible">
				<div class="product__item">
					<div class="product__overlay">
						<a href="#" class="product__link">перейти</a>
					</div>
					<div class="product__discount">10%</div>
					<div class="product__item-row">
						<img src="<?=SITE_TEMPLATE_PATH?>/images/youtube.svg" alt="" class="product__video">
						<div class="product__img-box">
							<img src="<?=SITE_TEMPLATE_PATH?>/images/product-01.jpg" alt="">
						</div>
						<img src="<?=SITE_TEMPLATE_PATH?>/images/product-basket.svg" alt="" class="product__basket">
					</div>
					<div class="product__name">Диск пильный 60х20х2,8/1,8х48 5° TFZ L Pilana, Ламинат, ЛДСП, МДФ</div>
					<div class="product__price-box">
						<div class="product__old-price">130 000</div>
						<div class="product__price">125 500 <span>руб/шт</span></div>
					</div>
				</div> <!-- product__item -->
				<div class="product__item">
					<div class="product__overlay">
						<a href="#" class="product__link">перейти</a>
					</div>
					<div class="product__discount">10%</div>
					<div class="product__item-row">
						<img src="<?=SITE_TEMPLATE_PATH?>/images/youtube.svg" alt="" class="product__video">
						<div class="product__img-box">
							<img src="<?=SITE_TEMPLATE_PATH?>/images/product-01.jpg" alt="">
						</div>
						<img src="<?=SITE_TEMPLATE_PATH?>/images/product-basket.svg" alt="" class="product__basket">
					</div>
					<div class="product__name">Диск пильный 60х20х2,8/1,8х48 5° TFZ L Pilana, Ламинат, ЛДСП, МДФ</div>
					<div class="product__price-box">
						<div class="product__old-price">130 000</div>
						<div class="product__price">125 500 <span>руб/шт</span></div>
					</div>
				</div> <!-- product__item -->
				<div class="product__item">
					<div class="product__overlay">
						<a href="#" class="product__link">перейти</a>
					</div>
					<div class="product__discount">10%</div>
					<div class="product__item-row">
						<img src="<?=SITE_TEMPLATE_PATH?>/images/youtube.svg" alt="" class="product__video">
						<div class="product__img-box">
							<img src="<?=SITE_TEMPLATE_PATH?>/images/product-01.jpg" alt="">
						</div>
						<img src="<?=SITE_TEMPLATE_PATH?>/images/product-basket.svg" alt="" class="product__basket">
					</div>
					<div class="product__name">Диск пильный 60х20х2,8/1,8х48 5° TFZ L Pilana, Ламинат, ЛДСП, МДФ</div>
					<div class="product__price-box">
						<div class="product__old-price">130 000</div>
						<div class="product__price">125 500 <span>руб/шт</span></div>
					</div>
				</div> <!-- product__item -->
				<div class="product__item">
					<div class="product__overlay">
						<a href="#" class="product__link">перейти</a>
					</div>
					<div class="product__discount">10%</div>
					<div class="product__item-row">
						<img src="<?=SITE_TEMPLATE_PATH?>/images/youtube.svg" alt="" class="product__video">
						<div class="product__img-box">
							<img src="<?=SITE_TEMPLATE_PATH?>/images/product-01.jpg" alt="">
						</div>
						<img src="<?=SITE_TEMPLATE_PATH?>/images/product-basket.svg" alt="" class="product__basket">
					</div>
					<div class="product__name">Диск пильный 60х20х2,8/1,8х48 5° TFZ L Pilana, Ламинат, ЛДСП, МДФ</div>
					<div class="product__price-box">
						<div class="product__price">125 500 <span>руб/шт</span></div>
					</div>
				</div> <!-- product__item -->
				<div class="product__item">
					<div class="product__overlay">
						<a href="#" class="product__link">перейти</a>
					</div>
					<div class="product__discount">10%</div>
					<div class="product__item-row">
						<img src="<?=SITE_TEMPLATE_PATH?>/images/youtube.svg" alt="" class="product__video">
						<div class="product__img-box">
							<img src="<?=SITE_TEMPLATE_PATH?>/images/product-01.jpg" alt="">
						</div>
						<img src="<?=SITE_TEMPLATE_PATH?>/images/product-basket.svg" alt="" class="product__basket">
					</div>
					<div class="product__name">Диск пильный 60х20х2,8/1,8х48 5° TFZ L Pilana, Ламинат, ЛДСП, МДФ</div>
					<div class="product__price-box">
						<div class="product__price">125 500 <span>руб/шт</span></div>
					</div>
				</div> <!-- product__item -->
				<div class="product__item">
					<div class="product__more-text">
						<div>Хотите больше?</div>
						<div>Фрезы в нашем каталоге</div>
					</div>
					<div class="product__more-items">
						<a href="#" class="product__more-item">#Фрезы-для-дверей</a>
						<a href="#" class="product__more-item">Фрезы для фасадов</a>
						<a href="#" class="product__more-item">Фрезы прямые</a>
						<a href="#" class="product__more-item">Фрезы для ручного фрезера</a>
						<a href="#" class="product__more-item">Фрезы для слэбов</a>
					</div>
				</div> <!-- product__item -->
			</div> <!-- product__items -->
			<div class="product__items js-product-items product-items-02">
				<div class="product__item">
					<div class="product__overlay">
						<a href="#" class="product__link">перейти</a>
					</div>
					<div class="product__discount">10%</div>
					<div class="product__item-row">
						<img src="<?=SITE_TEMPLATE_PATH?>/images/youtube.svg" alt="" class="product__video">
						<div class="product__img-box">
							<img src="<?=SITE_TEMPLATE_PATH?>/images/product-02.jpg" alt="">
						</div>
						<img src="<?=SITE_TEMPLATE_PATH?>/images/product-basket.svg" alt="" class="product__basket">
					</div>
					<div class="product__name">Диск пильный Bosch Eco WO 190x20-48T (2608644378), Ламинат, ЛДСП</div>
					<div class="product__price-box">
						<div class="product__old-price">70 000</div>
						<div class="product__price">65 500 <span>руб/шт</span></div>
					</div>
				</div> <!-- product__item -->
				<div class="product__item">
					<div class="product__overlay">
						<a href="#" class="product__link">перейти</a>
					</div>
					<div class="product__discount">10%</div>
					<div class="product__item-row">
						<img src="<?=SITE_TEMPLATE_PATH?>/images/youtube.svg" alt="" class="product__video">
						<div class="product__img-box">
							<img src="<?=SITE_TEMPLATE_PATH?>/images/product-02.jpg" alt="">
						</div>
						<img src="<?=SITE_TEMPLATE_PATH?>/images/product-basket.svg" alt="" class="product__basket">
					</div>
					<div class="product__name">Диск пильный Bosch Eco WO 190x20-48T (2608644378), Ламинат, ЛДСП</div>
					<div class="product__price-box">
						<div class="product__old-price">70 000</div>
						<div class="product__price">65 500 <span>руб/шт</span></div>
					</div>
				</div> <!-- product__item -->
				<div class="product__item">
					<div class="product__overlay">
						<a href="#" class="product__link">перейти</a>
					</div>
					<div class="product__discount">10%</div>
					<div class="product__item-row">
						<img src="<?=SITE_TEMPLATE_PATH?>/images/youtube.svg" alt="" class="product__video">
						<div class="product__img-box">
							<img src="<?=SITE_TEMPLATE_PATH?>/images/product-02.jpg" alt="">
						</div>
						<img src="<?=SITE_TEMPLATE_PATH?>/images/product-basket.svg" alt="" class="product__basket">
					</div>
					<div class="product__name">Диск пильный Bosch Eco WO 190x20-48T (2608644378), Ламинат, ЛДСП</div>
					<div class="product__price-box">
						<div class="product__old-price">70 000</div>
						<div class="product__price">65 500 <span>руб/шт</span></div>
					</div>
				</div> <!-- product__item -->
				<div class="product__item">
					<div class="product__overlay">
						<a href="#" class="product__link">перейти</a>
					</div>
					<div class="product__discount">10%</div>
					<div class="product__item-row">
						<img src="<?=SITE_TEMPLATE_PATH?>/images/youtube.svg" alt="" class="product__video">
						<div class="product__img-box">
							<img src="<?=SITE_TEMPLATE_PATH?>/images/product-02.jpg" alt="">
						</div>
						<img src="<?=SITE_TEMPLATE_PATH?>/images/product-basket.svg" alt="" class="product__basket">
					</div>
					<div class="product__name">Диск пильный Bosch Eco WO 190x20-48T (2608644378), Ламинат, ЛДСП</div>
					<div class="product__price-box">
						<div class="product__old-price">70 000</div>
						<div class="product__price">65 500 <span>руб/шт</span></div>
					</div>
				</div> <!-- product__item -->
				<div class="product__item">
					<div class="product__overlay">
						<a href="#" class="product__link">перейти</a>
					</div>
					<div class="product__discount">10%</div>
					<div class="product__item-row">
						<img src="<?=SITE_TEMPLATE_PATH?>/images/youtube.svg" alt="" class="product__video">
						<div class="product__img-box">
							<img src="<?=SITE_TEMPLATE_PATH?>/images/product-02.jpg" alt="">
						</div>
						<img src="<?=SITE_TEMPLATE_PATH?>/images/product-basket.svg" alt="" class="product__basket">
					</div>
					<div class="product__name">Диск пильный Bosch Eco WO 190x20-48T (2608644378), Ламинат, ЛДСП</div>
					<div class="product__price-box">
						<div class="product__old-price">70 000</div>
						<div class="product__price">65 500 <span>руб/шт</span></div>
					</div>
				</div> <!-- product__item -->
				<div class="product__item">
					<div class="product__more-text">
						<div>Хотите больше?</div>
						<div>Фрезы в нашем каталоге</div>
					</div>
					<div class="product__more-items">
						<a href="#" class="product__more-item">#Фрезы-для-дверей</a>
						<a href="#" class="product__more-item">Фрезы для фасадов</a>
						<a href="#" class="product__more-item">Фрезы прямые</a>
						<a href="#" class="product__more-item">Фрезы для ручного фрезера</a>
						<a href="#" class="product__more-item">Фрезы для слэбов</a>
					</div>
				</div> <!-- product__item -->
			</div> <!-- product__items -->
		</div> <!-- product__items-box -->

	</div> <!-- product__row -->
</div> <!-- container -->
</div> <!-- product -->

<div class="mproduct">
<div class="container">
	<div class="mproduct__header">
		<div class="mproduct__new-label">наши новинки</div>
		<div class="mproduct__caption js-mproduct-caption">фрезы по дереву</div>
	</div>

	<div class="mproduct__sliders">
		<div class="mproduct__slider-box js-mproduct-slider-box slider-01 is-visible">
			<div class="mproduct__slider js-mproduct-slider owl-carousel owl-theme">
				<div class="mproduct__item">
					<div class="mproduct__overlay">
						<a href="#" class="mproduct__link">перейти</a>
					</div>
					<div class="mproduct__discount">10%</div>
					<div class="mproduct__item-row">
						<img src="<?=SITE_TEMPLATE_PATH?>/images/youtube.svg" alt="" class="mproduct__video">
						<div class="mproduct__img-box">
							<img src="<?=SITE_TEMPLATE_PATH?>/images/product-01.jpg" alt="">
						</div>
						<img src="<?=SITE_TEMPLATE_PATH?>/images/product-basket.svg" alt="" class="mproduct__basket">
					</div>
					<div class="mproduct__name">Диск пильный 60х20х2,8/1,8х48 5° TFZ L Pilana, Ламинат, ЛДСП, МДФ</div>
					<div class="mproduct__price-box">
						<div class="mproduct__old-price">130 000</div>
						<div class="mproduct__price">125 500 <span>руб/шт</span></div>
					</div>
				</div> <!-- mproduct__item -->
				<div class="mproduct__item">
					<div class="mproduct__overlay">
						<a href="#" class="mproduct__link">перейти</a>
					</div>
					<div class="mproduct__discount">10%</div>
					<div class="mproduct__item-row">
						<img src="<?=SITE_TEMPLATE_PATH?>/images/youtube.svg" alt="" class="mproduct__video">
						<div class="mproduct__img-box">
							<img src="<?=SITE_TEMPLATE_PATH?>/images/product-01.jpg" alt="">
						</div>
						<img src="<?=SITE_TEMPLATE_PATH?>/images/product-basket.svg" alt="" class="mproduct__basket">
					</div>
					<div class="mproduct__name">Диск пильный 60х20х2,8/1,8х48 5° TFZ L Pilana, Ламинат, ЛДСП, МДФ</div>
					<div class="mproduct__price-box">
						<div class="mproduct__old-price">130 000</div>
						<div class="mproduct__price">125 500 <span>руб/шт</span></div>
					</div>
				</div> <!-- mproduct__item -->
				<div class="mproduct__item">
					<div class="mproduct__overlay">
						<a href="#" class="mproduct__link">перейти</a>
					</div>
					<div class="mproduct__discount">10%</div>
					<div class="mproduct__item-row">
						<img src="<?=SITE_TEMPLATE_PATH?>/images/youtube.svg" alt="" class="mproduct__video">
						<div class="mproduct__img-box">
							<img src="<?=SITE_TEMPLATE_PATH?>/images/product-01.jpg" alt="">
						</div>
						<img src="<?=SITE_TEMPLATE_PATH?>/images/product-basket.svg" alt="" class="mproduct__basket">
					</div>
					<div class="mproduct__name">Диск пильный 60х20х2,8/1,8х48 5° TFZ L Pilana, Ламинат, ЛДСП, МДФ</div>
					<div class="mproduct__price-box">
						<div class="mproduct__old-price">130 000</div>
						<div class="mproduct__price">125 500 <span>руб/шт</span></div>
					</div>
				</div> <!-- mproduct__item -->
				<div class="mproduct__item">
					<div class="mproduct__overlay">
						<a href="#" class="mproduct__link">перейти</a>
					</div>
					<div class="mproduct__discount">10%</div>
					<div class="mproduct__item-row">
						<img src="<?=SITE_TEMPLATE_PATH?>/images/youtube.svg" alt="" class="mproduct__video">
						<div class="mproduct__img-box">
							<img src="<?=SITE_TEMPLATE_PATH?>/images/product-01.jpg" alt="">
						</div>
						<img src="<?=SITE_TEMPLATE_PATH?>/images/product-basket.svg" alt="" class="mproduct__basket">
					</div>
					<div class="mproduct__name">Диск пильный 60х20х2,8/1,8х48 5° TFZ L Pilana, Ламинат, ЛДСП, МДФ</div>
					<div class="mproduct__price-box">
						<div class="mproduct__old-price">130 000</div>
						<div class="mproduct__price">125 500 <span>руб/шт</span></div>
					</div>
				</div> <!-- mproduct__item -->
				<div class="mproduct__item">
					<div class="mproduct__overlay">
						<a href="#" class="mproduct__link">перейти</a>
					</div>
					<div class="mproduct__discount">10%</div>
					<div class="mproduct__item-row">
						<img src="<?=SITE_TEMPLATE_PATH?>/images/youtube.svg" alt="" class="mproduct__video">
						<div class="mproduct__img-box">
							<img src="<?=SITE_TEMPLATE_PATH?>/images/product-01.jpg" alt="">
						</div>
						<img src="<?=SITE_TEMPLATE_PATH?>/images/product-basket.svg" alt="" class="mproduct__basket">
					</div>
					<div class="mproduct__name">Диск пильный 60х20х2,8/1,8х48 5° TFZ L Pilana, Ламинат, ЛДСП, МДФ</div>
					<div class="mproduct__price-box">
						<div class="mproduct__old-price">130 000</div>
						<div class="mproduct__price">125 500 <span>руб/шт</span></div>
					</div>
				</div> <!-- mproduct__item -->
			</div> <!-- mproduct__slider -->
		</div> <!-- mproduct__slider-box -->
		<div class="mproduct__slider-box js-mproduct-slider-box slider-02">
			<div class="mproduct__slider js-mproduct-slider owl-carousel owl-theme">

				<div class="mproduct__item">
					<div class="mproduct__overlay">
						<a href="#" class="mproduct__link">перейти</a>
					</div>
					<div class="mproduct__discount">10%</div>
					<div class="mproduct__item-row">
						<img src="<?=SITE_TEMPLATE_PATH?>/images/youtube.svg" alt="" class="mproduct__video">
						<div class="mproduct__img-box">
							<img src="<?=SITE_TEMPLATE_PATH?>/images/product-02.jpg" alt="">
						</div>
						<img src="<?=SITE_TEMPLATE_PATH?>/images/product-basket.svg" alt="" class="mproduct__basket">
					</div>
					<div class="mproduct__name">Диск пильный Bosch Eco WO 190x20-48T (2608644378), Ламинат, ЛДСП, МДФ</div>
					<div class="mproduct__price-box">
						<div class="mproduct__old-price">70 000</div>
						<div class="mproduct__price">65 500 <span>руб/шт</span></div>
					</div>
				</div> <!-- mproduct__item -->
				<div class="mproduct__item">
					<div class="mproduct__overlay">
						<a href="#" class="mproduct__link">перейти</a>
					</div>
					<div class="mproduct__discount">10%</div>
					<div class="mproduct__item-row">
						<img src="<?=SITE_TEMPLATE_PATH?>/images/youtube.svg" alt="" class="mproduct__video">
						<div class="mproduct__img-box">
							<img src="<?=SITE_TEMPLATE_PATH?>/images/product-02.jpg" alt="">
						</div>
						<img src="<?=SITE_TEMPLATE_PATH?>/images/product-basket.svg" alt="" class="mproduct__basket">
					</div>
					<div class="mproduct__name">Диск пильный Bosch Eco WO 190x20-48T (2608644378), Ламинат, ЛДСП, МДФ</div>
					<div class="mproduct__price-box">
						<div class="mproduct__old-price">70 000</div>
						<div class="mproduct__price">65 500 <span>руб/шт</span></div>
					</div>
				</div> <!-- mproduct__item -->
				<div class="mproduct__item">
					<div class="mproduct__overlay">
						<a href="#" class="mproduct__link">перейти</a>
					</div>
					<div class="mproduct__discount">10%</div>
					<div class="mproduct__item-row">
						<img src="<?=SITE_TEMPLATE_PATH?>/images/youtube.svg" alt="" class="mproduct__video">
						<div class="mproduct__img-box">
							<img src="<?=SITE_TEMPLATE_PATH?>/images/product-02.jpg" alt="">
						</div>
						<img src="<?=SITE_TEMPLATE_PATH?>/images/product-basket.svg" alt="" class="mproduct__basket">
					</div>
					<div class="mproduct__name">Диск пильный Bosch Eco WO 190x20-48T (2608644378), Ламинат, ЛДСП, МДФ</div>
					<div class="mproduct__price-box">
						<div class="mproduct__old-price">70 000</div>
						<div class="mproduct__price">65 500 <span>руб/шт</span></div>
					</div>
				</div> <!-- mproduct__item -->
				<div class="mproduct__item">
					<div class="mproduct__overlay">
						<a href="#" class="mproduct__link">перейти</a>
					</div>
					<div class="mproduct__discount">10%</div>
					<div class="mproduct__item-row">
						<img src="<?=SITE_TEMPLATE_PATH?>/images/youtube.svg" alt="" class="mproduct__video">
						<div class="mproduct__img-box">
							<img src="<?=SITE_TEMPLATE_PATH?>/images/product-02.jpg" alt="">
						</div>
						<img src="<?=SITE_TEMPLATE_PATH?>/images/product-basket.svg" alt="" class="mproduct__basket">
					</div>
					<div class="mproduct__name">Диск пильный Bosch Eco WO 190x20-48T (2608644378), Ламинат, ЛДСП, МДФ</div>
					<div class="mproduct__price-box">
						<div class="mproduct__old-price">70 000</div>
						<div class="mproduct__price">65 500 <span>руб/шт</span></div>
					</div>
				</div> <!-- mproduct__item -->
				<div class="mproduct__item">
					<div class="mproduct__overlay">
						<a href="#" class="mproduct__link">перейти</a>
					</div>
					<div class="mproduct__discount">10%</div>
					<div class="mproduct__item-row">
						<img src="<?=SITE_TEMPLATE_PATH?>/images/youtube.svg" alt="" class="mproduct__video">
						<div class="mproduct__img-box">
							<img src="<?=SITE_TEMPLATE_PATH?>/images/product-02.jpg" alt="">
						</div>
						<img src="<?=SITE_TEMPLATE_PATH?>/images/product-basket.svg" alt="" class="mproduct__basket">
					</div>
					<div class="mproduct__name">Диск пильный Bosch Eco WO 190x20-48T (2608644378), Ламинат, ЛДСП, МДФ</div>
					<div class="mproduct__price-box">
						<div class="mproduct__old-price">70 000</div>
						<div class="mproduct__price">65 500 <span>руб/шт</span></div>
					</div>
				</div> <!-- mproduct__item -->
			</div> <!-- mproduct__slider -->
		</div> <!-- mproduct__slider-box -->
	</div> <!-- mproduct__sliders -->

	<div class="mproduct__select-btn js-mproduct-select-btn"><span>фрезы по дереву</span></div>
	<ul class="mproduct__select-items js-mproduct-select-items">
		<li class="mproduct__select-item js-mproduct-select-item" data-slider="slider-01">фрезы по дереву</li>
		<li class="mproduct__select-item js-mproduct-select-item" data-slider="slider-02">Фрезы концевые</li>
		<li class="mproduct__select-item js-mproduct-select-item" data-slider="slider-01">Фрезы спиральные</li>
		<li class="mproduct__select-item js-mproduct-select-item" data-slider="slider-02">фрезы со сменным ножем</li>
		<li class="mproduct__select-item js-mproduct-select-item" data-slider="slider-01">фрезы долбежные</li>
		<li class="mproduct__select-item js-mproduct-select-item" data-slider="slider-02">фрезы алмазные</li>
		<li class="mproduct__select-item js-mproduct-select-item" data-slider="slider-01">фрезы долбежные</li>
		<li class="mproduct__select-item js-mproduct-select-item" data-slider="slider-02">фрезы долбежные</li>
	</ul>
</div> <!-- container -->
</div> <!-- mproduct -->
*/?>

<div class="why">
	<div class="container">
		<div class="why__title">почему выгодно покупать инструмент у нас</div>
		<div class="why__items">
			<div class="why__item">
				<img src="<?=SITE_TEMPLATE_PATH?>/images/why-01.png" alt="" class="why__item-img">
				<div class="why__item-caption">Широкий ассортимент продукции</div>
				<div class="why__item-text">
					Складская программа содержит широкий перечень профессионального инструмента. 800 видов концевых фрез с поставкой на склад от 50 шт. каждой позиции и боле. 350 видов пильных дисков и большой ассортимент приспособлений, свёрл, ножей, зенкеров, патронов, цанг, струбцин и многого другого. Ассортимент стабильно пополняется и увеличивается каждые 1.5-2 месяца. Все позиции представленные на сайте являются стабильной складской программой.
				</div>
			</div> <!-- why__item -->
			<div class="why__item">
				<img src="<?=SITE_TEMPLATE_PATH?>/images/why-02.png" alt="" class="why__item-img">
				<div class="why__item-caption">Работаем с лучшими ТК</div>
				<div class="why__item-text">
					Компания Тулдирект проводит тщательную экспертизу ценового предложения всех фабрик. Нам не интересны фабрики с минимальными ценами и низким качеством, а также фабрики с эксклюзивным дорогим инструментом. Наша основная задача дать максимально высокое качество за разумные деньги без компромиссов.
				</div>
			</div> <!-- why__item -->
			<div class="why__item">
				<img src="<?=SITE_TEMPLATE_PATH?>/images/why-03.png" alt="" class="why__item-img">
				<div class="why__item-caption">Высокое качество продукции</div>
				<div class="why__item-text">
					Приоритетом компании является поиск самых качественных ОЕМ производителей инструмента в мире. Благодаря знаниям и опыту у нас есть полное представление где размещают свои заказы различные именитые Европейские, Американские, Израильские бренды, какой уровень качества и ассортимент поставляется ими на Российский рынок. Мы размещаем заказы только на инструмент высокого качества в больших объёмах, что гарантирует стабильность поставок без изменения уровня качества.
				</div>
			</div> <!-- why__item -->
			<div class="why__item">
				<img src="<?=SITE_TEMPLATE_PATH?>/images/why-04.png" alt="" class="why__item-img">
				<div class="why__item-caption">Отгрузка в день заказа</div>
				<div class="why__item-text">
					Если заказ сделан до 16.00, то его можно легко забрать в тот же день со склада в Москве. Если заказ сделан до 15.00 - отправим транспортной компанией в ваш регион. Благодаря прямым контрактам с заводами изготовителями – мы можем предложить Вам одни из самых лучших цена на рынке, широкий ассортимент, индустриальное качество и стабильное наличие на складе, отличные дилерские скидки на весь ассортимент.
				</div>
			</div> <!-- why__item -->
		</div> <!-- why__items -->
		<?/*<div class="why__text">
			<p>
				Благодаря контрактам с заводами изготовителями и дистрибьюторами производителей инструмента — мы можем предложить Вам одни из лучших цен на рынке на продукцию заводского уровня качества. Ищем дилеров в регионах.
			</p>
		</div>*/?>
		<!-- why__text -->
		<div class="why__button-box">
			<a href="javascript:void(0)" data-toggle="modal" data-target="#dealerModal" class="why__button button button--green button--h64 button--fz24">Стать дилером</a>
		</div>
		<?/*<div class="why__text why__text--hidemob">
			<p>
				Tideway – огромный промышленный комплекс, расположенный в Ханьчжоу на западе Китая. Фабрика занимается производством большого объёма режущего инструмента высокого качества. Продукция данного завода уже давно знакома Российским потребителям под различными торговыми марками Европейских производителей, которые часть продукции размещают в Китае.
			</p>
			<p>
				Также компания Tideway является крупнейшим импортёром в Азии твёрдого сплава именно  Люксембургской фабрики Ceratizit, что делает их продукцию значимо отличной от других производителей в данном регионе.
			</p>
			<p>
				Компания Тулдирект представляет продукцию завода под их собственным брендом. Без двойных логистических перемещений из Азии в Европу, затем из Европы в Россию; без  многих наценок различных заинтересованных сторон. Мы рады предложить качественную продукцию завода со склада в Москве по самым справедливым ценам на рынке.
			</p>*/?>
		</div> <!-- why__text -->
	</div> <!-- container -->
</div> <!-- why -->

<?/*
<div class="mtext">
	<div class="mtext__items">
		<div class="mtext__item js-mtext-item">
			<div class="mtext__item-header">
				<div class="container">
					<div class="mtext__item-title">Что такое Tooldirect</div>
				</div>
			</div>
			<div class="mtext__item-body">
				<div class="container">
					<div class="mtext__item-text">
						<p>
							Tideway – огромный промышленный комплекс, расположенный в Ханьчжоу на западе Китая. Фабрика занимается производством большого объёма режущего инструмента высокого качества. Продукция данного завода уже давно знакома Российским потребителям под различными торговыми марками Европейских производителей, которые часть продукции размещают в Китае.
						</p>
						<p>
							Также компания Tideway является крупнейшим импортёром в Азии твёрдого сплава именно  Люксембургской фабрики Ceratizit, что делает их продукцию значимо отличной от других производителей в данном регионе.
						</p>
						<p>
							Компания Тулдирект представляет продукцию завода под их собственным брендом. Без двойных логистических перемещений из Азии в Европу, затем из Европы в Россию; без  многих наценок различных заинтересованных сторон. Мы рады предложить качественную продукцию завода со склада в Москве по самым справедливым ценам на рынке.
						</p>
					</div> <!-- mtext__item-text -->
					<div class="mtext__close-btn js-mtext-close-btn">Свернуть</div>
				</div> <!-- container -->
			</div> <!-- mtext__item-body -->
		</div> <!-- mtext__item -->
		<div class="mtext__item js-mtext-item is-opened">
			<div class="mtext__item-header">
				<div class="container">
					<div class="mtext__item-title">Что такое Tooldirect</div>
				</div>
			</div>
			<div class="mtext__item-body">
				<div class="container">
					<div class="mtext__item-text">
						<p>
							Tideway – огромный промышленный комплекс, расположенный в Ханьчжоу на западе Китая. Фабрика занимается производством большого объёма режущего инструмента высокого качества. Продукция данного завода уже давно знакома Российским потребителям под различными торговыми марками Европейских производителей, которые часть продукции размещают в Китае.
						</p>
						<p>
							Также компания Tideway является крупнейшим импортёром в Азии твёрдого сплава именно  Люксембургской фабрики Ceratizit, что делает их продукцию значимо отличной от других производителей в данном регионе.
						</p>
						<p>
							Компания Тулдирект представляет продукцию завода под их собственным брендом. Без двойных логистических перемещений из Азии в Европу, затем из Европы в Россию; без  многих наценок различных заинтересованных сторон. Мы рады предложить качественную продукцию завода со склада в Москве по самым справедливым ценам на рынке.
						</p>
					</div> <!-- mtext__item-text -->
					<div class="mtext__close-btn">Свернуть</div>
				</div> <!-- container -->
			</div> <!-- mtext__item-body -->
		</div> <!-- mtext__item -->
	</div> <!-- mtext__items -->
</div> <!-- mtext -->
*/?>

<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "inc",
		"EDIT_TEMPLATE" => "",
		"PATH" => SITE_DIR."include/toolorder.php"
	)
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
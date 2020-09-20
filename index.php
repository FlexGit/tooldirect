<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Купить фрезы, пилы, сверла и другие инструменты с доставкой по всей России.");
$APPLICATION->SetPageProperty("keywords", "купить фрезы, купить фрезы недорого, купить сверла, купить пилы, купить инструменты, где купить фрезы, купить концевые фрезы");
$APPLICATION->SetPageProperty("description", "Интернет-магазин \"Тулдирект\" предлагает широкий ассортимент инструмента для резки и распила различного материала. У нас вы можете купить фрезы для обработки древесины и металла, сверла, пилы, комплектующие и аксессуары.");
?>
<?$APPLICATION->SetTitle("Tooldirect");?>
<?$APPLICATION->IncludeComponent("custom:slider", "makes", Array());?>
<?/*<div style="margin: 0 auto 40px;width: 310px;">
	<a href="/pdf-catalog/" class="link">
		<img src="/images/pdf.png" alt="" title="">&nbsp;&nbsp;&nbsp;<span style="font-size: 24px;font-weight: bold;">СКАЧАТЬ КАТАЛОГ</span>
	</a>
</div>*/?>
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
		<!-- why__text -->
		<div class="why__button-box">
			<a href="javascript:void(0)" data-toggle="modal" data-target="#dealerModal" class="why__button button button--green button--h64 button--fz24">Стать дилером</a>
		</div>
		</div> <!-- why__text -->
	</div> <!-- container -->
</div> <!-- why -->

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
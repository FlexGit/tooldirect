<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle("Карта сайта");
$APPLICATION->AddChainItem("Карта сайта", "");
?>
<div class="container">
	<h1><?$APPLICATION->ShowTitle(false)?></h1>
	<div class="greenseparator"></div>
	<ul class="map" style="margin-bottom: 40px;">
		<li><a href="/o-kompanii/" class="link">О компании</a></li>
		<li>
			<a href="/catalog/" class="link">Каталог</a>
			<?
			global $arrFilterSectionMain;
			$arrFilterSectionMain = Array(
				"=UF_SEO_SECTION" => false,
				"=UF_USER_SECTION" => false,
				"=UF_USER_EXT_SECTION" => false,
			);
			?>
			<?$APPLICATION->IncludeComponent(
				"bitrix:catalog.section.list","map", Array(
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
		</li>
		<li><a href="/oferta/" class="link">Оферта</a></li>
		<li><a href="/katalogi-i-prezentatsii/" class="link">Каталоги и презентации</a></li>
		<li><a href="/poleznaya-informatsiya/" class="link">Полезная информация</a></li>
		<li><a href="/novosti/" class="link">Новости</a></li>
		<li><a href="/stati/" class="link">Статьи</a></li>
		<li><a href="/aktsii/" class="link">Акции</a></li>
		<li><a href="/novinki/" class="link">Новинки</a></li>
		<li><a href="/dostavka/" class="link">Доставка</a></li>
		<li><a href="/oplata/" class="link">Оплата</a></li>
		<li><a href="/kontakty/" class="link">Контакты</a></li>
		<li><a href="/gde-kupit/" class="link">Где купить</a></li>
		<li><a href="/stat-dilerom/" class="link">Стать дилером</a></li>
		<li><a href="/instrument-na-zakaz/" class="link">Инструмент на заказ</a></li>
	</ul>
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
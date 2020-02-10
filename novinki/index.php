<?
define("HIDE_SIDEBAR", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Новинки");
?>
<div class="container">
	<h1><?$APPLICATION->ShowTitle(false)?></h1>
	<div class="greenseparator"></div>
	<section id="soputstvuyshie">
		<div class="row">
			<?
			global $arrFilterSectionMain;
			$arrFilterSectionMain = Array(
				"=PROPERTY_NEW" => "Y",
			);
			?>
			<?$APPLICATION->IncludeComponent(
				"bitrix:catalog.section", "main", Array(
				//"IS_MAIN" => true,
				"IBLOCK_ID" => CATALOG_BLOCK_ID,
				"IBLOCK_TYPE" => "catalog",
				"SECTION_ID" => CATALOG_MAIN_SECTION_ID,
				"HIDE_NOT_AVAILABLE" => "N", // Недоступные товары
				"HIDE_NOT_AVAILABLE_OFFERS" => "N",	// Недоступные торговые предложения
				"FILTER_NAME" => "arrFilterSectionMain",
				"TITLE" => "Новинки",
				"PAGE_ELEMENT_COUNT" => "400",
				"INCLUDE_SUBSECTIONS" => "Y",
				"OFFERS_LIMIT" => "",
				"SHOW_ALL_WO_SECTION" => "Y",
				"SHOW_FROM_SECTION" => "N",
				"PRICE_CODE" => array(	// Тип цены
					0 => "BASE",
				),
				"CACHE_FILTER" => "Y",
				"CACHE_TIME" => "36000000",
				"CACHE_TYPE" => "A",
				"PROPERTY_CODE" => array( // Свойства
				),
				"SHOW_OLD_PRICE" => "Y",
				"SHOW_DISCOUNT_PERCENT" => "Y",
			), false
			);
			?>
		</div>
	</section>
</div>
<div style="margin-bottom: 50px;"></div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
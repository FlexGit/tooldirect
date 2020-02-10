<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Поиск");
$APPLICATION->AddChainItem("Поиск", "");
?>
<div class="container">
	<h1><?$APPLICATION->ShowTitle(false)?></h1>
	<div class="greenseparator"></div>
	<?$APPLICATION->IncludeComponent (
		"bitrix:catalog.search",
		"",
		Array(
			"AJAX_MODE" => "Y",
			"IBLOCK_TYPE" => "catalog",
			"IBLOCK_ID" => CATALOG_BLOCK_ID,
			"ELEMENT_SORT_FIELD" => "name",
			"ELEMENT_SORT_ORDER" => "asc",
			"ELEMENT_SORT_FIELD2" => "id",
			"ELEMENT_SORT_ORDER2" => "desc",
			"SECTION_URL" => "",
			"DETAIL_URL" => "",
			"BASKET_URL" => "/personal/cart/",
			"ACTION_VARIABLE" => "action",
			"PRODUCT_ID_VARIABLE" => "id",
			"PRODUCT_QUANTITY_VARIABLE" => "quantity",
			"PRODUCT_PROPS_VARIABLE" => "prop",
			"SECTION_ID_VARIABLE" => "SECTION_ID",
			"DISPLAY_COMPARE" => "N",
			"PAGE_ELEMENT_COUNT" => "20",
			"LINE_ELEMENT_COUNT" => "3",
			"PROPERTY_CODE" => array(),
			"OFFERS_FIELD_CODE" => array(),
			"OFFERS_PROPERTY_CODE" => array(),
			"OFFERS_SORT_FIELD" => "sort",
			"OFFERS_SORT_ORDER" => "asc",
			"OFFERS_SORT_FIELD2" => "id",
			"OFFERS_SORT_ORDER2" => "desc",
			"OFFERS_LIMIT" => "200",
			"PRICE_CODE" => array("BASE"),
			"USE_PRICE_COUNT" => "Y",
			"SHOW_PRICE_COUNT" => "1",
			"PRICE_VAT_INCLUDE" => "Y",
			"USE_PRODUCT_QUANTITY" => "Y",
			"CACHE_TYPE" => "A",
			"CACHE_TIME" => "36000000",
			"RESTART" => "Y",
			"NO_WORD_LOGIC" => "Y",
			"USE_LANGUAGE_GUESS" => "N",
			"CHECK_DATES" => "N",
			"DISPLAY_TOP_PAGER" => "Y",
			"DISPLAY_BOTTOM_PAGER" => "Y",
			"PAGER_TITLE" => "Товары",
			"PAGER_SHOW_ALWAYS" => "Y",
			"PAGER_TEMPLATE" => "visual",
			"PAGER_DESC_NUMBERING" => "Y",
			"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
			"PAGER_SHOW_ALL" => "Y",
			"HIDE_NOT_AVAILABLE" => "N",
			"CONVERT_CURRENCY" => "Y",
			"CURRENCY_ID" => "RUB",
			"OFFERS_CART_PROPERTIES" => array(),
			"AJAX_OPTION_JUMP" => "Y",
			"AJAX_OPTION_STYLE" => "Y",
			"AJAX_OPTION_HISTORY" => "Y",
			"PAGE_RESULT_COUNT" => "500",
		)
	);?>
	<?$APPLICATION->IncludeComponent(
		"bitrix:main.include",
		".default",
		array(
			"AREA_FILE_SHOW" => "file",
			"AREA_FILE_SUFFIX" => "inc",
			"EDIT_TEMPLATE" => "",
			"PATH" => SITE_DIR."include/dealer.php",
			"COMPONENT_TEMPLATE" => ".default"
		),
		false
	);?>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
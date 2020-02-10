<?
define("HIDE_SIDEBAR", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Корзина");
?>
<div class="container">
	<h1><?$APPLICATION->ShowTitle(false)?></h1>
	<div class="greenseparator"></div>
	<?$APPLICATION->IncludeComponent("bitrix:sale.basket.basket", ".default"._template, array(
		"COUNT_DISCOUNT_4_ALL_QUANTITY" => "Y",
		"COLUMNS_LIST" => array(
			0 => "NAME",
			1 => "DISCOUNT",
			2 => "PRICE",
			3 => "QUANTITY",
			4 => "SUM",
			5 => "PROPS",
			6 => "DELETE",
			7 => "DELAY",
		),
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"PATH_TO_ORDER" => "/personal/order/make/",
		"HIDE_COUPON" => "N",
		"QUANTITY_FLOAT" => "N",
		"PRICE_VAT_SHOW_VALUE" => "N",
		"TEMPLATE_THEME" => "site",
		"SET_TITLE" => "Y",
		"AJAX_OPTION_ADDITIONAL" => "",
		"OFFERS_PROPS" => array(
				0 => "PROPERTY_ARTICLE"
		),
		"USE_GIFTS" => "N",
		"SHOW_FILTER" => "N"
		),
		false
	);?>
	<?$APPLICATION->IncludeComponent(
		"bitrix:main.include",
		"",
		Array(
			"AREA_FILE_SHOW" => "file",
			"AREA_FILE_SUFFIX" => "inc",
			"EDIT_TEMPLATE" => "",
			"PATH" => SITE_DIR."include/toolorder_inner.php"
		)
	);?>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
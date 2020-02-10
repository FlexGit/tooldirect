<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("iblock");
CModule::IncludeModule("catalog");

if (!empty($_POST['section_id']) && !empty($_POST['section_parent_id'])) {
	$sectionId = trim($_POST['section_id']);
	$sectionParentId = trim($_POST['section_parent_id']);
	$sectionUrl = trim($_POST['section_url']);
	
	global $arrFilterSectionMain;
	$arrFilterSectionMain = Array(
		"=PROPERTY_SHOW_MAIN_SUBSECTION" => "Y",
	);
	?>
	<?$APPLICATION->IncludeComponent(
		"bitrix:catalog.section", "main", Array(
			"IS_MAIN" => true,
			"IBLOCK_ID" => CATALOG_BLOCK_ID,
			"IBLOCK_TYPE" => "catalog",
			"SECTION_ID" => $sectionId,
			"HIDE_NOT_AVAILABLE" => "N", // Недоступные товары
			"HIDE_NOT_AVAILABLE_OFFERS" => "N",	// Недоступные торговые предложения
			"FILTER_NAME" => "arrFilterSectionMain",
			"TITLE" => "Новинки",
			"PAGE_ELEMENT_COUNT" => "5",
			"INCLUDE_SUBSECTIONS" => "Y",
			"OFFERS_LIMIT" => "5",
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
	<div class="product__item">
		<div class="product__more-text">
			<div style="margin-bottom:10px;">Хотите больше?</div>
			<?/*<div style="margin-bottom:10px;"><?=$arSection['NAME']?> в нашем каталоге</div>*/?>
			<a href="<?=$sectionUrl?>" class="product__menu-button">в каталог</a>
		</div>
		<?
		global $arrFiltermain;
		$arrFiltermain = Array(
			"=UF_MAIN_SHOW" => true,
			"=UF_SEO_SECTION" => true,
			"=UF_PARENT_SECTION" => $sectionParentId,
		);
		?>
		<?$APPLICATION->IncludeComponent(
			"bitrix:catalog.section.list", "seo", Array(
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
				"FILTER_NAME" => "arrFiltermain",
				"ADD_SECTIONS_CHAIN" => "Y",
				"CACHE_TYPE" => "A",
				"CACHE_TIME" => "36000000",
				"CACHE_NOTES" => "",
				"CACHE_GROUPS" => "Y"
			)
		);
		?>
	</div> <!-- product__item -->
	<?
}
?>

<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Каталоги и презентации инструментов (фрез, пил, ножей и других). Широкий ассортимент фрез, пил, ножей, аксессуаров и комплектующих от ведущих мировых производителей инструментов.");
$APPLICATION->SetPageProperty("keywords", "купить фрезы, купить пилы, купить концевые фрезы, купить алмазные фрезы, алмазные фрезы недорого, алмазные фрезы дешево");
$APPLICATION->SetPageProperty("title", "Все виды фрез, пилы: каталоги и презентации");
$APPLICATION->SetTitle("Каталоги и презентации инструментов");
?>
<div class="container">
	<h1><?$APPLICATION->ShowTitle(false)?></h1>
	<div class="greenseparator"></div>

	<section id="akcii">
		<?$APPLICATION->IncludeComponent("bitrix:news", "presentations", array(
			"IBLOCK_TYPE" => "news",
			"IBLOCK_ID" => "8",
			"TEMPLATE_THEME" => "site",
			"NEWS_COUNT" => "8",
			"USE_SEARCH" => "N",
			"USE_RSS" => "N",
			"NUM_NEWS" => "20",
			"NUM_DAYS" => "180",
			"YANDEX" => "N",
			"USE_RATING" => "N",
			"USE_CATEGORIES" => "N",
			"USE_REVIEW" => "N",
			"USE_FILTER" => "N",
			"SORT_BY1" => "ACTIVE_FROM",
			"SORT_ORDER1" => "DESC",
			"SORT_BY2" => "SORT",
			"SORT_ORDER2" => "ASC",
			"CHECK_DATES" => "Y",
			"SEF_MODE" => "Y",
			"SEF_FOLDER" => "/katalogi-i-prezentatsii/",
			"AJAX_MODE" => "N",
			"AJAX_OPTION_SHADOW" => "Y",
			"AJAX_OPTION_JUMP" => "N",
			"AJAX_OPTION_STYLE" => "Y",
			"AJAX_OPTION_HISTORY" => "N",
			"CACHE_TYPE" => "A",
			"CACHE_TIME" => "36000000",
			"CACHE_FILTER" => "N",
			"CACHE_GROUPS" => "Y",
			"DISPLAY_PANEL" => "Y",
			"SET_TITLE" => "Y",
			"SET_STATUS_404" => "Y",
			"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
			"ADD_SECTIONS_CHAIN" => "N",
			"ADD_ELEMENT_CHAIN" => "Y",
			"USE_PERMISSIONS" => "N",
			"PREVIEW_TRUNCATE_LEN" => "",
			"LIST_ACTIVE_DATE_FORMAT" => "d.m.Y",
			"LIST_FIELD_CODE" => array(
				0 => "",
				1 => "",
			),
			"LIST_PROPERTY_CODE" => array(
				0 => "FILE",
				1 => "",
			),
			"HIDE_LINK_WHEN_NO_DETAIL" => "N",
			"DISPLAY_NAME" => "Y",
			"META_KEYWORDS" => "-",
			"META_DESCRIPTION" => "-",
			"BROWSER_TITLE" => "-",
			"DETAIL_ACTIVE_DATE_FORMAT" => "d.m.Y",
			"DETAIL_FIELD_CODE" => array(
				0 => "",
				1 => "",
			),
			"DETAIL_PROPERTY_CODE" => array(
				0 => "",
				1 => "",
			),
			"DETAIL_DISPLAY_TOP_PAGER" => "N",
			"DETAIL_DISPLAY_BOTTOM_PAGER" => "Y",
			"DETAIL_PAGER_TITLE" => "Страница",
			"DETAIL_PAGER_TEMPLATE" => "visual",
			"DETAIL_PAGER_SHOW_ALL" => "Y",
			"DISPLAY_TOP_PAGER" => "N",
			"DISPLAY_BOTTOM_PAGER" => "Y",
			"PAGER_TITLE" => "Каталоги и презентации",
			"PAGER_SHOW_ALWAYS" => "N",
			"PAGER_TEMPLATE" => "visual",
			"PAGER_DESC_NUMBERING" => "N",
			"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000000",
			"PAGER_SHOW_ALL" => "N",
			"DISPLAY_DATE" => "Y",
			"DISPLAY_PICTURE" => "Y",
			"DISPLAY_PREVIEW_TEXT" => "Y",
			"AJAX_OPTION_ADDITIONAL" => "",
			"SLIDER_PROPERTY" => "PICS_NEWS",
			"SEF_URL_TEMPLATES" => array(
				"news" => "",
				"section" => "",
				"detail" => "#ELEMENT_CODE#/",
				"search" => "search/",
				"rss" => "rss/",
				"rss_section" => "#SECTION_ID#/rss/",
			)
		),
			false
		);?>
	</section>
	<?$APPLICATION->IncludeComponent(
		"bitrix:main.include",
		"",
		Array(
			"AREA_FILE_SHOW" => "file",
			"AREA_FILE_SUFFIX" => "inc",
			"EDIT_TEMPLATE" => "",
			"PATH" => SITE_DIR."include/dealer.php"
		)
	);?>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("iblock");
CModule::IncludeModule("catalog");

$sectionId = intval($_POST['section_id']);
$dataAttr = $_POST['dataAttr'];

$sortBy = 'PROPERTY_D';
$sortType = 'asc';
if (!empty($_POST['sortBy']) && !empty($_POST['sortType'])) {
	$sortBy = $_POST['sortBy'];
	$sortType = $_POST['sortType'];
}

if ($sectionId) {
	global $arrFilterSectionMain;
	if (!empty($dataAttr)) {
		foreach ($dataAttr as $data) {
			if ($data['code'] == 'MAKE') {
				if (!empty($data['values'])) {
					$values = $ids = [];
					foreach ($data['checked'] as $key => $value) {
						if ($value) $values[] = $key;
					}
					if (empty($values)) {
						$ids[] = 0;
					} else {
						$arSelect = ["ID"];
						$arFilter = ["IBLOCK_ID" => MAKE_BLOCK_ID, "NAME" => $values];
						$res = CIBlockElement::GetList([], $arFilter, false, false, $arSelect);
						while ($ob = $res->GetNextElement()) {
							$arFields = $ob->GetFields();
							$ids[] = $arFields['ID'];
						}
					}
					if (!empty($ids)) {
						$arrFilterSectionMain['=PROPERTY_' . $data['code'].'.ID'] = $ids;
					}
				}
			} elseif ($data['display_type'] == 'A') {
				$arrFilterSectionMain['>=PROPERTY_' . $data['code']] = $data['value_from'];
				$arrFilterSectionMain['<=PROPERTY_' . $data['code']] = $data['value_to'];
			} else {
				if (!empty($data['checked'])) {
					$values = [];
					foreach ($data['checked'] as $key => $value) {
						if ($value) $values[] = $key;
					}
					if (empty($values)) {
						$values[] = 'blank';
					}
					$arrFilterSectionMain['PROPERTY_'.$data['code'].'_VALUE'] = $values;
				}
			}
		}
	}
	//echo '<pre>';print_r($arrFilterSectionMain);echo '</pre>';
	?>
	<?$APPLICATION->IncludeComponent(
		"bitrix:catalog.section", "", Array(
			"IBLOCK_ID" => CATALOG_BLOCK_ID,
			"IBLOCK_TYPE" => "catalog",
			"TEMPLATE_THEME" => "site",
			"SECTION_ID" => $sectionId,
			"HIDE_NOT_AVAILABLE" => "N", // Недоступные товары
			"HIDE_NOT_AVAILABLE_OFFERS" => "N",	// Недоступные торговые предложения
			"USE_FILTER" => "Y",
			"FILTER_NAME" => "arrFilterSectionMain",
			"PAGE_ELEMENT_COUNT" => "10",
			"LINE_ELEMENT_COUNT" => "1",
			"INCLUDE_SUBSECTIONS" => "Y",
			"OFFERS_LIMIT" => "0",
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
			"LAZY_LOAD" => "Y",
			"LOAD_ON_SCROLL" => "Y",
			"MESS_BTN_ADD_TO_BASKET" => "В корзину",
			"DISPLAY_TOP_PAGER" => "N",
			"DISPLAY_BOTTOM_PAGER" => "N",
			"PAGER_SHOW_ALWAYS" => "N",
			"PAGER_SHOW_ALL" => "N",
			"ELEMENT_SORT_FIELD" => $sortBy,
			"ELEMENT_SORT_ORDER" => $sortType,
			"ELEMENT_SORT_FIELD2" => "name",
			"ELEMENT_SORT_ORDER2" => "asc"
	), false
	);
	?>
<?}?>

<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("iblock");
CModule::IncludeModule("catalog");

$IBLOCK_ID = 4;
$IBLOCK_SECTION_ID = 7373;
$PRICE_TYPE_ID = 1;
/*
 * frezy1.xlsx - Фрезы алмазные
 * frezy2.xlsx - Фрезы концевые
 * frezy3.xlsx - Фрезы насадные
 * frezy4.xlsx - Фрезы сменный нож
 * frezy5.xlsx - Фрезы спиральные
 * accessories.xlsx - Аксессуары
 * gravery.xlsx - Граверы
 * nozhy.xlsx - Ножи
 * patrony_ysangy.xlsx - Патроны и фанги
 * pilnye_diski.xlsx - Пильные диски
 * prisposoblenya_stoliarnye.xlsx - Приспособления столярные
 * sverla_zankery.xlsx - Сверла и зенкеры
 * stoly_verstaki_tisky.xlsx - Столы, верстаки, тиски
 * strubtsiny.xlsx - Струбцины
 */
$FILE = 'strubtsiny.xlsx';
$ACTIVE_SHEETS = [
	0 => 'MAIN',
	1 => 'SEO',
	2 => 'USER',
	3 => 'USER_EXT'
];

$translitParams = [
	"max_len" => "100", // обрезает символьный код до 100 символов
	"change_case" => "L", // буквы преобразуются к нижнему регистру
	"replace_space" => "-", // меняем пробелы на нижнее подчеркивание
	"replace_other" => "-", // меняем левые символы на нижнее подчеркивание
	"delete_repeat_replace" => "true", // удаляем повторяющиеся нижние подчеркивания
	"use_google" => "false", // отключаем использование google
];

//exit;

if (CModule::IncludeModule("nkhost.phpexcel")) {
	global $PHPEXCELPATH;
	
	require_once ($PHPEXCELPATH . '/PHPExcel/IOFactory.php');
	
	$xls = PHPExcel_IOFactory::load($FILE);

	foreach ($ACTIVE_SHEETS as $ACTIVE_SHEET => $GROUP_TYPE) {
		// Устанавливаем индекс активного листа
		$xls->setActiveSheetIndex($ACTIVE_SHEET);
		// Получаем активный лист
		$sheet = $xls->getActiveSheet();
		
		for ($i = 1; $i <= $sheet->getHighestRow(); $i++) {
			$nColumn = PHPExcel_Cell::columnIndexFromString($sheet->getHighestColumn());
			$n = 0;
			for ($j = 0; $j < $nColumn; $j++) {
				$value = trim($sheet->getCellByColumnAndRow($j, $i)->getValue());
				if ($value) {
					$arProducts[$GROUP_TYPE][$i][$n] = $value;
					$n++;
				}
			}
		}
	}
	
	/*echo '<pre>';
	var_dump($arProducts);
	echo '<pre>';*/
	
	foreach ($arProducts as $GROUP_TYPE => $products) {
		// определяем тип раздела
		switch ($GROUP_TYPE) {
			case 'MAIN':
				$SECTION_FOR_SEO = 0;
				$SECTION_FOR_USER = 0;
				$SECTION_FOR_USER_EXT = 0;
			break;
			
			case 'SEO':
				$SECTION_FOR_SEO = 1;
				$SECTION_FOR_USER = 0;
				$SECTION_FOR_USER_EXT = 0;
			break;
			
			case 'USER':
				$SECTION_FOR_SEO = 0;
				$SECTION_FOR_USER = 1;
				$SECTION_FOR_USER_EXT = 0;
			break;
			
			case 'USER_EXT':
				$SECTION_FOR_SEO = 0;
				$SECTION_FOR_USER = 0;
				$SECTION_FOR_USER_EXT = 1;
			break;
			
			default:
				$SECTION_FOR_SEO = 0;
				$SECTION_FOR_USER = 0;
				$SECTION_FOR_USER_EXT = 0;
		}
		
		foreach ($products as $product) {
			// собираем разделы в массив
			$groupArr = [];
			for ($i = 3; $i <= count($product); $i++) {
				$groupArr[] = $product[$i];
			}
			
			/*echo '<pre>';
			print_r($product);
			echo '</pre>';*/
			
			if (count($groupArr)) {
				$groupIds = [];
				foreach ($groupArr as $group) {
					// поиск раздела
					$rsSect = CIBlockSection::GetList([], ['IBLOCK_ID' => $IBLOCK_ID, 'NAME' => $group]);
					if ($arSect = $rsSect->GetNext()) {
						$groupIds[] = $arSect['ID'];
					}
					else {
						// добавление раздела
						$bs = new CIBlockSection;
						$arLoadSectionArray = [
							"IBLOCK_SECTION_ID" => $IBLOCK_SECTION_ID,
							"IBLOCK_ID" => $IBLOCK_ID,
							"NAME" => $group,
							"CODE" => CUtil::translit($group, "ru", $translitParams),
							"ACTIVE" => "Y",
							"UF_SEO_SECTION" => $SECTION_FOR_SEO,
							"UF_USER_SECTION" => $SECTION_FOR_USER,
							"UF_USER_EXT_SECTION" => $SECTION_FOR_USER_EXT
						];
						$groupIds[] = $bs->Add($arLoadSectionArray);
					}
				}
			}
			
			if (($key = array_search(16, $groupIds)) !== false) {
				unset($groupIds[$key]);
			}
			
			if (empty($groupIds)) continue;
			
			// поиск элемента
			$arFilter = ["IBLOCK_ID" => $IBLOCK_ID, "PROPERTY_ARTICLE" => $product[0]];
			$res = CIBlockElement::GetList([], $arFilter, false, false, ["ID", "IBLOCK_ID"]);
			if ($ob = $res->GetNextElement()) {
				$arFields = $ob->GetFields();
				
				// разделы, к которым привязан элемент
				$oldGroupsIds = [];
				$oldGroupsRes = CIBlockElement::GetElementGroups($arFields["ID"], true);
				while ($arGroup = $oldGroupsRes->Fetch()) {
					$oldGroupsIds[] = $arGroup["ID"];
				}
				// обновление разделов элемента
				$newGroupIds = array_unique(array_merge($oldGroupsIds, $groupIds));
				//echo 'Разделы артикула ' . $product[0] . ': '.implode(',', $newGroupIds).'<br>';
				CIBlockElement::SetElementSection($arFields["ID"], $newGroupIds);
			} else {
				// добавление элемента
				$el = new CIBlockElement;
				$PROP = [];
				$PROP['ARTICLE'] = $product[0];
				$arLoadProductArray = [
					"MODIFIED_BY" => 1,
					"IBLOCK_SECTION" => $groupIds,
					"IBLOCK_ID" => $IBLOCK_ID,
					"PROPERTY_VALUES" => $PROP,
					"NAME" => $product[1],
					"CODE" => CUtil::translit($product[1], "ru", $translitParams),
					"ACTIVE" => "Y"
				];
				if ($GROUP_TYPE == 'MAIN') {
					$arLoadProductArray["IBLOCK_SECTION_ID"] = $groupIds[0];
				}
				
				if ($productId = $el->Add($arLoadProductArray)) {
					echo 'Товар ID ' . $productId . ' добавлен, Артикул ' . $product[0] . '<br>';
					
					// разделы, к которым привязан элемент
					$oldGroupsIds = [];
					$oldGroupsRes = CIBlockElement::GetElementGroups($arFields["ID"], true);
					while ($arGroup = $oldGroupsRes->Fetch()) {
						$oldGroupsIds[] = $arGroup["ID"];
					}
					// обновление разделов элемента
					$newGroupIds = array_unique(array_merge($oldGroupsIds, $groupIds));
					//echo 'Старые разделы артикула ' . $product[0] . ': '.implode(',', $oldGroupsIds).'<br>';
					//echo 'Новые разделы артикула ' . $product[0] . ': '.implode(',', $groupIds).'<br>';
					CIBlockElement::SetElementSection($arFields["ID"], $newGroupIds);
					
					// цена
					$price = str_replace(',', '.', trim(floatval(str_replace(' ', '', $product[2]))));
					$arFields = [
						"PRODUCT_ID" => $productId,
						"CATALOG_GROUP_ID" => $PRICE_TYPE_ID,
						"PRICE" => $price,
						"CURRENCY" => "RUB"
					];
					$res = CPrice::GetList([], ["PRODUCT_ID" => $productId, "CATALOG_GROUP_ID" => $PRICE_TYPE_ID]);
					if ($arr = $res->Fetch()) {
						CPrice::Update($arr["ID"], $arFields);
					} else {
						$cataloProductClass = new CCatalogProduct;
						$cataloProductClass->Add([
							"ID" => $productId,
							"QUANTITY" => 0,
							"VAT_INCLUDED" => "Y"
						]);
						CPrice::Add($arFields);
					}
				}
			}
		}
	}
}

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");
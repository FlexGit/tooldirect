<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("iblock");
CModule::IncludeModule("catalog");

exit;

$IBLOCK_ID = 4;
$IBLOCK_SECTION_ID = 7118;
$PRICE_TYPE_ID = 1;

$FILE = 'frezy_koncevye_new.xlsx';

$ACTIVE_SHEETS = [
	0 => 'USER_EXT',
	/*1 => 'USER'*/
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
				if (!empty(trim($value))) {
					$arProducts[$GROUP_TYPE][$i][$n] = $value;
					$n++;
				}
			}
		}
	}
	
	/*echo '<pre>';
	print_r($arProducts);
	echo '<pre>';
	exit;*/
	
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
			for ($i = 1; $i <= count($product); $i++) {
				if ($product[$i]) {
					$groupArr[] = $product[$i];
				}
			}
			
			/*echo '<pre>';
			print_r($groupArr);
			echo '</pre>';
			exit;*/
			
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
						if ($groupIds[] = $bs->Add($arLoadSectionArray)) {
							echo 'Добавлен раздел: ' . $group . '<br>';
						}
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
				echo 'Текущие разделы артикула ' . $product[0] . ': '.implode(',', $oldGroupsIds).'<br>';
				// обновление разделов элемента
				$newGroupIds = array_unique(array_merge($oldGroupsIds, $groupIds));
				echo 'Обновленные разделы артикула ' . $product[0] . ': '.implode(',', $newGroupIds).'<br>';
				CIBlockElement::SetElementSection($arFields["ID"], $newGroupIds);
			}
		}
	}
}

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");
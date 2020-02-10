<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("iblock");
CModule::IncludeModule("catalog");

$IBLOCK_ID = 4;
$FILE = 'names2.xlsx';

$translitParams = [
	"max_len" => "250", // обрезает символьный код до 100 символов
	"change_case" => "L", // буквы преобразуются к нижнему регистру
	"replace_space" => "-", // меняем пробелы на нижнее подчеркивание
	"replace_other" => "-", // меняем левые символы на нижнее подчеркивание
	"delete_repeat_replace" => "true", // удаляем повторяющиеся нижние подчеркивания
	"use_google" => "false", // отключаем использование google
];

function utf8_to_cp1251($string) {
	return utf8_encode($decoded = utf8_decode($string)) === $string ? $decoded : iconv("utf8", "cp1251", $string);
}

exit;

if (CModule::IncludeModule("nkhost.phpexcel")) {
	global $PHPEXCELPATH;
	
	require_once ($PHPEXCELPATH . '/PHPExcel/IOFactory.php');
	
	$xls = PHPExcel_IOFactory::load($FILE);

	// Устанавливаем индекс активного листа
	$xls->setActiveSheetIndex(0);
	// Получаем активный лист
	$sheet = $xls->getActiveSheet();
	
	for ($i = 1; $i <= $sheet->getHighestRow(); $i++) {
		$nColumn = PHPExcel_Cell::columnIndexFromString($sheet->getHighestColumn());
		$n = 0;
		for ($j = 0; $j < $nColumn; $j++) {
			$value = trim($sheet->getCellByColumnAndRow($j, $i)->getValue());
			if ($value) {
				$arProducts[$i][$n] = $value;
				$n++;
			}
		}
	}
	
	//echo '<pre>';print_r($arProducts);echo '<pre>';
	
	foreach ($arProducts as $products => $product) {
		$product[0] = trim($product[0]);

		//if ($product[0] == 'ACS001') {
			//echo '<pre>';print_r($product);echo '<pre>';
			$v1 = utf8_encode($product[1]);
			$v2 = iconv("cp1251", "utf8", $product[1]);
			
			/*echo "Broked string charset detected: ".(mb_detect_encoding($v1, mb_detect_order()))." and ".(mb_check_encoding($v1, "utf8") ? "valid" : "invalid")."\n";
			echo "Valid string charset detected: ".(mb_detect_encoding($v2, mb_detect_order()))." and ".(mb_check_encoding($v2, "utf8") ? "valid" : "invalid")."\n";
			
			echo "\nOriginal:\n";
			var_dump($v1, $v2);
			echo "\nBroken:\n";
			var_dump($v1, utf8_decode($v1));
			echo "\nValid:\n";
			var_dump($v2, utf8_decode($v2));
			echo "\nNormalize:\n";
			var_dump(utf8_to_cp1251($v1), utf8_to_cp1251($v2));*/
			
			//echo '<pre>';print_r($product);echo '<pre>';
			//exit;
		
			$name = utf8_to_cp1251($v1)/* . ', арт. ' . $product[0]*/;
			
			// поиск элемента
			$arFilter = ["IBLOCK_ID" => $IBLOCK_ID, "PROPERTY_ARTICLE" => $product[0]];
			$res = CIBlockElement::GetList([], $arFilter, false, false, ["ID", "IBLOCK_ID"]);
			if ($ob = $res->GetNextElement()) {
				$arFields = $ob->GetFields();
				
				// обновление элемента
				$el = new CIBlockElement;
				$arLoadProductArray = [
					"MODIFIED_BY" => 1,
					"IBLOCK_ID" => $IBLOCK_ID,
					"NAME" => $name,
					"CODE" => CUtil::translit($name, "ru", $translitParams),
				];
				
				//print_r($arLoadProductArray);
				
				if ($el->Update($arFields["ID"], $arLoadProductArray)) {
					echo 'Товар ID ' . $arFields["ID"] . ' обновлен, Артикул ' . $product[0] . '<br>';
				} else {
					echo 'Товар ID ' . $arFields["ID"] . ' не обновлен, Артикул ' . $product[0] . '<br>';
				}
			}
		//}
	}
}

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");
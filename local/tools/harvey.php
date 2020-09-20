<?php
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

CModule::IncludeModule("iblock");
CModule::IncludeModule('main');
CModule::IncludeModule("catalog");

$validParams = [
	'ARTICLE',
	'MAKE',
	'D',
	'I',
	'L',
	'S',
	'CUTTING_TYPE',
	'Z',
	'MATERIAL',
	'RATE',
	/*'B',
	'R',
	'H',
	'K',
	'P',
	'RN',
	'R2',
	'Z_TYPE',
	'RH_LH',
	'LENGTH',
	'WIDTH',
	'HEIGHT',
	'TOOL_MATERIAL',
	'DIMENSIONS',
	'B2',
	'WEIGHT',
	'D2',
	'TYPE_TOOL',
	'TEETH_TYPE',
	'TEETH_ANGLE',
	'COATING',
	'F',
	'SPREAD',*/
];

$i = 0;
$arr[$i] = [
	'ID',
	'Наименование',
	'Описание',
	'Фото',
	'Производитель',
	'Артикул',
	'Диаметр, мм',
	'Длина режущей части ножа, мм',
	'Общая длина, мм',
	'Диаметр хвостовика, мм',
	'Градус резки, °',
	'Количество зубьев, шт.',
	'Обрабатываемый материал',
	'Частота вращения, об/мин',
	'Стоимость',
	'Наличие'/*,
	'Разделы'*/
];
$i++;

$arFilter = ["IBLOCK_ID" => CATALOG_BLOCK_ID, "ACTIVE" => "Y", "PROPERTY_MAKE" => [319]/*, "ID" => 6767*/];
$arSelect = ["ID", "IBLOCK_ID", "NAME", "DETAIL_TEXT", "DETAIL_PICTURE", "PROPERTY_*"];
$res = CIBlockElement::GetList(["NAME" => "ASC"], $arFilter, false, false, $arSelect);
while ($ob = $res->GetNextElement()) {
	$arFields = $ob->GetFields();
	$arProps = $ob->GetProperties();
	
	//echo '<pre>';print_r($arProps);echo '</pre>';
	
	$arr[$i][] = (string)$arFields["ID"];
	
	$arFields["NAME"] = htmlentities($arFields["NAME"], null, 'UTF-8');
	$arFields["NAME"] = str_replace("&nbsp;", " ", $arFields["NAME"]);
	$arFields["NAME"] = str_replace("&amp;", "", $arFields["NAME"]);
	$arFields["NAME"] = str_replace("&laquo;", "", $arFields["NAME"]);
	$arFields["NAME"] = str_replace("&raquo;", "", $arFields["NAME"]);
	$arFields["NAME"] = str_replace("amp;", "", $arFields["NAME"]);
	$arFields["NAME"] = str_replace("quot;", "\"", $arFields["NAME"]);
	$arFields["NAME"] = str_replace("laquo;", "", $arFields["NAME"]);
	$arFields["NAME"] = str_replace("raquo;", "", $arFields["NAME"]);
	
	$arr[$i][] = (string)trim($arFields["NAME"]);
	
	/*$arFields["DETAIL_TEXT"] = htmlentities($arFields['DETAIL_TEXT'], null, 'UTF-8');
	$arFields["DETAIL_TEXT"] = str_replace("&nbsp;", " ", $arFields['DETAIL_TEXT']);
	$arFields["DETAIL_TEXT"] = str_replace("&amp;", "", $arFields['DETAIL_TEXT']);
	$arFields["DETAIL_TEXT"] = str_replace("&laquo;", "", $arFields['DETAIL_TEXT']);
	$arFields["DETAIL_TEXT"] = str_replace("&raquo;", "", $arFields['DETAIL_TEXT']);
	$arFields["DETAIL_TEXT"] = str_replace("amp;", "", $arFields['DETAIL_TEXT']);
	$arFields["DETAIL_TEXT"] = str_replace("quot;", "\"", $arFields['DETAIL_TEXT']);
	$arFields["DETAIL_TEXT"] = str_replace("laquo;", "", $arFields['DETAIL_TEXT']);
	$arFields["DETAIL_TEXT"] = str_replace("raquo;", "", $arFields['DETAIL_TEXT']);*/

	$arr[$i][] = /*(string)trim(strip_tags($arFields["DETAIL_TEXT"]))*/'';
	
	$arr[$i][] = (string)'https://tooldirect.ru' . CFile::GetPath($arFields["DETAIL_PICTURE"]);
	
	foreach ($arProps as $k => $v) {
		if (!in_array($k, $validParams)) continue;
		//if (empty($v["VALUE"])) continue;
		
		if ($v["PROPERTY_TYPE"] == 'E') {
			$resSub = CIBlockElement::GetByID($v["VALUE"]);
			if ($obSub = $resSub->GetNext()) {
				$arr[$i][] = (string)$obSub["NAME"];
			}
		} elseif ($v["PROPERTY_TYPE"] == 'N') {
			$arr[$i][] = (string)$v["VALUE"];
		} else {
			if (is_array($v["VALUE"])) {
				$arr[$i][] = implode(',', $v["VALUE"]);
			} else {
				$arr[$i][] = (string)$v["VALUE"];
			}
		}
	}
	
	$resPrice = CPrice::GetList([], ["PRODUCT_ID" => $arFields['ID'], "CATALOG_GROUP_ID" => 1]);
	if ($arrPrice = $resPrice->Fetch()) {
		$arr[$i][] = (string)$arrPrice['PRICE'];
	}
	
	$resProduct = CCatalogProduct::GetByID($arFields['ID']);
	
	if ($resProduct['QUANTITY'] <= 0)
		$arr[$i][] = 'ожидается поступление';
	elseif ($resProduct['QUANTITY'] <= 2)
		$arr[$i][] = 'до 2';
	elseif ($resProduct['QUANTITY'] >= 3 && $resProduct['QUANTITY'] <= 5)
		$arr[$i][] = 'от 3 до 5';
	elseif ($resProduct['QUANTITY'] > 5 && $resProduct['QUANTITY'] <= 10)
		$arr[$i][] = 'от 5 до 10';
	elseif ($resProduct['QUANTITY'] > 10 && $resProduct['QUANTITY'] <= 20)
		$arr[$i][] = 'от 10 до 20';
	elseif ($resProduct['QUANTITY'] > 20)
		$arr[$i][] = 'от 20';
	
	// разделы
	$sectionIds = [];
	$resSectionIds = CIBlockElement::GetElementGroups($arFields["ID"]);
	while ($arSectionIds = $resSectionIds->Fetch()) {
		$sectionIds[] = $arSectionIds["ID"];
	}
	$sections = [];
	if (count($sectionIds)) {
		$arSectionFilter = ["IBLOCK_ID" => CATALOG_BLOCK_ID, "ACTIVE" => "Y", "UF_SEO_SECTION" => "0", "DEPTH_LEVEL" => 2, "ID" => $sectionIds];
		$arSectionSelect = ["ID", "IBLOCK_ID", "IBLOCK_SECTION_ID", "NAME"];
		$resSection = CIBlockSection::GetList([], $arSectionFilter, true, $arSectionSelect);
		while ($obSection = $resSection->GetNextElement()) {
			$arSectionFields = $obSection->GetFields();
			$sections[] = $arSectionFields["NAME"];
		}
		$sections = array_unique($sections);
		if (!empty($sections)) {
			foreach ($sections as $section) {
				$arr[$i][] = $section;
			}
		}
	}
	
	$i++;
}

//echo '<pre>';print_r($arr);echo '</pre>';
//exit;

//file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/upload/price/harvey.json', json_encode($arr));

if (!empty($arr)) {
	$fp = fopen($_SERVER['DOCUMENT_ROOT'] . '/upload/price/harvey.csv', 'w');
	foreach ($arr as $fields) {
		fputcsv($fp, $fields, ';', '"', "\\");
	}
	fclose($fp);
}

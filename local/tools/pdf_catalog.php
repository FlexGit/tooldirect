<?
ini_set('memory_limit', '4095M');

$sections = explode(',', $_REQUEST['sections']);
$makes = explode(',', $_REQUEST['makes']);
$type = $_REQUEST['type'];

if ((empty($sections) && empty($makes)) || empty($type)) {
	die();
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
include $_SERVER['DOCUMENT_ROOT'] . '/local/php_interface/lib/phpqrcode/qrlib.php';
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

//use Monolog\Logger;
//use Monolog\Handler\StreamHandler;

CModule::IncludeModule("iblock");
CModule::IncludeModule("catalog");
CModule::IncludeModule('main');
CModule::IncludeModule('highloadblock');

define("YOUTUBE_VIDEO_PATH", "https://www.youtube.com/watch?v=");

$months = [
	'01' => 'января',
	'02' => 'февраля',
	'03' => 'марта',
	'04' => 'апреля',
	'05' => 'мая',
	'06' => 'июня',
	'07' => 'июля',
	'08' => 'августа',
	'09' => 'сентября',
	'10' => 'октября',
	'11' => 'ноября',
	'12' => 'декабря'
];

$pdfField = 'NAME_PDF_CATALOG';
if ($type == 'extended') $pdfField = 'NAME_PDF';

$sectionParams = [
	'7118' => [
		'params' =>	['D','I','L','S','R','Z','CUTTING_TYPE','H'],
		'type' => 'UF_USER_EXT_SECTION',
	], // Фрезы концевые
	'7235' => [
		'params' =>	[$pdfField],
		'type' => 'UF_USER_SECTION',
	], // Фрезы алмазные
	'7292' => [
		'params' =>	[$pdfField],
		'type' => 'UF_USER_SECTION',
	], // Аксессуары
	'7305' => [
		'params' =>	['D','I','L','S','CUTTING_TYPE'],
		'type' => 'UF_USER_SECTION',
	], // Граверы
	'7246' => [
		'params' =>	['D','I','L','B','R','H','CUTTING_TYPE','Z'],
		'type' => 'UF_USER_SECTION',
	], // Фрезы насадные
	'7310' => [
		'params' =>	['LENGTH','WIDTH','HEIGHT','R','CUTTING_TYPE'],
		'type' => 'UF_USER_SECTION',
	], // Ножи и бланкеты
	'7322' => [
		'params' =>	[$pdfField],
		'type' => 'UF_USER_SECTION',
	], // Патроны и цанги
	'7328' => [
		'params' =>	['D','B','K','P','Z','TEETH_TYPE'],
		'type' => 'UF_USER_SECTION',
	], // Пильные диски
	'7353' => [
		'params' =>	[$pdfField],
		'type' => 'UF_USER_SECTION',
	], // Столярные приспособления
	'7359' => [
		'params' =>	['D','I','L','S','RH_LH'],
		'type' => 'UF_USER_SECTION',
	], // Свёрла и зенкеры
	'7255' => [
		'params' =>	['D','I','L','S','R','Z','CUTTING_TYPE'],
		'type' => 'UF_USER_SECTION',
	], // Фрезы со сменными ножами
	'7268' => [
		'params' =>	['D','I','L','S','RN','R','Z'],
		'type' => 'UF_USER_SECTION',
	], // Фрезы спиральные
	'7370' => [
		'params' =>	[$pdfField],
		'type' => 'UF_USER_SECTION',
	], // Столы, верстаки, тиски
	'7373' => [
		'params' =>	[$pdfField],
		'type' => 'UF_USER_SECTION',
	], // Струбцины
];

// Properties
$properties = [];
$resProperty = CIBlockProperty::GetList([], ["IBLOCK_ID" => CATALOG_BLOCK_ID]);
while ($obProperty = $resProperty->Fetch()) {
	$properties[$obProperty['CODE']] = $obProperty['NAME'];
}

//echo '<pre>';print_r($properties);echo '</pre>';
//exit;

$arResult = [];

function getSections($sections, $makes = []) {
	global $sectionParams, $arResult;

	$arResult["sectionIntersectCount"] = 0;

	foreach ($sections as $sectionId) {
		$arSectionFilter = ["IBLOCK_ID" => CATALOG_BLOCK_ID, "ACTIVE" => "Y", "DEPTH_LEVEL" => 2, "SECTION_ID" => $sectionId];
		$arSectionSelect = ["ID", "IBLOCK_ID", "IBLOCK_SECTION_ID", "NAME", "PICTURE", "UF_*"];
		$arSectionOrder = ["SECTION_ID" => "ASC"];
		$resSection = CIBlockSection::GetList($arSectionOrder, $arSectionFilter, true, $arSectionSelect);
		while ($obSection = $resSection->GetNextElement()) {
			$arSectionFields = $obSection->GetFields();
			
			if (!array_key_exists($arSectionFields['IBLOCK_SECTION_ID'], $sectionParams)) continue;
			if (!$arSectionFields['UF_USER_SECTION'] && !$arSectionFields['UF_USER_EXT_SECTION']) continue;
			
			$arResult['SECTIONS'][$arSectionFields['ID']]['NAME'] = $arSectionFields['NAME'];
			$arResult['SECTIONS'][$arSectionFields['ID']]['IBLOCK_SECTION_ID'] = $arSectionFields['IBLOCK_SECTION_ID'];
			$arResult['SECTIONS'][$arSectionFields['ID']]['PICTURE'] = $arSectionFields['PICTURE'];
			$arResult['SECTIONS'][$arSectionFields['ID']]['SRC'] = CFile::GetPath($arSectionFields['PICTURE']);
			$arResult['SECTIONS'][$arSectionFields['ID']]['DESCRIPTION'] = $arSectionFields['UF_DESCRIPTION'];
			$arResult['SECTIONS'][$arSectionFields['ID']]['UF_USER_SECTION'] = $arSectionFields['UF_USER_SECTION'];
			$arResult['SECTIONS'][$arSectionFields['ID']]['UF_USER_EXT_SECTION'] = $arSectionFields['UF_USER_EXT_SECTION'];
			
			// Elements
			$arElementFilter = ["IBLOCK_ID" => CATALOG_BLOCK_ID, "ACTIVE" => "Y", "SECTION_ID" => $arSectionFields['ID']];
			if (!empty($makes)) {
				$arElementFilter["PROPERTY_MAKE"] = $makes;
			}
			$arElementSelect = ["ID", "IBLOCK_ID", "NAME", "IBLOCK_SECTION_ID", "DETAIL_PAGE_URL", "DETAIL_PICTURE", "PROPERTY_*"];
			$resElement = CIBlockElement::GetList([], $arElementFilter, false, false, $arElementSelect);
			while ($obElement = $resElement->GetNextElement()) {
				$arElementFields = $obElement->GetFields();
				$arElementProps = $obElement->GetProperties();
				
				$arResult['SECTIONS'][$arSectionFields['ID']]['ELEMENTS'][$arElementFields["ID"]]["FIELDS"] = $arElementFields;
				$arResult['SECTIONS'][$arSectionFields['ID']]['ELEMENTS'][$arElementFields["ID"]]["PROPS"] = $arElementProps;
				// подсчет кол-ва непустых значений данного параметра данного раздела
				foreach ($sectionParams[$arSectionFields['IBLOCK_SECTION_ID']]['params'] as $param) {
					if (!empty($arElementProps[$param]['VALUE'])) {
						$arResult['SECTIONS'][$arSectionFields['ID']][$param]['PROPS_CNT']++;
					}
				}
				$arResult['SECTIONS'][$arSectionFields['ID']]['MAKES'][] = $arElementProps["MAKE"]["VALUE"];
				$arResult['SECTIONS'][$arSectionFields['ID']]['ELEMENTS_CNT']++;
				
				// Price
				$arResult['SECTIONS'][$arSectionFields['ID']]['ELEMENTS'][$arElementFields["ID"]]["PRICE"] = '-';
				$resPrice = CPrice::GetList([], ["PRODUCT_ID" => $arElementFields['ID'], "CATALOG_GROUP_ID" => 1]);
				if ($arrPrice = $resPrice->Fetch()) {
					$arResult['SECTIONS'][$arSectionFields['ID']]['ELEMENTS'][$arElementFields["ID"]]["PRICE"] = $arrPrice['PRICE'];
				}
				
				if (!empty($makes)) {
					$arResult["sectionIntersectCount"]++;
				}
			}
			$arResult['SECTIONS'][$arSectionFields['ID']]['MAKES'] = array_unique($arResult['SECTIONS'][$arSectionFields['ID']]['MAKES']);
			
			if (!$arResult['SECTIONS'][$arSectionFields['ID']]['ELEMENTS_CNT']) {
				unset($arResult['SECTIONS'][$arSectionFields['ID']]);
			}
		}
	}
	
	return $arResult;
}

// если выбраны разделы
if (!empty($sections[0])) {
	$arResult = getSections($sections, $makes);
	$sectionIntersectCount = $arResult["sectionIntersectCount"];
	
	if (!$arResult["sectionIntersectCount"]) {
		$arResult = getSections($sections, []);
	}
}

// если выбраны производители и не найдено элементов по производителям в поиске по разделам
if (!$sectionIntersectCount && !empty($makes[0])) {
	$childSections = [];
	$arElementFilter = ["IBLOCK_ID" => CATALOG_BLOCK_ID, "ACTIVE" => "Y", "PROPERTY_MAKE" => $makes];
	$arElementSelect = ["ID", "IBLOCK_ID", "IBLOCK_SECTION_ID"];
	$resElement = CIBlockElement::GetList([], $arElementFilter, false, false, $arElementSelect);
	while ($obElement = $resElement->GetNextElement()) {
		$arElementFields = $obElement->GetFields();
		
		$resChildSections = CIBlockElement::GetElementGroups($arElementFields["ID"]);
		while ($arGroup = $resChildSections->Fetch()) {
			$childSections[] = $arGroup["ID"];
		}
	}
	$childSections = array_unique($childSections);
	
	$sections = [];
	if (count($childSections)) {
		$arSectionFilter = ["IBLOCK_ID" => CATALOG_BLOCK_ID, "ACTIVE" => "Y", "DEPTH_LEVEL" => 2, "ID" => $childSections];
		$arSectionSelect = ["ID", "IBLOCK_ID", "IBLOCK_SECTION_ID", "NAME"];
		$arSectionOrder = [];
		$resSection = CIBlockSection::GetList($arSectionOrder, $arSectionFilter, true, $arSectionSelect);
		while ($obSection = $resSection->GetNextElement()) {
			$arSectionFields = $obSection->GetFields();
			$sections[] = $arSectionFields["IBLOCK_SECTION_ID"];
		}
		$sections = array_unique($sections);
	}
	
	if (count($sections)) {
		$arResult = getSections($sections, $makes);
	}
}

//echo '<pre>';print_r($arResult);echo '</pre>';
//exit;

// Makes
$makes = [];
$arFilter = ["IBLOCK_ID" => MAKE_BLOCK_ID, "ACTIVE" => "Y"];
$arSelect = ["ID", "IBLOCK_ID", "NAME", "DETAIL_PICTURE"];
$arOrder = ["SORT" => "ASC"];
$res = CIBlockElement::GetList($arOrder, $arFilter, false, false, $arSelect);
while ($ob = $res->GetNextElement()) {
	$arFields = $ob->GetFields();
	$arProps = $ob->GetProperties();
	
	$arResult['MAKES'][$arFields['ID']]['NAME'] = $arFields['NAME'];
	$arResult['MAKES'][$arFields['ID']]['DETAIL_PICTURE'] = $arFields['DETAIL_PICTURE'];
	$arResult['MAKES'][$arFields['ID']]['SRC'] = CFile::GetPath($arFields['DETAIL_PICTURE']);
	$arResult['MAKES'][$arFields['ID']]['COLOR'] = $arProps["COLOR"]["VALUE"];
}

//echo '<pre>';print_r($arResult);echo '</pre>';
//echo count($arResult);
//exit;

$curDate = date('d') . ' ' . $months[date('m')] . ' ' . date('Y');

$html = '
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<title></title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">';
	/*
	<style>
	@page {
		margin: 30px 30px 10px;
		footer: page-footer;
	}
	page[size="A4"] {
		width: 210mm;
		height: 297mm;
	}
	body {
		background-color: #fff;
		font-family: "montserrat", sans-serif;
		font-size: 10px;
		font-weight: normal;
		line-height: 12px;
		color: #262626;
	}
	.logo {
		width: 165px;
	}
	.logo-img {
		width: 48px;
		height: 40px;
	}
	h1 {
		font-size: 16px;
		font-weight: bold;
		color: #00AC25;
		text-transform: uppercase;
		line-height: 24px;
	}
	page {
		display: block;
		margin: 0 auto;
		size: 210mm 297mm;
	}
	table {
		border-spacing: 0;
		border-collapse: collapse;
		border: 0;
		width: 100%;
	}
	table td {
		padding: 0;vertical-align: top;
	}
	.section-img {
		width: 96px;height: 96px;
	}
	.make-logo {
		width: 48px;height: 24px;
	}
	.elements {
		margin: 20px 0 30px;
	}
	.elements tr td {
		width: 25px;padding: 7px 0;vertical-align: middle;border-bottom: 1px solid #DFF5E4;
	}
	.elements tr td.first {
		width: 10px;padding: 0;vertical-align: middle;text-align: left;
	}
	.bold {
		font-weight: bold;
	}
	.price {
		color: #00AC25;
	}
	.footer {
		width: 100%;
		background-color: #DFF5E4;
	}
	.footer td {
		padding: 7px 10px;font-size: 9px;
	}
	</style>*/
$html .= '
</head>
<body style="background-color: #fff;font-family: montserrat,sans-serif;font-size: 10px;font-weight: normal;line-height: 12px;color: #262626;">';

$html .= '<page size="A4" style="margin: -30px 30px 10px;">';
if (!empty($arResult['SECTIONS'])) {
	$i = 1;
	foreach ($arResult['SECTIONS'] as $sectionKey => $sectionValue) {
		if ($sectionParams[$sectionValue["IBLOCK_SECTION_ID"]]['type'] == 'UF_USER_SECTION' && $sectionValue['UF_USER_SECTION'] != 1) continue;
		if ($sectionParams[$sectionValue["IBLOCK_SECTION_ID"]]['type'] == 'UF_USER_EXT_SECTION' && $sectionValue['UF_USER_EXT_SECTION'] != 1) continue;
		
		$html .= 'chunk
			<table class="header" style="font-size: 10px;border-spacing: 0;border-collapse: collapse;border: 0;width: 100%;">
				<tr>
					<td style="padding: 0;vertical-align: top;width: 96px;text-align: center;padding-right: 30px;">
						<img src="' . $sectionValue['SRC'] . '" class="section-img" style="width: 96px;height: 96px;">
						<table style="border-spacing: 0;border-collapse: collapse;border: 0;width: 100%;background-color: #DFF5E4;margin-top: 5px;">
							<tr><td style="vertical-align: top;padding: 5px 10px;text-align: center;">' . $curDate . '</td></tr>
						</table>
					</td>
					<td nowrap style="vertical-align: top;width: 500px;padding: 5px 0 0;">
						<h1 style="font-size: 16px;font-weight: bold;color: #00AC25;text-transform: uppercase;line-height: 24px;"><span style="color: #262626;">' . $i . '</span> ' . $sectionValue['NAME'] . '</h1>
						<br>
						<div>
							' . $sectionValue['DESCRIPTION'] . '
						</div>
						<br>
						<div>';
							if (!empty($sectionValue['MAKES'])) {
								//$width = (48 + 8) * count($sectionValue['MAKES']);
								$html .= '<table class="make-logo-container" style="border-spacing: 0;border-collapse: collapse;border: 0;width: 1px;"><tr>';
								foreach ($sectionValue['MAKES'] as $makeValue) {
									$html .= '<td style="padding: 0;vertical-align: top;width: 48px;max-width: 48px;height: 27px;padding-right: 8px"><table style="border-spacing: 0;border-collapse: collapse;border: 0;width: 100%;"><tr><td style="padding: 0;vertical-align: top;"><img src="' . $arResult['MAKES'][$makeValue]['SRC'] . '" style="height:24px;"></td></tr><tr><td style="padding: 0;vertical-align: top;height: 3px;background-color: ' . $arResult['MAKES'][$makeValue]['COLOR'] . '"></td></tr></table></td>';
								}
								$html .= '</tr></table>';
							}
							$html .= '
						</div>
					</td>
					<td style="padding: 0;vertical-align: top;text-align: right;">
						<img src="/local/templates/tooldirect_copy/images/logo-pdf.png" alt="" class="logo-img" style="width: 48px;height: 40px;">
					</td>
				</tr>
			</table>
			<div style="clear: both;"></div>
			';
		
		switch ($type) {
			default:
			case 'standart':
				$firstColumnElementsCount = round($sectionValue['ELEMENTS_CNT'] / 2);
				$secondColumnElementsCount = $sectionValue['ELEMENTS_CNT'] - $firstColumnElementsCount;
				
				//$html .= '<div style="page-break-before: avoid;">';
				$html .= '<div style="width: 50%;float: left;">';
				
				if ($firstColumnElementsCount) {
					$html .= '<table class="elements" style="width: 100%;margin: 20px 0 30px;margin-right: 5px;font-size: 10px;">';
					if (!empty($sectionValue['ELEMENTS'])) {
						$html .= '
					<thead>
					<tr class="head">
						<td class="first" style="border-bottom: 1px solid #DFF5E4;width: 10px;padding: 0;vertical-align: middle;text-align: left;"></td>
						<td class="bold" style="width: 25px;padding: 7px 0;vertical-align: middle;border-bottom: 1px solid #DFF5E4;font-weight: bold;">Артикул</td>
					';
						foreach ($sectionParams[$sectionValue["IBLOCK_SECTION_ID"]]['params'] as $param) {
							if (!$sectionValue[$param]["PROPS_CNT"]) continue; // если кол-ва непустых значений параметра == 0, не выводим
							$html .= '<td class="bold" style="width: 25px;padding: 7px 0;vertical-align: middle;border-bottom: 1px solid #DFF5E4;font-weight: bold;" nowrap="nowrap">';
							if (in_array($param, ['CUTTING_TYPE','RH_LH','TEETH_TYPE','RN','LENGTH','WIDTH','HEIGHT'])) {
								$html .= $properties[$param];
							} elseif ($param == $pdfField) {
								$html .= 'Наименование';
							} else {
								$html .= $param;
							}
							$html .= '</td>';
						}
						$html .= '
						<td class="bold" style="width: 25px;padding: 7px 0;vertical-align: middle;border-bottom: 1px solid #DFF5E4;font-weight: bold;">Цена</td>
					</tr>
					</thead>';
						$j = 1;
						foreach ($sectionValue['ELEMENTS'] as $elementKey => $elementValue) {
							$html .= '
						<tr>
							<td class="first" style="border-bottom: 1px solid #DFF5E4;width: 10px;padding: 0;vertical-align: middle;text-align: left;"><div style="background-color: ' . $arResult['MAKES'][$elementValue['PROPS']['MAKE']['VALUE']]['COLOR'] . '">&nbsp;</div></td>
							<td style="width: 25px;padding: 7px 0;vertical-align: middle;border-bottom: 1px solid #DFF5E4;"><a href="https://tooldirect.ru' . $elementValue['FIELDS']['DETAIL_PAGE_URL'] . '" target="_blank" style="font-family: montserrat,sans-serif;font-size: 10px;font-weight: normal;line-height: 12px;color: #262626;text-decoration: none;">' . $elementValue['PROPS']['ARTICLE']['VALUE'] . '</a></td>
						';
							foreach ($sectionParams[$sectionValue["IBLOCK_SECTION_ID"]]['params'] as $param) {
								if (!$sectionValue[$param]["PROPS_CNT"]) continue; // если кол-ва непустых значений параметра == 0, не выводим
								$html .= '<td style="width: 25px;padding: 7px 0;vertical-align: middle;border-bottom: 1px solid #DFF5E4;">';
								if (!empty($elementValue['PROPS'][$param]['VALUE'])) {
									if (is_array($elementValue['PROPS'][$param]['VALUE'])) {
										$html .=  str_replace('/', ' / ', implode(', ', $elementValue['PROPS'][$param]['VALUE']));
									} else {
										$elementValue['PROPS'][$param]['VALUE'] = str_replace('/', ' / ', $elementValue['PROPS'][$param]['VALUE']);
										$html .= $elementValue['PROPS'][$param]['VALUE'];
									}
								} else {
									$html .= '-';
								}
								$html .= '</td>';
							}
							$html .= '
							<td style="width: 25px;padding: 7px 0;vertical-align: middle;border-bottom: 1px solid #DFF5E4;"><span class="price" style="color: #00AC25;">' . number_format($elementValue['PRICE'], 0, '.', '&nbsp;') . '&nbsp;<span>&#8381;</span></span></td>
						</tr>';
							$j++;
							if ($j > $firstColumnElementsCount) break;
						}
					}
					$html .= '</table>';
				}
				
				$html .= '</div>';
				$html .= '<div style="width: 50%;float: right;">';
				
				if ($secondColumnElementsCount) {
					$html .= '<table class="elements" style="width: 100%;margin: 20px 0 30px;margin-left: 5px;font-size: 10px;">';
					if (!empty($sectionValue['ELEMENTS'])) {
						$html .= '
					<thead>
					<tr class="head">
						<td class="first" style="border-bottom: 1px solid #DFF5E4;width: 10px;padding: 0;vertical-align: middle;text-align: left;"></td>
						<td class="bold" style="width: 25px;padding: 7px 0;vertical-align: middle;border-bottom: 1px solid #DFF5E4;font-weight: bold;">Артикул</td>
					';
						foreach ($sectionParams[$sectionValue["IBLOCK_SECTION_ID"]]['params'] as $param) {
							if (!$sectionValue[$param]["PROPS_CNT"]) continue; // если кол-ва непустых значений параметра == 0, не выводим
							$html .= '<td class="bold" style="width: 25px;padding: 7px 0;vertical-align: middle;border-bottom: 1px solid #DFF5E4;font-weight: bold;" nowrap="nowrap">';
							if (in_array($param, ['CUTTING_TYPE','RH_LH','TEETH_TYPE','RN','LENGTH','WIDTH','HEIGHT'])) {
								$html .= $properties[$param];
							} elseif ($param == $pdfField) {
								$html .= 'Наименование';
							} else {
								$html .= $param;
							}
							$html .= '</td>';
						}
						$html .= '
						<td class="bold" style="width: 25px;padding: 7px 0;vertical-align: middle;border-bottom: 1px solid #DFF5E4;font-weight: bold;">Цена</td>
					</tr>
					</thead>';
						$j = 1;
						foreach ($sectionValue['ELEMENTS'] as $elementKey => $elementValue) {
							if ($j <= $firstColumnElementsCount) {
								$j++;
								continue;
							}
							$html .= '
						<tr>
							<td class="first" style="border-bottom: 1px solid #DFF5E4;width: 10px;padding: 0;vertical-align: middle;text-align: left;"><div style="background-color: ' . $arResult['MAKES'][$elementValue['PROPS']['MAKE']['VALUE']]['COLOR'] . '">&nbsp;</div></td>
							<td style="width: 25px;padding: 7px 0;vertical-align: middle;border-bottom: 1px solid #DFF5E4;"><a href="https://tooldirect.ru' . $elementValue['FIELDS']['DETAIL_PAGE_URL'] . '" target="_blank" style="font-family: montserrat,sans-serif;font-size: 10px;font-weight: normal;line-height: 12px;color: #262626;text-decoration: none;">' . $elementValue['PROPS']['ARTICLE']['VALUE'] . '</a></td>
						';
							foreach ($sectionParams[$sectionValue["IBLOCK_SECTION_ID"]]['params'] as $param) {
								if (!$sectionValue[$param]["PROPS_CNT"]) continue; // если кол-ва непустых значений параметра == 0, не выводим
								$html .= '<td style="width: 25px;padding: 7px 0;vertical-align: middle;border-bottom: 1px solid #DFF5E4;">';
								if (!empty($elementValue['PROPS'][$param]['VALUE'])) {
									if (is_array($elementValue['PROPS'][$param]['VALUE'])) {
										$html .=  str_replace('/', ' / ', implode(', ', $elementValue['PROPS'][$param]['VALUE']));
									} else {
										$elementValue['PROPS'][$param]['VALUE'] = str_replace('/', ' / ', $elementValue['PROPS'][$param]['VALUE']);
										$html .= $elementValue['PROPS'][$param]['VALUE'];
									}
								} else {
									$html .= '-';
								}
								$html .= '</td>';
							}
							$html .= '
							<td style="width: 25px;padding: 7px 0;vertical-align: middle;border-bottom: 1px solid #DFF5E4;"><span class="price" style="color: #00AC25;">' . number_format($elementValue['PRICE'], 0, '.', '&nbsp;') . '&nbsp;<span>&#8381;</span></span></td>
						</tr>';
						}
					}
					$html .= '</table>';
				}
				
				$html .= '</div><div style="clear: both"></div>';
				//$html .= '</div>';
			break;
			
			case 'extended':
				$html .= '<table class="elements" style="width: 100%;margin: 20px 0 30px;margin-right: 5px;font-size: 10px;">';
				if (!empty($sectionValue['ELEMENTS'])) {
					$html .= '
					<thead>
					<tr class="head">
						<td class="first" style="border-bottom: 1px solid #DFF5E4;width: 10px;padding: 0;vertical-align: middle;text-align: left;"></td>
						<td class="bold" style="padding: 7px 10px 7px 0;vertical-align: middle;border-bottom: 1px solid #DFF5E4;font-weight: bold;">Артикул</td>
					';
					foreach ($sectionParams[$sectionValue["IBLOCK_SECTION_ID"]]['params'] as $param) {
						if (!$sectionValue[$param]["PROPS_CNT"]) continue; // если кол-ва непустых значений параметра == 0, не выводим
						$html .= '<td class="bold" style="padding: 7px 10px 7px 0;vertical-align: middle;border-bottom: 1px solid #DFF5E4;font-weight: bold;" nowrap="nowrap">';
						if (in_array($param, ['CUTTING_TYPE','RH_LH','TEETH_TYPE','RN','LENGTH','WIDTH','HEIGHT'])) {
							$html .= $properties[$param];
						} elseif ($param == $pdfField) {
							$html .= 'Наименование';
						} else {
							$html .= $param;
						}
						$html .= '</td>';
					}
					$html .= '
						<td style="border-bottom: 1px solid #DFF5E4;"></td>
					</tr>
					</thead>';
					foreach ($sectionValue['ELEMENTS'] as $elementKey => $elementValue) {
						$youtubeVideoIds = explode(',', $elementValue['PROPS']['YOUTUBE_VIDEO_ID']['VALUE']);
						$videoId = $youtubeVideoIds[0];
						if (!empty($elementValue['PROPS']['YOUTUBE_VIDEO_ID']['VALUE']) && !file_exists($_SERVER['DOCUMENT_ROOT'] . '/upload/qrcode/qrcode-' . $elementValue['FIELDS']['ID'] . '.png')) {
							QRcode::png(YOUTUBE_VIDEO_PATH . $videoId, $_SERVER['DOCUMENT_ROOT'] . '/upload/qrcode/catalog/qrcode-' . $elementValue['FIELDS']['ID'] . '.png', "H", 2, 3);
						}
						
						$html .= '
						<tr>
							<td class="first" style="border-bottom: 1px solid #DFF5E4;width: 10px;padding: 0;vertical-align: middle;text-align: left;"><div style="background-color: ' . $arResult['MAKES'][$elementValue['PROPS']['MAKE']['VALUE']]['COLOR'] . '">&nbsp;</div></td>
							<td style="padding: 7px 10px 7px 0;vertical-align: middle;border-bottom: 1px solid #DFF5E4;">
								<a href="https://tooldirect.ru' . $elementValue['FIELDS']['DETAIL_PAGE_URL'] . '" target="_blank" style="font-family: montserrat,sans-serif;font-size: 10px;font-weight: normal;line-height: 12px;color: #262626;text-decoration: none;">' . $elementValue['PROPS']['ARTICLE']['VALUE'] . '
								</a>
								<br>
								<span class="price" style="color: #00AC25;">' . number_format($elementValue['PRICE'], 0, '.', '&nbsp;') . '&nbsp;<span>&#8381;</span></span>
						</td>
						';
						foreach ($sectionParams[$sectionValue["IBLOCK_SECTION_ID"]]['params'] as $param) {
							if (!$sectionValue[$param]["PROPS_CNT"]) continue; // если кол-ва непустых значений параметра == 0, не выводим
							$html .= '<td style="padding: 7px 10px 7px 0;vertical-align: middle;border-bottom: 1px solid #DFF5E4;">';
							if (!empty($elementValue['PROPS'][$param]['VALUE'])) {
								if (is_array($elementValue['PROPS'][$param]['VALUE'])) {
									$html .=  str_replace('/', ' / ', implode(', ', $elementValue['PROPS'][$param]['VALUE']));
								} else {
									$elementValue['PROPS'][$param]['VALUE'] = str_replace('/', ' / ', $elementValue['PROPS'][$param]['VALUE']);
									$html .= $elementValue['PROPS'][$param]['VALUE'];
								}
							} else {
								$html .= '-';
							}
							$html .= '</td>';
						}
						$html .= '<td nowrap="nowrap" style="vertical-align: middle;border-bottom: 1px solid #DFF5E4;text-align: right;padding-right: 0;">';
						if (!empty($elementValue['PROPS']['MORE_PHOTO']['VALUE'])) {
							$photoCount = count($elementValue['PROPS']['MORE_PHOTO']['VALUE']);
							$photoIndex1 = round($photoCount / 2) - 1;
							$photoIndex2 = $photoIndex1 + 1;
							$photoIndex3 = $photoIndex1 - 1;
							$photoIndexes = [0];
							if (!in_array($photoIndex1, $photoIndexes)) {
								$photoIndexes[] = $photoIndex1;
							}
							if (!in_array($photoIndex2, $photoIndexes)) {
								$photoIndexes[] = $photoIndex2;
							}
							if (count($photoIndexes) < 3 && !in_array($photoIndex3, $photoIndexes)) {
								$photoIndexes[] = $photoIndex3;
							}
							$photoIndexes[] = $photoCount - 1;
							
							$photoIndexesCount = count($photoIndexes);
							$j = 1;
							//$html .= json_encode($elementValue['PROPS']['MORE_PHOTO']['VALUE']).'<br>'.json_encode($photoIndexes);
							foreach ($elementValue['PROPS']['MORE_PHOTO']['VALUE'] as $k => $v) {
								if (!in_array($k, $photoIndexes)) continue;
								
								/*if ($j == 1) {
									$margin = 'margin: 0;';
								} else {*/
									//$margin = 'margin: 0 2px 0 2px;';
								/*}*/
								$resizeFile = CFile::ResizeImageGet($v, ['width' => 56, 'height' => '56'], BX_RESIZE_IMAGE_EXACT, true, arWaterMark);
								$html .= '<img src="'.$resizeFile['src'].'" width="'.$resizeFile['width'].'" height="'.$resizeFile['height'].'" style="margin: 0 2px 0 2px;">';
								$j++;
								if ($j == 5) break;
							}
						}
						if ($videoId) {
							$html .= '<img src="/upload/qrcode/catalog/qrcode-' . $elementValue['FIELDS']['ID'] . '.png" style="style="width: 56px;height: 56px;margin: 0 2px 0 2px;"">';
						}
						$html .= '</td>';
						$html .= '</tr>chunk';
					}
				}
				$html .= '</table>';
			break;
		}
		
		$i++;
	}
}

$html .= '</page>';
$html .= '</body>
</html>
';

$footer = '
	<table class="footer" style="border-spacing: 0;border-collapse: collapse;border: 0;width: 100%;background-color: #DFF5E4;">
		<tr>
			<td style="vertical-align: top;width: 15%;padding: 7px 10px;font-size: 9px;" nowrap="nowrap">
				tooldirect.ru
			</td>
			<td style="vertical-align: top;width: 15%;padding: 7px 10px;font-size: 9px;" nowrap="nowrap">
				zakaz@tooldirect.ru
			</td>
			<td style="vertical-align: top;width: 15%;padding: 7px 10px;font-size: 9px;" nowrap="nowrap">
				+7 (495) 984-41-55
			</td>
			<td style="vertical-align: top;width: 15%;padding: 7px 10px;font-size: 9px;" nowrap="nowrap">
				г. Москва, Иркутская ул. д11 к2
			</td>
			<td style="vertical-align: top;width: 40%;text-align: right;padding: 7px 10px;font-size: 9px;">
				{PAGENO} / {nb}
			</td>
		</tr>
	</table>
';

// create a log channel
//$logger = new Logger('name');
//$logger->pushHandler(new StreamHandler($_SERVER['DOCUMENT_ROOT'] . '/local/tools/mpdf.log', Logger::DEBUG));

$defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
$fontDirs = $defaultConfig['fontDir'];

$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
$fontData = $defaultFontConfig['fontdata'];

$mpdf = new \Mpdf\Mpdf([
	'fontDir' => array_merge($fontDirs, [
		$_SERVER['DOCUMENT_ROOT'] . '/local/templates/tooldirect_copy/fonts',
	]),
	'fontdata' => [
		'montserrat' => $fontData + [
				'R' => 'Montserrat-Regular.ttf',
				'B' => 'Montserrat-Bold.ttf',
			]
	],
	'default_font' => 'montserrat',
	'margin_left' => 10,
	'margin_right' => 10,
	'margin-top' => 0,
	'margin-bottom' => 0,
	'margin_header' => 0,
	'margin_footer' => 5,
	'mode' => 'utf-8',
	'format' => 'A4',
]);
$mpdf->SetDisplayMode('fullpage');
$mpdf->SetTitle('PDF-Catalog');
$mpdf->SetAuthor('Tooldirect');
$mpdf->keepColumns = true;
$mpdf->shrink_tables_to_fit = 1;
$mpdf->use_kwt = true;
$mpdf->setAutoTopMargin = 'stretch';
$mpdf->setAutoBottomMargin = 'stretch';
//$mpdf->simpleTables = true;
//$mpdf->packTableData = true;
//$mpdf->setLogger($logger);

$mpdf->setHTMLFooter($footer);

$chunks = explode("chunk", $html);
foreach($chunks as $key => $val) {
	$mpdf->WriteHTML($val, 2);
}
//$mpdf->WriteHTML($html, 2);
$mpdf->Output('Tooldirect PDF-Catalog.pdf', 'I');
?>

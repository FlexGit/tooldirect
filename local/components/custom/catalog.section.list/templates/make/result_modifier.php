<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arViewModeList = array('LIST', 'LINE', 'TEXT', 'TILE');

$arDefaultParams = array(
	'VIEW_MODE' => 'LIST',
	'SHOW_PARENT_NAME' => 'Y',
	'HIDE_SECTION_NAME' => 'N'
);

$arParams = array_merge($arDefaultParams, $arParams);

if (!in_array($arParams['VIEW_MODE'], $arViewModeList))
	$arParams['VIEW_MODE'] = 'LIST';
if ('N' != $arParams['SHOW_PARENT_NAME'])
	$arParams['SHOW_PARENT_NAME'] = 'Y';
if ('Y' != $arParams['HIDE_SECTION_NAME'])
	$arParams['HIDE_SECTION_NAME'] = 'N';

$arResult['VIEW_MODE_LIST'] = $arViewModeList;

/*if (0 < $arResult['SECTIONS_COUNT'])
{
	if ('LIST' != $arParams['VIEW_MODE'])
	{
		$boolClear = false;
		$arNewSections = array();
		foreach ($arResult['SECTIONS'] as &$arOneSection)
		{
			if (1 < $arOneSection['RELATIVE_DEPTH_LEVEL'])
			{
				$boolClear = true;
				continue;
			}
			$arNewSections[] = $arOneSection;
		}
		unset($arOneSection);
		if ($boolClear)
		{
			$arResult['SECTIONS'] = $arNewSections;
			$arResult['SECTIONS_COUNT'] = count($arNewSections);
		}
		unset($arNewSections);
	}
}*/

//echo '<pre>';print_r($arResult["SECTIONS"]);echo '</pre>';
//echo $arResult['SECTIONS_COUNT'];

if (0 < $arResult['SECTIONS_COUNT'])
{
	/*$boolPicture = false;
	$boolDescr = false;*/
	$arSelect = array('ID');
	$arMap = array();
	/*if ('LINE' == $arParams['VIEW_MODE'] || 'TILE' == $arParams['VIEW_MODE'])
	{
		reset($arResult['SECTIONS']);
		$arCurrent = current($arResult['SECTIONS']);
		if (!isset($arCurrent['PICTURE']))
		{
			$boolPicture = true;
			$arSelect[] = 'PICTURE';
		}
		if ('LINE' == $arParams['VIEW_MODE'] && !array_key_exists('DESCRIPTION', $arCurrent))
		{
			$boolDescr = true;
			$arSelect[] = 'DESCRIPTION';
			$arSelect[] = 'DESCRIPTION_TYPE';
		}
	}*/
	/*if ($boolPicture || $boolDescr)
	{*/
	/*global $USER;
	if ($USER->GetID() == 1) {
		echo '<pre>';
		print_r($arResult['SECTIONS']);
		echo '</pre>';
	}*/
	
		foreach ($arResult['SECTIONS'] as $k_section => $v_section) {
			foreach ($v_section as $key => $arSection) {
				$arMap[$arSection['ID']] = $key;
			}
			//echo '<pre>';print_r($arMap);echo '</pre>';
			$rsSections = CIBlockSection::GetList(array(), array('ID' => array_keys($arMap)), false, $arSelect);
			while ($arSection = $rsSections->GetNext())
			{
				if (!isset($arMap[$arSection['ID']]))
					continue;
				$key = $arMap[$arSection['ID']];
				/*if ($boolPicture)
				{*/
					$arSection['PICTURE'] = intval($arSection['PICTURE']);
					$arSection['PICTURE'] = (0 < $arSection['PICTURE'] ? CFile::GetFileArray($arSection['PICTURE']) : false);
					$arResult['SECTIONS'][$k_section][$key]['PICTURE'] = $arSection['PICTURE'];
					$arResult['SECTIONS'][$k_section][$key]['~PICTURE'] = $arSection['~PICTURE'];
				/*}
				if ($boolDescr)
				{
					$arResult['SECTIONS'][$key]['DESCRIPTION'] = $arSection['DESCRIPTION'];
					$arResult['SECTIONS'][$key]['~DESCRIPTION'] = $arSection['~DESCRIPTION'];
					$arResult['SECTIONS'][$key]['DESCRIPTION_TYPE'] = $arSection['DESCRIPTION_TYPE'];
					$arResult['SECTIONS'][$key]['~DESCRIPTION_TYPE'] = $arSection['~DESCRIPTION_TYPE'];
				}*/
			}
		}
	/*}*/
	
	/*foreach($arResult['SECTIONS'] as $k => $v){
		$subArr[$k] = $v["ELEMENT_CNT"];
	}
	natsort($subArr);
	$subArrTmp = $arResult['SECTIONS'];
	unset($arResult['SECTIONS']);
	foreach($subArr as $k => $v) {
		$arResult['SECTIONS'][$k] = $subArrTmp[$k];
	}
	$arResult['SECTIONS'] = array_reverse($arResult['SECTIONS']);*/
	
	$dir = $APPLICATION->GetCurDir();
	$dir = explode('/', $dir);
	$subArr = [];
	// сортировка
	foreach($arResult['SECTIONS'] as $k => $v) {
		$sortExists = 0;
		$sortBrandArr = explode(',', $v["UF_SORT_BRAND"]);
		foreach ($sortBrandArr as $sortBrand) {
			$sortArr =	explode(':', $sortBrand);
			//print_r($sortArr);
			//echo strtolower($sortArr[0]).' - '.strtolower($dir[2]).' - '.$sortArr[1].'<br>';
			if (mb_strtolower($sortArr[0]) === mb_strtolower($dir[2])) {
				$subArr[$k] = $sortArr[1];
				$sortExists = 1;
			}
		}
		if (!$sortExists) {
			$subArr[$k] = 100000;
		}
	}
	natsort($subArr);
	//print_r($subArr);
	$subArrTmp = $arResult['SECTIONS'];
	unset($arResult['SECTIONS']);
	foreach($subArr as $k => $v) {
		$arResult['SECTIONS'][$k] = $subArrTmp[$k];
	}
}
?>
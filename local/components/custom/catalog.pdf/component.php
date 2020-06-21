<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

/** @var CBitrixComponent $this */
/** @var array $arParams */
/** @var array $arResult */
/** @var string $componentPath */
/** @var string $componentName */
/** @var string $componentTemplate */
/** @global CDatabase $DB */
/** @global CUser $USER */
/** @global CMain $APPLICATION */


$arResult["THEME_COMPONENT"] = $this->getParent();
if(!is_object($arResult["THEME_COMPONENT"]))
	$arResult["THEME_COMPONENT"] = $this;

if (!isset($arParams['ELEMENT_SORT_FIELD2']))
	$arParams['ELEMENT_SORT_FIELD2'] = '';
if (!isset($arParams['ELEMENT_SORT_ORDER2']))
	$arParams['ELEMENT_SORT_ORDER2'] = '';
if (!isset($arParams['HIDE_NOT_AVAILABLE']))
	$arParams['HIDE_NOT_AVAILABLE'] = '';
if (!isset($arParams['OFFERS_SORT_FIELD2']))
	$arParams['OFFERS_SORT_FIELD2'] = '';
if (!isset($arParams['OFFERS_SORT_ORDER2']))
	$arParams['OFFERS_SORT_ORDER2'] = '';

// Sections
$arFilter = ["IBLOCK_ID" => CATALOG_BLOCK_ID, "ACTIVE" => "Y", "UF_SEO_SECTION" => 0, "UF_USER_SECTION" => 0, "UF_USER_EXT_SECTION" => 0, "DEPTH_LEVEL" => 1];
$arSelect = ["ID", "IBLOCK_ID", "NAME", "UF_*"];
$arOrder = ["SORT" => "ASC"];
$res = CIBlockSection::GetList($arOrder, $arFilter, false, $arSelect);
while ($ob = $res->GetNextElement()) {
	$arFields = $ob->GetFields();
	$arProps = $ob->GetProperties();
	
	$arResult['sections'][$arFields['ID']]['NAME'] = $arFields['NAME'];
}

// Makes
$makes = [];
$arFilter = ["IBLOCK_ID" => MAKE_BLOCK_ID, "ACTIVE" => "Y"];
$arSelect = ["ID", "IBLOCK_ID", "NAME", "DETAIL_PICTURE"];
$arOrder = ["SORT" => "ASC"];
$res = CIBlockElement::GetList($arOrder, $arFilter, false, false, $arSelect);
while ($ob = $res->GetNextElement()) {
	$arFields = $ob->GetFields();
	
	$arResult['makes'][$arFields['ID']]['NAME'] = $arFields['NAME'];
	$arResult['makes'][$arFields['ID']]['DETAIL_PICTURE'] = $arFields['DETAIL_PICTURE'];
}

$this->IncludeComponentTemplate();
?>
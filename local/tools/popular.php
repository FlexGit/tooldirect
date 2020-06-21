<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("iblock");

exit;

$popular = 10000;

$arFilter = ["IBLOCK_ID" => CATALOG_BLOCK_ID];
$arSelect = ["ID", "NAME", "IBLOCK_ID", "PROPERTY_POPULAR"];
$res = CIBlockElement::GetList([], $arFilter, false, false, $arSelect);
while ($ob = $res->GetNextElement()) {
	$arFields = $ob->GetFields();
	//print_r($arFields);
	CIBlockElement::SetPropertyValueCode($arFields['ID'], "POPULAR", $popular);
}

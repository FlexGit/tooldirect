<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("iblock");

$days = 90;
$date = date("Y-m-d H:i:s", mktime(0,0,0, date("m"), date("d") - $days, date("Y")));
//echo $date;

$arFilter = ["IBLOCK_ID" => CATALOG_BLOCK_ID, "PROPERTY_NEW" => "Y", "<=PROPERTY_NEW_DATE" => $date];
$arSelect = ["ID", "NAME", "IBLOCK_ID", "PROPERTY_NEW", "PROPERTY_NEW_DATE"];
$res = CIBlockElement::GetList([], $arFilter, false, false, $arSelect);
while ($ob = $res->GetNextElement()) {
	$arFields = $ob->GetFields();
	//print_r($arFields);
	CIBlockElement::SetPropertyValueCode($arFields['ID'], "NEW", "N");
	CIBlockElement::SetPropertyValueCode($arFields['ID'], "NEW_DATE", "");
}

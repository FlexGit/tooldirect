<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("iblock");
CModule::IncludeModule("catalog");

$arSelect = Array("ID", "IBLOCK_ID", "NAME", "PROPERTY_ARTICLE");
$arFilter = Array("IBLOCK_TYPE" => "catalog", "IBLOCK_ID" => 4, "PROPERTY_MAKE" => false);
$arOrder = Array("SORT" => "ASC");
$res = CIBlockElement::GetList($arOrder, $arFilter, false, Array(), $arSelect);
$sliderNum = 0;
$data = array();
while($ob = $res->GetNextElement())
{
	$arFields = $ob->GetFields();

	echo $arFields["PROPERTY_ARTICLE_VALUE"].'<br>';
};


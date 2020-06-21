<?php
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');
CModule::IncludeModule("iblock");
CModule::IncludeModule("catalog");
CModule::IncludeModule('main');

$xml = '<?xml version="1.0" encoding="UTF-8"?>';
$xml .= '
<rss xmlns:g="http://base.google.com/ns/1.0" version="2.0">
	<channel>
		<title>Tooldirect</title>
		<link>https://'.$_SERVER[HTTP_HOST].'</link>
		<description>Тулдирект – надёжный поставщик широкого спектра профессионального инструмента для обработки древесины и деревосодержащих материалов (ДСП, МДФ, OSB), алюминия, композитов и пластиков, а так же большого количества инструмента и приспособлений для DIY.</description>
';

$arFilter = ["IBLOCK_ID" => CATALOG_BLOCK_ID, "ACTIVE" => "Y"];
$arSelect = ["ID", "IBLOCK_ID", "NAME", "DETAIL_PAGE_URL", "DETAIL_PICTURE", "PROPERTY_*"];
$res = CIBlockElement::GetList([], $arFilter, false, false, $arSelect);
while($ob = $res->GetNextElement()) {
	$arFields = $ob->GetFields();
	$arProps = $ob->GetProperties();
	$title = $arProps["NAME_PDF"]["VALUE"];
	
	$arFields["DETAIL_PICTURE"] = CFile::GetFileArray($arFields["DETAIL_PICTURE"]);
	
	$make = '';
	$resMake = CIBlockElement::GetByID($arProps["MAKE"]["VALUE"]);
	if($arMake = $resMake->GetNext()) {
		$make = $arMake["NAME"];
	}
	
	if (empty($title))
		$title = $arFields["NAME"];
	
	$title = htmlentities($title, null, 'UTF-8');
	$title = str_replace("&nbsp;", " ", $title);
	$title = str_replace("&amp;", "", $title);
	$title = str_replace("&quot;", "\"", $title);
	$title = str_replace("&laquo;", "", $title);
	$title = str_replace("&raquo;", "", $title);
	$title = str_replace("&alpha;", "α", $title);
	$title = str_replace("&deg;", "°", $title);
	$title = str_replace("&ordm;", "°", $title);
	$title = str_replace("amp;", "", $title);
	$title = str_replace("quot;", "\"", $title);
	$title = str_replace("laquo;", "", $title);
	$title = str_replace("raquo;", "", $title);
	$title = str_replace("alpha;", "α", $title);
	$title = str_replace("deg;", "°", $title);
	$title = str_replace("ordm;", "°", $title);
	
	$title = mb_substr($title, 0,150);
	
	$arFields["NAME"] = htmlentities($arFields["NAME"], null, 'UTF-8');
	$arFields["NAME"] = str_replace("&nbsp;", " ", $arFields["NAME"]);
	$arFields["NAME"] = str_replace("&amp;", "", $arFields["NAME"]);
	$arFields["NAME"] = str_replace("&quot;", "\"", $arFields["NAME"]);
	$arFields["NAME"] = str_replace("&laquo;", "", $arFields["NAME"]);
	$arFields["NAME"] = str_replace("&raquo;", "", $arFields["NAME"]);
	$arFields["NAME"] = str_replace("&alpha;", "α", $arFields["NAME"]);
	$arFields["NAME"] = str_replace("&deg;", "°", $arFields["NAME"]);
	$arFields["NAME"] = str_replace("&ordm;", "°", $arFields["NAME"]);
	$arFields["NAME"] = str_replace("amp;", "", $arFields["NAME"]);
	$arFields["NAME"] = str_replace("quot;", "\"", $arFields["NAME"]);
	$arFields["NAME"] = str_replace("laquo;", "", $arFields["NAME"]);
	$arFields["NAME"] = str_replace("raquo;", "", $arFields["NAME"]);
	$arFields["NAME"] = str_replace("alpha;", "α", $arFields["NAME"]);
	$arFields["NAME"] = str_replace("deg;", "°", $arFields["NAME"]);
	$arFields["NAME"] = str_replace("ordm;", "°", $arFields["NAME"]);
	
	$resProduct = CCatalogProduct::GetByID($arFields['ID']);
	$avail = 'in stock';
	if ($resProduct['QUANTITY'] <= 0)
		$avail = 'preorder';
	$price = 0;
	$resPrice = CPrice::GetList([], ["PRODUCT_ID" => $arFields['ID'], "CATALOG_GROUP_ID" => 1]);
	if ($arrPrice = $resPrice->Fetch()) {
		$price = $arrPrice['PRICE'];
	}
	if ($price == 0) continue;
	$price = number_format($price, 2, '.', '');
	
	$xml .= '
		<item>
			<g:id>'.$arFields["ID"].'</g:id>
			<g:title>'.$title.'</g:title>
			<g:description>'.$arFields["NAME"].'</g:description>
			<g:availability>'.$avail.'</g:availability>
			<g:condition>new</g:condition>
			<g:price>'.$price.' RUB</g:price>
			<g:link>https://'.$_SERVER[HTTP_HOST] . $arFields["DETAIL_PAGE_URL"].'</g:link>
			<g:image_link>https://'.$_SERVER[HTTP_HOST] . $arFields["DETAIL_PICTURE"]["SRC"].'</g:image_link>
			<g:brand>'.$make.'</g:brand>
			<g:google_product_category>3650</g:google_product_category>
		</item>
	';
}
$xml .= '
	</channel>
</rss>';
header('Content-type: text/xml');
header('Content-Disposition: attachment; filename="fb_feed_'.date("Ymd_His").'.xml"');
echo $xml;

<?php
/**
 * Добавление товара в корзину для турбо режима яндекса
 */
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

$productID = intval($_GET["id"]);

if($productID <= 0) {
	header("Location: /");
	die();
}

CModule::IncludeModule("sale");
CModule::IncludeModule("catalog");

$items = [];
$num = $sum = $discount = $weight = $makeId = 0;
$article = $make = '';

$rsElem = CIBlockElement::GetById($productID);
if ($arElem = $rsElem->GetNextElement()) {
	$arProps = $arElem->GetProperties();
	$article = $arProps['ARTICLE']['VALUE'];
	$makeId = $arProps['MAKE']['VALUE'];
} else {
	header("Location: /");
	die();
}

if (intval($makeId) > 0) {
	$rsElem = CIBlockElement::GetById($makeId);
	if ($arElem = $rsElem->GetNextElement()) {
		$arFields = $arElem->GetFields();
		$make = $arFields['NAME'];
	}
}

$props = [
	['NAME' => 'Артикул', 'CODE' => 'ARTICLE', 'VALUE' => $article],
	['NAME' => 'Производитель', 'CODE' => 'MAKE', 'VALUE' => $make],
];
Add2BasketByProductID($productID, 1, [], $props);
		
$res = CSaleBasket::GetList([],	["FUSER_ID" => CSaleBasket::GetBasketUserID(), "LID" => SITE_ID, "ORDER_ID" => "NULL"],false,false, ["ID", "PRODUCT_ID", "QUANTITY", "PRICE", "DISCOUNT_PRICE", "WEIGHT"]);
while ($rows = $res->Fetch()) {
	$rows = CSaleBasket::GetByID($rows["ID"]);
	$sum += $rows['DISCOUNT_PRICE'] * $rows['QUANTITY'];
	$weight += $rows["WEIGHT"] * $rows["QUANTITY"];
	$items[] = $rows;
}

//echo '<pre>';print_r($items);echo '</pre>';
//exit;

$arOrder = [
	'SITE_ID' => SITE_ID,
	'USER_ID' => $GLOBALS["USER"]->GetID(),
	'ORDER_PRICE' => $sum,
	'ORDER_WEIGHT' => $weight,
	'BASKET_ITEMS' => $items
];
		
$arOptions = [
	'COUNT_DISCOUNT_4_ALL_QUANTITY' => 'Y',
];

$arErrors = [];
CSaleDiscount::DoProcessOrder($arOrder, $arOptions, $arErrors);

header("Location: /personal/cart/");
die();

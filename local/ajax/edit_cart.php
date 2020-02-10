<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("sale");
CModule::IncludeModule("catalog");

$success = false;
$items = [];
$num = $sum = $discount = $weight = 0;

if (!empty($_POST['product_id']) && !empty($_POST['quantity'])) {
	$productID = intval(htmlspecialchars($_POST["product_id"]));
	$quantity = intval(htmlspecialchars($_POST["quantity"]));
	if (!$quantity) $quantity = 1;
	$article = htmlspecialchars($_POST["article"]);
	$make = htmlspecialchars($_POST["make"]);

	if (IntVal($productID) > 0) {
		$a = CSaleBasket::GetList(
			array(),
			array("FUSER_ID" => CSaleBasket::GetBasketUserID(), "LID" => SITE_ID, "ORDER_ID" => "NULL", "PRODUCT_ID" => $productID),
			false,
			false,
			array("ID")
		);
		if (count($a->arResult)) {
			$basketProductID = $a->arResult[0]["ID"];
			CSaleBasket::Update($basketProductID, ["QUANTITY" => $quantity]);
		}
		
		$success = true;
		
		$res = CSaleBasket::GetList(
			array(),
			array("FUSER_ID" => CSaleBasket::GetBasketUserID(), "LID" => SITE_ID, "ORDER_ID" => "NULL"),
			false,
			false,
			array("ID", "PRODUCT_ID", "QUANTITY", "PRICE", "DISCOUNT_PRICE", "WEIGHT"));
		while ($rows = $res->Fetch()) {
			$rows = CSaleBasket::GetByID($rows["ID"]);
			$sum += $rows['DISCOUNT_PRICE'] * $rows['QUANTITY'];
			$weight += $rows["WEIGHT"] * $rows["QUANTITY"];
			$items[] = $rows;
		}
		
		$arOrder = array(
			'SITE_ID' => SITE_ID,
			'USER_ID' => $GLOBALS["USER"]->GetID(),
			'ORDER_PRICE' => $sum,
			'ORDER_WEIGHT' => $weight,
			'BASKET_ITEMS' => $items
		);
		
		$arOptions = array(
			'COUNT_DISCOUNT_4_ALL_QUANTITY' => 'Y',
		);
		
		$arErrors = array();
		
		CSaleDiscount::DoProcessOrder($arOrder, $arOptions, $arErrors);
		foreach ($arOrder["BASKET_ITEMS"] as $arItem) {
			$num++;
			$sum += $arItem["PRICE"] * $arItem["QUANTITY"];
			$discount += $arItem["DISCOUNT_PRICE"] * $arItem["QUANTITY"];
		}
	}
}
//echo $success;
echo json_encode([
	'success' => $success,
	'num' => $num,
	'sum' => number_format($sum, 2, '.', ' ') . ' руб.',
	'discount' => number_format($discount, 2, '.', ' ')
]);

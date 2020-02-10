<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("sale");
CModule::IncludeModule("catalog");

if (!empty($_POST['product_id']) && !empty($_POST['quantity'])) {
	$productID = intval(htmlspecialchars($_POST["product_id"]));
	$quantity = intval(htmlspecialchars($_POST["quantity"]));
	if (!$quantity) $quantity = 0;
	
	$arID = [];
	$arBasketItems = [];
	$dbBasketItems = CSaleBasket::GetList(
		[
			"NAME" => "ASC",
			"ID" => "ASC"
		],
		[
			"FUSER_ID" => CSaleBasket::GetBasketUserID(),
			"LID" => SITE_ID,
			"ORDER_ID" => "NULL"
		],
		false,
		false,
		["ID", "CALLBACK_FUNC", "MODULE", "PRODUCT_ID", "QUANTITY", "PRODUCT_PROVIDER_CLASS"]
	);
	while ($arItems = $dbBasketItems->Fetch()) {
		if ($arItems['PRODUCT_PROVIDER_CLASS'] != '' || $arItems["CALLBACK_FUNC"] != '') {
			CSaleBasket::UpdatePrice($arItems["ID"],
				$arItems["CALLBACK_FUNC"],
				$arItems["MODULE"],
				$arItems["PRODUCT_ID"],
				$arItems["QUANTITY"],
				"N",
				$arItems["PRODUCT_PROVIDER_CLASS"]
			);
			$arID[] = $arItems["ID"];
		}
	}
	if (!empty($arID)) {
		$dbBasketItems = CSaleBasket::GetList(
			[
				"NAME" => "ASC",
				"ID" => "ASC"
			],
			[
				"ID" => $arID,
				"ORDER_ID" => "NULL"
			],
			false,
			false,
			["ID", "CALLBACK_FUNC", "MODULE", "PRODUCT_ID", "QUANTITY", "DELAY", "CAN_BUY", "PRICE", "WEIGHT", "PRODUCT_PROVIDER_CLASS", "NAME"]
		);
		while ($arItems = $dbBasketItems->Fetch()) {
			$arBasketItems[] = $arItems;
		}
	}
	// Печатаем массив, содержащий актуальную на текущий момент корзину
	/*echo "<pre>";
	print_r($arBasketItems);
	echo "</pre>";*/
	
	echo json_encode([
		'success' => true,
		'pos' => $arBasketItems,
	]);
	
}
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

global $USER, $APPLICATION;
use Bitrix\Main,
	Bitrix\Main\Loader,
	Bitrix\Main\Config\Option,
	Bitrix\Sale,
	Sale\Fuser,
	Bitrix\Sale\Order,
	Bitrix\Main\Application,
	Bitrix\Sale\DiscountCouponsManager,
	Bitrix\Currency\CurrencyManager,
	Bitrix\Main\Context,
	Bitrix\Sale\Basket,
	Bitrix\Sale\Delivery\Services\Manager as DeliveryManager,
	Bitrix\Sale\PaySystem\Manager as PaySystemManager;

if (!Loader::IncludeModule('sale') || !Loader::IncludeModule('catalog'))
	die();

$siteId = \Bitrix\Main\Context::getCurrent()->getSite();
$currencyCode = Option::get('sale', 'default_currency', 'RUB');

//print_r($_POST);

$deliveryArr = [
	'2' => 'Доставка курьером',
	'3' => 'Самовывоз',
];

$payArr = [
	'1' => 'Наличные курьеру',
	'7' => 'Сбербанк',
	'8' => 'Банковский перевод',
	'9' => 'Внутренний счет',
];

$propArr = [
	'1' => [
		'name' => 1,
		'email' => 2,
		'phone' => 3,
		'address' => 7,
	],
	'2' => [
		'name' => 12,
		'email' => 13,
		'phone' => 14,
		'address' => 19,
		'company' => 8,
	]
];

$userId = 12; //$USER->GetID();
$email = trim(strip_tags(htmlspecialchars($_POST['email'])));
$phone = trim(strip_tags(htmlspecialchars($_POST['phone'])));
$name = trim(strip_tags(htmlspecialchars($_POST['name'])));
$address = trim(strip_tags(htmlspecialchars($_POST['address'])));
$pay = intVal($_POST['pay']);
$delivery = intVal($_POST['delivery']);
$jur_type = intVal($_POST['jur_type']);
$company = trim(strip_tags(htmlspecialchars($_POST['company'])));
//$comment = trim(strip_tags(htmlspecialchars($_POST['comment'])));
if (!$jur_type) {
	$jur_type = 1;
	$company = '';
}
//echo $email .' - '. $phone .' - '. $name .' - '. $pay .' - '. $delivery;
$error = 1;
if ($email && $phone && $name && $pay && $delivery) {
	//$basket = Sale\Basket::loadItemsForFUser(Sale\Fuser::getId(), $siteId);
	
	$order = Order::create($siteId, $userId);
	$order->setPersonTypeId($jur_type);
	$basket = Sale\Basket::loadItemsForFUser(\CSaleBasket::GetBasketUserID(), $siteId)->getOrderableItems();
	$order->setBasket($basket);
	
	/*Shipment*/
	$shipmentCollection = $order->getShipmentCollection();
	$shipment = $shipmentCollection->createItem();
	$shipment->setFields([
		'DELIVERY_ID' => $delivery,
		'DELIVERY_NAME' => $deliveryArr[$delivery],
		'CURRENCY' => $order->getCurrency()
	]);
	$shipmentItemCollection = $shipment->getShipmentItemCollection();
	foreach ($order->getBasket() as $item) {
		$shipmentItem = $shipmentItemCollection->createItem($item);
		$shipmentItem->setQuantity($item->getQuantity());
	}
	
	/*Payment*/
	$paymentCollection = $order->getPaymentCollection();
	$extPayment = $paymentCollection->createItem();
	$extPayment->setFields([
		'PAY_SYSTEM_ID' => $pay,
		'PAY_SYSTEM_NAME' => $payArr[$pay],
		'SUM' => $order->getPrice()
	]);
	
	/**/
	$order->doFinalAction(true);
	$propertyCollection = $order->getPropertyCollection();
	$propertyValue = $propertyCollection->getItemByOrderPropertyId($propArr[$jur_type]['name']);
	$propertyValue->setField('VALUE', $name);
	$propertyValue = $propertyCollection->getItemByOrderPropertyId($propArr[$jur_type]['email']);
	$propertyValue->setField('VALUE', $email);
	$propertyValue = $propertyCollection->getItemByOrderPropertyId($propArr[$jur_type]['phone']);
	$propertyValue->setField('VALUE', $phone);
	$propertyValue = $propertyCollection->getItemByOrderPropertyId($propArr[$jur_type]['address']);
	$propertyValue->setField('VALUE', $address);
	if ($jur_type == 2) {
		$propertyValue = $propertyCollection->getItemByOrderPropertyId($propArr[$jur_type]['company']);
		$propertyValue->setField('VALUE', $company);
	}
	
	$order->setField('CURRENCY', $currencyCode);
	//$order->setField('COMMENTS', 'Заказ в 1 клик: ' . $comment);
	
	//print_r($order);
	$order->save();
	$orderId = $order->GetId();
	
	if ($orderId > 0) {
		$error = 0;
		
		$strOrderList = "";
		$dbBasketItems = CSaleBasket::GetList(
			array("NAME" => "ASC"),
			array("ORDER_ID" => $orderId),
			false,
			false,
			array("ID", "NAME", "QUANTITY", "PRICE", "CURRENCY")
		);
		while ($arBasketItems = $dbBasketItems->Fetch()) {
			$strOrderList .= $arBasketItems["NAME"]." - ".$arBasketItems["QUANTITY"]." ".GetMessage("SOA_SHT").": ".SaleFormatCurrency($arBasketItems["PRICE"], $arBasketItems["CURRENCY"]);
			$strOrderList .= "\n";
		}
		
		/*$arEventFields = array(
			"ORDER_ID" => $orderId,
			"PHONE" => $phone,
			"EMAIL" => $email,
			"NAME" => $name,
			"ADDRESS" => $address,
			//"COMMENT" => $comment,
			"ORDER_LIST" => $strOrderList,
			"PRICE" => $order->getPrice(),
		);
		if ($jur_type == 2) {
			$arEventFields['COMPANY'] = $company;
		}
		CEvent::SendImmediate("ORDER", SITE_ID, $arEventFields);
		CEvent::SendImmediate("USER_ORDER", SITE_ID, $arEventFields);*/
		
		$arEventFields = array(
			"ORDER_ID" => $orderId,
			"ORDER_USER" => $name,
			"ORDER_DATE" => date("d.m.Y H:i:s"),
			"ORDER_LIST" => $strOrderList,
			"PRICE" => SaleFormatCurrency($order->getPrice(), $order->getCurrency()),
			"SALE_EMAIL" => COption::GetOptionString("sale", "order_email"),
			"PHONE" => $phone,
			"EMAIL" => $email,
			"ADDRESS" => $address,
			"DELIVERY_SYSTEM" => $deliveryArr[$delivery],
			"PAY_SYSTEM" => $payArr[$pay],
			//"DELIVERY_PRICE" => '',
			//"COMMENT" => $comment,
		);
		if ($jur_type == 2) {
			$arEventFields['COMPANY'] = $company;
		}
		CEvent::Send("USER_ORDER", SITE_ID, $arEventFields, "N", 54);
		CEvent::Send("ORDER", SITE_ID, $arEventFields, "N", 52);
		CEvent::CheckEvents();
	}
}

$result = [];
if ($error) {
	$result = [
		'success' => false,
		'msg' => 'Ошибка оформления!'
	];
} else {
	$result = [
		'success' => true,
		'msg' => 'Ваш заказ № '.$orderId.' успешно оформлен! Мы свяжемся с Вами в ближайшее время.'
	];
}
echo json_encode($result);


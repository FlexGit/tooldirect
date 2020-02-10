<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

global $USER, $APPLICATION;
use Bitrix\Main,
	Bitrix\Main\Loader,
	Bitrix\Main\Config\Option,
	Bitrix\Sale,
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

//$request = Application::getInstance()->getContext()->getRequest();
$siteId = \Bitrix\Main\Context::getCurrent()->getSite();
$currencyCode = Option::get('sale', 'default_currency', 'RUB');

//DiscountCouponsManager::init();

//print_r($_POST);

$userId = 12; //$USER->GetID();
$productId = intVal($_POST['product_id']);
$quantity = intVal($_POST['quantity']);
if (!$quantity) $quantity = 1;
$email = $_POST['email'];
$phone = $_POST['phone'];
$name = $_POST['name'];
$priceArr = CCatalogProduct::GetOptimalPrice($productId, CUser::GetUserGroupArray());
$price = $priceArr['DISCOUNT_PRICE'];
$comment = $_POST['comment'];

$error = 1;
if ($productId && $email && $phone) {
	
	$elementsIterator = CIBlockElement::GetList([], ['ID' => $productId, 'IBLOCK_ID' => CATALOG_BLOCK_ID],false,false, ['ID','NAME','DETAIL_PAGE_URL']);
	if (($element = $elementsIterator->GetNext(false, false))) {
		$product = $element['NAME'];
		$url = $element['DETAIL_PAGE_URL'];
	}
	
	$basket = Sale\Basket::create($siteId);
	$item = $basket->createItem('catalog', $productId);
	$item->setFields([
		'QUANTITY' => $quantity,
		'CURRENCY' => \Bitrix\Currency\CurrencyManager::getBaseCurrency(),
		'LID' => $siteId,
		'PRODUCT_PROVIDER_CLASS' => 'CCatalogProductProvider',
		/*'PRICE' => $price,
		'NAME' => $productInfo['NAME'] ?: '',
		'DETAIL_PAGE_URL' => $productInfo['DETAIL_PAGE_URL'] ?: '',*/
	]);
	
	/*$basket = Sale\Basket::loadItemsForFUser(Sale\Fuser::getId(), Bitrix\Main\Context::getCurrent()->getSite());
	if ($item = $basket->getExistsItem('catalog', $productId)) {
		$item->setField('QUANTITY', $item->getQuantity() + $quantity);
	} else {
		$item = $basket->createItem('catalog', $request['product_id']);
		$item->setFields(array(
			'QUANTITY' => $quantity,
			'CURRENCY' => \Bitrix\Currency\CurrencyManager::getBaseCurrency(),
			'LID' => $siteId,
			'PRODUCT_PROVIDER_CLASS' => 'CCatalogProductProvider',
		));
	}
	$basket->save();*/
	
	$order = Order::create($siteId, $userId);
	$order->setPersonTypeId(1);
	//$basket = Sale\Basket::loadItemsForFUser(\CSaleBasket::GetBasketUserID(), $siteId)->getOrderableItems();
	$order->setBasket($basket);
	
	/*Shipment*/
	$shipmentCollection = $order->getShipmentCollection();
	$shipment = $shipmentCollection->createItem();
	$shipment->setFields([
		'DELIVERY_ID' => 3,
		'DELIVERY_NAME' => 'Самовывоз',
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
		'PAY_SYSTEM_ID' => 1,
		'PAY_SYSTEM_NAME' => 'Наличные',
		'SUM' => $order->getPrice()
	]);
	
	/**/
	$order->doFinalAction(true);
	$propertyCollection = $order->getPropertyCollection();
	$propertyValue = $propertyCollection->getItemByOrderPropertyId(1);
	$propertyValue->setField('VALUE', $name);
	$propertyValue = $propertyCollection->getItemByOrderPropertyId(2);
	$propertyValue->setField('VALUE', $email);
	$propertyValue = $propertyCollection->getItemByOrderPropertyId(3);
	$propertyValue->setField('VALUE', $phone);
	
	$order->setField('CURRENCY', $currencyCode);
	$order->setField('COMMENTS', 'Заказ в 1 клик: ' . $comment);
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
			"COMMENT" => $comment,
			"PRODUCT" => $product,
			"URL" => $url,
			"QUANTITY" => $quantity,
			"PRICE" => $order->getPrice(),
		);
		CEvent::SendImmediate("QUICK_ORDER", SITE_ID, $arEventFields);
		CEvent::SendImmediate("QUICK_USER_ORDER", SITE_ID, $arEventFields);*/
		
		$arEventFields = array(
			"ORDER_ID" => $orderId,
			"ORDER_USER" => $name,
			"ORDER_DATE" => date("d.m.Y H:i:s"),
			"ORDER_LIST" => $strOrderList,
			"PRICE" => SaleFormatCurrency($order->getPrice(), $order->getCurrency()),
			"SALE_EMAIL" => COption::GetOptionString("sale", "order_email"),
			"PHONE" => $phone,
			"EMAIL" => $email,
			"COMMENT" => $comment,
		);
		CEvent::Send("QUICK_USER_ORDER", SITE_ID, $arEventFields, "N", 55);
		CEvent::Send("QUICK_ORDER", SITE_ID, $arEventFields, "N", 51);
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
		'msg' => 'Ваш заказ успешно оформлен! Мы свяжемся с Вами в ближайшее время.'
	];
}
echo json_encode($result);


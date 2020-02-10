<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

CModule::IncludeModule("iblock");

$email = trim(strip_tags($_POST['email']));
$phone = trim(strip_tags($_POST['phone']));
$name = trim(strip_tags($_POST['name']));
$city = trim(strip_tags($_POST['city']));
$comment = trim(strip_tags($_POST['comment']));

$error = 1;
if ($email && $phone) {
	$el = new CIBlockElement;
	
	$PROP = array();
	$PROP[140] = $phone;
	$PROP[141] = $email;
	$PROP[142] = $city;
	$PROP[143] = $comment;
	
	$arr = Array(
		"IBLOCK_SECTION_ID" => false,
		"IBLOCK_ID"         => 11,
		"PROPERTY_VALUES"   => $PROP,
		"NAME"              => $name,
		"ACTIVE"            => "Y",
	);
	
	if ($id = $el->Add($arr)) {
		$error = 0;
		$arEventFields = array(
			"EMAIL" => $email,
			"PHONE" => $phone,
			"NAME" => $name,
			"CITY" => $city,
			"COMMENT" => $comment,
		);
		CEvent::SendImmediate("TOOL", SITE_ID, $arEventFields);
	}
}

$result = [];
if ($error) {
	$result = [
		'success' => false,
		'msg' => 'Ошибка при отправке! '.$el->LAST_ERROR
	];
} else {
	$result = [
		'success' => true,
		'msg' => 'Ваша заявка успешно отправлена! Мы свяжемся с Вами в ближайшее время.'
	];
}
echo json_encode($result);


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

CModule::IncludeModule("iblock");

$email = trim(strip_tags($_POST['email']));

$error = 1;
if (isset($email) && !empty($email)) {
	$code = rand(100000,999999);

	$el = new CIBlockElement;
	
	$PROP = array();
	$PROP[137] = $email;
	$PROP[136] = $code;
	
	$arr = Array(
		"IBLOCK_SECTION_ID" => false,
		"IBLOCK_ID"         => 10,
		"PROPERTY_VALUES"   => $PROP,
		"NAME"              => $email,
		"ACTIVE"            => "Y",
	);
	
	if ($id = $el->Add($arr)) {
		$error = 0;
		
		$arEventFields = [
			"EMAIL" => $email,
			"CODE" => $code,
		];
		CEvent::SendImmediate("PDF_CATALOG_CODE", SITE_ID, $arEventFields);
	}
}

$result = [];
if ($error) {
	$result = [
		'success' => false,
		'msg' => 'Ошибка: '.$el->LAST_ERROR
	];
} else {
	$result = [
		'success' => true,
		'msg' => 'Письмо с кодом подтверждения успешно отправлено на указанный адрес'
	];
}
echo json_encode($result);

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

global $USER;

// проверка reCaptcha
$objRecaptcha = new Recaptcha();
$recaptcha_response = $objRecaptcha->verify($_POST["g-recaptcha-response"]);

if (!$recaptcha_response->success || $recaptcha_response->score < 0.9) {
	echo json_encode([]);
	die();
}

// авторизация
if (!is_object($USER)) $USER = new CUser;
$arAuthResult = $USER->Login($_POST['auth_login'], $_POST['auth_password'], "Y");
$APPLICATION->arAuthResult = $arAuthResult;

echo json_encode($APPLICATION->arAuthResult);


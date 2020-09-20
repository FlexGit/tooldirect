<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

global $USER;

// проверка reCaptcha
/*$objRecaptcha = new Recaptcha();
$recaptcha_response = $objRecaptcha->verify($_POST["g-recaptcha-response"]);

if (!$recaptcha_response->success || $recaptcha_response->score < 0.9) {
	echo json_encode(['success' => false, 'msg' => $recaptcha_response->success . ' : ' . $recaptcha_response->score]);
	die();
}*/

$name = trim(strip_tags($_POST['reg_name']));
$email = trim(strip_tags($_POST['reg_email']));
$phone = trim(strip_tags($_POST['reg_phone']));
$city = trim(strip_tags($_POST['reg_city']));

if(!$name || !$email || !$phone || !$city) {
	echo json_encode(['success' => false, 'msg' => 'Все поля обязательны для заполнения.']);
	die();
}

// регистрация
if (!is_object($USER)) $USER = new CUser;

$password = randString(8, [
	"abcdefghjknmpqrstuvwxyz",
	"ABCDEFGHJKNMPQRSTUVWXYZ",
	"23456789",
	"@#$%&*",
]);
$code = mb_substr(md5(uniqid(rand(),true)), 0, 8);

$arFields = Array(
	"NAME"              => $name,
	"LOGIN"             => $email,
	"EMAIL"             => $email,
	"LID"               => "s1",
	"ACTIVE"            => "N",
	"GROUP_ID"          => array(3,4,8),
	"PASSWORD"          => $password,
	"CONFIRM_PASSWORD"  => $password,
	"CONFIRM_CODE"	    => $code,
	"UF_CITY"			=> $city,
	"UF_PHONE" 			=> $phone,
);

$ID = $USER->Add($arFields);

if (intval($ID) > 0) {
	echo json_encode(['ID' => $ID, 'success' => true, 'msg' => 'Вы зарегистрированы. Для активации Вашего аккаунта перейдите по ссылке в письме, отправленного на указанный E-mail.']);
} else {
	echo json_encode(['success' => false, 'msg' => $USER->LAST_ERROR]);
}


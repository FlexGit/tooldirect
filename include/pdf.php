<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
?>

<?$APPLICATION->IncludeComponent(
	"bitrix:pdf.viewer",
	"",
	Array(
		"WIDTH" => "",
		"HEIGHT" => "",
		"IFRAME" => "Y",
		"PATH" => $_GET['path'],
		"PRINT" => "N",
		"PRINT_URL" => "",
		"TITLE" => "",
		"VIEWER_ID" => ""
	)
);?>
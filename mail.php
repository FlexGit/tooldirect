<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
$arEventFields = array(
	"EMAIL" => 'd1d1d1@inbox.ru',
	"PHONE" => '+7(903)123-12-12',
	"NAME" => 'test',
	"CITY" => 'test',
	"COMMENT" => 'test',
);
if (CModule::IncludeModule("main")) {
	//if (CEvent::Send("DEALER", "s1", $arEventFields)) {
		CEvent::Send("DEALER", "s1", $arEventFields, 'N', 49);
		CEvent::CheckEvents();
	
		CEvent::SendImmediate("DEALER", array(SITE_ID), $arEventFields);
	
	//echo 'ok';
	//}
}

<?php
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

CModule::IncludeModule("iblock");
CModule::IncludeModule('main');

global $USER;

$debug = false;
$userId = $USER->GetID();
if ($userId == 1)
	$debug = true;

$iblockSettings = 20;
$iblockKeyQueries = 23;
$iblockKeyQueriesLinks = 21;
$iblockKeyQueriesLinksLog = 22;
$iblockSearch = ["'4'","'13'","'15'","'6'","'7'","'1'"];

$sphinx = mysqli_connect('localhost:9306');
if (mysqli_connect_errno()) {
	echo 'Не удалось подключиться: ' . mysqli_connect_error();
	exit;
}

if (!intval($userId)) {
	echo 'Для выполнения операции необходимо авторизоваться';
	exit;
}

if (!intval($_POST['id'])) {
	echo 'Отсутствует ID ключевого запроса';
	exit;
}

$keyQueryId = $keyQuery = '';
$arFilter = ["IBLOCK_ID" => $iblockKeyQueries, "ID" => intval($_POST['id'])];
$arSelect = ["ID", "IBLOCK_ID", "NAME"];
$res = CIBlockElement::GetList([], $arFilter, false, false, $arSelect);
if ($ob = $res->GetNextElement()) {
	$arFields = $ob->GetFields();
	$keyQueryId = $arFields['ID'];
	$keyQuery = $arFields['NAME'];
}

if (empty($keyQueryId)) {
	echo 'Отсутствует ID ключевого запроса';
	exit;
}

$links = [];
$arFilter = ["IBLOCK_ID" => $iblockKeyQueriesLinks, "PROPERTY_KEY_QUERY" => $keyQueryId/*, "ID" => 7107*/];
$arSelect = ["ID", "IBLOCK_ID", "NAME"];
$res = CIBlockElement::GetList(["ID" => "ASC"], $arFilter, false, false, $arSelect);
while ($ob = $res->GetNextElement()) {
	$arFields = $ob->GetFields();
	$links[] = $arFields["NAME"];
}

$cnt = 0;
if (!empty($links)) {
	foreach ($links as $link) {
		$q = 'select * from bitrix where match(\'"' . $link . '"\') and param2 in ('.implode(',', $iblockSearch).')';
		//echo 'Ссылка: ' . $q;
		//exit;
		$result = mysqli_query($sphinx, $q);
		while ($row = mysqli_fetch_assoc($result)) {
			//if (!in_array($row['param2'], $iblockSearch)) continue;
			$detailText = '';
			$arFilterEl = ["IBLOCK_ID" => $row['param2'], "ID" => $row['item']];
			$arSelectEl = ["ID", "IBLOCK_ID", "NAME", "DETAIL_TEXT", "PROPERTY_*"];
			$resEl = CIBlockElement::GetList([], $arFilterEl, false, false, $arSelectEl);
			if ($obEl = $resEl->GetNextElement()) {
				$arFieldsEl = $obEl->GetFields();
				//$arProps = $obEl->GetProperties();
				
				$linkEscaped = str_replace('.','\.',$link);
				$linkEscaped = str_replace('/','\/',$link);
				$detailText = preg_replace('/\<a[\s]href=\"'.$linkEscaped.'\".*\>(.*)\<\/a\>/ismU', '$1', html_entity_decode($arFieldsEl["DETAIL_TEXT"]));
				//echo '!'.$detailText.'!';
				//exit;
				
				if (!empty($detailText)) {
					$el = new CIBlockElement;
					$arLoad = [
						"MODIFIED_BY" => $userId,
						"DETAIL_TEXT" => $detailText,
						"DETAIL_TEXT_TYPE" => "html"
					];
					if ($res = $el->Update($arFieldsEl["ID"], $arLoad)) {
						$cnt++;

						// пишем в лог удаления
						$elLog = new CIBlockElement;
						$arLoadLog = [
							"IBLOCK_ID" => $iblockKeyQueriesLinksLog,
							"NAME" => $link,
							"CODE" => $link,
							"DETAIL_TEXT" => $detailText,
							"DETAIL_TEXT_TYPE" => "html",
							"PROPERTY_VALUES" => [
								"EVENT" => "Удаление",
								"KEY_QUERY" => $keyQuery,
								"URL" => $link,
								"IBLOCK_TYPE" => $row['param1'],
								"IBLOCK_ID" => $arFieldsEl["IBLOCK_ID"],
								"ELEMENT_ID" => $arFieldsEl["ID"],
							]
						];
						$resLog = $elLog->Add($arLoadLog);
					}
				}
			}
		}
	}
}

if ($cnt)
	echo 'Ссылок успешно удалено: ' . $cnt;
else
	echo 'Ссылок для удаленая не найдено';

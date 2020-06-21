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

if (!empty($_POST['id'])) {
	if (!intval($_POST['id'])) {
		echo 'Отсутствует ID ключевого запроса';
		exit;
	}
}

$keyQueries = getKeyQueries($_POST['id']);

$cntAll = $cnt = 0;
if (!empty($keyQueries)) {
	foreach ($keyQueries as $i => $keyQuery) {
		$q = 'select * from bitrix where match(\'@body "' . $keyQuery['name'] . '"~1\') and param2 in ('.implode(',', $iblockSearch).')';
		$result = mysqli_query($sphinx, $q);
		while ($row = mysqli_fetch_assoc($result)) {
			$arFilterEl = ["IBLOCK_ID" => $row['param2'], "ID" => $row['item']];
			$arSelectEl = ["ID", "IBLOCK_ID", "NAME", "ACTIVE", "PREVIEW_TEXT", "DETAIL_TEXT"];
			$resEl = CIBlockElement::GetList([], $arFilterEl, false, false, $arSelectEl);
			if ($obEl = $resEl->GetNextElement()) {
				$arFieldsEl = $obEl->GetFields();
				
				//preg_match_all('/data-sphinx="true"/s', $arFieldsEl['DETAIL_TEXT'], $matches);
				
				$qSnippet = 'SELECT SNIPPET(\'' . $arFieldsEl['DETAIL_TEXT'] . '\', \'@body "' . $keyQuery['name'] . '"~1\', \'limit=100000\', \'after_match=</sphinx>\', \'before_match=<sphinx>\') AS SNIPPET FROM bitrix LIMIT 1;';
				
				//echo $qSnippet.'<br>';
				
				$resultSnippet = mysqli_query($sphinx, $qSnippet);
				while ($rowSnippet = mysqli_fetch_assoc($resultSnippet)) {
					$snippet = $rowSnippet['snippet'];
					
					$snippet = str_replace('</sphinx> <sphinx>', ' ', $snippet);
					//echo $snippet;
					preg_match_all('#<sphinx>(.+?)</sphinx>#is', $snippet, $arr);
					
					//echo '<pre>';print_r($arr[1]);echo '</pre>';
					
					// отсечение фраз, которые не совпадают по кол-ву слов с ключевой фразой
					//$newArr = [];
					if (!empty($arr[1])) {
						foreach ($arr[1] as $k => $v) {
							//echo count(explode(' ', $keyQuery['name'])).' - '.$v.' - '.count(explode(' ', $v)).'<br>';
							if (count(explode(' ', $keyQuery['name'])) === count(explode(' ', $v)))
								//$newArr[] = $v;
								$cnt++;
						}
					}
					//echo '<pre>';print_r($newArr);echo '</pre>';
				}
			}
			$cntAll++;
		}
		mysqli_free_result($result);
	}
	echo 'Найдено ' . $cnt . ' КЗ в ' . $cntAll . ' материалах';
} else {
	echo 'Не найдено ни одного КЗ';
}

mysqli_close($sphinx);

function getKeyQueries($id = '') {
	global $iblockKeyQueries, $debug;
	$keyQueries = [];
	$i = 0;
	$arFilter = ["IBLOCK_ID" => $iblockKeyQueries];
	if ($id) {
		$arFilter["ID"] = $id;
	}
	$arSelect = ["ID", "IBLOCK_ID", "NAME", "DATE_ACTIVE_FROM", "DATE_ACTIVE_TO", "PROPERTY_*"];
	$res = CIBlockElement::GetList(["ID" => "ASC"], $arFilter, false, false, $arSelect);
	while($ob = $res->GetNextElement()) {
		$arFields = $ob->GetFields();
		
		$keyQueries[$i]['id'] = $arFields["ID"];
		$keyQueries[$i]['name'] = $arFields["NAME"];
		$i++;
	}
	return $keyQueries;
}

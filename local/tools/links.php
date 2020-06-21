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

$settings = getSettings();
if ($settings['active'] != 'Y') {
	exit;
}
$keyQueries = getKeyQueries($_POST['id']);

if (!empty($keyQueries)) {
	foreach ($keyQueries as $i => $keyQuery) {
		if ($debug) {
			echo '<br>';
			echo '<br>Global maxLinksCountPerDay: ' . $settings['maxLinksCountPerDay'];
			echo '<br>Global maxLinksCountPerWeek: ' . $settings['maxLinksCountPerWeek'];
			echo '<br>Global maxLinksCount1000Symbols: ' . $settings['maxLinksCount1000Symbols'];
			echo '<br>Global maxLinksCount3000Symbols: ' . $settings['maxLinksCount3000Symbols'];
			echo '<br>Global maxLinksCount3000SymbolsMore: ' . $settings['maxLinksCount3000SymbolsMore'];
			echo '<br>KeyQuery name: ' . $keyQuery['name'];
			echo '<br>KeyQuery dateActiveFrom: ' . $keyQuery['dateActiveFrom'];
			echo '<br>KeyQuery dateActiveTo: ' . $keyQuery['dateActiveTo'];
			echo '<br>KeyQuery maxLinksCount: ' . $keyQuery['maxLinksCount'];
			echo '<br>KeyQuery maxLinksCountPerDay: ' . $keyQuery['maxLinksCountPerDay'];
			echo '<br>KeyQuery maxLinksCountPerWeek: ' . $keyQuery['maxLinksCountPerWeek'];
			echo '<br>KeyQuery Links Set Total: ' . $keyQuery['log']['cnt'];
			echo '<br>KeyQuery Links Set Day: ' . $keyQuery['log']['cnt_day'];
			echo '<br>KeyQuery Links Set Week: ' . $keyQuery['log']['cnt_week'];
		}

		if (
			empty($keyQuery['name']) ||
			empty($keyQuery['links']) ||
			($keyQuery['log']['cnt'] >= $keyQuery['maxLinksCount']) ||
			($keyQuery['log']['cnt_day'] >= $keyQuery['maxLinksCountPerDay']) ||
			($keyQuery['log']['cnt_week'] >= $keyQuery['maxLinksCountPerWeek']) ||
			($keyQuery['log']['cnt_day'] >= $settings['maxLinksCountPerDay']) ||
			($keyQuery['log']['cnt_week'] >= $settings['maxLinksCountPerWeek'])
		)
			continue;
		
		if ($debug) {
			echo '<br>';
			echo 'SEARCH: ' . $keyQuery['name'] . '<br>';
			echo 'URLS: ';
			echo '<pre>';
			print_r($keyQuery['links']);
			echo '</pre>';
			echo '<br><br>';
		}
		
		$q = 'select * from bitrix where match(\'@body "' . $keyQuery['name'] . '"~1\') and param2 in ('.implode(',', $iblockSearch).')';
		
		if ($debug) {
			echo $q . '<br>';
		}
		
		$result = mysqli_query($sphinx, $q);
		while ($row = mysqli_fetch_assoc($result)) {
			//if (!in_array($row['param2'], $iblockSearch)) continue;
			
			//echo $row['param1'].' - '.$row['param2'].' - '.$row['item'].'<br>';
			
			$arFilterEl = ["IBLOCK_ID" => $row['param2'], "ID" => $row['item']];
			$arSelectEl = ["ID", "IBLOCK_ID", "NAME", "ACTIVE", "PREVIEW_TEXT", "DETAIL_TEXT"];
			$resEl = CIBlockElement::GetList([], $arFilterEl, false, false, $arSelectEl);
			if ($obEl = $resEl->GetNextElement()) {
				$arFieldsEl = $obEl->GetFields();
				
				//echo '<pre>';print_r($arFieldsEl);echo '<pre>';
				
				preg_match_all('/data-sphinx="true"/s', $arFieldsEl['DETAIL_TEXT'], $matches);
				
				$textLength = strlen(strip_tags($arFieldsEl['DETAIL_TEXT']));
				
				if ($debug) {
					echo '<br>Text Length: ' . $textLength;
					echo '<br>Count Matches: ' . count($matches[0]);
				}
				
				if ($textLength <= 1000) {
					if (count($matches[0]) >= $settings['maxLinksCount1000Symbols'])
						continue;
				} elseif ($textLength > 1000 && $textLength <= 3000) {
					if (count($matches[0]) >= $settings['maxLinksCount3000Symbols'])
						continue;
				} elseif ($textLength > 3000) {
					if (count($matches[0]) >= $settings['maxLinksCount3000SymbolsMore'])
						continue;
				}
				
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
					$newArr = [];
					if (!empty($arr[1])) {
						foreach ($arr[1] as $k => $v) {
							//echo count(explode(' ', $keyQuery['name'])).' - '.$v.' - '.count(explode(' ', $v)).'<br>';
							if (count(explode(' ', $keyQuery['name'])) === count(explode(' ', $v)))
								$newArr[] = $v;
						}
					}
					
					//echo '<pre>';print_r($newArr);echo '</pre>';
					
					if (!empty($newArr)) {
						foreach ($newArr as $k => $v) {
							foreach ($keyQuery['links']['links'] as $k_link => $v_link) {
								$newValue = '';
								
								if ($debug) {
									echo '<br>';
									echo '<br>Фраза: ' . $v;
									echo '<br>Global maxLinksCountPerDay: ' . $settings['maxLinksCountPerDay'];
									echo '<br>Global maxLinksCountPerWeek: ' . $settings['maxLinksCountPerWeek'];
									echo '<br>keyQuery maxLinksCount: ' . $keyQuery['maxLinksCount'];
									echo '<br>keyQuery maxLinksCountPerDay: ' . $keyQuery['maxLinksCountPerDay'];
									echo '<br>keyQuery maxLinksCountPerWeek: ' . $keyQuery['maxLinksCountPerWeek'];
									echo '<br>KeyQuery Links Set Total: ' . $keyQuery['log']['cnt'];
									echo '<br>KeyQuery Links Set Day: ' . $keyQuery['log']['cnt_day'];
									echo '<br>KeyQuery Links Set Week: ' . $keyQuery['log']['cnt_week'];
									echo '<br>Link: ' . $v_link['url'];
									echo '<br>Link dateActiveFrom: ' . $v_link['dateActiveFrom'];
									echo '<br>Link dateActiveTo: ' . $v_link['dateActiveTo'];
									echo '<br>Link Total: ' . $v_link['total'];
									echo '<br>Link Set: ' . $v_link['log']['cnt'];
								}
								
								if (
									($v_link['log']['cnt'] >= $v_link['total']) ||
									($keyQuery['log']['cnt'] >= $keyQuery['maxLinksCount']) ||
									($keyQuery['log']['cnt_day'] >= $keyQuery['maxLinksCountPerDay']) ||
									($keyQuery['log']['cnt_week'] >= $keyQuery['maxLinksCountPerWeek']) ||
									($keyQuery['log']['cnt_day'] >= $settings['maxLinksCountPerDay']) ||
									($keyQuery['log']['cnt_week'] >= $settings['maxLinksCountPerWeek'])
								)
									continue;

								$newValue = preg_replace("/<sphinx>$v<\/sphinx>/", "<a href=\"$v_link[url]\" title=\"$v\" class=\"link_green\" data-sphinx=\"true\">$v</a>", $snippet, 1);
								if ($newValue !== $snippet) {
									$clearNewValue = str_replace(['<sphinx>','</sphinx>'],'', $newValue);
									if (setLink($keyQuery['name'], $v_link['url'], $v, $clearNewValue, $row['param1'], $row['param2'], $row['item'])) {
										$keyQuery['links']['links'][$k_link]['log']['cnt']++;
										$keyQuery['log']['cnt']++;
										$keyQuery['log']['cnt_day']++;
										$keyQuery['log']['cnt_week']++;
										$snippet = $newValue;
										
										if ($debug) {
											echo '<br><br>LINK ADD<br><br>';
										}
									} else {
										if ($debug) {
											echo '<br><br>LINK NOT ADD';
										}
									}
								} else {
									if ($debug) {
										echo '<br><br>LINK NOT ADD';
									}
								}
							}
						}
					}
				}
			}
		}
		mysqli_free_result($result);
	}
} else {
	echo 'Нет активных КЗ для перелинковки';
}

mysqli_close($sphinx);

function setLink($keyQuery, $url, $phrase, $text, $iblockType, $iblockId, $elementId) {
	global $iblockKeyQueriesLinksLog, $USER;
	
	$el = new CIBlockElement;
	$arLoad = [
		"MODIFIED_BY" => $USER->GetID(),
		"DETAIL_TEXT" => $text,
		"DETAIL_TEXT_TYPE" => "html"
	];
	if ($el->Update($elementId, $arLoad)) {
		$elLog = new CIBlockElement;
		$arLoadLog = [
			"IBLOCK_ID" => $iblockKeyQueriesLinksLog,
			"NAME" => $url,
			"DETAIL_TEXT" => $text,
			"DETAIL_TEXT_TYPE" => "html",
			"PROPERTY_VALUES" => [
				"EVENT" => "Добавление",
				"KEY_QUERY" => $keyQuery,
				"PHRASE" => $phrase,
				"URL" => $url,
				"IBLOCK_TYPE" => $iblockType,
				"IBLOCK_ID" => $iblockId,
				"ELEMENT_ID" => $elementId,
			]
		];
		$elLog->Add($arLoadLog);
		return true;
	}
	return false;
}

function getSettings() {
	global $iblockSettings;
	$settings = [];
	$arFilter = ["IBLOCK_ID" => $iblockSettings];
	$arSelect = ["ID", "IBLOCK_ID", "NAME", "ACTIVE", "PROPERTY_*"];
	$res = CIBlockElement::GetList(["ID" => "ASC"], $arFilter, false, false, $arSelect);
	while ($ob = $res->GetNextElement()) {
		$arFields = $ob->GetFields();
		$arProps = $ob->GetProperties();
		$settings['active'] = $arFields["ACTIVE"];
		$settings['maxLinksCountPerDay'] = intval($arProps["MAX_LINKS_COUNT_PER_DAY"]["VALUE"]); // макс. вол-во ссылок в день
		$settings['maxLinksCountPerWeek'] = intval($arProps["MAX_LINKS_COUNT_PER_WEEK"]["VALUE"]); // макс. кол-во ссылок в неделю
		$settings['maxLinksCount1000Symbols'] = intval($arProps["MAX_LINKS_COUNT_1000_SYMBOLS"]["VALUE"]); // макс. кол-во ссылок в тексте до 1000 символов
		$settings['maxLinksCount3000Symbols'] = intval($arProps["MAX_LINKS_COUNT_3000_SYMBOLS"]["VALUE"]); // макс. кол-во символов в тексте до 3000 символов
		$settings['maxLinksCount3000SymbolsMore'] = intval($arProps["MAX_LINKS_COUNT_3000_SYMBOLS_MORE"]["VALUE"]); // макс. кол-во символов в тексте свыше 3000 символов
	}
	return $settings;
}

function getKeyQueries($id = '') {
	global $iblockKeyQueries, $debug;
	$nowDate = date("Ymd");
	$keyQueries = [];
	$i = 0;
	$arFilter = ["IBLOCK_ID" => $iblockKeyQueries, "ACTIVE" => "Y"];
	if ($id) {
		$arFilter["ID"] = $id;
	}
	$arSelect = ["ID", "IBLOCK_ID", "NAME", "DATE_ACTIVE_FROM", "DATE_ACTIVE_TO", "PROPERTY_*"];
	$res = CIBlockElement::GetList(["ID" => "ASC"], $arFilter, false, false, $arSelect);
	while($ob = $res->GetNextElement()) {
		$arFields = $ob->GetFields();
		
		$dateActiveFrom = date("Ymd", mktime(0,0,0, date("m"), date("d"), date("Y") - 1));
		if (!empty($arFields["DATE_ACTIVE_FROM"])) {
			$dateActiveFrom = date("Ymd", strtotime($arFields["DATE_ACTIVE_FROM"]));
		}
		$dateActiveTo = date("Ymd", mktime(0,0,0, date("m"), date("d"), date("Y") + 1));
		if (!empty($arFields["DATE_ACTIVE_TO"])) {
			$dateActiveTo = date("Ymd", strtotime($arFields["DATE_ACTIVE_TO"]));
		}

		// проверяем даты активности
		if ($debug) {
			echo 'keyQuery ACTIVE DATES: ' . $dateActiveFrom . ' - ' . $dateActiveTo . ' - ' . $nowDate . '<br>';
		}
		if ($dateActiveFrom > $nowDate || $nowDate > $dateActiveTo)
			continue;
	
		$arProps = $ob->GetProperties();
		
		$keyQueries[$i]['id'] = $arFields["ID"];
		$keyQueries[$i]['name'] = $arFields["NAME"];
		$keyQueries[$i]['dateActiveFrom'] = $arFields["DATE_ACTIVE_FROM"];
		$keyQueries[$i]['dateActiveTo'] = $arFields["DATE_ACTIVE_TO"];
		$keyQueries[$i]['maxLinksCount'] = intval($arProps["MAX_LINKS_COUNT"]["VALUE"]); // макс. ссылок всего
		$keyQueries[$i]['maxLinksCountPerDay'] = intval($arProps["MAX_LINKS_COUNT_PER_DAY"]["VALUE"]); // макс. ссылок в день
		$keyQueries[$i]['maxLinksCountPerWeek'] = intval($arProps["MAX_LINKS_COUNT_PER_WEEK"]["VALUE"]); // макс. ссылок в неделю
		$keyQueries[$i]['links'] = getLinks($arFields["ID"], $arFields["NAME"]); // ссылки данного КЗ
		$keyQueries[$i]['log'] = getLog($arFields["NAME"]); // лог данного КЗ
		$i++;
	}
	return $keyQueries;
}

function getLinks($keyQueryId, $keyQuery) {
	global $iblockKeyQueriesLinks, $debug;
	$nowDate = date("Ymd");
	$keyQueriesLinks = [];
	$i = 0;
	$arFilter = ["IBLOCK_ID" => $iblockKeyQueriesLinks, "ACTIVE" => "Y", "PROPERTY_KEY_QUERY" => $keyQueryId];
	$arSelect = ["ID", "IBLOCK_ID", "NAME", "DATE_ACTIVE_FROM", "DATE_ACTIVE_TO", "PROPERTY_*"];
	$res = CIBlockElement::GetList(["ID" => "ASC"], $arFilter, false, false, $arSelect);
	while ($ob = $res->GetNextElement()) {
		$arFields = $ob->GetFields();
		
		$dateActiveFrom = date("Ymd", mktime(0,0,0, date("m"), date("d"), date("Y") - 1));
		if (!empty($arFields["DATE_ACTIVE_FROM"])) {
			$dateActiveFrom = date("Ymd", strtotime($arFields["DATE_ACTIVE_FROM"]));
		}
		$dateActiveTo = date("Ymd", mktime(0,0,0, date("m"), date("d"), date("Y") + 1));
		if (!empty($arFields["DATE_ACTIVE_TO"])) {
			$dateActiveTo = date("Ymd", strtotime($arFields["DATE_ACTIVE_TO"]));
		}
		
		// проверяем даты активности
		if ($debug) {
			echo 'Link ACTIVE DATES: ' . $dateActiveFrom . ' - ' . $dateActiveTo . ' - ' . $nowDate . '<br>';
		}
		if ($dateActiveFrom > $nowDate || $nowDate > $dateActiveTo)
			continue;

		$arProps = $ob->GetProperties();
		
		$keyQueriesLinks['links'][$i]['id'] = $arFields['ID'];
		$keyQueriesLinks['links'][$i]['url'] = $arFields['NAME'];
		$keyQueriesLinks['links'][$i]['dateActiveFrom'] = $arFields['DATE_ACTIVE_FROM'];
		$keyQueriesLinks['links'][$i]['dateActiveTo'] = $arFields['DATE_ACTIVE_TO'];
		$keyQueriesLinks['links'][$i]['total'] = intval($arProps["QUANTITY"]["VALUE"]); // кол-во ссылок по данному URL
		$keyQueriesLinks['links'][$i]['log'] = getLog($keyQuery, $arFields['NAME']); // лог данного УРЛ
		$i++;
	}
	return $keyQueriesLinks;
}

function getLog($keyQuery, $link = '') {
	global $iblockKeyQueriesLinksLog;
	
	$nowDate = date("Ymd");
	$beginDate = date("Ymd", strtotime("last Monday"));
	$endDate = date("Ymd", strtotime("Sunday"));

	$arr = [
		'cnt' => 0, // общее кол-во ссылок по КЗ / УРЛ
		'cnt_day' => 0, // кол-во ссылок по КЗ / УРЛ, проставленное за текущий день
		'cnt_week' => 0 // кол-во ссылок по КЗ / УРЛ, проставленное за текущую неделю
	];
	
	// проверяем наличие записи об удалении ссылок по КЗ
	$dateCreateOfDelete = '';
	$arFilter = ["IBLOCK_ID" => $iblockKeyQueriesLinksLog, "ACTIVE" => "Y", "PROPERTY_KEY_QUERY" => $keyQuery, "PROPERTY_EVENT" => 'Удаление'];
	if (!empty($link)) {
		$arFilter["URL"] = $link;
	}
	$arSelect = ["ID", "IBLOCK_ID", "DATE_CREATE", "NAME", "ACTIVE", "PROPERTY_*"];
	$res = CIBlockElement::GetList(["ID" => "DESC"], $arFilter, false, false, $arSelect);
	if ($ob = $res->GetNextElement()) {
		$arFields = $ob->GetFields();
		$dateCreateOfDelete = date("d.m.Y H:i:s", strtotime($arFields["DATE_CREATE"]));
	}

	$arFilter = ["IBLOCK_ID" => $iblockKeyQueriesLinksLog, "ACTIVE" => "Y", "PROPERTY_KEY_QUERY" => $keyQuery, "PROPERTY_EVENT" => 'Добавление'];
	if (!empty($link)) {
		$arFilter["URL"] = $link;
	}
	if (!empty($dateCreateOfDelete)) {
		$arFilter[">=DATE_CREATE"] = $dateCreateOfDelete;
	}
	//echo '<pre>';print_r($arFilter);echo '</pre>';
	$arSelect = ["ID", "IBLOCK_ID", "DATE_CREATE", "NAME", "ACTIVE", "PROPERTY_*"];
	$res = CIBlockElement::GetList(["ID" => "ASC"], $arFilter, false, false, $arSelect);
	while ($ob = $res->GetNextElement()) {
		$arFields = $ob->GetFields();
		//echo '<br>'.$arFields["ID"];
		
		$arr['cnt']++;
		
		$dateCreate = date("Ymd", strtotime($arFields["DATE_CREATE"]));
		if ($dateCreate == $nowDate) {
			$arr['cnt_day']++;
		}
		if ($dateCreate >= $beginDate && $dateCreate <= $endDate) {
			$arr['cnt_week']++;
		}
	}
	return $arr;
}
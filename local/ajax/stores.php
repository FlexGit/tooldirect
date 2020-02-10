<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("iblock");

use lib\Helper;

$city = trim(strip_tags(htmlspecialchars($_POST['city'])));
$userCoords = trim(strip_tags(htmlspecialchars($_POST['coords'])));

$arr = [];
$arSelect = ["ID", "IBLOCK_ID", "NAME", "PROPERTY_*"];
$arFilter = ["IBLOCK_ID" => 9, "ACTIVE" => "Y"];
if ($city)
	$arFilter["PROPERTY_CITY.CODE"] = $city;
$res = CIBlockElement::GetList([], $arFilter, false, false, $arSelect);
while ($ob = $res->GetNextElement()) {
	$arFields = $ob->GetFields();
	$arProps = $ob->GetProperties();
	
	$distance = '';
	if (!empty($userCoords)) {
		$coords = explode(',', $arProps['COORDS']['VALUE']);
		$distance = Helper::distance($userCoords[0], $userCoords[1], $coords[1], $coords[0]);
	}
	
	$arr[] = [
		'NAME' => $arFields['NAME'],
		'ADDRESS' => $arProps['ADDRESS']['VALUE'],
		'PHONE' => $arProps['PHONE']['VALUE'],
		'EMAIL' => $arProps['EMAIL']['VALUE'],
		'SITE' => $arProps['SITE']['VALUE'],
		'WORKING_HOURS' => $arProps['WORKING_HOURS']['VALUE'],
		'COORDS' => $arProps['COORDS']['VALUE'],
		'DISTANCE' => $distance
	];
}

$stores = '';
$features = [];

if (!empty($arr)) {
	usort($arr, function ($item1, $item2) {
		return $item1['DISTANCE'] <=> $item2['DISTANCE'];
	});
	
	foreach ($arr as $k => $v) {
		$coords = explode(',', $v['COORDS']);
		
		$stores .= '<div class="row" style="margin-bottom: 5px;padding: 10px 10px;margin-left: 0;margin-right: 0;background: #fff;">
					<div class="col-sm-3 margin-auto">' . $v['NAME'] . '</div>
					<div class="col-sm-3 margin-auto">' . $v['ADDRESS'] . '</div>
					<div class="col-sm-3 margin-auto">Тел.: <a href="tel:+' . preg_replace("/[^0-9]/", '', $v['PHONE']) . '" style="color: #000;">' . $v['PHONE'] . '</a> <br>E-mail: <a href="mailto:' . $v['EMAIL'] . '" style="color: #000;">' . $v['EMAIL'] . '</a></div>
					<div class="col-sm-3 margin-auto">' . $v['SITE'] . '<br>Время работы: ' . $v['WORKING_HOURS'] . '</div>
				</div>';
		
		$features[] = [
			'type' => 'Feature',
			'id' => $k,
			'geometry' => [
				'type' => 'Point',
				'coordinates' => [$coords[0], $coords[1]]
			],
			'properties' => [
				'balloonContentHeader' => $v['NAME'],
				'balloonContentBody' => '<p>Адрес: ' . $v['ADDRESS'] . '</p><p>Тел.: ' . $v['PHONE'] . '</p><p>E-mail: ' . $v['EMAIL'] . '</p><p>Сайт: ' . $v['SITE'] . '</p><p>Время работы: ' . $v['WORKING_HOURS'] . '</p>',
				'balloonContentFooter' => '',
				'clusterCaption' => 'Еще магазины',
				'hintContent' => 'Подсказка'
			]
		];
	}
}

echo json_encode([
	'stores' => $stores,
	'map' => [
		'type' => 'FeatureCollection',
		'features' => $features
	]
]);


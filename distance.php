<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("iblock");

function distance($lat1,$lng1,$lat2,$lng2/*$lat1, $long1, $lat2, $long2*/) {
	$lat1  = deg2rad($lat1);
	$lng1  = deg2rad($lng1);
	$lat2  = deg2rad($lat2);
	$lng2  = deg2rad($lng2);
	$delta_lat  = ($lat2 - $lat1);
	$delta_lng  = ($lng2 - $lng1);
	return round(6378137 * acos(cos($lat1) * cos($lat2) * cos($lng1 - $lng2) + sin($lat1) * sin($lat2)));
	
	//радиус Земли
	/*$R = 6372795;
	//перевод коордитат в радианы
	$lat1 *= pi() / 180;
	$lat2 *= pi() / 180;
	$long1 *= pi() / 180;
	$long2 *= pi() / 180;
	//вычисление косинусов и синусов широт и разницы долгот
	$cl1 = cos($lat1);
	$cl2 = cos($lat2);
	$sl1 = sin($lat1);
	$sl2 = sin($lat2);
	$delta = $long2 - $long1;
	$cdelta = cos($delta);
	$sdelta = sin($delta);
	//вычисления длины большого круга
	$y = sqrt(pow($cl2 * $sdelta, 2) + pow($cl1 * $sl2 - $sl1 * $cl2 * $cdelta, 2));
	$x = $sl1 * $sl2 + $cl1 * $cl2 * $cdelta;
	$ad = atan2($y, $x);
	$dist = $ad * $R;
	//расстояние между двумя координатами в метрах
	return $dist;*/
}

/*$userCoords = [27.561481, 53.902496];

$res = CIBlockElement::GetList(Array(), Array("IBLOCK_ID" => 12, "ACTIVE" => "Y"), false, false, Array("ID", "IBLOCK_ID", "NAME", "CODE", "PROPERTY_COORDS", "PROPERTY_REGION"));
while ($ob = $res->GetNextElement()) {
	$arFields = $ob->GetFields();
	$arProps = $ob->GetProperties();
	
	$coords = explode(',', $arProps['COORDS']['VALUE']);
	$distance = distance($userCoords[0], $userCoords[1], $coords[1], $coords[0]);
	
	$arr[$i]['NAME'] = $arFields['NAME'];
	$arr[$i]['CODE'] = $arFields['CODE'];
	$arr[$i]['DISTANCE'] = $distance;
	$i++;
}

usort($arr, function ($item1, $item2) {
	return $item1['DISTANCE'] <=> $item2['DISTANCE'];
});

echo '<pre>';print_r($arr);echo '</pre>';*/

$url = 'https://geocode-maps.yandex.ru/1.x/?format=json&geocode=Москва';
$response_json = file_get_contents($url);
echo $response_json;
/*$response = json_decode($response_json, true);
echo '<pre>';print_r($response);echo '</pre>';

if (!empty($response['response']['GeoObjectCollection']['featureMember'])) {
	foreach ($response['response']['GeoObjectCollection']['featureMember'] as $geoObject) {
		echo '<pre>';print_r($geoObject);echo '</pre>';
	}
}*/

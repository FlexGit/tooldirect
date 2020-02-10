<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("iblock");

use lib\Helper;

$city = trim(strip_tags(htmlspecialchars($_POST['city'])));
$coords = trim(strip_tags(htmlspecialchars($_POST['coords'])));

//print_r($_POST);

// check reCaptcha
$objRecaptcha = new Recaptcha();
$recaptcha_response = $objRecaptcha->verify($_POST["g-recaptcha-response"]);

$code = $userPlace = $userRegion = $userArea = $userCity = $userLocality = '';
$userCoords = $userPlaceArr = [];

if (($city || $coords) && $recaptcha_response->success && $recaptcha_response->score >= 0.9) {
	$object = $coords;
	if ($city) {
		$object = urlencode($city);
		$coords = '';
	}

	$url = 'http://geocode-maps.yandex.ru/1.x/?apikey=' . YANDEX_GEOKODER_KEY . '&format=json&geocode=' . $object;
	$response_json = file_get_contents($url);
	$response = json_decode($response_json, true);
	$cities = '';
	if (!empty($response['response']['GeoObjectCollection']['featureMember'])) {
		foreach ($response['response']['GeoObjectCollection']['featureMember'] as $geoObject) {
			//$cities = $geoObject;
			if ($city) {
				if (mb_strtolower($geoObject['GeoObject']['name']) === mb_strtolower($city)) {
					$userCoords = explode(' ', $geoObject['GeoObject']['Point']['pos']);
					$userRegion = $geoObject['GeoObject']['metaDataProperty']['GeocoderMetaData']['AddressDetails']['Country']['AdministrativeArea']['AdministrativeAreaName'];
					break;
				}
			} else {
				$userPlaceArr[] = $geoObject['GeoObject']['name'];
				
				/*$userCoords = explode(' ', $geoObject['GeoObject']['Point']['pos']);
				$userRegion = $geoObject['GeoObject']['metaDataProperty']['GeocoderMetaData']['AddressDetails']['Country']['AdministrativeArea']['AdministrativeAreaName'];
				$userArea = $geoObject['GeoObject']['metaDataProperty']['GeocoderMetaData']['AddressDetails']['Country']['AdministrativeArea']['SubAdministrativeArea']['SubAdministrativeAreaName'];
				$userCity = $geoObject['GeoObject']['metaDataProperty']['GeocoderMetaData']['AddressDetails']['Country']['AdministrativeArea']['SubAdministrativeArea']['Locality']['LocalityName'];
				$userLocality = $geoObject['GeoObject']['metaDataProperty']['GeocoderMetaData']['AddressDetails']['Country']['AdministrativeArea']['SubAdministrativeArea']['Locality']['Premise']['PremiseName'];
				if ($userCity)
					$userPlace = $userCity;
				else if ($userLocality)
					$userPlace = $userLocality;
				else if ($userArea)
					$userPlace = $userArea;
				else
					$userPlace = $userRegion;
				break;*/
			}
		}
	}
	
	$i=0;
	$res = CIBlockElement::GetList(Array(), Array("IBLOCK_ID" => 12, "ACTIVE" => "Y"), false, false, Array("ID", "IBLOCK_ID", "NAME", "CODE", "PROPERTY_COORDS", "PROPERTY_REGION"));
	while ($ob = $res->GetNextElement()) {
		$arFields = $ob->GetFields();
		$arProps = $ob->GetProperties();
		
		if (mb_strtolower($userRegion) === mb_strtolower($arProps['REGION']['VALUE'])) {
			$label1 = $code = $arFields['CODE'];
			break;
		}
		
		if (!empty($userCoords)) {
			$coords = explode(',', $arProps['COORDS']['VALUE']);
			$distance = Helper::distance($userCoords[0], $userCoords[1], $coords[1], $coords[0]);
			
			$arr[$i]['CODE'] = $arFields['CODE'];
			$arr[$i]['DISTANCE'] = $distance;
			$i++;
		}
	}
	
	if (!$code && !empty($userCoords)) {
		usort($arr, function ($item1, $item2) {
			return $item1['DISTANCE'] <=> $item2['DISTANCE'];
		});
		
		//print_r($arr);
		
		$label2 = $code = $arr[0]['CODE'];
	}
	if (!$code)	{
		$label3 = $code = 'moskva';
	}
}

if (!empty($userPlaceArr)) {
	krsort($userPlaceArr);
}

//echo $code.' - '.$userPlace;

echo json_encode([
	'code' => $code,
	'usercity' => implode(', ',$userPlaceArr),
	'request' => $_POST,
	'recaptcha_response' => $recaptcha_response,
	'debug' => $label1.' - '.$label2.' - '.$label3.' - '.$userRegion,
	'arr' => $arr,
	'userCoords' => $userCoords,
	'userRegion' => $userRegion,
	'featureMember' => $response['response']['GeoObjectCollection']['featureMember'],
	//'cities' => $cities,
	//'response' => $response,
	'response_json' => $response_json,
	'url' => $url
]);

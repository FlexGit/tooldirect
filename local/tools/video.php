<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("iblock");

exit;

$arr = [];
$i=0;
$arFilter = ["IBLOCK_ID" => $IBLOCK_ID];
$arSelect = ["ID", "NAME", "IBLOCK_ID", "PROPERTY_PHOTOS", "PROPERTY_VIDEOS"];
$res = CIBlockElement::GetList([], $arFilter, false, false, $arSelect);
while ($ob = $res->GetNextElement()) {
	$arFields = $ob->GetFields();
	$arProps = $ob->GetProperties();
	
	//echo '<pre>';print_r($arProps);echo '</pre>';
	
	$arr[$i]['ID'] = $arFields['ID'];
	$arr[$i]['NAME'] = $arFields['NAME'];
	if (!empty($arProps['PHOTOS']['VALUE'])) {
		$arr[$i]['PHOTOS'] = $arProps['PHOTOS']['VALUE'];
	}
	if (!empty($arProps['VIDEOS']['VALUE'])) {
		$arr[$i]['VIDEOS'] = $arProps['VIDEOS']['VALUE'];
	}
	
	$i++;
}

//echo '<pre>';print_r($arr);echo '</pre>';
//exit;

if (!empty($arr)) {
	foreach ($arr as $k => $v) {
		$PROP = [];
		
		$PROP['MORE_PHOTO'] = [];
		if (!empty($v['PHOTOS'])) {
			$photos = explode(',', $v['PHOTOS']);
			foreach ($photos as $photo) {
				$PROP['MORE_PHOTO'][] = ['VALUE' => CFile::MakeFileArray($photo), 'DESCRIPTION' => ''];
			}
		}
		
		$PROP['VIDEO'] = [];
		if (!empty($v['VIDEOS'])) {
			$videos = explode(',', $v['VIDEOS']);
			foreach ($videos as $video) {
				$PROP['VIDEO'][] = ['VALUE' => CFile::MakeFileArray($video), 'DESCRIPTION' => ''];
			}
		}
		
		//echo '<pre>';print_r($PROP);echo '</pre>';

		CIBlockElement::SetPropertyValuesEx($v['ID'], 4, $PROP);
	}
}

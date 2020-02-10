<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("iblock");

$result = '';
$arSelect = ["ID", "IBLOCK_ID", "NAME", "CODE", "PROPERTY_*"];
$arFilter = ["IBLOCK_ID" => 12, "ACTIVE" => "Y"];
$res = CIBlockElement::GetList([], $arFilter, false, false, $arSelect);
while ($ob = $res->GetNextElement()) {
	$arFields = $ob->GetFields();
	$arProps = $ob->GetProperties();
	
	$cities[$i]['ID'] = $arFields['ID'];
	$cities[$i]['NAME'] = $arFields['NAME'];
	$cities[$i]['CODE'] = $arFields['CODE'];
	$cities[$i]['COORDS'] = $arProps['COORDS']['VALUE'];
	
	$checked = '';
	if ($arFields['NAME'] == 'Москва')
		$checked = 'checked="checked"';
	
	if ($APPLICATION->get_cookie("siteLayout") == 'mobile') {
		$result .= '<div style="margin-right: 15px;"><label class="control control--radio"><input type="radio" name="radio" data-code="' . $arFields['CODE'] . '" data-coord="' . $arProps['COORDS']['VALUE'] . '" ' . $checked . ' class="city-radio"/> ' . $arFields['NAME'] . '<div class="control__indicator"></div></label></div>';
	} else {
		$result .= '<label class="control control--radio">' . $arFields['NAME'] . '<input type="radio" name="radio" data-code="' . $arFields['CODE'] . '" data-coord="' . $arProps['COORDS']['VALUE'] . '" ' . $checked . ' class="city-radio"/><div class="control__indicator"></div></label>';
	}
}

echo '<div style="display: flex;flex-wrap: wrap;">' . $result . '</div>';


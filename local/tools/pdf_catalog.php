<?
$sections = explode(',', $_REQUEST['sections']);
$makes = explode(',', $_REQUEST['makes']);
$type = $_REQUEST['type'];

if (empty($sections) || empty($makes) || empty($type)) {
	die();
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
include $_SERVER['DOCUMENT_ROOT'] . '/local/php_interface/lib/phpqrcode/qrlib.php';
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

CModule::IncludeModule("iblock");
CModule::IncludeModule("catalog");
CModule::IncludeModule('main');
CModule::IncludeModule('highloadblock');

define("YOUTUBE_VIDEO_PATH", "https://www.youtube.com/watch?v=");

$sectionParams = [
	'7118' => [
		'params' =>	['D','I','L','S','R','Z','CUTTING_TYPE','H'],
		'type' => 'UF_USER_EXT_SECTION',
	], // Фрезы концевые
	'7235' => [
		'params' =>	['NAME_PDF'],
		'type' => 'UF_USER_SECTION',
	], // Фрезы алмазные
	'7292' => [
		'params' =>	['NAME_PDF'],
		'type' => 'UF_USER_SECTION',
	], // Аксессуары
	'7305' => [
		'params' =>	['D','I','L','S','CUTTING_TYPE'],
		'type' => 'UF_USER_SECTION',
	], // Граверы
	'7246' => [
		'params' =>	['D','I','L','B','R','H','CUTTING_TYPE','Z'],
		'type' => 'UF_USER_SECTION',
	], // Фрезы насадные
	'7310' => [
		'params' =>	['LENGTH','WIDTH','HEIGHT','R','CUTTING_TYPE'],
		'type' => 'UF_USER_SECTION',
	], // Ножи и бланкеты
	'7322' => [
		'params' =>	['NAME_PDF'],
		'type' => 'UF_USER_SECTION',
	], // Патроны и цанги
	'7328' => [
		'params' =>	['D','B','K','P','Z','TEETH_TYPE'],
		'type' => 'UF_USER_SECTION',
	], // Пильные диски
	'7353' => [
		'params' =>	['NAME_PDF'],
		'type' => 'UF_USER_SECTION',
	], // Столярные приспособления
	'7359' => [
		'params' =>	['D','I','L','S','RH_LH'],
		'type' => 'UF_USER_SECTION',
	], // Свёрла и зенкеры
	'7255' => [
		'params' =>	['D','I','L','S','R','Z','CUTTING_TYPE'],
		'type' => 'UF_USER_SECTION',
	], // Фрезы со сменными ножами
	'7268' => [
		'params' =>	['D','I','L','S','RN','R','Z'],
		'type' => 'UF_USER_SECTION',
	], // Фрезы спиральные
	'7370' => [
		'params' =>	['NAME_PDF'],
		'type' => 'UF_USER_SECTION',
	], // Столы, верстаки, тиски
	'7373' => [
		'params' =>	['NAME_PDF'],
		'type' => 'UF_USER_SECTION',
	], // Струбцины
];

// Properties
$properties = [];
$resProperty = CIBlockProperty::GetList([], ["IBLOCK_ID" => CATALOG_BLOCK_ID]);
while ($obProperty = $resProperty->Fetch()) {
	$properties[$obProperty['CODE']] = $obProperty['NAME'];
}

//echo '<pre>';print_r($properties);echo '</pre>';
//exit;

$arResult = [];

// Sections
$arSectionFilter = ["IBLOCK_ID" => CATALOG_BLOCK_ID, "ACTIVE" => "Y", /*"UF_SEO_SECTION" => 0, "UF_USER_SECTION" => 0, "UF_USER_EXT_SECTION" => 1,*/ "DEPTH_LEVEL" => 2, "SECTION_ID" => $sections];
$arSectionSelect = ["ID", "IBLOCK_ID", "IBLOCK_SECTION_ID", "NAME", "PICTURE", "UF_*"];
$arSectionOrder = ["SORT" => "ASC"];
$resSection = CIBlockSection::GetList($arSectionOrder, $arSectionFilter, false, $arSectionSelect);
while ($obSection = $resSection->GetNextElement()) {
	$arSectionFields = $obSection->GetFields();
	
	if (!array_key_exists($arSectionFields['IBLOCK_SECTION_ID'], $sectionParams)) continue;
	if (!$arSectionFields['UF_USER_SECTION'] && !$arSectionFields['UF_USER_EXT_SECTION']) continue;
	
	$arResult['SECTIONS'][$arSectionFields['ID']]['NAME'] = $arSectionFields['NAME'];
	$arResult['SECTIONS'][$arSectionFields['ID']]['IBLOCK_SECTION_ID'] = $arSectionFields['IBLOCK_SECTION_ID'];
	$arResult['SECTIONS'][$arSectionFields['ID']]['PICTURE'] = $arSectionFields['PICTURE'];
	$arResult['SECTIONS'][$arSectionFields['ID']]['SRC'] = CFile::GetPath($arSectionFields['PICTURE']);
	$arResult['SECTIONS'][$arSectionFields['ID']]['DESCRIPTION'] = $arSectionFields['DESCRIPTION'];
	
	// Elements
	$arElementFilter = ["IBLOCK_ID" => CATALOG_BLOCK_ID, "SECTION_ID" => $arSectionFields['ID'], "PROPERTY_MAKE" => $makes];
	$arElementSelect = ["ID", "IBLOCK_ID", "NAME", "IBLOCK_SECTION_ID", "DETAIL_PICTURE", "PROPERTY_*"];
	$resElement = CIBlockElement::GetList([], $arElementFilter, false, false, $arElementSelect);
	while ($obElement = $resElement->GetNextElement()) {
		$arElementFields = $obElement->GetFields();
		$arElementProps = $obElement->GetProperties();
		
		$arResult['SECTIONS'][$arSectionFields['ID']]['ELEMENTS'][$arElementFields["ID"]]["FIELDS"] = $arElementFields;
		$arResult['SECTIONS'][$arSectionFields['ID']]['ELEMENTS'][$arElementFields["ID"]]["PROPS"] = $arElementProps;
		$arResult['SECTIONS'][$arSectionFields['ID']]['MAKES'][] = $arElementProps["MAKE"]["VALUE"];
		$arResult['SECTIONS'][$arSectionFields['ID']]['ELEMENTS_CNT']++;
		
		// Price
		$arResult['SECTIONS'][$arSectionFields['ID']]['ELEMENTS'][$arElementFields["ID"]]["PRICE"] = '-';
		$resPrice = CPrice::GetList([], ["PRODUCT_ID" => $arElementFields['ID'], "CATALOG_GROUP_ID" => 1]);
		if ($arrPrice = $resPrice->Fetch()) {
			$arResult['SECTIONS'][$arSectionFields['ID']]['ELEMENTS'][$arElementFields["ID"]]["PRICE"] = $arrPrice['PRICE'];
		}
	}
	$arResult['SECTIONS'][$arSectionFields['ID']]['MAKES'] = array_unique($arResult['SECTIONS'][$arSectionFields['ID']]['MAKES']);
	
	if (!$arResult['SECTIONS'][$arSectionFields['ID']]['ELEMENTS_CNT']) unset($arResult['SECTIONS'][$arSectionFields['ID']]);
}

// Makes
$makes = [];
$arFilter = ["IBLOCK_ID" => MAKE_BLOCK_ID, "ACTIVE" => "Y"];
$arSelect = ["ID", "IBLOCK_ID", "NAME", "DETAIL_PICTURE"];
$arOrder = ["SORT" => "ASC"];
$res = CIBlockElement::GetList($arOrder, $arFilter, false, false, $arSelect);
while ($ob = $res->GetNextElement()) {
	$arFields = $ob->GetFields();
	
	$arResult['MAKES'][$arFields['ID']]['NAME'] = $arFields['NAME'];
	$arResult['MAKES'][$arFields['ID']]['DETAIL_PICTURE'] = $arFields['DETAIL_PICTURE'];
	$arResult['MAKES'][$arFields['ID']]['SRC'] = CFile::GetPath($arFields['DETAIL_PICTURE']);
}

//echo '<pre>';print_r($arResult);echo '</pre>';
//echo count($arResult);
//exit;

$curDate = date('d M Y');

$defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
$fontDirs = $defaultConfig['fontDir'];

$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
$fontData = $defaultFontConfig['fontdata'];

$mpdf = new \Mpdf\Mpdf([
	'fontDir' => array_merge($fontDirs, [
		$_SERVER['DOCUMENT_ROOT'] . '/local/templates/tooldirect_copy/fonts',
	]),
	'fontdata' => [
		'montserrat' => $fontData + [
				'R' => 'Montserrat-Regular.ttf',
				'B' => 'Montserrat-Bold.ttf',
			]
	],
	'default_font' => 'montserrat'
]);
$mpdf->SetTitle('PDF-Catalog');
$mpdf->SetAuthor('Tooldirect');

$html = '
<style>
	@page {
		margin: 20px;
	}
	page[size="A4"] {
		width: 210mm;
		height: 297mm;
	}
	body {
		background-color: #fff;
		font-family: "montserrat", sans-serif;
		font-size: 10px;
		font-weight: normal;
		line-height: 12px;
		color: #262626;
	}
	.logo {
		width: 165px;
	}
	.logo-img {
		width: 48px;
		height: 40px;
	}
	h1 {
		font-size: 16px;
		font-weight: bold;
		color: #00AC25;
		text-transform: uppercase;
		line-height: 24px;
	}
	page {
		display: block;
		margin: 0 auto;
		size: 210mm 297mm;
	}
	.small {
		font-size: 8px;
		line-height: 12px;
	}
	table {
		border-spacing: 0;
		border-collapse: collapse;
		border: 0;
		width: 100%;
	}
	table td {
		padding: 0;
		vertical-align: top;
	}
	.section-img {
		width: 96px;
		height: 96px;
	}
	.make-logo {
		width: 48px;
		height: 24px;
	}
	.elements {
		width: 100%;
	}
	.elements tr td {
		width: 25px;
		padding: 7px 0;
		border-bottom: 1px solid #DFF5E4;
	}
	.bold {
		font-weight: bold;
	}
	.price {
		color: #00AC25;
	}
</style>';

$html .= '<page size="A4">';
if (!empty($arResult['SECTIONS'])) {
	$i = 1;
	foreach ($arResult['SECTIONS'] as $sectionKey => $sectionValue) {
		$html .= '
			<table class="header">
				<tr>
					<td>
						<img src="' . $sectionValue['SRC'] . '" class="section-img">
						<br>
						<div>
							<span>' . $curDate . '</span>
						</div>
					</td>
					<td>
						<br>
						<h1><span style="color: #262626;">' . $i . '</span> ' . $sectionValue['NAME'] . '</h1>
						<br>
						<div>
							' . $sectionValue['DESCRIPTION'] . '
						</div>
						<br>
						<div>';
		if (!empty($sectionValue['MAKES'])) {
			foreach ($sectionValue['MAKES'] as $makeValue) {
				$html .= '<img src="' . $arResult['MAKES'][$makeValue]['SRC'] . '" class="make-logo">';
			}
		}
		$html .= '
						</div>
					</td>
					<td>
						<img src="/local/templates/tooldirect_copy/images/logo-pdf.png" alt="" class="img-logo">
					</td>
				</tr>
			</table>';
		
		switch ($type) {
			case 'standart':
				$firstColumnElementsCount = round($sectionValue['ELEMENTS_CNT'] / 2);
				$secondColumnElementsCount = $sectionValue['ELEMENTS_CNT'] - $firstColumnElementsCount;
				
				//$html .= $sectionValue['ELEMENTS_CNT'].' - '.$firstColumnElementsCount . ' - ' . $secondColumnElementsCount;
				
				$html .= '<table><tr><td style="width: 49%;">';
				
				if ($firstColumnElementsCount) {
					$html .= '<table class="elements">';
					if (!empty($sectionValue['ELEMENTS'])) {
						$html .= '
					<tr>
						<td class="bold">Артикул</td>
					';
						foreach ($sectionParams[$sectionValue["IBLOCK_SECTION_ID"]]['params'] as $param) {
							$html .= '<td class="bold">';
							if (in_array($param, ['CUTTING_TYPE','RH_LH','TEETH_TYPE','RN','LENGTH','WIDTH','HEIGHT'])) {
								$html .= $properties[$param];
							} else {
								$html .= $param;
							}
							$html .= '</td>';
						}
						$html .= '
						<td class="bold">Цена</td>
					</tr>';
						$j = 1;
						foreach ($sectionValue['ELEMENTS'] as $elementKey => $elementValue) {
							$html .= '
						<tr>
							<td>' . $elementValue['PROPS']['ARTICLE']['VALUE'] . '</td>
						';
							foreach ($sectionParams[$sectionValue["IBLOCK_SECTION_ID"]]['params'] as $param) {
								$html .= '<td>';
								if ($elementValue['PROPS'][$param]['VALUE']) {
									$html .= $elementValue['PROPS'][$param]['VALUE'];
								} else {
									$html .= '-';
								}
								$html .= '</td>';
							}
							$html .= '
							<td><span class="price">' . number_format($elementValue['PRICE'], 0, '.', '&nbsp;') . '&nbsp;<span>&#8381;</span></span></td>
						</tr>';
							$j++;
							if ($j > $firstColumnElementsCount) break;
						}
					}
					$html .= '</table>';
				}
				
				$html .= '</td>';
				$html .= '<td style="width: 2%;"></td>';
				$html .= '<td style="width: 49%;">';
				
				if ($secondColumnElementsCount) {
					$html .= '<table class="elements">';
					if (!empty($sectionValue['ELEMENTS'])) {
						$html .= '
					<tr>
						<td class="bold">Артикул</td>
					';
						foreach ($sectionParams[$sectionValue["IBLOCK_SECTION_ID"]]['params'] as $param) {
							$html .= '<td class="bold">';
							if (in_array($param, ['CUTTING_TYPE','RH_LH','TEETH_TYPE','RN','LENGTH','WIDTH','HEIGHT'])) {
								$html .= $properties[$param];
							} else {
								$html .= $param;
							}
							$html .= '</td>';
						}
						$html .= '
						<td class="bold">Цена</td>
					</tr>';
						$j = 1;
						foreach ($sectionValue['ELEMENTS'] as $elementKey => $elementValue) {
							if ($j <= $firstColumnElementsCount) {
								$j++;
								continue;
							}
							$html .= '
						<tr>
							<td>' . $elementValue['PROPS']['ARTICLE']['VALUE'] . '</td>
						';
							foreach ($sectionParams[$sectionValue["IBLOCK_SECTION_ID"]]['params'] as $param) {
								$html .= '<td>';
								if ($elementValue['PROPS'][$param]['VALUE']) {
									$html .= $elementValue['PROPS'][$param]['VALUE'];
								} else {
									$html .= '-';
								}
								$html .= '</td>';
							}
							$html .= '
							<td><span class="price">' . number_format($elementValue['PRICE'], 0, '.', '&nbsp;') . '&nbsp;<span>&#8381;</span></span></td>
						</tr>';
						}
					}
					$html .= '</table>';
				}
				
				$html .= '</td></tr></table>';
			break;
			case 'extended':
			break;
			default:
		}
		
		$i++;
	}
}
$html .= '</page>';

$footer = '
	<table style="margin: 0 40px;width: 100%;">
		<tr>
			<td colspan="2"><hr style="color: #DFF5E4;"></td>
		</tr>
		<tr>
			<td>
				<span style="font-size:8px;color: #262626;">11111</span>
			</td>
			<td nowrap style="text-align: right;">
				<span style="font-size: 9px;color: #00AC25">tooldirect.ru</span>
			</td>
		</tr>
	</table>
';
$mpdf->WriteHTML($html);
$mpdf->setHtmlFooter($footer);
//$mpdf->Output();
$mpdf->Output('Tooldirect PDF-Catalog.pdf', 'I');
?>

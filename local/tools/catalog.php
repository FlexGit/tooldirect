<?php
ini_set("pcre.backtrack_limit", "1000000");
setlocale(LC_ALL, 'ru_RU', 'ru_RU.UTF-8', 'ru', 'russian');

require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
include $_SERVER['DOCUMENT_ROOT'] . '/local/php_interface/lib/phpqrcode/qrlib.php';
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

CModule::IncludeModule("iblock");
CModule::IncludeModule("catalog");
CModule::IncludeModule('main');
CModule::IncludeModule('highloadblock');

define("YOUTUBE_VIDEO_PATH", "https://www.youtube.com/watch?v=");

$sectionsGlobal = [
	7328 => ['D', 'I', 'L', 'S'], // пильные диски
	7118 => ['D', 'I', 'L', 'S'], // фрезы концевы
	7268 => ['D', 'I', 'L', 'S'], // фрезы спиральные
	7305 => ['D', 'I', 'L', 'S'], // граверы
	7255 => ['D', 'I', 'L', 'S'], // фрезы со сменными ножами
	7235 => ['D', 'I', 'L', 'S'], // фрезы алмазные
	7246 => ['D', 'I', 'L', 'S'], // фрезы насадные
	7359 => ['D', 'I', 'L', 'S'], // сверла и зенкеры
	7322 => ['D', 'I', 'L', 'S'], // патроны и цанги
	7310 => ['D', 'I', 'L', 'S'], // ножи и бланкеты
	7373 => ['D', 'I', 'L', 'S'], // струбцины
	7353 => ['D', 'I', 'L', 'S'], // столярные приспособления
	7370 => ['D', 'I', 'L', 'S'], // столы, верстаки, тиски
	7292 => ['D', 'I', 'L', 'S'], // аксессуары
];

$typeFilter = $_REQUEST['type'];
$makesFilter = (array)$_REQUEST['makes'];
$sectionsFilter = (array)$_REQUEST['sections'];

if (!empty($sectionsFilter) || !empty($makesFilter)) {
	// список производителей
	$makes = [];
	$arFilter = ["IBLOCK_ID" => MAKE_BLOCK_ID, "ACTIVE" => "Y"];
	$arSelect = ["ID", "IBLOCK_ID", "NAME", "DETAIL_PICTURE"];
	$res = CIBlockElement::GetList([], $arFilter, false, false, $arSelect);
	while ($ob = $res->GetNextElement()) {
		$arFields = $ob->GetFields();
		
		$makes[$arFields["ID"]]["NAME"] = $arFields["NAME"];
		$makes[$arFields["ID"]]["DETAIL_PICTURE"] = $arFields["DETAIL_PICTURE"];
	}

	$arFilter = ["IBLOCK_ID" => CATALOG_BLOCK_ID];
	if (!empty($sectionsFilter)) {
		$arFilter["IBLOCK_SECTION_ID"] = $sectionsFilter;
	}
	if (!empty($makesFilter)) {
		$arFilter["PROPERTY_MAKE"] = $makesFilter;
	}
	
	// список подразделов
	$arr = [];
	$n=0;
	$arFilter = ["IBLOCK_ID" => CATALOG_BLOCK_ID, "ACTIVE" => "Y", "SECTION_ID" => $sectionsFilter, "UF_SEO_SECTION" => 0, "UF_USER_SECTION" => 1, "UF_USER_EXT_SECTION" => 0];
	$arSelect = ["ID", "NAME", "IBLOCK_ID", "IBLOCK_SECTION_ID", "DETAIL_TEXT", "DETAIL_PICTURE", "UF_SEO_SECTION", "UF_PARENT_SECTION"];
	$arOrder = ["SORT" => "ASC"];
	$rsSections = CIBlockSection::GetList($arOrder, $arFilter, false, $arSelect);
	while ($arSections = $rsSections->Fetch()) {
		$arr[$arSections["IBLOCK_SECTION_ID"]]["SECTIONS"][$arSections["ID"]]["NAME"] = $arSections["NAME"];
		$arr[$arSections["IBLOCK_SECTION_ID"]]["SECTIONS"][$arSections["ID"]]["DETAIL_TEXT"] = $arSections["DETAIL_TEXT"];
		$arr[$arSections["IBLOCK_SECTION_ID"]]["SECTIONS"][$arSections["ID"]]["DETAIL_PICTURE"] = $arSections["DETAIL_PICTURE"];
		$arr[$arSections["IBLOCK_SECTION_ID"]]["SECTIONS"][$arSections["ID"]]["ELEMENTS"] = [];
		
		// список позиций
		$arFilter = ["IBLOCK_ID" => CATALOG_BLOCK_ID, "ACTIVE" => "Y", "SECTION_ID" => $arSections["ID"]];
		$arSelect = ["ID", "IBLOCK_ID", "NAME", "IBLOCK_SECTION_ID", "SECTION_ID", "PROPERTY_*"];
		$res = CIBlockElement::GetList([], $arFilter, false, false, $arSelect);
		while ($ob = $res->GetNextElement()) {
			$arFields = $ob->GetFields();
			$arProps = $ob->GetProperties();
			
			$arr[$arSections["IBLOCK_SECTION_ID"]]["SECTIONS"][$arSections["ID"]]["ELEMENTS"][$arFields["ID"]]["NAME"] = $arFields["NAME"];
			$arr[$arSections["IBLOCK_SECTION_ID"]]["SECTIONS"][$arSections["ID"]]["ELEMENTS"][$arFields["ID"]]["ARTICLE"] = $arProps["ARTICLE"]["VALUE"];
			$arr[$arSections["IBLOCK_SECTION_ID"]]["SECTIONS"][$arSections["ID"]]["ELEMENTS"][$arFields["ID"]]["MAKE"] = $arProps["MAKE"]["VALUE"];
			
			if (!empty($sectionsGlobal[$arSections["IBLOCK_SECTION_ID"]])) {
				foreach ($sectionsGlobal[$arSections["IBLOCK_SECTION_ID"]] as $param) {
					$arr[$arSections["IBLOCK_SECTION_ID"]]["SECTIONS"][$arSections["ID"]]["ELEMENTS"][$arFields["ID"]][$param] = $arProps[$param]["VALUE"];
				}
			}
			
			if (!empty($arProps['MORE_PHOTO']['VALUE'])) {
				$i = 0;
				foreach ($arProps['MORE_PHOTO']['VALUE'] as $k => $v) {
					$arr[$arSections["IBLOCK_SECTION_ID"]]["SECTIONS"][$arSections["ID"]]["ELEMENTS"][$arFields["ID"]]["PHOTOS"][$i] = CFile::ResizeImageGet($v, ['width' => 56, 'height' => '56'], BX_RESIZE_IMAGE_EXACT, true, arWaterMark);
					$i++;
					if ($i == 4) break;
				}
			}
			
			$youtubeVideoIds = explode(',', $arProps['YOUTUBE_VIDEO_ID']['VALUE']);
			$videoId = $youtubeVideoIds[0];
			
			if (!empty($arProps['YOUTUBE_VIDEO_ID']['VALUE']) && !file_exists($_SERVER['DOCUMENT_ROOT'] . '/upload/qrcode/qrcode-' . $arFields['ID'] . '.png')) {
				QRcode::png(YOUTUBE_VIDEO_PATH . $videoId, $_SERVER['DOCUMENT_ROOT'] . '/upload/qrcode/qrcode-' . $arFields['ID'] . '.png', "L", 3, 3);
			}
			
			$price = 0;
			$resPrice = CPrice::GetList([], ["PRODUCT_ID" => $arFields['ID'], "CATALOG_GROUP_ID" => 1]);
			if ($arrPrice = $resPrice->Fetch()) {
				$price = $arrPrice['PRICE'];
			}
			$arr[$arSections["IBLOCK_SECTION_ID"]]["SECTIONS"][$arSections["ID"]]["ELEMENTS"][$arFields["ID"]]["PRICE"] = $price;
			
			$n++;
			
			//if ($n == 2)
				break;
		}
	}
	
	/*echo '<pre>';
	print_r($arr);
	echo '</pre>';
	/*exit;*/
	
	if (!empty($arr)) {
		$date = date("Y-m-d");
		
		$html = '
			<style>
				@page {
					margin: 48px 64px;
				}
				page[size="A4"] {
					width: 210mm;
					height: 297mm;
				}
				body {
					background-color: #fff;
					font-family: "montserrat", sans-serif;
					font-size: 12px;
					font-weight: normal;
					line-height: 21px;
					color: #232323;
				}
				.logo {
					width: 165px;
				}
				.logo-img {
					width: 130px;
				}
				h1 {
					font-size: 16px;
					font-weight: bold;
					color: #00ac25;
					text-transform: uppercase;
					line-height: 24px;
				}
				h2 {
					font-size: 20px;
					font-weight: normal;
					color: #262626;
					line-height: 31px;
				}
				page {
					display: block;
					size: 210mm 297mm;
				}
				.small {
					margin-top: 6px;
					font-size: 14px;
					line-height: 18px;
				}
				.extra-small {
					font-size: 10px;
					line-height: 14px;
				}
				.gray {
					color: #757575;
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
				table.header {
				}
				table.header td {
				}
				table.catalog {
					margin: 30px 0;
				}
				table.catalog thead th {
					font-weight: bold;
				}
				table.catalog tbody tr td {
					border-bottom: 1px solid #DFF5E4;
					vertical-align: middle;
				}
				.border {
					border: 1px solid #DFF5E4;
				}
				.img-logo {
					width: 54px;
				}
				.line {
					width: 100%;
					height: 1px;
					margin: 20px 0 5px;
					background-color: #50287D;
				}
				.date span {
					font-size: 8px;
					color: #262626;
				}
			</style>
			<page size="A4">
			';
			$i = 1;
			foreach ($sectionsFilter as $sectionId) {
				foreach ($arr[$sectionId]["SECTIONS"] as $subSectionId => $subSection) {
					/*echo '<pre>';
					print_r($subSection);
					echo '</pre>';
					exit;*/
					
					$resizeFile = CFile::ResizeImageGet($subSection['DETAIL_PICTURE'], ['width' => 96, 'height' => 96], BX_RESIZE_IMAGE_EXACT, true/*, arWaterMark*/);
					
					$html .= '
					<table class="header">
						<tr>
							<td style="width: 20%;">
								<table>
									<tr>
										<td style="text-align: center;padding: 0 0 10px 0;">
											<img src="' . $resizeFile['src'] . '" width="' . $resizeFile['width'] . '" height="' . $resizeFile['height'] . '">
										</td>
									</tr>
									<tr>
										<td style="text-align: center;background-color: #DFF5E4;padding: 5px 10px;font-size: 10px;">
											' . mb_strtolower(strftime('%d %B %Y', strtotime($date))) . '
										</td>
									</tr>
								</table>
							</td>
							<td style="width: 65%;padding-left: 20px;">
								<h1><span style="color: #262626;">' . $i . '</span> ' . $subSection['NAME'] . '</h1>
								<span>' . $subSection['DETAIL_TEXT'] . '</span>
							</td>
							<td style="width: 15%;text-align: right;">
								<img src="' . SITE_TEMPLATE_PATH . '/images/logo-pdf.png" alt="" class="img-logo">
							</td>
						</tr>
					</table>
					<table class="catalog">
						<thead>
							<tr>
								<th style="text-align: center;">Артикул/Цена</th>
								';
								foreach ($sectionsGlobal[$sectionId] as $param) {
									$html .= '<th>' . $param . '</th>';
								}
								$html .= '
								<th></th>
							</tr>
						</thead>
						<tbody>
						';
						foreach ($subSection["ELEMENTS"] as $elementId => $element) {
							$html .= '<tr>';
							$html .= '<td>' . $element["ARTICLE"] . '<br><span style="color: #00AC25;">' . number_format($element["PRICE"], 0, '.', ' ') . '&nbsp;<span>&#8381;</span></span> </td>';
							foreach ($sectionsGlobal[$sectionId] as $param) {
								$html .= '<td>' . $element[$param] . '</td>';
							}
							$html .= '<td>';
							if (!empty($element["PHOTOS"])) {
								foreach ($element["PHOTOS"] as $photo) {
									$html .= '<img src="' . $photo['src'] . '" width="' . $photo['width'] . '" height="' . $photo['height'] . '" style="margin-left: 2px;">';
								}
							}
							if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/upload/qrcode/qrcode-' . $elementId . '.png')) {
								$html .= '<img src="/upload/qrcode/qrcode-' . $elementId . '.png">';
							}
							$html .= '</td>';
							$html .= '</tr>';
						}
						$html .= '
						</tbody>
					</table>
					<pagebreak>
				';
					$i++;
				}
			}
		$html .= '
			</page>
			';
		
		$footer = '
		<table style="margin: 0 40px;width: 100%;">
			<tr>
				<td colspan="2"><hr style="color: #DFF5E4;"></td>
			</tr>
			<tr>
				<td nowrap style="text-align: right;">
					<span style="font-size: 9px;color: #00AC25">tooldirect.ru</span>
				</td>
			</tr>
		</table>
		';
	}
	
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
		'default_font' => 'montserrat',
	]);
	$mpdf->SetTitle('Tooldirect Pdf-каталог от ' . $date);
	$mpdf->SetAuthor('Tooldirect');
	$mpdf->WriteHTML($html);
	$mpdf->SetDisplayMode('fullpage');
	$mpdf->setHtmlFooter($footer);
	$mpdf->Output('Tooldirect Catalog ' . $date . '.pdf', 'I');
}

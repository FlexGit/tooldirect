<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
include $_SERVER['DOCUMENT_ROOT'] . '/local/php_interface/lib/phpqrcode/qrlib.php';
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

CModule::IncludeModule("iblock");
CModule::IncludeModule("catalog");
CModule::IncludeModule('main');
CModule::IncludeModule('highloadblock');

$disabledProps = [
	'NEW',
	'MORE_PHOTO',
	'PROMO',
	'VIDEO',
	'SHOW_MAIN',
	'SHOW_MAIN_SUBSECTION',
	'MATERIAL',
	'YOUTUBE_LINK',
	'DRAWING',
];

if (intval($_REQUEST['id'])) {
	$arFilter = ["IBLOCK_ID" => CATALOG_BLOCK_ID, "ID" => intval($_REQUEST['id'])];
	$arSelect = ["ID", "IBLOCK_ID", "NAME", "IBLOCK_SECTION_ID", "DETAIL_PICTURE", "PROPERTY_*"];
	$res = CIBlockElement::GetList([], $arFilter, false, false, $arSelect);
	if ($ob = $res->GetNextElement()) {
		$arFields = $ob->GetFields();
		$arProps = $ob->GetProperties();
		
		if (!empty($arProps['YOUTUBE_LINK']['VALUE']) && !file_exists($_SERVER['DOCUMENT_ROOT'] . '/upload/qrcode/qrcode-' . $arFields['ID'] . '.png')) {
			QRcode::png($arProps['YOUTUBE_LINK']['VALUE'], $_SERVER['DOCUMENT_ROOT'] . '/upload/qrcode/qrcode-' . $arFields['ID'] . '.png', "L", 3, 3);
		}
		
		//echo '<pre>';print_r($arFields);echo '</pre>';
		//echo '<pre>';print_r($arProps['MATERIAL']);echo '</pre>';
		//exit;
		
		$resSection = CIBlockSection::GetByID($arFields['IBLOCK_SECTION_ID']);
		$arSection = $resSection->GetNext();
		
		$resParentSection = CIBlockSection::GetByID($arSection['IBLOCK_SECTION_ID']);
		$arParentSection = $resParentSection->GetNext();
		
		if (!empty($arParentSection['NAME']))
			$arSection['NAME'] = $arParentSection['NAME'];
		
		$price = 0;
		$resPrice = CPrice::GetList([], ["PRODUCT_ID" => $arFields['ID'], "CATALOG_GROUP_ID" => 1]);
		if ($arrPrice = $resPrice->Fetch()) {
			$price = $arrPrice['PRICE'];
		}
	}
	
	if (!empty($arFields)) {
		
		$html = '
	<style>
		@page {
			margin: 0;
		}
		page[size="A4"] {
			width: 210mm;
			height: 297mm;
		}
		body {
			background-color: #fff;
			font-family: "montserrat", sans-serif;
			font-size: 16px;
			font-weight: normal;
			line-height: 21px;
			color: #666666;
		}
		.logo {
			width: 165px;
		}
		.logo-img {
			width: 130px;
		}
		h1 {
			font-size: 32px;
			font-weight: bold;
			color: #00AC25;
			text-transform: uppercase;
			line-height: 31px;
		}
		h2 {
			font-size: 20px;
			font-weight: normal;
			color: #262626;
			line-height: 31px;
		}
		page {
			display: block;
			margin: 0 auto;
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
			background: #DFF5E4;
		}
		table.header td {
			padding: 40px;
		}
		.border {
			border: 1px solid #DFF5E4;
		}
		.img-logo {
			width: 110px;
		}
		.line {
			width: 100%;
			height: 1px;
			margin: 20px 0 5px;
			background-color: #50287D;
		}
	</style>
	<page size="A4">
		<table class="header">
			<tr>
				<td>
					<br>
					<h1>' . $arSection['NAME'] . '</h1>
					<br>
					<h2>' . $arFields['NAME'] . '</h2>
				</td>
				<td>
					<img src="' . SITE_TEMPLATE_PATH . '/images/logo-pdf.png" alt="" class="img-logo">
				</td>
			</tr>
		</table>
		<table style="width: 90%;margin: 0 auto;">
			<tr>
				<td class="border" style="padding-right: 0;width: 341px;">';
		if (!empty($arFields['DETAIL_PICTURE'])) {
			$resizeFile = CFile::ResizeImageGet($arFields['DETAIL_PICTURE'], ['width' => 338, 'height' => '338'], BX_RESIZE_IMAGE_EXACT, true, arWaterMark);
			$html .= '<img src="' . $resizeFile['src'] . '" width="' . $resizeFile['width'] . '" height="' . $resizeFile['height'] . '">';
		}
		else {
			$html .= '<img src="' . SITE_TEMPLATE_PATH . '/images/no_photo.png" width="338" height="338">';
		}
		$html .= '
				</td>
				<td style="width: 12px;"></td>
				<td style="padding-left: 0;width: 352px;">';
		if (!empty($arProps['MORE_PHOTO']['VALUE'])) {
			$i = 1;
			foreach ($arProps['MORE_PHOTO']['VALUE'] as $k => $v) {
				$resizeFile = CFile::ResizeImageGet($v, ['width' => 112, 'height' => '111'], BX_RESIZE_IMAGE_EXACT, true, arWaterMark);
				if ($i == 1) {
					$img_style = "margin: 0 10px 0 0;";
				}
				else if ($i == 2) {
					$img_style = "margin: 0 10px 0 0;";
				}
				else if ($i == 3) {
					$img_style = "margin: 0 0 0 0;";
				}
				else if ($i == 4) {
					$img_style = "margin: 10px 10px 0 0;";
				}
				else if ($i == 5) {
					$img_style = "margin: 10px 10px 0 0;";
				}
				else if ($i == 6) {
					$img_style = "margin: 10px 0 0 0;";
				}
				else if ($i == 7) {
					$img_style = "margin: 10px 10px 0 0;";
				}
				else if ($i == 8) {
					$img_style = "margin: 10px 10px 0 0;";
				}
				else if ($i == 9) {
					$img_style = "margin: 10px 0 0 0;";
				}
				$html .= '<img src="' . $resizeFile['src'] . '" width="' . $resizeFile['width'] . '" height="' . $resizeFile['height'] . '" style="' . $img_style . '">';
				if ($i == 9) break;
				$i++;
			}
		}
		$html .= '
				</td>
			</tr>
			<tr>
				<td colspan="3" style="height: 12px;"></td>
			</tr>
			<tr>
				<td class="border">';
					if (!empty($arProps['YOUTUBE_LINK']['VALUE'])) {
						$html .= '
						<table>
							<tr>
								<td>
									<img src="/upload/qrcode/qrcode-' . $arFields['ID'] . '.png">
								</td>
								<td style="vertical-align: middle;">
									<table>
										<tr>
											<td style="height: 25px;font-size: 12px;color: #262626;line-height: 1.4em;">
												Сняли товар на видео
											</td>
										</tr>
										<tr>
											<td style="font-size: 10px;color: #262626;line-height: 1.4em;">
												Просканируйте QR-код своим телефоном, чтобы увидеть короткое видео с товаром
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>';
					}
					$html .= '
				</td>
				<td style="width: 12px;"></td>
				<td class="border" bgcolor="#DFF5E4" style="padding: 5px 0 0 2px;">
					<table>
						<tr>
							<td style="padding: 5px 10px 3px 15px;width: 50%;"><h1>';
		$html .= number_format($price, 0, '.', ' ') . '&nbsp;<span>&#8381;</span>';
		$html .= '
							</h1></td>
							<td rowspan="2" style="padding: 5px 10px 10px 15px;vertical-align: middle;color: #262626;font-size: 10px;line-height: 1.4em;">
								Актуальную цену товара уточняйте на сайте<br>при оформлении заказа
							</td>
						</tr>
						<tr>
							<td style="padding: 0 20px 10px 15px;color: #262626;font-size: 10px;line-height: 1.4em;">
								Цена указана<br>за единицу товара
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td style="padding-top: 15px;">';
		if (!empty($arProps)) {
			foreach ($arProps as $code => $property) {
				if (empty($property['VALUE'])) continue;
				if (in_array($code, $disabledProps)) continue;
				$html .= '<div style="font-size: 12px;"><br>
						<span>' . $property['NAME'] . ':</span> ';
				if (is_array($property['VALUE']))
					$html .= '<span style="font-weight: bold;color: #262626;">' . implode(' / ', $property['VALUE']) . '</span>';
				else
					$html .= '<span style="font-weight: bold;color: #262626;">' . strip_tags($property['VALUE']) . '</span>';
				$html .= '</div>';
			}
		}
		
		$html .= '</td><td></td><td style="padding-top: 15px;">';
		if (!empty($arProps['MATERIAL']['VALUE'])) {
			$html .= '<div style="font-size: 12px;"><br>
					<span>' . $arProps['MATERIAL']['NAME'] . ':</span><br>';
			$html .= '<span style="font-weight: bold;color: #262626;">' . implode(' / ', $arProps['MATERIAL']['VALUE']) . '</span>';
			$html .= '</div>';
		}
		$html .= '</td>
			</tr>
		</table>';
		
		$html .= '</page>';
		
		$defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
		$fontDirs = $defaultConfig['fontDir'];
		
		$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
		$fontData = $defaultFontConfig['fontdata'];
		
		$mpdf = new \Mpdf\Mpdf([
			'fontDir' => array_merge($fontDirs, [
				$_SERVER['DOCUMENT_ROOT'] . SITE_TEMPLATE_PATH . '/fonts',
			]),
			'fontdata' => [
				'montserrat' => $fontData + [
						'R' => 'Montserrat-Regular.ttf',
						'B' => 'Montserrat-Bold.ttf',
					]
			],
			'default_font' => 'montserrat'
		]);
		$mpdf->SetTitle('PDF: ' . $arFields['NAME']);
		$mpdf->SetAuthor('Tooldirect');
		$footer = '
		<table style="margin: 0 40px;width: 100%;">
			<tr>
				<td colspan="2"><hr style="color: #DFF5E4;"></td>
			</tr>
			<tr>
				<td>
					<span style="font-size:8px;color: #262626;">' . $arFields['NAME'] . '</span>
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
		$mpdf->Output($arSection['NAME'] . ' ' . $arProps['ARTICLE']['VALUE'] . '.pdf', 'I');
	}
}
?>

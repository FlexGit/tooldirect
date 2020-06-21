<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

CModule::IncludeModule("iblock");
CModule::IncludeModule('main');

if (CModule::IncludeModule("nkhost.phpexcel")) {
	require_once($PHPEXCELPATH . '/PHPExcel.php');
	require_once($PHPEXCELPATH . '/PHPExcel/Writer/Excel5.php');
	
	$xls = new PHPExcel();
	$xls->setActiveSheetIndex(0);
	$sheet = $xls->getActiveSheet();
	$sheet->setTitle('Товары');
	
	$arr = [];
	$arFilter = ["IBLOCK_ID" => CATALOG_BLOCK_ID/*, "ID" => 5281*/];
	$arSelect = ["ID", "NAME", "IBLOCK_ID", "SECTION_ID", "DETAIL_PAGE_URL", "PROPERTY_*"];
	$rsElements = CIBlockElement::GetList([], $arFilter, false, false, $arSelect);
	while ($arElements = $rsElements->GetNextElement()) {
		$arFields = $arElements->GetFields();
		$arProps = $arElements->GetProperties();
		
		$sectionIDs = [];
		$rsSectionIDs = CIBlockElement::GetElementGroups($arFields["ID"]);
		while($arSectionIDs = $rsSectionIDs->Fetch()) {
			$sectionIDs[] = $arSectionIDs["ID"];
		}
		
		//print_r($sectionIDs);
		
		$sectionUserExt = $sectionUser = $sectionSeo = [];
		$rsSections = CIBlockSection::GetList([],["IBLOCK_ID" => CATALOG_BLOCK_ID, "ID" => $sectionIDs], false, ["NAME", "UF_*"], false);
		while ($arSections = $rsSections->GetNextElement()) {
			//echo '<pre>'; print_r($arSections->fields); echo '</pre>';
			
			if ($arSections->fields["UF_USER_EXT_SECTION"]) {
				$sectionUserExt[] = $arSections->fields["NAME"];
			}
			if ($arSections->fields["UF_USER_SECTION"]) {
				$sectionUser[] = $arSections->fields["NAME"];
			}
			if ($arSections->fields["UF_SEO_SECTION"]) {
				$sectionSeo[] = $arSections->fields["NAME"];
			}
		}
		
		$arr[$arProps['ARTICLE']['VALUE']]["NAME"] = $arFields['NAME'];
		$arr[$arProps['ARTICLE']['VALUE']]["SECTION_USER"] = implode(', ', $sectionUser);
		$arr[$arProps['ARTICLE']['VALUE']]["SECTION_USER_EXT"] = implode(', ', $sectionUserExt);
		$arr[$arProps['ARTICLE']['VALUE']]["SECTION_SEO"] = implode(', ', $sectionSeo);
		$arr[$arProps['ARTICLE']['VALUE']]["DETAIL_PAGE_URL"] = 'https://' . $_SERVER['SERVER_NAME'] . $arFields['DETAIL_PAGE_URL'];
	}
	
	//echo '<pre>'; print_r($arr); echo '</pre>';
	//exit;
	
	if (!empty($arr)) {
		$i = 1;
		$sheet->setCellValueExplicit('A'.$i, 'Артикул', PHPExcel_Cell_DataType::TYPE_STRING);
		$sheet->setCellValueExplicit('B'.$i, 'Наименование', PHPExcel_Cell_DataType::TYPE_STRING);
		$sheet->setCellValueExplicit('C'.$i, 'Для пользователя', PHPExcel_Cell_DataType::TYPE_STRING);
		$sheet->setCellValueExplicit('D'.$i, 'Для пользователя (расширенное)', PHPExcel_Cell_DataType::TYPE_STRING);
		$sheet->setCellValueExplicit('E'.$i, 'Для SEO', PHPExcel_Cell_DataType::TYPE_STRING);
		$sheet->setCellValueExplicit('F'.$i, 'Адрес', PHPExcel_Cell_DataType::TYPE_STRING);
		$i++;
		foreach ($arr as $k => $v) {
			$sheet->setCellValueExplicit('A'.$i, $k, PHPExcel_Cell_DataType::TYPE_STRING);
			$sheet->setCellValueExplicit('B'.$i, $v['NAME'], PHPExcel_Cell_DataType::TYPE_STRING);
			$sheet->setCellValueExplicit('C'.$i, $v['SECTION_USER'], PHPExcel_Cell_DataType::TYPE_STRING);
			$sheet->setCellValueExplicit('D'.$i, $v['SECTION_USER_EXT'], PHPExcel_Cell_DataType::TYPE_STRING);
			$sheet->setCellValueExplicit('E'.$i, $v['SECTION_SEO'], PHPExcel_Cell_DataType::TYPE_STRING);
			$sheet->setCellValueExplicit('F'.$i, $v['DETAIL_PAGE_URL'], PHPExcel_Cell_DataType::TYPE_STRING);
			$i++;
		}
	}
	
	header("Expires: Mon, 1 Apr 1974 05:00:00 GMT");
	header("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
	header("Cache-Control: no-cache, must-revalidate");
	header("Pragma: no-cache");
	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=product_section_".date("YmdHis").".xls");
	
	$objWriter = new PHPExcel_Writer_Excel5($xls);
	$objWriter->save('php://output');
}

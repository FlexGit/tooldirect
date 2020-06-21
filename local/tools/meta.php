<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

CModule::IncludeModule("iblock");
CModule::IncludeModule('main');

function normalizeName($name) {
	$name = htmlentities($name, null, 'UTF-8');
	$name = str_replace("&nbsp;", " ", $name);
	$name = str_replace("&amp;", "", $name);
	$name = str_replace("amp;", "", $name);
	$name = str_replace("quot;", "", $name);
	$name = str_replace("&laquo;", "", $name);
	$name = str_replace("&raquo;", "", $name);
	$name = str_replace("\"", "", $name);
	$name = str_replace("'", "", $name);
	$name = str_replace(",", " ", $name);
	$name = str_replace("   ", " ", $name);
	$name = str_replace("  ", " ", $name);
	
	return $name;
}

if (CModule::IncludeModule("nkhost.phpexcel")) {
	require_once($PHPEXCELPATH . '/PHPExcel.php');
	require_once($PHPEXCELPATH . '/PHPExcel/Writer/Excel5.php');
	
	$xls = new PHPExcel();
	$xls->setActiveSheetIndex(0);
	$sheet = $xls->getActiveSheet();
	$sheet->setTitle('Товары');
	
	$arr = [];
	$i = 0;
	$arFilter = ["IBLOCK_ID" => CATALOG_BLOCK_ID];
	$arSelect = ["ID", "NAME", "IBLOCK_ID", "ACTIVE", "DETAIL_PAGE_URL", "PROPERTY_*"];
	$rsElements = CIBlockElement::GetList([], $arFilter, false, false, $arSelect);
	while ($arElements = $rsElements->GetNextElement()) {
		$arFields = $arElements->GetFields();
		
		$ipropElementTemplates = new \Bitrix\Iblock\InheritedProperty\ElementTemplates(CATALOG_BLOCK_ID, $arFields['ID']);
		$templates = $ipropElementTemplates->findTemplates();
		
		$name = normalizeName($arFields['NAME']);
		
		if (strpos($templates['ELEMENT_META_TITLE']['TEMPLATE'], $name) !== false )
			continue;
		
		$arProps = $arElements->GetProperties();
		
		$arr[$i]['ID'] = $arFields['ID'];
		$arr[$i]['ARTICLE'] = $arProps['ARTICLE']['VALUE'];
		if ($arFields['ACTIVE'] == 'Y')
			$arr[$i]['ACTIVE'] = 'Да';
		else
			$arr[$i]['ACTIVE'] = 'Нет';
		$arr[$i]['NAME'] = $arFields['NAME'];
		$arr[$i]['URL'] = 'https://' . $_SERVER['SERVER_NAME'] . $arFields['DETAIL_PAGE_URL'];
		
		$arr[$i]['META_TITLE'] = $templates['ELEMENT_META_TITLE']['TEMPLATE'];
		$arr[$i]['META_DESCRIPTION'] = $templates['ELEMENT_META_DESCRIPTION']['TEMPLATE'];
		$arr[$i]['META_KEYWORDS'] = $templates['ELEMENT_META_KEYWORDS']['TEMPLATE'];
		
		$i++;
	}
	
	if (!empty($arr)) {
		$i = 1;
		
		$sheet->setCellValueExplicit('A'.$i, 'ID', PHPExcel_Cell_DataType::TYPE_STRING);
		$sheet->setCellValueExplicit('B'.$i, 'ARTICLE', PHPExcel_Cell_DataType::TYPE_STRING);
		$sheet->setCellValueExplicit('C'.$i, 'ACTIVE', PHPExcel_Cell_DataType::TYPE_STRING);
		$sheet->setCellValueExplicit('D'.$i, 'NAME', PHPExcel_Cell_DataType::TYPE_STRING);
		$sheet->setCellValueExplicit('E'.$i, 'URL', PHPExcel_Cell_DataType::TYPE_STRING);
		$sheet->setCellValueExplicit('F'.$i, 'META_TITLE', PHPExcel_Cell_DataType::TYPE_STRING);
		$sheet->setCellValueExplicit('G'.$i, 'META_DESCRIPTION', PHPExcel_Cell_DataType::TYPE_STRING);
		$sheet->setCellValueExplicit('H'.$i, 'META_KEYWORDS', PHPExcel_Cell_DataType::TYPE_STRING);
		$i++;

		foreach ($arr as $k => $v) {
			$sheet->setCellValueExplicit('A'.$i, $v['ID'], PHPExcel_Cell_DataType::TYPE_STRING);
			$sheet->setCellValueExplicit('B'.$i, $v['ARTICLE'], PHPExcel_Cell_DataType::TYPE_STRING);
			$sheet->setCellValueExplicit('C'.$i, $v['ACTIVE'], PHPExcel_Cell_DataType::TYPE_STRING);
			$sheet->setCellValueExplicit('D'.$i, $v['NAME'], PHPExcel_Cell_DataType::TYPE_STRING);
			$sheet->setCellValueExplicit('E'.$i, $v['URL'], PHPExcel_Cell_DataType::TYPE_STRING);
			$sheet->setCellValueExplicit('F'.$i, $v['META_TITLE'], PHPExcel_Cell_DataType::TYPE_STRING);
			$sheet->setCellValueExplicit('G'.$i, $v['META_DESCRIPTION'], PHPExcel_Cell_DataType::TYPE_STRING);
			$sheet->setCellValueExplicit('H'.$i, $v['META_KEYWORDS'], PHPExcel_Cell_DataType::TYPE_STRING);
			$i++;
		}
	}
	
	$xls->createSheet();
	$xls->setActiveSheetIndex(1);
	$sheet = $xls->getActiveSheet();
	$sheet->setTitle('Разделы');
	
	$arr = [];
	$i = 0;
	$arFilter = ["IBLOCK_ID" => CATALOG_BLOCK_ID];
	$arSelect = ["ID", "NAME", "IBLOCK_ID", "ACTIVE", "SECTION_PAGE_URL", "UF_SEO_SECTION"];
	$rsElements = CIBlockSection::GetList([], $arFilter, false, $arSelect);
	while ($arElements = $rsElements->GetNextElement()) {
		$arFields = $arElements->GetFields();
		
		$ipropSectionTemplates = new \Bitrix\Iblock\InheritedProperty\SectionTemplates(CATALOG_BLOCK_ID, $arFields['ID']);
		$templates = $ipropSectionTemplates->findTemplates();
		
		$name = normalizeName($arFields['NAME']);
		
		if (strpos($templates['SECTION_META_TITLE']['TEMPLATE'], $name) !== false )
			continue;
		
		$arProps = $arElements->GetProperties();
		
		$arr[$i]['ID'] = $arFields['ID'];
		if ($arFields['ACTIVE'] == 'Y')
			$arr[$i]['ACTIVE'] = 'Да';
		else
			$arr[$i]['ACTIVE'] = 'Нет';
		$arr[$i]['NAME'] = $arFields['NAME'];
		if ($arFields['UF_SEO_SECTION'])
			$arr[$i]['SEO'] = 'Да';
		else
			$arr[$i]['SEO'] = 'Нет';
		$arr[$i]['URL'] = 'https://' . $_SERVER['SERVER_NAME'] . $arFields['SECTION_PAGE_URL'];
		
		$arr[$i]['META_TITLE'] = $templates['SECTION_META_TITLE']['TEMPLATE'];
		$arr[$i]['META_DESCRIPTION'] = $templates['SECTION_META_DESCRIPTION']['TEMPLATE'];
		$arr[$i]['META_KEYWORDS'] = $templates['SECTION_META_KEYWORDS']['TEMPLATE'];
		
		$i++;
	}
	
	if (!empty($arr)) {
		$i = 1;
		
		$sheet->setCellValueExplicit('A'.$i, 'ID', PHPExcel_Cell_DataType::TYPE_STRING);
		$sheet->setCellValueExplicit('B'.$i, 'ACTIVE', PHPExcel_Cell_DataType::TYPE_STRING);
		$sheet->setCellValueExplicit('C'.$i, 'NAME', PHPExcel_Cell_DataType::TYPE_STRING);
		$sheet->setCellValueExplicit('D'.$i, 'SEO', PHPExcel_Cell_DataType::TYPE_STRING);
		$sheet->setCellValueExplicit('E'.$i, 'URL', PHPExcel_Cell_DataType::TYPE_STRING);
		$sheet->setCellValueExplicit('F'.$i, 'META_TITLE', PHPExcel_Cell_DataType::TYPE_STRING);
		$sheet->setCellValueExplicit('G'.$i, 'META_DESCRIPTION', PHPExcel_Cell_DataType::TYPE_STRING);
		$sheet->setCellValueExplicit('H'.$i, 'META_KEYWORDS', PHPExcel_Cell_DataType::TYPE_STRING);
		$i++;

		foreach ($arr as $k => $v) {
			$sheet->setCellValueExplicit('A'.$i, $v['ID'], PHPExcel_Cell_DataType::TYPE_STRING);
			$sheet->setCellValueExplicit('B'.$i, $v['ACTIVE'], PHPExcel_Cell_DataType::TYPE_STRING);
			$sheet->setCellValueExplicit('C'.$i, $v['NAME'], PHPExcel_Cell_DataType::TYPE_STRING);
			$sheet->setCellValueExplicit('D'.$i, $v['SEO'], PHPExcel_Cell_DataType::TYPE_STRING);
			$sheet->setCellValueExplicit('E'.$i, $v['URL'], PHPExcel_Cell_DataType::TYPE_STRING);
			$sheet->setCellValueExplicit('F'.$i, $v['META_TITLE'], PHPExcel_Cell_DataType::TYPE_STRING);
			$sheet->setCellValueExplicit('G'.$i, $v['META_DESCRIPTION'], PHPExcel_Cell_DataType::TYPE_STRING);
			$sheet->setCellValueExplicit('H'.$i, $v['META_KEYWORDS'], PHPExcel_Cell_DataType::TYPE_STRING);
			$i++;
		}
	}
	
	$xls->setActiveSheetIndex(0);
	
	header("Expires: Mon, 1 Apr 1974 05:00:00 GMT");
	header("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
	header("Cache-Control: no-cache, must-revalidate");
	header("Pragma: no-cache");
	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=meta_".date("YmdHis").".xls");
	
	$objWriter = new PHPExcel_Writer_Excel5($xls);
	$objWriter->save('php://output');
}

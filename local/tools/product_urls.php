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
	$arFilter = ["IBLOCK_ID" => CATALOG_BLOCK_ID];
	$arSelect = ["ID", "NAME", "IBLOCK_ID", "DETAIL_PAGE_URL", "PROPERTY_*"];
	$rsElements = CIBlockElement::GetList([], $arFilter, false, false, $arSelect);
	while ($arElements = $rsElements->GetNextElement()) {
		$arFields = $arElements->GetFields();
		$arProps = $arElements->GetProperties();
		
		$arr[$arProps['ARTICLE']['VALUE']] = 'https://' . $_SERVER['SERVER_NAME'] . $arFields['DETAIL_PAGE_URL'];
	}
	
	if (!empty($arr)) {
		$i = 1;
		foreach ($arr as $k => $v) {
			$sheet->setCellValueExplicit('A'.$i, $k, PHPExcel_Cell_DataType::TYPE_STRING);
			$sheet->setCellValueExplicit('B'.$i, $v, PHPExcel_Cell_DataType::TYPE_STRING);
			$i++;
		}
	}
	
	header("Expires: Mon, 1 Apr 1974 05:00:00 GMT");
	header("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
	header("Cache-Control: no-cache, must-revalidate");
	header("Pragma: no-cache");
	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=product_urls_".date("YmdHis").".xls");
	
	$objWriter = new PHPExcel_Writer_Excel5($xls);
	$objWriter->save('php://output');
}

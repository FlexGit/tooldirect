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
	$i = 0;
	$arFilter = ["IBLOCK_ID" => CATALOG_BLOCK_ID];
	$arSelect = ["ID", "NAME", "IBLOCK_ID", "CREATED_DATE", "ACTIVE", "DETAIL_PAGE_URL", "PROPERTY_*"];
	$rsElements = CIBlockElement::GetList(["ID" => "DESC"], $arFilter, false, false, $arSelect);
	while ($arElements = $rsElements->GetNextElement()) {
		$arFields = $arElements->GetFields();
		$arProps = $arElements->GetProperties();
		
		$arr[$i]['ID'] = $arFields['ID'];
		$arr[$i]['ARTICLE'] = $arProps['ARTICLE']['VALUE'];
		$arr[$i]['ACTIVE'] = $arFields['ACTIVE'];
		$arr[$i]['CREATED_DATE'] = $arFields['CREATED_DATE'];
		$arr[$i]['NAME'] = $arFields['NAME'];

		if (intval($arProps['VIDEO']['VALUE'][0]) > 0) {
			$arr[$i]['URL'] = 'https://' . $_SERVER['SERVER_NAME'] . CFile::GetPath($arProps['VIDEO']['VALUE'][0]);
		}
		
		$i++;
	}
	
	$i = 1;
	$sheet->setCellValueExplicit('A'.$i, 'ID', PHPExcel_Cell_DataType::TYPE_STRING);
	$sheet->setCellValueExplicit('B'.$i, 'Наименование', PHPExcel_Cell_DataType::TYPE_STRING);
	$sheet->setCellValueExplicit('C'.$i, 'Артикул', PHPExcel_Cell_DataType::TYPE_STRING);
	$sheet->setCellValueExplicit('D'.$i, 'Активность', PHPExcel_Cell_DataType::TYPE_STRING);
	$sheet->setCellValueExplicit('E'.$i, 'Дата', PHPExcel_Cell_DataType::TYPE_STRING);
	$sheet->setCellValueExplicit('F'.$i, 'Адрес видео', PHPExcel_Cell_DataType::TYPE_STRING);
	$i++;

	if (!empty($arr)) {
		foreach ($arr as $k => $v) {
			$sheet->setCellValueExplicit('A'.$i, $v['ID'], PHPExcel_Cell_DataType::TYPE_STRING);
			$sheet->setCellValueExplicit('B'.$i, $v['NAME'], PHPExcel_Cell_DataType::TYPE_STRING);
			$sheet->setCellValueExplicit('C'.$i, $v['ARTICLE'], PHPExcel_Cell_DataType::TYPE_STRING);
			$sheet->setCellValueExplicit('D'.$i, $v['ACTIVE'], PHPExcel_Cell_DataType::TYPE_STRING);
			$sheet->setCellValueExplicit('E'.$i, $v['CREATED_DATE'], PHPExcel_Cell_DataType::TYPE_STRING);
			$sheet->setCellValueExplicit('F'.$i, $v['URL'], PHPExcel_Cell_DataType::TYPE_STRING);
			$i++;
		}
	}
	
	header("Expires: Mon, 1 Apr 1974 05:00:00 GMT");
	header("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
	header("Cache-Control: no-cache, must-revalidate");
	header("Pragma: no-cache");
	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=video_urls_".date("YmdHis").".xls");
	
	$objWriter = new PHPExcel_Writer_Excel5($xls);
	$objWriter->save('php://output');
}

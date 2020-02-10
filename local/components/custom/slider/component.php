<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFramemode(true);
CModule::IncludeModule("iblock");

if ($this->StartResultCache()) {
    $arSelect = Array("ID", "IBLOCK_ID", "CODE", "NAME", "PREVIEW_PICTURE", "ACTIVE_FROM", "SORT", "DETAIL_PICTURE");
    $arFilter = Array("IBLOCK_ID" => MAKE_BLOCK_ID, "ACTIVE" => "Y", "!PREVIEW_PICTURE" => false);
    $arOrder = Array("SORT" => "ASC");
    $res = CIBlockElement::GetList($arOrder, $arFilter, false, Array(), $arSelect);
    $sliderNum = 0;
    $data = array();
    while($ob = $res->GetNextElement()) {
        $arFields = $ob->GetFields();
		$resizeFile = CFile::ResizeImageGet($arFields['PREVIEW_PICTURE'], array('width'=>170, 'height'=>'82'), BX_RESIZE_IMAGE_EXACT, true);
        $data[] = array(
			'CODE' => $arFields["CODE"],
        	'NAME' => $arFields["NAME"],
            'PICTURE' => $resizeFile['src'],
			'WIDTH' => $resizeFile['width'],
			'HEIGHT' => $resizeFile['height'],
        );
        $arResult["DATA"] = $data;
    };    
    $this->IncludeComponentTemplate();    
}
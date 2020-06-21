<?php
require($_SERVER['DOCUMENT_ROOT'] . '/local/class/recaptcha.class.php');

require_once 'lib/helper.php';
//require_once $_SERVER['DOCUMENT_ROOT'] . '/local/class/youtube.class.php';

define("RECAPTCHA_SITE_KEY", "6LdcebsUAAAAALa4RtfpreMkUDaU0gNjirKVUzoP");
define("RECAPTCHA_SECRET_KEY", "6LdcebsUAAAAAMlgxhTPc9mnU0-s2jS-J_Qq4Tb4");
define("YANDEX_GEOKODER_KEY", "eedee5e2-7f38-4efd-8c07-680bd00a559c");
define("YOUTUBE_API_KEY", "AIzaSyCScoyOpIsLv_sTuA9T9B0maWIQ2tRLdwI");

define('CATALOG_BLOCK_ID', 4);
define('MAKE_BLOCK_ID', 6);
define('SECTIONS_BLOCK_ID', [7328,7118,7268,7305,7235,7246,7359,7322,7310,7373,7353,7370,7292,7255]);

$arWaterMark = Array(
	array(
		"name" => "watermark",
		"position" => "center",
		"size" => "big",
		"type" => "image",
		"alpha_level" => "90",
		"file" => $_SERVER['DOCUMENT_ROOT']."/images/watermark.png",
	)
);
define('arWaterMark', $arWaterMark);

global $APPLICATION;
CModule::IncludeModule('nurgush.mobiledetect');
$detect = new Nurgush\MobileDetect\Main();

//echo '!!!'.$detect->isMobile().' - '.$detect->isTablet().' - '.$_GET['layout'].' - '.$APPLICATION->get_cookie("siteLayout").' ! '._template;

if (in_array($_GET['layout'], ['mobile','original'])) {
	$APPLICATION->set_cookie("siteLayout", $_GET['layout'], time() + 3600 * 24 * 30);
	LocalRedirect("/");
	exit;
} elseif (empty($APPLICATION->get_cookie("siteLayout"))) {
	if ($detect->isMobile() || $detect->isTablet()) {
		$APPLICATION->set_cookie("siteLayout", "mobile", time() + 3600 * 24 * 30);
		LocalRedirect("/");
		exit;
	} else {
		$APPLICATION->set_cookie("siteLayout", "original", time() + 3600 * 24 * 30);
	}
}

/*if ($APPLICATION->get_cookie("siteLayout") == 'mobile')
	define('_template', '_mobile');
else*/
	define('_template', '');

CModule::IncludeModule("iblock");

AddEventHandler("iblock", "OnAfterIBlockElementUpdate", Array("ProductClass", "OnAfterIBlockElementUpdateHandler"));
AddEventHandler("iblock", "OnAfterIBlockElementAdd", Array("ProductClass", "OnAfterIBlockElementAddHandler"));

class ProductClass {
	function OnAfterIBlockElementUpdateHandler(&$arFields) {
		//AddMessage2Log(json_encode($arFields["PROPERTY_VALUES"][146]));
		if (!empty($arFields["RESULT"])) {
			// если выставили свойство Новинка, сохраняем дату выставления
			foreach ($arFields["PROPERTY_VALUES"][146] as $k => $v) {
				if ($v["VALUE"] == 'Y') {
					$newDate = date('d.m.Y');
					CIBlockElement::SetPropertyValueCode($arFields['ID'], "NEW_DATE", $newDate);
				}
				break;
			}
		}
	}
	function OnAfterIBlockElementAddHandler(&$arFields) {
		if (!empty($arFields["RESULT"])) {
			//$youtube = new Youtube();
			//$youtube->upload($arFields['ID']);
			
			$arFilter = ["IBLOCK_ID" => CATALOG_BLOCK_ID, "ID" => $arFields['ID']];
			$arSelect = ["ID", "NAME", "IBLOCK_ID", "DETAIL_PAGE_URL", "PROPERTY_VIDEO", "PROPERTY_MAKE", "PROPERTY_ARTICLE"];
			$res = CIBlockElement::GetList([], $arFilter, false, false, $arSelect);
			if ($ob = $res->GetNextElement()) {
				$fields = $ob->GetFields();
				$props = $ob->GetProperties();
				
				//AddMessage2Log(json_encode($fields));
				//AddMessage2Log(json_encode($props));
				
				$options = [
					'ID' => $fields['ID'],
					'NAME' => $fields['NAME'],
					'DETAIL_PAGE_URL' => $fields['DETAIL_PAGE_URL'],
					'VIDEO_PATH' => CFile::GetPath($props['VIDEO']['VALUE'][0]),
				];
				
				AddMessage2Log($options['VIDEO_PATH']);
				
				if (!empty($options['VIDEO_PATH'])) {
					//$youtube = new Youtube();
					//$youtube->upload($options);

					file_get_contents('https://tooldirect.ru/local/tools/youtube.php?video_path=' . $options['VIDEO_PATH']);
				}
			}
		}
	}
}

AddEventHandler('main', 'OnAdminContextMenuShow', 'LinksDetailAdminContextMenuShow');
function LinksDetailAdminContextMenuShow(&$items) {
	if ($_SERVER['REQUEST_METHOD'] == 'GET' && $GLOBALS['APPLICATION']->GetCurPage() == '/bitrix/admin/iblock_element_edit.php' && $_REQUEST['ID'] > 0 && $_REQUEST['IBLOCK_ID'] == 23) {
		$items[] = [
			"TEXT" => "Анализ", // название
			"LINK" => "javascript:if(confirm('Вы уверены?'))analysis_links(".$_REQUEST['ID'].")", // ссылка
			"TITLE" => "Анализ", // подпись
			"ICON" => "adm-btn" // картинка
		];
		$items[] = [
			"TEXT" => "Перелинковка", // название
			"LINK" => "javascript:if(confirm('Вы уверены?'))set_links(".$_REQUEST['ID'].")", // ссылка
			"TITLE" => "Перелинковка", // подпись
			"ICON" => "adm-btn" // картинка
		];
		$items[] = [
			"TEXT" => "Удалить все ссылки", // название
			"LINK" => "javascript:if(confirm('Вы уверены?'))delete_links(".$_REQUEST['ID'].")", // ссылка
			"TITLE" => "Удалить все ссылки", // подпись
			"ICON" => "adm-btn" // картинка
		];
	}
}

AddEventHandler("main", "OnEpilog", "error_page");
function error_page()
{
	$page_404 = "/404.php";
	GLOBAL $APPLICATION;
	if(strpos($APPLICATION->GetCurPage(), $page_404) === false && defined("ERROR_404") && ERROR_404 == "Y")
	{
		$APPLICATION->RestartBuffer();
		CHTTP::SetStatus("404 Not Found");
		include($_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH."/header.php");
		include($_SERVER["DOCUMENT_ROOT"].$page_404);
		include($_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH."/footer.php");
		die();
	}
}
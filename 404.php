<?
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');

CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");
define("HIDE_SIDEBAR", true);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Страница не найдена");
$APPLICATION->AddChainItem("Ошибка 404", "");
?>

<?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/404.css");?>

<div class="not-found">
	<div class="notfound-top">
		<h1>404</h1>
	</div>
	<div class="content">
		<img src="/images/green.png" alt="" title="">
		<h3>Такой страницы не существует. Воспользуйтесь нашим поиском или найдите нужный раздел в нашем <a href="/catalog/" class="link">каталоге</a>.</h3>
	</div>
	<div class="clear"> </div>
</div>

<?/*
<div class="container">
	<h1><?$APPLICATION->ShowTitle()?></h1>
	<div class="greenseparator"></div>
	<div class="row">
		<div class="bx-404-container">
			<div class="bx-404-block"><img src="<?=SITE_DIR?>images/404.png" alt=""></div>
			<div class="bx-404-text-block">Неправильно набран адрес, <br>или такой страницы на сайте больше не существует.</div>
			<div class="">Вернитесь на <a href="<?=SITE_DIR?>">главную</a> или воспользуйтесь картой сайта.</div>
		</div>
		<div class="map-columns row">
			<div class="col-sm-10 col-sm-offset-1">
				<div class="bx-maps-title">Карта сайта:</div>
			</div>
		</div>

		<div class="col-sm-offset-2 col-sm-4">
			<div class="bx-map-title"><i class="fa fa-leanpub"></i> Каталог</div>
			<?$APPLICATION->IncludeComponent(
				"bitrix:catalog.section.list",
				"",
				array(
					"COMPONENT_TEMPLATE" => "",
					"IBLOCK_TYPE" => "catalog",
					"IBLOCK_ID" => CATALOG_BLOCK_ID,
					"SECTION_ID" => "",
					"SECTION_CODE" => "",
					"COUNT_ELEMENTS" => "N",
					"TOP_DEPTH" => "1",
					"SECTION_FIELDS" => array(
						0 => "",
						1 => "",
					),
					"SECTION_USER_FIELDS" => array(
						0 => "",
						1 => "",
					),
					"SECTION_URL" => "",
					"CACHE_TYPE" => "A",
					"CACHE_TIME" => "36000000",
					"CACHE_GROUPS" => "Y",
					"ADD_SECTIONS_CHAIN" => "Y"
				),
				false
			);
			?>
		</div>
	
		<div class="col-sm-offset-1 col-sm-4">
			<div class="bx-map-title"><i class="fa fa-info-circle"></i> О нас</div>
			<?
			$APPLICATION->IncludeComponent(
				"bitrix:main.map",
				".default",
				array(
					"CACHE_TYPE" => "A",
					"CACHE_TIME" => "36000000",
					"SET_TITLE" => "Y",
					"LEVEL" => "1",
					"COL_NUM" => "1",
					"SHOW_DESCRIPTION" => "Y",
					"COMPONENT_TEMPLATE" => ".default"
				),
				false
			);?>
		</div>
	</div>
</div>
*/?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
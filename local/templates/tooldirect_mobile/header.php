<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
	<link rel="manifest" href="/manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">
	<meta name="google-site-verification" content="Xuzu5AgI06IRJRZquroM00hmBMDWw816C3PqQ-taidY" />
	<meta name="yandex-verification" content="92c6466831680e9c" />
	<?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/bootstrap.min.css");?>
	<?$APPLICATION->ShowHead();?>
	<?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/tooltipster.bundle.min.css");?>
	<?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/tooltipster-sideTip-borderless.min.css");?>
    <?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/owl.carousel.css");?>
    <?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/owl.theme.default.css");?>
	<?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/video-js.css");?>
	<?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/lightgallery.css");?>
	<?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/ion.rangeSlider.css");?>
	<?$APPLICATION->SetAdditionalCSS("/bitrix/css/main/font-awesome.css");?>
    <title><?$APPLICATION->ShowTitle()?></title>
	<!-- Facebook Pixel Code -->
	<script>
		!function(f,b,e,v,n,t,s)
		{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
			n.callMethod.apply(n,arguments):n.queue.push(arguments)};
			if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
			n.queue=[];t=b.createElement(e);t.async=!0;
			t.src=v;s=b.getElementsByTagName(e)[0];
			s.parentNode.insertBefore(t,s)}(window, document,'script',
			'https://connect.facebook.net/en_US/fbevents.js');
		fbq('init', '642706103131177');
		fbq('track', 'PageView');
	</script>
	<noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=642706103131177&ev=PageView&noscript=1" /></noscript>
	<!-- End Facebook Pixel Code -->
</head>
<body>
    <div id="panel"><?$APPLICATION->ShowPanel();?></div>
    <?/*$APPLICATION->IncludeComponent(
        "bitrix:menu", 
        "top-main-menu", 
        array(
            "ALLOW_MULTI_SELECT" => "N",
            "CHILD_MENU_TYPE" => "left",
            "DELAY" => "N",
            "MAX_LEVEL" => "1",
            "MENU_CACHE_GET_VARS" => array(
            ),
            "MENU_CACHE_TIME" => "36000000",
            "MENU_CACHE_TYPE" => "A",
            "MENU_CACHE_USE_GROUPS" => "Y",
            "ROOT_MENU_TYPE" => "topmain",
            "USE_EXT" => "N",
            "COMPONENT_TEMPLATE" => "top-main-menu"
        ),
        false
    );*/?>
    <div class="menu">
        <div class="container">
            <div class="menu__row">
                <div class="menu__catalog">
                    <a href="#" class="menu__catalog-hamb js-full-cat">
                        <span></span>
                        <span></span>
                        <span></span>
                    </a>
                    <div class="menu__catalog-link js-full-cat">полный каталог</div>
                </div> <!-- menu__catalog -->
				<?$APPLICATION->IncludeComponent("bitrix:menu", "top-add-menu", Array(
					"ALLOW_MULTI_SELECT" => "N",    // Разрешить несколько активных пунктов одновременно
						"CHILD_MENU_TYPE" => "left",    // Тип меню для остальных уровней
						"DELAY" => "N", // Откладывать выполнение шаблона меню
						"MAX_LEVEL" => "1", // Уровень вложенности меню
						"MENU_CACHE_GET_VARS" => "",    // Значимые переменные запроса
						"MENU_CACHE_TIME" => "36000000",    // Время кеширования (сек.)
						"MENU_CACHE_TYPE" => "A",   // Тип кеширования
						"MENU_CACHE_USE_GROUPS" => "Y", // Учитывать права доступа
						"ROOT_MENU_TYPE" => "topadd",  // Тип меню для первого уровня
						"USE_EXT" => "N",   // Подключать файлы с именами вида .тип_меню.menu_ext.php
						"COMPONENT_TEMPLATE" => "top-main-menu"
					),
					false
				);?>
            </div> <!-- menu__row -->
        </div> <!-- container -->
    </div> <!-- menu -->
    <div class="mheader">
        <div class="container">
            <div class="mheader__row">
                <div class="mheader__menu-btn js-mheader-menu-btn">
                    <img src="<?=SITE_TEMPLATE_PATH?>/images/hamb.svg" alt="">
                </div>
				<div><a href="https://instagram.com/tooldirect?igshid=q6cqhf3vqdbk" target="_blank"><img src="/images/instagram.png" style="width:32px;height:32px;"></a></div>
                <form action="/search/" class="mheader__search">
                    <input type="text" name="q" value="<?=$_REQUEST['q']?>" class="mheader__input" placeholder="Искать по сайту">
                    <input type="submit" class="mheader__submit" value="">
                </form>
                <a href="/personal/cart/" class="mheader__basket">
                    <img src="<?=SITE_TEMPLATE_PATH?>/images/mobile-basket.svg" alt="">
                </a>
            </div> <!-- mheader__row -->
        </div> <!-- container -->
		<?$APPLICATION->IncludeComponent(
			"bitrix:menu",
			"main-menu-mobile", Array(
				"ALLOW_MULTI_SELECT" => "N",    // Разрешить несколько активных пунктов одновременно
				"CHILD_MENU_TYPE" => "left",    // Тип меню для остальных уровней
				"DELAY" => "N", // Откладывать выполнение шаблона меню
				"MAX_LEVEL" => "1", // Уровень вложенности меню
				"MENU_CACHE_GET_VARS" => "",    // Значимые переменные запроса
				"MENU_CACHE_TIME" => "36000000",    // Время кеширования (сек.)
				"MENU_CACHE_TYPE" => "A",   // Тип кеширования
				"MENU_CACHE_USE_GROUPS" => "Y", // Учитывать права доступа
				"ROOT_MENU_TYPE" => "topmain",  // Тип меню для первого уровня
				"USE_EXT" => "N",   // Подключать файлы с именами вида .тип_меню.menu_ext.php
				"COMPONENT_TEMPLATE" => "top-main-menu"
			),
			false
		);?>
    </div> <!-- mheader -->
    <div class="fullcat">
        <div class="container">
            <div class="fullcat__btn js-full-cat">полный каталог</div>
        </div> <!-- container -->
    </div> <!-- fullcat -->
    <div class="catmenu js-catmenu">
        <div class="container">
            <div class="catmenu__box">
                <div class="catmenu__items">
					<?
					global $arrFilterSectionMain;
					$arrFilterSectionMain = Array(
						"=UF_SEO_SECTION" => false,
						"=UF_USER_SECTION" => false,
						"=UF_USER_EXT_SECTION" => false,
					);
					?>
					<?$APPLICATION->IncludeComponent(
						"bitrix:catalog.section.list","menu", Array(
							"SHOW_PARENT_NAME" => "Y",
							"IBLOCK_TYPE" => "catalog",
							"IBLOCK_ID" => CATALOG_BLOCK_ID,
							"SECTION_ID" => "",
							"SECTION_CODE" => "",
							"SECTION_URL" => "",
							"COUNT_ELEMENTS" => "Y",
							"TOP_DEPTH" => "1",
							"SECTION_FIELDS" => "",
							"SECTION_USER_FIELDS" => Array('UF_*'),
							"USE_FILTER" => "Y",
							"FILTER_NAME" => "arrFilterSectionMain",
							"ADD_SECTIONS_CHAIN" => "Y",
							"CACHE_TYPE" => "A",
							"CACHE_TIME" => "36000000",
							"CACHE_NOTES" => "",
							"CACHE_GROUPS" => "Y"
						)
					);?>
                </div> <!-- catmenu__items -->
            </div> <!-- catmenu__box -->
        </div> <!-- container -->
    </div> <!-- catmenu -->



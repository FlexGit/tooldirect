<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Контакты интернет-магазина \"Тулдирект\": адреса магазинов инструментов в Москве, Московской области, а также в регионах РФ. Лучшие инструменты (фрезы, пилы, пильные диски, ножи, граверы) по самым низким ценам.");
$APPLICATION->SetPageProperty("keywords", "заказать фрезы, купить фрезы, фрезы под заказ, фрезы с доставкой, концевые фрезы купить, купить алмазные фрезы, купить фрезы в Москве");
$APPLICATION->SetPageProperty("title", "Надежные и качественные инструменты от Тулдирект");
$APPLICATION->SetTitle("Контакты");
?>
<div class="container">
	<h1><?$APPLICATION->ShowTitle(false)?></h1>
	<div class="greenseparator"></div>
	<div style="margin-bottom: 20px;">
		<p>Tooldirect - Ваш надёжный поставщик пильных дисков, концевых фрез, свёрл, строгальных ножей и твёрдого сплава для деревообработки. У нас широчайший ассортимент инструмента для обработки древесины, фанеры, ЛДCП, МДФ. Мы предлагаем эксклюзивные фрезы производства Тайваньской фабрики ARDEN в самом широком ассортименте на Российском рынке.</p>
		<h4 style="color: #333;margin: 20px 0;">Адрес магазина-шоурума</h4>
		<p><strong>Адрес:</strong> г. Москва, Мажоров пер. д.14 офис 15304 (7 минут  пешком от м.Электрозаводская)</p>
		<p><strong>Тел.:</strong> <a href="tel:+74959844155" style="color:#000;">+7(495) 984-41-55</a></p>
		<p>Будние дни с 10.00-20.00</a></p>
		<h4 style="color: #333;margin: 20px 0;">Адрес склада</h4>
		<p><strong>Адрес:</strong> г. Москва, Иркутская ул. д11 к2</p>
		<p><strong>Тел.:</strong> <a href="tel:+74959844155" style="color:#000;">+7(495) 984-41-55</a></p>
		<p>Будние дни с 9.00-17.30</a></p>
		<div style="width: 100%;text-align: center;">
			<h4 style="color: #333;margin: 20px 0;">Наши дилеры</h4>
			<img src="/images/100-pil-logo.png" title="" alt="" style="border: 1px solid #3caa37;">
			<img src="/images/220-volt-logo.png" title="" alt="" style="border: 1px solid #3caa37;">
			<img src="/images/Mnogofrez-logo.png" title="" alt="" style="border: 1px solid #3caa37;">
			<img src="/images/Olmitool-logo.png" title="" alt="" style="border: 1px solid #3caa37;">
			<img src="/images/Vseinstrum-logo.png" title="" alt="" style="border: 1px solid #3caa37;">
		</div>
	</div>
	<?/*$APPLICATION->IncludeComponent("custom:stores",".default"._template,array(),false);*/?>

	<?$APPLICATION->IncludeComponent(
		"bitrix:main.include",
		".default",
		array(
			"AREA_FILE_SHOW" => "file",
			"AREA_FILE_SUFFIX" => "inc",
			"EDIT_TEMPLATE" => "",
			"PATH" => SITE_DIR."include/dealer.php",
			"COMPONENT_TEMPLATE" => ".default"
		),
		false
	);?>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Стать дилером");
?>

<style>
ol.default {
	margin-top: 10px;
	line-height: 2em;
}
</style>

<div class="container">
	<h1><?$APPLICATION->ShowTitle(false)?></h1>
	<div class="greenseparator"></div>
	<div class="row" style="margin:0;padding:0;">
		<div class="col-md-8">
			Став дилером компании Тулдирект Вы получаете:
			<ol class="default">
				<li>Широкий ассортимент востребованного расходного инструмента, включая уникальные торговые позиции</li>
				<li>Лучшее ценовое предложение относительно конкурентов</li>
				<li>Стабильное наличие большинства товарных позиций на складе в Москве</li>
				<li>Регулярное обновление и восполнение ассортимента</li>
				<li>Гибкий подход к формированию товарной матрицы под потребности ваших клиентов</li>
				<li>Хорошие скидки без привязки к месячным, квартальным, годовым оборотам</li>
				<li>Заказы от любых сумм</li>
				<li>Бесплатное торговое оборудование и каталоги</li>
			</ol>
		</div>
		<div class="col-md-4">
			<?/*<img src="../images/img_td1.png" alt="" class="td1img">*/?>
		</div>
	</div>
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
	<div class="why__title" style="margin-top: 50px;">почему выгодно покупать инструмент у нас</div>
	<div class="why__items">
		<div class="why__item">
			<img src="/bitrix/templates/tooldirect/images/why-01.png" alt="" class="why__item-img">
			<div class="why__item-caption">Широкий ассортимент продукции</div>
			<div class="why__item-text">
				Складская программа содержит широкий перечень профессионального инструмента. 800 видов концевых фрез с поставкой на склад от 50 шт. каждой позиции и боле. 350 видов пильных дисков и большой ассортимент приспособлений, свёрл, ножей, зенкеров, патронов, цанг, струбцин и многого другого. Ассортимент стабильно пополняется и увеличивается каждые 1.5-2 месяца. Все позиции представленные на сайте являются стабильной складской программой.
			</div>
		</div> <!-- why__item -->
		<div class="why__item">
			<img src="/bitrix/templates/tooldirect/images/why-02.png" alt="" class="why__item-img">
			<div class="why__item-caption">Самые лучшие цены</div>
			<div class="why__item-text">
				Компания Тулдирект проводит тщательную экспертизу ценового предложения всех фабрик. Нам не интересны фабрики с минимальными ценами и низким качеством, а также фабрики с эксклюзивным дорогим инструментом. Наша основная задача дать максимально высокое качество за разумные деньги без компромиссов.
			</div>
		</div> <!-- why__item -->
		<div class="why__item">
			<img src="/bitrix/templates/tooldirect/images/why-03.png" alt="" class="why__item-img">
			<div class="why__item-caption">Высокое качество продукции</div>
			<div class="why__item-text">
				Приоритетом компании является поиск самых качественных ОЕМ производителей инструмента в мире. Благодаря знаниям и опыту у нас есть полное представление где размещают свои заказы различные именитые Европейские, Американские, Израильские бренды, какой уровень качества и ассортимент поставляется ими на Российский рынок. Мы размещаем заказы только на инструмент высокого качества в больших объёмах, что гарантирует стабильность поставок без изменения уровня качества.
			</div>
		</div> <!-- why__item -->
		<div class="why__item">
			<img src="/bitrix/templates/tooldirect/images/why-04.png" alt="" class="why__item-img">
			<div class="why__item-caption">Отгрузка в день заказа</div>
			<div class="why__item-text">
				Если заказ сделан до 16.00, то его можно легко забрать в тот же день со склада в Москве. Если заказ сделан до 15.00 - отправим транспортной компанией в ваш регион. Благодаря прямым контрактам с заводами изготовителями – мы можем предложить Вам одни из самых лучших цена на рынке, широкий ассортимент, индустриальное качество и стабильное наличие на складе, отличные дилерские скидки на весь ассортимент.
			</div>
		</div> <!-- why__item -->
	</div> <!-- why__items -->
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
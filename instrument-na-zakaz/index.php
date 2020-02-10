<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Инструмент на заказ");
?>
<style>
ul.default {
	line-height: 2em;
	list-style-type: disc;
	margin: 10px 40px 10px 40px;
}
</style>
<div class="container">
	<h1><?$APPLICATION->ShowTitle(false)?></h1>
	<div class="greenseparator"></div>
	Если вам не удалось найти нужный инструмент в нашем каталоге товаров, то вы легко можете заказать его у нас. Мы не делаем дополнительной наценки за индивидуальный подход к задачам клиентов. Если ваши потребности укладываются в размеры близких по параметру инструментов, то вы можете смело ориентироваться на их стоимость у нас на сайте или в прас-листе. Основной проблемой является не возможность заказывать инструмент минимальными количествами с крупных фабрик. Мы готовы взять себе на склад часть заказанного товара, что-бы вам было удобнее заказывать приемлемое количество позиций.
	<br><br>
	Минимальное количество для заказа в шт. на одну позицию:
	<ul class="default">
		<li>Фрезы Алмазные от 2шт.</li>
		<li>Пилы алмазные от 3шт.</li>
		<li>Пилы твердосплавные от 5шт.</li>
		<li>Свёрла присадочные от 15шт.</li>
		<li>Фрезы ARDEN от 20шт.</li>
		<li>Фрезы PROCUT от 20шт.</li>
		<li>Спиральные фрезы:
			<ul class="default">
				<li>До 6 диаметра от 30шт.</li>
				<li>От 8 диаметра от 10шт.</li>
			</ul>
		</li>
		<li>Фрезы со сменным ножом от 20шт.</li>
		<li>Строгальные ножи от 10шт.</li>
	</ul>
	<br><br>
</div>
<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	".default",
	array(
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "inc",
		"EDIT_TEMPLATE" => "",
		"PATH" => SITE_DIR."include/toolorder.php",
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
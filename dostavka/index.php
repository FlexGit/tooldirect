<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Доставка");
?>

<div class="container">
	<h1><?$APPLICATION->ShowTitle(false)?></h1>
	<div class="greenseparator"></div>
	Способы получения товара:
	<br><br>
	<ol>
		<li>Самовывоз по адресу: г. Москва, Иркутская ул. д11 к2.<br>Тел.: +7(495) 984-41-55<br><br></li>
		<li>Доставка транспортной компанией «Деловые Линии».<br><br></li>
		<li>Доставка курьерской службой «СДЭК».</li>
	</ol>
	<br><br>
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
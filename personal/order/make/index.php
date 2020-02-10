<?
define("HIDE_SIDEBAR", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Оформление заказа");

/*CModule::IncludeModule("sale");

$rs_Basket = CSaleBasket::GetList(
	array(),
	array(
		'FUSER_ID' 	=> CSaleBasket::GetBasketUserID(),
		'LID' 		=> SITE_ID,
		'ORDER_ID' 	=> 'NULL',
		'MODULE' 	=> 'catalog'
	),
	false,
	false,
	array("ID")
);
if ($rs_Basket->SelectedRowsCount() == 0)
	LocalRedirect("/personal/cart/");
*/?>
<div class="container">
	<h1><?$APPLICATION->ShowTitle(false)?></h1>
	<div class="greenseparator"></div>
	<?/*$APPLICATION->IncludeComponent("bitrix:sale.order.ajax", "", array(
		"PAY_FROM_ACCOUNT" => "N",
		"COUNT_DELIVERY_TAX" => "N",
		"COUNT_DISCOUNT_4_ALL_QUANTITY" => "N",
		"ONLY_FULL_PAY_FROM_ACCOUNT" => "N",
		"ALLOW_AUTO_REGISTER" => "Y",
		"ALLOW_APPEND_ORDER" => "Y",
		"SHOW_VAT_PRIC" => "N",
		"SHOW_BASKET_HEADERS" => "N",
		"SHOW_COUPONS_DELIVERY" => "N",
		"SHOW_COUPONS_PAY_SYSTEM" => "N",
		"SEND_NEW_USER_NOTIFY" => "N",
		"DELIVERY_NO_AJAX" => "N",
		"TEMPLATE_LOCATION" => "popup",
		"PROP_1" => array(
		),
		"PATH_TO_BASKET" => "/personal/cart/",
		"PATH_TO_PERSONAL" => "/personal/order/",
		"PATH_TO_PAYMENT" => "/personal/order/payment/",
		"PATH_TO_ORDER" => "/personal/order/make/",
		"SET_TITLE" => "Y" ,
		"SHOW_ACCOUNT_NUMBER" => "N",
		"DELIVERY_NO_SESSION" => "Y",
		"COMPATIBLE_MODE" => "N",
		"BASKET_POSITION" => "before",
		"BASKET_IMAGES_SCALING" => "adaptive",
		"SERVICES_IMAGES_SCALING" => "adaptive",
		"USER_CONSENT" => "Y",
		"USER_CONSENT_ID" => "1",
		"USER_CONSENT_IS_CHECKED" => "Y",
		"USER_CONSENT_IS_LOADED" => "Y",
		"SKIP_USELESS_BLOCK" => "Y",
		"SHOW_COUPONS_BASKET" => "N",
		"DISABLE_BASKET_REDIRECT" => "N"
		),
		false
	);*/?>
	<div class="alert alert-success hidden" role="alert"></div>
	<div class="alert alert-danger hidden" role="alert"></div>
	<form method="POST" id="orderForm">
		<div class="row vidacha_flex" style="<?if ($APPLICATION->get_cookie("siteLayout") == 'mobile') {?>display: block;<?}?>">
			<div class="col">
				<div class="form-group">
					<label for="name">Как вас зовут <span class="required">*</span></label>
					<input type="text" id="name" name="name" class="form-control" placeholder="Иван Иванов" required>
				</div>
				<div class="form-group">
					<label for="phone">Ваш телефон <span class="required">*</span></label>
					<input type="tel" id="phone" name="phone" class="form-control" pattern="\+7\s?[\(]{1}[0-9]{3}[\)]{1}\s?\d{3}[-]{1}\d{2}[-]{1}\d{2}" required placeholder="+7(XXX)XXX-XX-XX">
				</div>
				<div class="form-group">
					<label for="email">Ваша почта <span class="required">*</span></label>
					<input type="email" id="email" name="email" class="form-control" pattern="[^@]+@[^@]+\.[a-zA-Z]{2,6}" required placeholder="ivanov@mail.ru">
				</div>
			</div>
			<div class="col">
				<div class="form-group">
					<label for="address">Ваш адрес <span class="required hidden">*</span></label>
					<input type="text" id="address" name="address" class="form-control" placeholder="070589 Москва, ул. Ленина 15 дом 21">
				</div>
				<div class="form-group">
					<label for="pay">Выберите удобный способ оплаты <span class="required">*</span></label>
					<select class="form-control" id="pay" name="pay" required>
						<option value="">---</option>
						<option value="1">Наличные курьеру</option>
						<option value="7" style="display: none;">Сбербанк</option>
						<option value="8" style="display: none;">Банковский перевод</option>
						<option value="9" style="display: none;">Внутренний счет</option>
					</select>
				</div>
				<div class="form-group">
					<label for="delivery">Выберите удобный способ доставки <span class="required">*</span></label>
					<select class="form-control" id="delivery" name="delivery" required>
						<option value="">---</option>
						<option value="3">Самовывоз</option>
						<option value="2">Доставка курьером</option>
					</select>
				</div>
			</div>
			<div class="col">
				<div class="custom-control custom-checkbox" style="margin-top: 35px;">
					<input type="checkbox" id="jur_type" name="jur_type" value="2" class="custom-control-input">
					<label class="custom-control-label" for="jur_type">Я ЮРИДИЧЕСКОЕ ЛИЦО</label>
				</div>
				<div class="form-group jur-type-container hidden">
					<label for="company">Название компании <span class="required hidden">*</span></label>
					<input type="text" id="company" name="company" class="form-control">
				</div>
				<?/*<a href="#" class="product__menu-button float-right">Отправить</a>*/?>
				<button type="submit" class="btn btn-success" style="margin-top: 32px;width: 100%;height: 50px;">Отправить</button>
			</div>
		</div>
	</form>
	<?$APPLICATION->IncludeComponent(
		"bitrix:main.include",
		"",
		Array(
			"AREA_FILE_SHOW" => "file",
			"AREA_FILE_SUFFIX" => "inc",
			"EDIT_TEMPLATE" => "",
			"PATH" => SITE_DIR."include/toolorder_inner.php"
		)
	);?>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
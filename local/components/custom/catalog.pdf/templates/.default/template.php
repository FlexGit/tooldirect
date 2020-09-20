<section id="pdf_catalog_params">
	<form action="/pdf-catalog/" method="GET" name="pdf-catalog-form">
		<span>Выберите разделы и производителей для формирования PDF-каталога:</span>
		<div class="pdf-catalog-container">
			<div class="pdf-catalog-column">
				<?if (!empty($arResult['sections'])) {?>
					<h4>Разделы</h4>
					<?foreach ($arResult['sections'] as $k => $v) {?>
						<div class="checkbox">
							<input type="checkbox" id="section_<?=$k?>" value="<?=$k?>" class="pdf-section">
							<label for="section_<?=$k?>"><?=$v['NAME']?></label>
						</div>
					<?}?>
				<?}?>
			</div>
			<div class="pdf-catalog-column">
				<?if (!empty($arResult['makes'])) {?>
					<h4>Производители</h4>
					<?foreach ($arResult['makes'] as $k => $v) {?>
						<div class="checkbox">
							<input type="checkbox" id="make_<?=$k?>" value="<?=$k?>" class="pdf-make">
							<label for="make_<?=$k?>"><?=$v['NAME']?></label>
						</div>
					<?}?>
				<?}?>
			</div>
			<div class="pdf-catalog-column">
				<h4>Формат каталога</h4>
				<div class="checkbox">
					<input type="radio" name="catalog_format" id="standart" value="standart" checked="checked" class="pdf-type">
					<label for="standart">Стандартный</label>
				</div>
				<div class="checkbox">
					<input type="radio" name="catalog_format" id="extended" value="extended" class="pdf-type">
					<label for="extended">Расширенный</label>
				</div>
			</div>
		</div>
		<div class="pdf-catalog-email-container">
			<div class="pdf-catalog-block-field">
				<div class="pdf-catalog-description">Укажите E-mail, на который будет отправлен код подтверждения, для получения доступа на скачивание PDF каталога:</div>
				<div class="form">
					<div class="form-group">
						<input type="text" name="pdf-catalog-email" placeholder="E-mail" class="form-control js-pdf-catalog-email">
						<span class="pdf-catalog-block-btn js-pdf-catalog-email-btn"></span>
					</div>
				</div>
				<div class="pdf-catalog-email-alert text-danger"></div>
			</div>
			<div class="pdf-catalog-block-field">
				<div class="pdf-catalog-description">Укажите код подтверждения, полученный в письме на указанный E-mail:</div>
				<div class="form">
					<div class="form-group">
						<input type="text" name="pdf-catalog-code" placeholder="Код подтверждения" class="form-control">
						<span class="pdf-catalog-block-btn js-pdf-catalog-code-btn"></span>
					</div>
					<div class="pdf-catalog-code-alert text-danger"></div>
				</div>
			</div>
			<div class="pdf-catalog-block-field">
				<a href="javascript:void(0);" class="product__menu-button <?/*js-pdf-catalog*/?>">
					<span>Скачать PDF Каталог</span>
				</a>
			</div>
		</div>
	</form>
</section>

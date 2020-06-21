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
					<input type="radio" id="catalog_format" value="standart" checked="checked" class="pdf-type">
					<label for="catalog_format">Стандартный</label>
				</div>
				<div class="checkbox">
					<input type="radio" id="catalog_format" value="extended" class="pdf-type">
					<label for="catalog_format">Расширенный</label>
				</div>
			</div>
		</div>
		<div>
			<a href="javascript:void(0);" class="product__menu-button js-pdf-catalog">
				<span>PDF Каталог</span>
			</a>
		</div>
	</form>
</section>

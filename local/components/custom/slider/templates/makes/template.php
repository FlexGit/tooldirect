<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); ?>

<?/*echo '<pre>';print_r($arResult["DATA"]);echo '</pre>';*/?>
<div class="tm">
	<div class="container">
		<div class="tm__title">Производители инструмента</div>
		<div class="tm__slider-box">
			<div class="tm__slider js-tm-slider owl-carousel owl-theme">
				<? foreach($arResult["DATA"] as $item):?>
					<div class="tm__slide">
						<a href="/proizvoditeli/<?=$item['CODE']?>/">
							<img src="<?=$item['PICTURE']?>" alt="<?=$item['NAME']?>" title="<?=$item['NAME']?>" class="tm__slide-img" width="<?=$item["width"]?>" height="<?=$item["height"]?>">
						</a>
					</div>
				<?endforeach?>
			</div> <!-- tm__slider -->
		</div> <!-- tm__slider-box -->
	</div> <!-- container -->
</div> <!-- tm -->

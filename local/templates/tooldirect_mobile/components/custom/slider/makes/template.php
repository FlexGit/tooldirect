<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); ?>

<?/*echo '<pre>';print_r($arResult["DATA"]);echo '</pre>';*/?>
<div class="tm">
	<div class="container">
		<div class="tm__mslider-box">
			<div class="tm__mslider js-tm-mslider owl-carousel owl-theme">
				<? foreach($arResult["DATA"] as $item):?>
					<div class="tm__slide">
						<a href="/proizvoditeli/<?=$item['CODE']?>/">
							<img src="<?=$item['PICTURE']?>" alt="<?=$item['NAME']?>" title="<?=$item['NAME']?>" class="tm__slide-img">
						</a>
					</div>
				<?endforeach?>
			</div> <!-- tm__mslider -->
		</div> <!-- tm__mslider-box -->
	</div> <!-- container -->
</div> <!-- tm -->

<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); ?>

<div class="smalldescription">
	<div style="margin-bottom: 20px;">
		Ваше местоположение: <span class="spancl your-city">-</span>
	</div>
	<div class="header-primary-cities">
		<form method="POST" id="cityForm" class="footer__form" enctype="application/x-www-form-urlencoded">
			<input type="text" id="city" name="city" class="footer__input" placeholder="Искать город...">
			<input type="hidden" id="coords" name="coords">
			<input type="hidden" name="g-recaptcha-response">
			<input type="submit" class="footer__submit" value="Искать" style="height: 50px; line-height: 50px;padding: 0;">
			<a href="javascript:void(0)">
				<img src="/images/placeholder.png" alt="" class="mappoint map-geo">
			</a>
			<?/*<a href="javascript:void(0)">
					<img src="/images/funnel.png" alt="" class="mappoint map-filter">
				</a>*/?>
		</form>
		<form id="city-radio-from"></form>
	</div>

	<div class="stores" style="margin-bottom: 20px;"></div>

	<div style="margin-bottom: 50px;text-align:center;">
		<div id="map"></div>
	</div>
</div>
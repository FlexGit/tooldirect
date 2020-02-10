<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Тулдирект: продажа инструментов с доставкой по Москве, Московской области и всей России. Только лучшие цены на качественные фрезы от ведущих мировых производителей, гибкая система скидок, отличные условия для оптовых клиентов.");
$APPLICATION->SetPageProperty("keywords", "купить инструменты, купить инструменты недорого, инструменты от производителя, профессиональные инструменты купить, купить инструмент с доставкой");
$APPLICATION->SetPageProperty("title", "Лучшие инструменты по лучшим ценам - Тулдирект");
$APPLICATION->SetTitle("О компании");
?>

<div class="container">
	<h1><?$APPLICATION->ShowTitle(false)?></h1>
	<div class="greenseparator"></div>
	<div class="o-kompanii-img">
		<a href="/images/certificate.pdf" target="_blank">
			<img src="/upload/medialibrary/2b7/2b7fe369088148b85a8747ea88da49e0.jpg" alt="" class="td1img float_left">
		</a>
	</div>
	<div style="text-align: justify;">
		Тулдирект – надёжный поставщик широкого спектра профессионального инструмента для обработки древесины и деревосодержащих материалов (ДСП, МДФ, OSB), алюминия, композитов и пластиков, а так же большого количества инструмента и приспособлений для DIY.
		<br><br>
		Далеко не секрет, что многие известные производители намеренно снижают ресурс инструмента для увеличения продаж. Задача нашей компании прямо противоположная – с минимальными затратами на маркетинг, поставлять самый высококачественный инструмент, по настоящим справедливым ценам, без переплат за узнаваемый бренд.
		<br><br>
		Компания ориентирована на дистрибуцию товаров с ведущих Азиатских фабрик, OEM производителей инструмента, которые выполняют заказы для крупных Европейских и Американских компаний. Все поставки на склад осуществляются только по прямым контрактам с производителями, в большом количестве и с обязательной проверкой качества до и после отправки в Россию.
		<br><br>
		Мы приглашаем к сотрудничеству всех, кто готов к долгосрочному, взаимовыгодному партнёрству в области инструмента.
		<br><br>
	</div>
	<div style="clear:both;"></div>

	<?
	$arFilterSection = ["IBLOCK_ID" => 18];
	$arSelectSection = ["ID", "NAME", "IBLOCK_ID"];
	$rsSections = CIBlockSection::GetList([], $arFilterSection, false, $arSelectSection);
	while ($arSections = $rsSections->Fetch()) {
		?><h4 style="margin: 0 0 20px;color: #212529;"><?=$arSections['NAME']?></h4><?
		?><div style="margin: 0 0 50px;"><?
			$arFilterElement = ["IBLOCK_ID" => 18, "SECTION_ID" => $arSections['ID']];
			$arSelectElement = ["ID", "NAME", "IBLOCK_ID", "DETAIL_PICTURE"];
			$rsElements = CIBlockElement::GetList([], $arFilterElement, false, false, $arSelectElement);
			while ($arElements = $rsElements->Fetch()) {
				//print_r($arElements);
				$resizeFilePreview = CFile::ResizeImageGet($arElements['DETAIL_PICTURE'], array('width'=>250, 'height'=>'250'), BX_RESIZE_IMAGE_EXACT, true);
				$resizeFileDetail = CFile::ResizeImageGet($arElements['DETAIL_PICTURE'], array('width'=>800, 'height'=>'800'), BX_RESIZE_IMAGE_EXACT, true);
				?>
				<a href="<?=$resizeFileDetail['src']?>" class="lightgallery">
					<img src="<?=$resizeFilePreview['src']?>" alt="<?=$arElements['NAME']?>" title="<?=$arElements['NAME']?>" width="<?=$resizeFile["width"]?>" height="<?=$resizeFile["height"]?>" style="margin: 0 20px 20px 0; border: 1px solid #3caa37;">
				</a>
				<?
			}
		?></div><?
	}
	?>
	
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
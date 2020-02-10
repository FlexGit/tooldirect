<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

$arViewModeList = $arResult['VIEW_MODE_LIST'];

$arViewStyles = array(
	'LIST' => array(
		'CONT' => 'bx_sitemap',
		'TITLE' => 'bx_sitemap_title',
		'LIST' => 'catalog-section-list-list',
	),
	'LINE' => array(
		'TITLE' => 'catalog-section-list-item-title',
		'LIST' =>  'catalog-section-list-line-list mb-4',
		'EMPTY_IMG' => $this->GetFolder().'/images/line-empty.png'
	),
	'TEXT' => array(
		'TITLE' => 'catalog-section-list-item-title',
		'LIST' =>  'catalog-section-list-text-list mb-4'
	),
	'TILE' => array(
		'TITLE' => 'catalog-section-list-item-title',
		'LIST' =>  'catalog-section-list-tile-list row mb-4',
		'EMPTY_IMG' => $this->GetFolder().'/images/tile-empty.png'
	)
);
$arCurView = $arViewStyles[$arParams['VIEW_MODE']];

$strSectionEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_EDIT");
$strSectionDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_DELETE");
$arSectionDeleteParams = array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM'));

//echo '<pre>';print_r($arResult['SECTIONS']);echo '</pre>';
?>

<style>
.product__items-box {
	width: 100%;
	display: flex;
	flex-wrap: wrap;
	/*justify-content: space-evenly;*/
	margin: 50px 0;
}
.product__item {
	width: 23%;
	padding-top: 0;
	padding-bottom: 0;
	margin-bottom: 25px;
}
.textbetween {
	justify-content: center;
}
.product__img-box {
	width: auto;
	height: auto;
}
.product__img-box img {
	width: 100%;
	height: auto;
	margin: 20px auto 10px auto;
}
</style>

<div class="product__items-box">
	<?
	if (0 < $arResult["SECTIONS_COUNT"])
	{
		foreach ($arResult['SECTIONS'] as $k_section => &$arSection)
		{
			?>
			<div class="product__item">
				<div class="product__item-row">
					<div class="product__img-box">
						<a href="<?=$arSection['SECTION_PAGE_URL']?>" title="<?=$arSection['NAME']?>">
							<?if ($arSection['PICTURE']['ID']) {?>
								<?
								$resizeFile = CFile::ResizeImageGet($arSection['PICTURE']['ID'], array('width'=>150, 'height'=>'150'), BX_RESIZE_IMAGE_EXACT, true, arWaterMark);
								?>
								<img src="<?=$resizeFile['src']?>" alt="" width="<?=$resizeFile["width"]?>" height="<?=$resizeFile["height"]?>">
							<?} else {?>
								<img src="<?=SITE_TEMPLATE_PATH?>/images/no_photo.png" alt="" style="width:150px;height:auto;">
							<?}?>
						</a>
					</div>
				</div>
				<div class="product__name">
					<a href="<?=$arSection['SECTION_PAGE_URL']?>" class="link" title="<?=$arSection['NAME']?>">
						<? echo $arSection['NAME']; ?>
					</a>
				</div>
				<? if ($arParams["COUNT_ELEMENTS"])
				{
					?>
					<div class="textbetween">
						<span class="catalog-section-list-item-counter">Товаров: <? echo $arSection['ELEMENT_CNT']; ?></span>
					</div>
					<?
				}
				?>
			</div>
			<?
			unset($arSection);
		}
	}
	?>
</div>
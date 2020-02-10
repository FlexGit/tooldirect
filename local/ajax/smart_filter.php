<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
//CModule::IncludeModule("sale");
//CModule::IncludeModule("catalog");

if (!empty(intval($_POST['id'])) && !empty($_POST['code']) && !empty($_POST['name']) && !empty($_POST['display_type'])) {
	?>
	<h2 style="margin-bottom: 20px;"><?=urldecode($_POST['name'])?>: </h2>
	<?if ($_POST['display_type'] == 'A') {?>
		<input type="text" class="js-range-slider" name="<?=$_POST['code']?>_range" value="" data-type="double" data-min="<?=intval($_POST['value_min'])?>" data-max="<?=intval($_POST['value_max'])?>" data-from="<?=intval($_POST['value_from'])?>" data-to="<?=intval($_POST['value_to'])?>" data-grid="true">
	<?} else {?>
		<?if (!empty(urldecode($_POST['values']))) {?>
			<?$values = explode(',', urldecode($_POST['values']));?>
			<?$checked = $_POST['checked'];?>
			<?$i=1;?>
			<?foreach ($values as $key => $value) {?>
				<div class="custom-control custom-checkbox" style="display: inline-block;">
					<input type="checkbox" class="custom-control-input js-smartfilter-chk" id="customCheck<?=$i?>" <?if ($checked[$value]){?>checked="checked"<?}?> data-code="<?=$_POST['code']?>">
					<label class="custom-control-label" for="customCheck<?=$i?>">
						<?=$value?>
					</label>
				</div>
				<?$i++;?>
			<?}?>
		<?}?>
	<?}?>
	<?
}
?>
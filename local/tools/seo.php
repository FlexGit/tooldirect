<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

CModule::IncludeModule("iblock");
CModule::IncludeModule('main');
CModule::IncludeModule('highloadblock');

class Seo {
	private static $instance = null;
	const IBLOCK_ID = 14;
	const HBLOCK_ID = 8;
	
	const DEBUG = true;
	
	/**
	 * @return Seo
	 */
	public static function getInstance() {
		if (null === self::$instance) {
			self::$instance = new self();
		}
		return self::$instance;
	}
	
	public function __construct() {
		$hlblock = Bitrix\Highloadblock\HighloadBlockTable::getById(self::HBLOCK_ID)->fetch();
		$entity = Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hlblock);
		$this->metaTaskRegistryEntity = $entity->getDataClass();
	}
	
	/**
	 * Получение Offset
	 *
	 */
	public function getOffset() {
		$metaTaskRegistryEntity = $this->metaTaskRegistryEntity;
		$offset = '';
		$resMetaTaskRegistry = $metaTaskRegistryEntity::getList([
			"select" => ['*'],
			"order"  => ['ID' => 'DESC']
		]);
		if ($rowMetaTaskRegistry = $resMetaTaskRegistry->Fetch()) {
			$offset = $rowMetaTaskRegistry;
		}
		return $offset;
	}
	
	/**
	 * Сохранение Offset
	 *
	 */
	public function setOffset() {
		$metaTaskRegistryEntity = $this->metaTaskRegistryEntity;
		$data = [
			"UF_DATE" => new Bitrix\Main\Type\DateTime(date('Y-m-d H:i:s', time()), 'Y-m-d H:i:s')
		];
		$metaTaskRegistryEntity::add($data);
	}
	
	public function normalizeName($name) {
		$name = htmlentities($name, null, 'UTF-8');
		$name = str_replace("&nbsp;", " ", $name);
		$name = str_replace("&amp;", "", $name);
		$name = str_replace("amp;", "", $name);
		$name = str_replace("quot;", "", $name);
		$name = str_replace("&laquo;", "", $name);
		$name = str_replace("&raquo;", "", $name);
		$name = str_replace("\"", "", $name);
		$name = str_replace("'", "", $name);
		$name = str_replace(",", " ", $name);
		$name = str_replace("   ", " ", $name);
		$name = str_replace("  ", " ", $name);
		
		return $name;
	}
	
	/**
	 * Templates
	 *
	 */
	public function getMetaTemplates() {
		$templates = [];
		
		$arFilter = ["IBLOCK_ID" => self::IBLOCK_ID/*, ">=TIMESTAMP_X" => $offset['UF_DATE']*/];
		$arSelect = ["ID", "NAME", "IBLOCK_ID", "PROPERTY_*"];
		$rsElements = CIBlockElement::GetList([], $arFilter, false, false, $arSelect);
		while ($arElements = $rsElements->GetNextElement()) {
			$arProps = $arElements->GetProperties();
			
			$templates[$arProps['SECTION']['VALUE']]['metaType'] = $arProps['TYPE']['VALUE'];

			$values = [];
			for ($i=1;$i<=8;$i++) {
				if ((trim($arProps['VALUE'.$i]['VALUE']))) {
					$values[] = $arProps['VALUE'.$i]['VALUE'];
				}
			}
			$templates[$arProps['SECTION']['VALUE']]['values'] = $values;
		}
		
		return $templates;
	}
	
if (!empty($metaType) && !empty($sectionId) && !empty($values)) {
Seo::getInstance()->getSections($offset);
}
	
	/**
	 * Sections
	 *
	 */
	public function getSections($offset, $templates) {
		$newTemplates = [];
		
		$arFilter = ["IBLOCK_ID" => CATALOG_BLOCK_ID, ">=TIMESTAMP_X" => $offset['UF_DATE']];
		$arSelect = ["ID", "NAME", "IBLOCK_ID", "IBLOCK_SECTION_ID", "UF_SEO_SECTION", "UF_PARENT_SECTION"];
		$rsSections = CIBlockSection::GetList([], $arFilter, false, $arSelect);
		while ($arSections = $rsSections->Fetch()) {
			/*if (empty($templates[$arSections['ID']]['metaType']) || empty($templates[$arSections['ID']]['values']))
				continue;*/
			
			$name = Seo::getInstance()->normalizeName($arSections['NAME']);

			/*if (self::DEBUG) {
				echo $metaType . ' - ' . $name . '<br>';
				print_r($values);
				echo '<br>';
			}*/
			
			$newValues = [];
			foreach ($values as $key => $value) {
				if (strpos($value, '/') !== false) {
					$variants = explode('/', $value);
					$newValues[] = $variants[rand(0, count($variants) - 1)];
				} else {
					$newValues[] = $value;
				}
			}
			
			/*if (self::DEBUG) {
				echo 'newValues';
				echo '<br>';
				print_r($newValues);
				echo '<br>';
			}*/
			
			$valuesToSave = [];
			foreach ($newValues as $key => $value) {
				$valuesToSave[$key] = $newValues[$key];
				if (strpos($value,'{item}') !== false) {
					$valuesToSave[$key] = str_replace('{item}', $name, $value);
				}
			}
			
			/*if (self::DEBUG) {
				echo 'valuesToSave';
				echo '<br>';
				print_r($valuesToSave);
				echo '<br>';
			}*/
			
			$ipropSectionTemplates = new \Bitrix\Iblock\InheritedProperty\SectionTemplates(CATALOG_BLOCK_ID, $sectionId);
			$templates = $ipropSectionTemplates->findTemplates();
			
			/*if (self::DEBUG) {
				echo '<pre>';print_r($templates);echo '</pre>';
				echo '<br>';
			}*/

			switch ($metaType) {
				case 'Title':
					if (empty($templates['SECTION_META_TITLE']['TEMPLATE'])) {
						$title = implode(' ', $valuesToSave);
						$newTemplates = [
							'SECTION_META_TITLE' => $title,
						];
					}
				break;
				case 'Description':
					if (empty($templates['SECTION_META_DESCRIPTION']['TEMPLATE'])) {
						$description = implode(' ', $valuesToSave);
						$newTemplates = [
							'SECTION_META_DESCRIPTION' => $description,
						];
					}
				break;
				case 'Keywords':
					if (empty($templates['SECTION_META_KEYWORDS']['TEMPLATE'])) {
						$keywords = implode(', ', $valuesToSave);
						$newTemplates = [
							'SECTION_META_KEYWORDS' => $keywords,
						];
					}
				break;
			}
			
			/*if (self::DEBUG) {
				echo 'SECTION newTemplates';
				echo '<br>';
				print_r($newTemplates);
				echo '<br><br>';
			}*/
			
			if (!empty($newTemplates)) {
				$ipropSectionTemplates->set($newTemplates);
				
				$ipropSectionValues = new \Bitrix\Iblock\InheritedProperty\SectionValues(CATALOG_BLOCK_ID, $sectionId);
				$ipropSectionValues->clearValues();
			}
			
			// поиск элементов
			$arFilter = ["IBLOCK_ID" => CATALOG_BLOCK_ID, "SECTION_ID" => $sectionId, "ID" => 6856];
			$arSelect = ["ID", "NAME", "IBLOCK_ID"];
			$rsElements = CIBlockElement::GetList([], $arFilter, false, false, $arSelect);
			while ($arElements = $rsElements->Fetch()) {
				//echo 'NAME: '.$name.'<br>';
				$name = Seo::getInstance()->normalizeName($arElements['NAME']);
				//echo 'NORMALIZE NAME: '.$name.'<br>';
				$elementId = $arElements['ID'];
				
				/*if (self::DEBUG) {
					echo $metaType.' - '.$name;
					echo '<br>';
					
					echo 'values';
					echo '<br>';
					print_r($values);
					echo '<br>';
				}*/
				
				$newValues = [];
				foreach ($values as $key => $value) {
					if (strpos($value, '/') !== false) {
						$variants = explode('/', $value);
						$newValues[] = $variants[rand(0, count($variants) - 1)];
					} else {
						$newValues[] = $value;
					}
				}
				
				$valuesToSave = [];
				foreach ($newValues as $key => $value) {
					$valuesToSave[$key] = $newValues[$key];
					if (strpos($value,'{item}') !== false) {
						$valuesToSave[$key] = str_replace('{item}', $name, $value);
					}
				}
				
				/*if (self::DEBUG) {
					echo 'valuesToSave';
					echo '<br>';
					print_r($valuesToSave);
					echo '<br>';
				}*/
				
				$ipropElementTemplates = new \Bitrix\Iblock\InheritedProperty\ElementTemplates(CATALOG_BLOCK_ID, $elementId);
				$templates = $ipropElementTemplates->findTemplates();
				
				/*if (self::DEBUG) {
					echo 'BEGIN templates';
					echo '<br>';
					echo '<pre>';print_r($templates);echo '</pre>';
					echo 'END templates';
					echo '<br>';
				}*/
				
				switch ($metaType) {
					case 'Title':
						if (empty($templates['ELEMENT_META_TITLE']['TEMPLATE'])) {
							$title = implode(' ', $valuesToSave);
							$newTemplates = [
								'ELEMENT_META_TITLE' => $title,
							];
						}
					break;
					case 'Description':
						if (empty($templates['ELEMENT_META_DESCRIPTION']['TEMPLATE'])){
							$description = implode(' ', $valuesToSave);
							$newTemplates = [
								'ELEMENT_META_DESCRIPTION' => $description,
							];
						}
					break;
					case 'Keywords':
						if (empty($templates['ELEMENT_META_KEYWORDS']['TEMPLATE'])) {
							$keywords = implode(', ', $valuesToSave);
							$newTemplates = [
								'ELEMENT_META_KEYWORDS' => $keywords,
							];
						}
					break;
				}
				
				/*if (self::DEBUG) {
					print_r($newTemplates);
					echo '<br><br>';
				}*/
				
				if (!empty($newTemplates)) {
					$ipropElementTemplates->set($newTemplates);
					
					$ipropElementValues = new \Bitrix\Iblock\InheritedProperty\ElementValues(CATALOG_BLOCK_ID, $elementId);
					$ipropElementValues->clearValues();
				}
			}
			
			// поиск подразделов
			/*$arFilter = ["IBLOCK_ID" => CATALOG_BLOCK_ID, "SECTION_ID" => $sectionId];
			$arSelect = ["ID", "NAME", "IBLOCK_ID"];
			$rsSections = CIBlockSection::GetList([], $arFilter, false, $arSelect);
			while ($arSections = $rsSections->Fetch()) {
				//echo 'Подраздел: '.$arSections['ID'].' - '.$arSections['NAME'].'<br>';
				Seo::getInstance()->getSections($metaType, $arSections['ID'], $values);
			}*/
		}
	}
}

$offset = Seo::getInstance()->getOffset();
$templates = Seo::getInstance()->getMetaTemplates();
Seo::getInstance()->getSections($offset, $templates);

Seo::getInstance()->setOffset();


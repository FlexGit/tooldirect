<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

CModule::IncludeModule("iblock");
CModule::IncludeModule('main');
CModule::IncludeModule('highloadblock');

class Seo {
	private static $instance = null;
	const IBLOCK_ID = 14;
	const HBLOCK_ID = 8;
	
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
	
	/**
	 * Templates
	 *
	 */
	public function getMetaTemplates($offset) {
		$arFilter = ["IBLOCK_ID" => self::IBLOCK_ID, ">=TIMESTAMP_X" => $offset['UF_DATE']];
		$arSelect = ["ID", "NAME", "IBLOCK_ID", "PROPERTY_*"];
		$rsElements = CIBlockElement::GetList([], $arFilter, false, false, $arSelect);
		while ($arElements = $rsElements->GetNextElement()) {
			$arProps = $arElements->GetProperties();
			
			$metaType = $arProps['TYPE']['VALUE'];
			$sectionId = $arProps['SECTION']['VALUE'];

			$values = [];
			for ($i=1;$i<=8;$i++) {
				if ((trim($arProps['VALUE'.$i]['VALUE']))) {
					$values[] = $arProps['VALUE'.$i]['VALUE'];
				}
			}
			
			if (!empty($metaType) && !empty($sectionId) && !empty($values)) {
				Seo::getInstance()->getSections($metaType, $sectionId, $values);
			}
		}
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
	 * Sections
	 *
	 */
	public function getSections($metaType, $sectionId, $values) {
		$arFilter = ["IBLOCK_ID" => CATALOG_BLOCK_ID, "ID" => $sectionId];
		$arSelect = ["ID", "NAME", "IBLOCK_ID"];
		$rsSections = CIBlockSection::GetList([], $arFilter, false, $arSelect);
		if ($arSections = $rsSections->Fetch()) {
			$name = Seo::getInstance()->normalizeName($arSections['NAME']);

			//echo $metaType.' - '.$name.'<br>';
			//print_r($values);
			//echo '<br>';
			
			$newValues = [];
			foreach ($values as $key => $value) {
				if (strpos($value, '/') !== false) {
					$variants = explode('/', $value);
					$newValues[] = $variants[rand(0, count($variants) - 1)];
				} else {
					$newValues[] = $value;
				}
			}
			
			//print_r($newValues);
			//echo '<br>';
			
			$valuesToSave = [];
			foreach ($newValues as $key => $value) {
				$valuesToSave[$key] = $newValues[$key];
				if (strpos($value,'{item}') !== false) {
					$valuesToSave[$key] = str_replace('{item}', $name, $value);
				}
			}
			//print_r($valuesToSave);
			//echo '<br>';
			
			$ipropSectionTemplates = new \Bitrix\Iblock\InheritedProperty\SectionTemplates(CATALOG_BLOCK_ID, $sectionId);
			//$templates = $ipropSectionTemplates->findTemplates();
			//$templates['SECTION_META_TITLE']['TEMPLATE']
			switch ($metaType) {
				case 'Title':
					$title = implode(' ', $valuesToSave);
					$newTemplates = [
						'SECTION_META_TITLE' => $title,
					];
				break;
				case 'Description':
					$description = implode(' ', $valuesToSave);
					$newTemplates = [
						'SECTION_META_DESCRIPTION' => $description,
					];
				break;
				case 'Keywords':
					$keywords = implode(', ', $valuesToSave);
					$newTemplates = [
						'SECTION_META_KEYWORDS' => $keywords,
					];
				break;
			}
			
			//print_r($newTemplates);
			//echo '<br><br>';
			
			$ipropSectionTemplates->set($newTemplates);
			
			$ipropSectionValues = new \Bitrix\Iblock\InheritedProperty\SectionValues(CATALOG_BLOCK_ID, $sectionId);
			$ipropSectionValues->clearValues();
			
			// поиск элементов
			$arFilter = ["IBLOCK_ID" => CATALOG_BLOCK_ID, "SECTION_ID" => $sectionId];
			$arSelect = ["ID", "NAME", "IBLOCK_ID"];
			$rsElements = CIBlockElement::GetList([], $arFilter, false, false, $arSelect);
			while ($arElements = $rsElements->Fetch()) {
				//echo 'NAME: '.$name.'<br>';
				$name = Seo::getInstance()->normalizeName($arElements['NAME']);
				//echo 'NORMALIZE NAME: '.$name.'<br>';
				$elementId = $arElements['ID'];
				
				//echo $metaType.' - '.$name;
				//echo '<br>';
				
				//print_r($values);
				//echo '<br>';
				
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
				//print_r($valuesToSave);
				//echo '<br>';
				
				$ipropElementTemplates = new \Bitrix\Iblock\InheritedProperty\ElementTemplates(CATALOG_BLOCK_ID, $elementId);
				//$templates = $ipropElementTemplates->findTemplates();
				//$templates['ELEMENT_META_TITLE']['TEMPLATE']
				switch ($metaType) {
					case 'Title':
						$title = implode(' ', $valuesToSave);
						$newTemplates = [
							'ELEMENT_META_TITLE' => $title,
						];
					break;
					case 'Description':
						$description = implode(' ', $valuesToSave);
						$newTemplates = [
							'ELEMENT_META_DESCRIPTION' => $description,
						];
					break;
					case 'Keywords':
						$keywords = implode(', ', $valuesToSave);
						$newTemplates = [
							'ELEMENT_META_KEYWORDS' => $keywords,
						];
					break;
				}
				
				//print_r($newTemplates);
				//echo '<br><br>';
				
				$ipropElementTemplates->set($newTemplates);
				
				$ipropElementValues = new \Bitrix\Iblock\InheritedProperty\ElementValues(CATALOG_BLOCK_ID, $elementId);
				$ipropElementValues->clearValues();
			}
			
			// поиск подразделов
			$arFilter = ["IBLOCK_ID" => CATALOG_BLOCK_ID, "SECTION_ID" => $sectionId];
			$arSelect = ["ID", "NAME", "IBLOCK_ID"];
			$rsSections = CIBlockSection::GetList([], $arFilter, false, $arSelect);
			while ($arSections = $rsSections->Fetch()) {
				//echo 'Подраздел: '.$arSections['ID'].' - '.$arSections['NAME'].'<br>';
				Seo::getInstance()->getSections($metaType, $arSections['ID'], $values);
			}
		}
	}
}

$offset = Seo::getInstance()->getOffset();
Seo::getInstance()->getMetaTemplates($offset);
Seo::getInstance()->setOffset();


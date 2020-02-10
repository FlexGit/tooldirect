<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

CModule::IncludeModule("iblock");
CModule::IncludeModule('main');

class Descr {
	private static $instance = null;
	const IBLOCK_ID = 16;
	const TEMPLATE_NAME = 'Шаблон для Фрезы концевые';
	const TEMPLATE_VARIANTS_COUNT = 9;
	
	/**
	 * @return Descr
	 */
	public static function getInstance() {
		if (null === self::$instance) {
			self::$instance = new self();
		}
		return self::$instance;
	}
	
	public function __construct() {
	}
	
	public function getDescrTemplates() {
		$arFilter = ["IBLOCK_ID" => self::IBLOCK_ID, "NAME" => self::TEMPLATE_NAME];
		$arSelect = ["ID", "NAME", "IBLOCK_ID", "PROPERTY_*"];
		$rsElements = CIBlockElement::GetList([], $arFilter, false, false, $arSelect);
		$values = [];
		while ($arElements = $rsElements->GetNextElement()) {
			$arFields = $arElements->GetFields();
			$arProps = $arElements->GetProperties();
			$sections = $arProps['SECTION']['VALUE'];
			for ($i = 1; $i <= self::TEMPLATE_VARIANTS_COUNT; $i++) {
				if ((trim($arProps['VALUE' . $i]['VALUE']))) {
					$values[$arFields['ID']][] = $arProps['VALUE' . $i]['VALUE'];
				}
			}
		}

		$articles = Descr::getInstance()->getArticles($sections);
		
		if (!empty($articles) && !empty($values)) {
			foreach ($articles as $article) {
				$values2 = [];
				foreach ($values as $k => $v) {
					$values2[] = $v[rand(0, self::TEMPLATE_VARIANTS_COUNT - 1)];
				}
				if (!empty($values2)) {
					shuffle($values2);

					$el = new CIBlockElement;
					$arLoadProductArray = [
						"DETAIL_TEXT" => implode('<br><br>', $values2),
						"DETAIL_TEXT_TYPE" => "html"
					];
					//print_r($arLoadProductArray);
					$res = $el->Update($article, $arLoadProductArray);
					//echo $article.' - '.$res.'<br><br>';
				}
			}
		}
	}
	
	public function getArticles($sections) {
		// поиск элементов
		$articles = [];
		$arFilter = ["IBLOCK_ID" => CATALOG_BLOCK_ID, "SECTION_ID" => $sections];
		$arSelect = ["ID", "NAME", "IBLOCK_ID"];
		$rsElements = CIBlockElement::GetList([], $arFilter, false, false, $arSelect);
		while ($arElements = $rsElements->Fetch()) {
			$articles[] = $arElements['ID'];
		}
		return $articles;
	}
}

Descr::getInstance()->getDescrTemplates();


<?php
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');

CModule::IncludeModule("iblock");
CModule::IncludeModule("catalog");
CModule::IncludeModule('main');
CModule::IncludeModule('highloadblock');

$params = [
	'PartNum' => 'ARTICLE', // Артикул
	'Make' => 'MAKE', // Производитель
	'Diam' => 'D', // Диаметр
	'Dia' => 'D', // Диаметр
	'Diam2' => 'D2', // Диаметр внутренний
	'I_CuttingPart' => 'I', // Длина режущей части ножа
	'Cutting part' => 'I', // Длина режущей части ножа
	'Lenght' => 'L', // Общая длина
	'Shank' => 'S', // Диаметр хвостовика
	'Rad' => 'R', // Радиус
	'DeepH' => 'H', // Глубина врезания
	'Grad' => 'CUTTING_TYPE', // Направление реза
	'Angle' => 'CUTTING_TYPE', // Угол реза
	'TeethQ' => 'Z', // Количество зубьев
	'Rotation1' => 'RN', // Направление реза
	'Material' => 'MATERIAL', // Обрабатываемый материал (Мягкая древесина,Твёрдая древесина,Фанера,МДФ,ЛДСП,Ламинат,Пластик,Композит,Алюминий,Тонкая сталь,Толстая сталь,Гипсокартон,Пеноблоки,Цветные металлы,Текстолит)
	'Rad2' => 'R2', // Радиус 2
	'I_Bore' => 'B', // Диаметер посадочного отверстия
	'Bore' => 'B', // Диаметер посадочного отверстия
	'Kerf' => 'K', // Толщина пропила
	'plate' => 'P', // Толщина корпуса
	'Bore add' => 'B2', // Доп. посадочные отверстия
	'Boreadd' => 'B2', // Доп. посадочные отверстия
	'Teeth' => 'Z', // Количество зубьев
	'Side teeth' => 'Z_TYPE', // Расклинивающие зубья
	'Rotation' => 'RH_LH', // Направление вращения
	'Long' => 'LENGTH', // Длина
	'Width' => 'WIDTH', // Ширина
	'length1' => 'WIDTH', // Ширина
	'Height' => 'HEIGHT', // Высота
	'Heght' => 'HEIGHT', // Высота
	'ToolMaterial' => 'TOOL_MATERIAL', // Материал ножа (HSS сталь,DS (легированная сталь),Твёрдый сплав (HW),Сталь + Твердосплавная напайка)
	'Size' => 'DIMENSIONS', // Размеры
	'Weight' => 'WEIGHT', // Вес
	'Rate' => 'RATE', // Частота вращения, об/мин
	'Typetool' => 'TYPE_TOOL', // Тип
	'Teethtype' => 'TEETH_TYPE', // Тип заточки зуба
	'teethangle' => 'TEETH_ANGLE', // Угол наклона зуба
	'Coating' => 'COATING', // Покрытие
	'Zev' => 'F', // Глубина зева
	'Spread' => 'SPREAD', // Max ширина разжима
];

$materials = [
	'Мягкая древесина' => 108,
	'Твёрдая древесина' => 109,
	'Фанера' => 110,
	'МДФ' => 111,
	'ЛДСП' => 111,
	'Ламинат' => 113,
	'Пластик' => 114,
	'Композит' => 115,
	'Алюминий' => 116,
	'Тонкая сталь' => 117,
	'Толстая сталь' => 118,
	'Гипсокартон' => 119,
	'Пеноблоки' => 120,
	'Цветные металлы' => 121,
	'Текстолит' => 122,
];

$toolMaterials = [
	'HSS сталь' => 128,
	'DS (легированная сталь)' => 129,
	'Твёрдый сплав (HW)' => 130,
	'Сталь + Твердосплавная напайка' => 131,
];

$schemes = [
	'Осмотр инструмента: Осмотр инструмента (Аксессуары)' => 7292,
	'Осмотр инструмента: Осмотр инструмента (Алмазные фрезы)' => 7235,
	'Осмотр инструмента: Осмотр инструмента (Граверы)' => 7305,
	'Осмотр инструмента: Осмотр инструмента (Концевые фрезы)' => 7118,
	'Осмотр инструмента: Осмотр инструмента (Насадные фрезы)' => 7246,
	'Осмотр инструмента: Осмотр инструмента (Ножи)' => 7310,
	'Осмотр инструмента: Осмотр инструмента (ножи) OLD' => 7310,
	'Осмотр инструмента: Осмотр инструмента (Патроны и цанги)' => 7322,
	'Осмотр инструмента: Осмотр инструмента (Пилы) OLD' => 7328,
	'Осмотр инструмента: Осмотр инструмента (Пильные диски)' => 7328,
	'Осмотр инструмента: Осмотр инструмента (Приспособления столярные)' => 7353,
	'Осмотр инструмента: Осмотр инструмента (Приспособления) OLD' => 7353,
	'Осмотр инструмента: Осмотр инструмента (Свёрла и зенкеры)' => 7359,
	'Осмотр инструмента: Осмотр инструмента (Сверла) OLD' => 7359,
	'Осмотр инструмента: Осмотр инструмента (Сменный нож фрезы)' => 7255,
	'Осмотр инструмента: Осмотр инструмента (Спиральные фрезы)' => 7268,
	'Осмотр инструмента: Осмотр инструмента (Столы, верстаки, тиски)' => 7370,
	'Осмотр инструмента: Осмотр инструмента (Струбцины)' => 7373,
	'Осмотр инструмента: Осмотр инструмента (фрезы) OLD' => 7118,
	'Осмотр инструмента: Осмотр инструмента (ножи)' => 7310,
	'Осмотр инструмента: Осмотр инструмента (Пилы)' => 7328,
	'Осмотр инструмента: Осмотр инструмента (Приспособления)' => 7353,
	'Осмотр инструмента: Осмотр инструмента (Сверла)' => 7359,
	'Осмотр инструмента: Осмотр инструмента (фрезы)' => 7118,
	'Осмотр инструмента: Осмотр инструмента' => 7118,
];

$RN = [
	'Верхний рез' => 123,
	'Нижний рез' => 124,
	'Двунаправленный рез' => 125,
];

$TEETH_TYPE = [
	'Раскос' => 132,
	'Прямой/трапеция' => 133,
	'Прямой' => 134,
	'Комбинационный' => 135,
	'Конический' => 136,
];

$translitParams = [
	"max_len" => "100", // обрезает символьный код до 100 символов
	"change_case" => "L", // буквы преобразуются к нижнему регистру
	"replace_space" => "-", // меняем пробелы на нижнее подчеркивание
	"replace_other" => "-", // меняем левые символы на нижнее подчеркивание
	"delete_repeat_replace" => "true", // удаляем повторяющиеся нижние подчеркивания
	"use_google" => "false", // отключаем использование google
];

class Viewapp {
	private static $instance = null;
	public $options;
	
	const API_URL = 'https://osmotr.itbroker.ru';
	const API_LOGIN = 'd1d1d1@inbox.ru';
	const API_PASSWORD = 'Sdfvcx1256';
	const IBLOCK_ID = CATALOG_BLOCK_ID;
	const MAKES_IBLOCK_ID = MAKE_BLOCK_ID;
	const HBLOCK_ID = 4;
	const PRICE_TYPE_ID = 1;

	/**
	 * @return Viewapp
	 */
	public static function getInstance() {
		if (null === self::$instance) {
			self::$instance = new self();
		}
		return self::$instance;
	}
	
	public function __construct() {
		$this->options = [
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_FAILONERROR => true,
		];
		
		$hlblock = Bitrix\Highloadblock\HighloadBlockTable::getById(self::HBLOCK_ID)->fetch();
		$entity = Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hlblock);
		$this->taskRegistryEntity = $entity->getDataClass();
	}
	
	/**
	 * Авторизация
	 *
	 */
	public function auth() {
		$ch = curl_init(self::API_URL . '/integrapi/v1/login');
		curl_setopt_array($ch, $this->options);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(["login" => self::API_LOGIN, "password" => md5(self::API_PASSWORD)]));
		$result = curl_exec($ch);
		//print_r(curl_getinfo($ch));
		curl_close($ch);
		$result = json_decode($result, true);
		return $result['token'];
	}
	
	/**
	 * Offset
	 *
	 */
	public function getOffset() {
		$taskRegistryEntity = $this->taskRegistryEntity;
		$offset = '';
		$resTaskRegistry = $taskRegistryEntity::getList([
			"select" => ['*'],
			"order"  => ['ID' => 'DESC'],
			"filter" => ['UF_PARAM' => 'viewapp_inspections_offset']
		]);
		if ($rowTaskRegistry = $resTaskRegistry->Fetch()) {
			$offset = $rowTaskRegistry;
		}
		return $offset;
	}

	/**
	 * Осмотр
	 *
	 */
	public function getInspection($token, $inspectionId) {
		$ch = curl_init(self::API_URL . '/integrapi/v3/inspection/' . $inspectionId . '?token=' . $token);
		curl_setopt_array($ch, $this->options);
		$result = curl_exec($ch);
		curl_close($ch);
		
		$inspection = json_decode($result, true);
		
		return $inspection;
	}

	/**
	 * Осмотры
	 *
	 */
	public function getInspections($token, $offset) {
		global $params, $schemes, $translitParams, $materials, $RN, $toolMaterials, $TEETH_TYPE;
		
		$taskRegistryEntity = $this->taskRegistryEntity;
		
		$watermark = $_SERVER['DOCUMENT_ROOT'] . '/images/watermark_video.png';
		
		$url = self::API_URL . '/integrapi/v2/inspections?token=' . $token . '&offset=' . $offset['UF_VALUE'];
		echo $url.'<br>';
		$ch = curl_init($url);
		/*$search = '357251';
		$ch = curl_init(self::API_URL . '/integrapi/v2/inspections?token=' . $token . '&search=' . $search);*/
		
		curl_setopt_array($ch, $this->options);
		$result = curl_exec($ch);
		curl_close($ch);
		
		$inspections = json_decode($result, true);
		
		//echo '<pre>';print_r($inspections);echo '</pre>';
		
		if ($inspections['success']) {
			if (count($inspections['inspections'])) {
				foreach ($inspections['inspections'] as $v) {
					// забираем только Осмотры в статусе Экспертиза и Договор
					if (!in_array($v['status']['alias'], ['expertise', 'contract'])) continue;
					
					if (!$schemes[$v['service_name']]) continue;
					
					$name = $description = $subSectionNameShort = $subSectionNameFull = '';
					$seoSections = [];
					
					if (!empty($v['object_name'])) {
						$name = $v['object_name'];
					}
					
					$inspection = Viewapp::getInstance()->getInspection($token, $v['id']);
					
					//echo '<pre>';print_r($inspection);echo '</pre>';
					
					$inspectionParams = [];
					if (count($inspection['form_data_json'])) {
						// перевод характеристик Viewapp в наименования полей сайта
						foreach ($inspection['form_data_json'] as $data) {
							if (empty($data['value']['text'])) continue;
							$inspectionParams[$data['fieldId']] = trim($data['value']['text']);
						}
					}
					
					if (!$inspectionParams['PartNum']) continue;
					
					echo 'Схема осмотра: ' . $v['service_name'] . ', ID раздела: ' . $schemes[$v['service_name']] . '<br>';
					
					$el = new CIBlockElement;
					$arLoadProductArray = [
						"MODIFIED_BY" => 1,
						"IBLOCK_ID" => self::IBLOCK_ID,
					];
					
					$PROP = [];
					$PROP['ARTICLE'] = $inspectionParams['PartNum'];
					
					$userGroupIds = $userExtGroupIds = $seoGroupIds = [];
					
					// характеристики
					foreach ($inspectionParams as $k_param => $v_param) {
						if ($k_param == 'PartNum') continue;
						if ($k_param == 'Name1') { // Наименование
							$name = $v_param;
						} elseif (in_array($k_param, array('Info','discription','Discription1','Addtool','adddiscription'))) { // Описание
							$description .= $v_param . '<p>';
						} elseif ($k_param == 'Categoryshort') { // подраздел краткий
							$userGroupIds = $this->getGroupIds(trim($v_param), $v['service_name'], 'user');
						} elseif ($k_param == 'Categoryfull') { // подраздел расширенный
							$userExtGroupIds = $this->getGroupIds(trim($v_param), $v['service_name'],'user_ext');
						} elseif ($k_param == 'SEOfeatures') { // SEO-признаки
							$v_param = explode(',', $v_param);
							if (count($v_param)) {
								foreach ($v_param as $value) {
									$seoSections[] = trim($value);
								}
								$seoGroupIds = $this->getGroupIds($seoSections, $v['service_name'],'seo');
							}
						} else {
							if ($k_param == 'Make') { // производитель
								$v_param = $this->getMakeId(trim(strip_tags($v_param)));
							}
							if ($k_param == 'Material') { // подходит для обработки материалов
								$v_param = explode(',', $v_param);
								if (count($v_param)) {
									$vArr = [];
									foreach ($v_param as $value) {
										$vArr[] = $materials[trim($value)];
									}
									$v_param = $vArr;
								}
							}
							if ($k_param == 'ToolMaterial') { // материал инструмента
								$v_param = explode(',', $v_param);
								if (count($v_param)) {
									$vArr = [];
									foreach ($v_param as $value) {
										$vArr[] = $toolMaterials[trim($value)];
									}
									$v_param = $vArr;
								}
							}
							if ($k_param == 'Rotation1') { // направление вращения
								$v_param = $RN[trim($v_param)];
							}
							if ($k_param == 'Teethtype') { // Тип заточки зубьев
								$v_param = $TEETH_TYPE[trim($v_param)];
							}
							$PROP[$params[$k_param]] = $v_param;
						}
					}
					
					// фото и видео
					$PROP['MORE_PHOTO'] = $PROP['VIDEO'] = [];
					foreach ($inspection['steps'] as $step) {
						if ($step['schema_step_type'] == 'photo' && !empty($step['photos'])) {
							foreach ($step['photos'] as $file) {
								if (trim($file['source_url'])) {
									$PROP['MORE_PHOTO'][] = ['VALUE' => CFile::MakeFileArray(trim($file['source_url'])), 'DESCRIPTION' => ''];
								}
							}
						}
						if ($step['schema_step_type'] == 'video' && !empty($step['videos'])) {
							foreach ($step['videos'] as $file) {
								if (trim($file['source_url'])) {
									$videoFile = CFile::MakeFileArray(trim($file['source_url']));
									$rand = rand(1000,9999);
									$newVideoFile = $_SERVER['DOCUMENT_ROOT'] . '/upload/video/video_watermark_'.$rand.'.mp4';
									exec('ffmpeg -i ' . $videoFile['tmp_name'] . ' -i ' . $watermark . ' -filter_complex "overlay=W-w-5:H-h-5" -c:v libx264 -crf 24 -c:a copy ' . $newVideoFile, $output);
									if (!empty($output)) {
										echo 'Видео ошибка: <br>';
										print_r($output);
									} else {
										if (file_exists($newVideoFile)) {
											if (unlink($videoFile['tmp_name'])) {
												if (rename($newVideoFile, $videoFile['tmp_name'])) {
													//echo 'Видео ' . $newVideoFile . ': <br>';
													file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/local/tools/video.log', date('d.m.Y H:i:s') . ': ' . $videoFile['tmp_name']);
													$PROP['VIDEO'][] = ['VALUE' => $videoFile, 'DESCRIPTION' => ''];
												}
											}
										}
									}
								}
							}
						}
					}
					
					// поиск товара на сайте по артикулу
					$arFilter = ["IBLOCK_ID" => self::IBLOCK_ID, "PROPERTY_ARTICLE" => $PROP['ARTICLE']];
					$arSelect = ["ID", "IBLOCK_ID", "NAME"];
					$res = CIBlockElement::GetList([], $arFilter, false, false, $arSelect);
					if ($ob = $res->GetNextElement()) {
						$arFields = $ob->GetFields();
						$elId = $arFields['ID'];
						
						// удаляем видео при обновлении
						$videosArr = [];
						$resVideos = CIBlockElement::GetProperty(self::IBLOCK_ID, $elId, 'sort', 'asc', ['CODE' => 'VIDEO']);
						while($arVideos = $resVideos->Fetch()) {
							if (!empty($arVideos["VALUE"])) {
								$videosArr[$arVideos['PROPERTY_VALUE_ID']] = ["VALUE" => ["del" => "Y"]];
							}
						}
						if (!empty($videosArr)) {
							CIBlockElement::SetPropertyValueCode($elId, "VIDEO", $videosArr);
						}
						
						// удаляем фото при обновлении
						$photosArr = [];
						$resPhotos = CIBlockElement::GetProperty(self::IBLOCK_ID, $elId, 'sort', 'asc', ['CODE' => 'MORE_PHOTO']);
						while($arPhotos = $resPhotos->Fetch()) {
							if (!empty($arPhotos["VALUE"])) {
								$photosArr[$arPhotos['PROPERTY_VALUE_ID']] = ["VALUE" => ["del" => "Y"]];
							}
						}
						if (!empty($photosArr)) {
							CIBlockElement::SetPropertyValueCode($elId, "MORE_PHOTO", $photosArr);
						}
						
						/*if (mb_strpos($arFields['NAME'],', арт.')) {
							//echo 'Исходное название: ' . $arFields['NAME'] . '<br>';
							$arFields['NAME'] = mb_substr($arFields['NAME'], 0, mb_strpos($arFields['NAME'], ', арт.'));
							//echo 'Очищенное название: ' . $arFields['NAME'] . '<br>';
						}
						$arLoadProductArray["NAME"] = $arFields['NAME'] . ', арт. ' . $PROP['ARTICLE'];*/
						//echo 'Название для сайта: ' . $arLoadProductArray["NAME"].'<br>';
						$arLoadProductArray["CODE"] = /*CUtil::translit($arLoadProductArray["NAME"], "ru", $translitParams)*/$this->str2url($arFields["NAME"]);
						$arLoadProductArray["PROPERTY_VALUES"] = $PROP;
						
						echo 'Артикул: ' . $PROP['ARTICLE'] . '<br>';
						echo '<pre>';
						print_r($arLoadProductArray);
						echo '</pre>';
						
						if ($res = $el->Update($elId, $arLoadProductArray)) {
							echo 'UPDATE: Товар ID ' . $elId . ' обновлен, Артикул ' . $inspectionParams['PartNum'] . '<br><br>';
						} else {
							echo 'UPDATE: Товар ID ' . $elId . ' ошибка: ' . $el->LAST_ERROR . '<br><br>';
						}
						
						$groupIds = array_unique(array_merge($userGroupIds, $userExtGroupIds, $seoGroupIds));
						if (!empty($elId) && !empty($groupIds)) {
							// разделы, к которым привязан элемент
							$oldGroupsIds = [];
							$oldGroupsRes = CIBlockElement::GetElementGroups($elId, true);
							while ($arGroup = $oldGroupsRes->Fetch()) {
								$oldGroupsIds[] = $arGroup["ID"];
							}
							// обновление разделов элемента
							$newGroupIds = array_unique(array_merge($oldGroupsIds, $groupIds));
							CIBlockElement::SetElementSection($elId, $newGroupIds);
						}
					} else {
						$arLoadProductArray["ACTIVE"] = "Y";
						$arLoadProductArray["IBLOCK_SECTION_ID"] = $schemes[$v['service_name']];
						$arLoadProductArray["IBLOCK_SECTION"] = $schemes[$v['service_name']];
						
						if (!empty($name)) {
							$arLoadProductArray["NAME"] = $name . ', арт. ' . $PROP['ARTICLE'];
						} elseif (!empty($v['object_name'])) {
							$arLoadProductArray["NAME"] = $v['object_name'] . ', арт. ' . $PROP['ARTICLE'];
						} else {
							$arLoadProductArray["NAME"] = $PROP['ARTICLE'];
						}
						$arLoadProductArray["CODE"] = /*CUtil::translit($arLoadProductArray["NAME"], "ru", $translitParams)*/$this->str2url($arLoadProductArray["NAME"]);
						if (!empty($description)) {
							$arLoadProductArray["DETAIL_TEXT"] = $description;
						}
						
						$arLoadProductArray["PROPERTY_VALUES"] = $PROP;
						
						echo 'Артикул: ' . $PROP['ARTICLE'] . '<br>';
						echo '<pre>';
						print_r($arLoadProductArray);
						echo '</pre>';
						
						if ($elId = $el->Add($arLoadProductArray)) {
							echo 'ADD Товар ID ' . $elId . ' добавлен, Артикул ' . $inspectionParams['PartNum'] . '<br><br>';
						} else {
							echo 'ADD: Товар ID ' . $elId . ' ошибка: ' . $el->LAST_ERROR . '<br><br>';
						}
						
						$groupIds = array_unique(array_merge($userGroupIds, $userExtGroupIds, $seoGroupIds));
						if (!empty($elId) && !empty($groupIds)) {
							// разделы, к которым привязан элемент
							$oldGroupsIds = [];
							$oldGroupsRes = CIBlockElement::GetElementGroups($elId, true);
							while ($arGroup = $oldGroupsRes->Fetch()) {
								$oldGroupsIds[] = $arGroup["ID"];
							}
							// обновление разделов элемента
							$newGroupIds = array_unique(array_merge($oldGroupsIds, $groupIds));
							CIBlockElement::SetElementSection($elId, $newGroupIds);
						}
						
						if (!empty($elId)) {
							$price = 0;
							$arFields = [
								"PRODUCT_ID" => $elId,
								"CATALOG_GROUP_ID" => self::PRICE_TYPE_ID,
								"PRICE" => $price,
								"CURRENCY" => "RUB"
							];
							$res = CPrice::GetList([], ["PRODUCT_ID" => $elId, "CATALOG_GROUP_ID" => self::PRICE_TYPE_ID]);
							if ($arr = $res->Fetch()) {
								//CPrice::Update($arr["ID"], $arFields);
							} else {
								$cataloProductClass = new CCatalogProduct;
								$cataloProductClass->Add([
									"ID" => $elId,
									"QUANTITY" => 0,
									"VAT_INCLUDED" => "Y"
								]);
								CPrice::Add($arFields);
							}
						}
					}
				}
			}
			
			echo 'OFFSET: ' . $inspections['new_offset'] . '<br>';
			
			if ($inspections['new_offset']) {
				$data = [
					"UF_PARAM" => "viewapp_inspections_offset",
					"UF_VALUE" => $inspections['new_offset'],
					"UF_DATE"  => new Bitrix\Main\Type\DateTime(date('Y-m-d H:i:s',time()),'Y-m-d H:i:s')
				];
				$taskRegistryEntity::add($data);
			}
		}
	}

	public function getGroupIds($groups, $scheme, $type) {
		global $translitParams, $schemes;
		
		switch ($type) {
			case 'user':
				$SECTION_FOR_SEO = 0;
				$SECTION_FOR_USER = 1;
				$SECTION_FOR_USER_EXT = 0;
			break;
			case 'user_ext':
				$SECTION_FOR_SEO = 0;
				$SECTION_FOR_USER = 0;
				$SECTION_FOR_USER_EXT = 1;
			break;
			case 'seo':
				$SECTION_FOR_SEO = 1;
				$SECTION_FOR_USER = 0;
				$SECTION_FOR_USER_EXT = 0;
			break;
		}
		
		$groupArr = [];
		if (is_array($groups))
			$groupArr = $groups;
		else
			$groupArr[] = $groups;

		$groupIds = [];
		/*print_r($groupArr);
		echo '<br>';*/
		foreach ($groupArr as $group) {
			// поиск раздела
			echo 'Группа: ' . $group . '<br>';
			$rsSect = CIBlockSection::GetList([], ['IBLOCK_ID' => CATALOG_BLOCK_ID, 'NAME' => $group]);
			if ($arSect = $rsSect->GetNext()) {
				$groupIds[] = $arSect['ID'];
			} else {
				// добавление раздела
				$bs = new CIBlockSection;
				$arLoadSectionArray = [
					"IBLOCK_SECTION_ID" => $schemes[$scheme],
					"IBLOCK_ID" => self::IBLOCK_ID,
					"NAME" => $group,
					"CODE" => /*CUtil::translit($group, "ru", $translitParams)*/$this->str2url($group),
					"ACTIVE" => "Y",
					"UF_SEO_SECTION" => $SECTION_FOR_SEO,
					"UF_USER_SECTION" => $SECTION_FOR_USER,
					"UF_USER_EXT_SECTION" => $SECTION_FOR_USER_EXT
				];
				if ($groupIds[] = $bs->Add($arLoadSectionArray)) {
					echo 'Добавлен раздел: ' . $group . '<br>';
				} else {
					echo 'Раздел ' . $group . ' не добавлен, ошибка: ' . $bs->LAST_ERROR . '<br>';
					echo '<pre>';print_r($arLoadSectionArray);echo '</pre>';
				}
			}
			echo 'ID групп: ';
			print_r($groupIds);
			echo '<br>';
		}
		return $groupIds;
	}
	
	public function getMakeId($make) {
		global $translitParams;
		
		$arFilterMakes = ["IBLOCK_ID" => self::MAKES_IBLOCK_ID, "NAME" => $make];
		$resMakes = CIBlockElement::GetList([], $arFilterMakes, false, false, ["ID", "IBLOCK_ID"]);
		if ($obMakes = $resMakes->GetNextElement()) {
			$arFieldsMakes = $obMakes->GetFields();
			$makeId = $arFieldsMakes['ID'];
		} else {
			$el = new CIBlockElement;
			$arLoadMakeArray = [
				"MODIFIED_BY" => 1,
				"IBLOCK_ID" => self::MAKES_IBLOCK_ID,
				"NAME" => $make,
				"CODE" => /*CUtil::translit($make, "ru", $translitParams)*/$this->str2url($make),
				"ACTIVE" => "Y",
			];
			if ($makeId = $el->Add($arLoadMakeArray)) {
				echo 'Добавлен производитель: ' . $make . '<br>';
			} else {
				echo 'Производитель ' . $make . ' не добавлен, ошибка: ' . $el->LAST_ERROR . '<br>';
			}
		}
		return $makeId;
	}

	public function rus2translit($string) {
		$converter = array(
			'а' => 'a',   'б' => 'b',   'в' => 'v',
			'г' => 'g',   'д' => 'd',   'е' => 'e',
			'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
			'и' => 'i',   'й' => 'y',   'к' => 'k',
			'л' => 'l',   'м' => 'm',   'н' => 'n',
			'о' => 'o',   'п' => 'p',   'р' => 'r',
			'с' => 's',   'т' => 't',   'у' => 'u',
			'ф' => 'f',   'х' => 'h',   'ц' => 'c',
			'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
			'ь' => '\'',  'ы' => 'y',   'ъ' => '\'',
			'э' => 'e',   'ю' => 'yu',  'я' => 'ya',
			
			'А' => 'A',   'Б' => 'B',   'В' => 'V',
			'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
			'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',
			'И' => 'I',   'Й' => 'Y',   'К' => 'K',
			'Л' => 'L',   'М' => 'M',   'Н' => 'N',
			'О' => 'O',   'П' => 'P',   'Р' => 'R',
			'С' => 'S',   'Т' => 'T',   'У' => 'U',
			'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',
			'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',
			'Ь' => '\'',  'Ы' => 'Y',   'Ъ' => '\'',
			'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',
		);
		return strtr($string, $converter);
	}

	public function str2url($str) {
		// переводим в транслит
		$str = $this->rus2translit($str);
		// в нижний регистр
		$str = strtolower($str);
		// заменям все ненужное нам на "-"
		$str = preg_replace('~[^-a-z0-9_]+~u', '-', $str);
		// удаляем начальные и конечные '-'
		$str = trim($str, "-");
		return $str;
	}
}

$token = Viewapp::getInstance()->auth();
//echo $token; exit;
if ($token) {
	echo 'TOKEN: ' . $token . '<br>';
	$offset = Viewapp::getInstance()->getOffset();
	print_r($offset);
	//if (mb_substr($offset['UF_VALUE'],0, 1) != '0') {
		Viewapp::getInstance()->getInspections($token, $offset);
	//}
}

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");
<?php
require_once __DIR__ . '/../../vendor/autoload.php';
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');

CModule::IncludeModule("iblock");
CModule::IncludeModule('main');

$client = new Google_Client();
$client->setApplicationName('API code samples');
$client->setDeveloperKey('AIzaSyCScoyOpIsLv_sTuA9T9B0maWIQ2tRLdwI');

$videos = [];

$youtube = new Google_Service_YouTube($client);

$queryParams = [
	'channelId' => 'UCDNmAQA3dOGQrrZMOscLk8g'
];

$responsePlaylists = $youtube->playlists->listPlaylists('snippet,contentDetails', $queryParams);

/*echo '<pre>';
print_r($response->items);
echo '</pre>';*/

if (!empty($responsePlaylists->items)) {
	foreach ($responsePlaylists->items as $itemPlaylist) { // плейлисты
		if (!empty($itemPlaylist->snippet->description)) {
			$playlistArticles = explode(',', $itemPlaylist->snippet->description);
		}
		
		$queryParams = [
			'maxResults' => 50,
			'playlistId' => $itemPlaylist->id
		];
		
		$responseVideos = $youtube->playlistItems->listPlaylistItems('snippet,contentDetails', $queryParams);
		
		/*echo '<pre>';
		print_r($responseVideos);
		echo '</pre>';*/
		
		if (!empty($responseVideos->items)) {
			foreach ($responseVideos->items as $itemVideos) { // видео
				if (!empty($itemVideos->snippet->description)) {
					$videoArticles = explode(',', $itemVideos->snippet->description);
				}
				$videoId = $itemVideos->contentDetails->videoId;
				$videos[$videoId] = array_unique(array_merge($playlistArticles, $videoArticles));
			}
		}
	}
}

/*echo '<pre>';
print_r($videos);
echo '</pre>';*/

$arr = [];

if (!empty($videos)) {
	foreach ($videos as $videoId => $articles) {
		if (empty($articles)) continue;
		
		foreach ($articles as $article) {
			$arr[$article][] = $videoId;
		}
	}
}

echo '<pre>';
print_r($arr);
echo '</pre>';

if (!empty($arr)) {
	foreach ($arr as $article => $videoId) {
		$videoIds = implode(',', $videoId);
		
		$arFilter = ["IBLOCK_ID" => CATALOG_BLOCK_ID, "PROPERTY_ARTICLE" => $article];
		$arSelect = ["ID", "IBLOCK_ID", "NAME", "PROPERTY_YOUTUBE_VIDEO_ID"];
		$res = CIBlockElement::GetList([], $arFilter, false, false, $arSelect);
		if ($ob = $res->GetNextElement()) {
			$arFields = $ob->GetFields();
			$arProps = $ob->GetProperties();
			CIBlockElement::SetPropertyValueCode($arFields['ID'], "YOUTUBE_VIDEO_ID", $videoIds);
		}
	}
}

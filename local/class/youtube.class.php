<?php
require_once __DIR__ . '/../../vendor/autoload.php';
session_start();

class Youtube {
	public function upload($id) {
		//$OAUTH2_CLIENT_ID = '936975284514-inuddn1i7lp359vm582dbvm6i4ui6mq7.apps.googleusercontent.com';
		//$OAUTH2_CLIENT_SECRET = 'Hp5Tev7TPnuzI7GfTuZ_5pyw';
		
		
		$redirect = 'https://' . $_SERVER['HTTP_HOST'] . /*$_SERVER['PHP_SELF']*/'/local/tools/youtube.php?id=' . $id;
		AddMessage2Log($redirect);
		
		$client = new Google_Client();
		//$client->setClientId($OAUTH2_CLIENT_ID);
		//$client->setClientSecret($OAUTH2_CLIENT_SECRET);
		$client->setAuthConfig(__DIR__ . '/../../../keys/client_secrets.json');
		$client->setRedirectUri($redirect);
		$client->addScope('https://www.googleapis.com/auth/youtube');
		//$client->setDeveloperKey('AIzaSyCJMvczviTEyZKG1njIP7gBQT2wKsYG5gw');
		$client->setAccessType('offline');
		$client->setPrompt("consent");
		$client->setIncludeGrantedScopes(true);
		
		//$client->setApprovalPrompt('force');
		//approval_prompt=auto
		
		$youtube = new Google_Service_YouTube($client);
		
		if (isset($_GET['code'])) {
			$token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
			$client->setAccessToken($token);
			$_SESSION['upload_token'] = $token;
			header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));
		}
		
		if (!empty($_SESSION['upload_token'])) {
			$client->setAccessToken($_SESSION['upload_token']);
			if ($client->isAccessTokenExpired()) {
				unset($_SESSION['upload_token']);
				
				// added rows
				$client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
				//file_put_contents($credentialsPath, json_encode($client->getAccessToken()));
				$_SESSION['upload_token'] = $client->getAccessToken();
			}
		} else {
			$authUrl = $client->createAuthUrl();
		}

		// Check to ensure that the access token was successfully acquired.
		if ($client->getAccessToken()) {
			$htmlBody = '';
			try{
				// REPLACE this value with the path to the file you are uploading.
				//$videoPath = __DIR__ . '/../../upload/iblock/ce4/ce419fd65161a7180e2fc9589b273642.mp4';
				$videoPath = $options['VIDEO_PATH'];
				// Create a snippet with title, description, tags and category ID
				// Create an asset resource and set its snippet metadata and type.
				// This example sets the video's title, description, keyword tags, and
				// video category.
				$snippet = new Google_Service_YouTube_VideoSnippet();
				$snippet->setTitle($options['NAME']);
				$snippet->setDescription('https://tooldirect.ru' . $options['DETAIL_PAGE_URL']);
				//$snippet->setTags(array("tag1", "tag2"));
				// Numeric video category. See
				// https://developers.google.com/youtube/v3/docs/videoCategories/list
				$snippet->setCategoryId("22");
				// Set the video's status to "public". Valid statuses are "public",
				// "private" and "unlisted".
				$status = new Google_Service_YouTube_VideoStatus();
				$status->privacyStatus = "public";
				// Associate the snippet and status objects with a new video resource.
				$video = new Google_Service_YouTube_Video();
				$video->setSnippet($snippet);
				$video->setStatus($status);
				// Specify the size of each chunk of data, in bytes. Set a higher value for
				// reliable connection as fewer chunks lead to faster uploads. Set a lower
				// value for better recovery on less reliable connections.
				$chunkSizeBytes = 1 * 1024 * 1024;
				// Setting the defer flag to true tells the client to return a request which can be called
				// with ->execute(); instead of making the API call immediately.
				$client->setDefer(true);
				// Create a request for the API's videos.insert method to create and upload the video.
				$insertRequest = $youtube->videos->insert("status,snippet", $video);
				// Create a MediaFileUpload object for resumable uploads.
				$media = new Google_Http_MediaFileUpload(
					$client,
					$insertRequest,
					'video/*',
					null,
					true,
					$chunkSizeBytes
				);
				$media->setFileSize(filesize($videoPath));
				
				// Read the media file and upload it chunk by chunk.
				$status = false;
				$handle = fopen($videoPath, "rb");
				while (!$status && !feof($handle)) {
					$chunk = fread($handle, $chunkSizeBytes);
					$status = $media->nextChunk($chunk);
				}
				fclose($handle);
				
				// If you want to make other calls after the file upload, set setDefer back to false
				$client->setDefer(false);
				
				$htmlBody .= "<h3>Video Uploaded</h3><ul>";
				$htmlBody .= sprintf('<li>%s (%s)</li>',
					$status['snippet']['title'],
					$status['id']);
				$htmlBody .= '</ul>';
			} catch (Google_Service_Exception $e) {
				$htmlBody .= sprintf('<p>A service error occurred: <code>%s</code></p>',
					htmlspecialchars($e->getMessage()));
			} catch (Google_Exception $e) {
				$htmlBody .= sprintf('<p>An client error occurred: <code>%s</code></p>',
					htmlspecialchars($e->getMessage()));
			}
			$_SESSION['upload_token'] = $client->getAccessToken();
		} else {
			$htmlBody = '<h3>Authorization Required</h3><p>You need to <a href="'.$authUrl.'">authorize access</a> before proceeding.</p>';
		}
		
		//echo $htmlBody;
		CIBlockElement::SetPropertyValueCode($options['ID'], "YOUTUBE_RESPONSE", $htmlBody);
	}
}

	
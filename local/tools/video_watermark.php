<?php
function scan_recursive($directory, $callback = null) {
	// Привести каталог в канонизированный абсолютный путь
	$directory = realpath($directory);
	
	if ($d = opendir($directory)) {
		while($fname = readdir($d)) {
			if ($fname == '.' || $fname == '..')
				continue;
			else {
				if ($callback != null && is_callable($callback)) {
					$callback($directory . DIRECTORY_SEPARATOR . $fname);
				}
			}
			
			if (is_dir($directory . DIRECTORY_SEPARATOR . $fname))
				scan_recursive($directory.DIRECTORY_SEPARATOR.$fname, $callback);
		}
		closedir($d);
	}
}
function scan_callback($fname) {
	$file = explode('.', $fname);
	
	/*if (!$_SESSION['continue']) {
		if ($fname != '/var/www/tool-direct/www/upload/iblock/231/2315d68fc424dc5dc736c077bc05289b.mp4')
			return false;
	}*/
	
	$_SESSION['continue'] = 1;
	
	if (!isset($file[1]) || $file[1] != 'mp4')
		return false;
	
	echo $fname.'<br>';
	
	$watermark = $_SERVER['DOCUMENT_ROOT'] . '/images/watermark_video.png';
	$rand = rand(1000,9999);
	$newFname = $_SERVER['DOCUMENT_ROOT'] . '/upload/video/video_watermark_'.$rand.'.mp4';
	
	exec('ffmpeg -i ' . $fname . ' -i ' . $watermark . ' -filter_complex "overlay=W-w-5:H-h-5" -c:v libx264 -crf 24 -c:a copy ' . $newFname, $output);
	
	if (!empty($output)) {
		print_r($output);
		echo '<br>';
	} else {
		//echo 'label1: '.$newFname.'<br>';
		if (file_exists($newFname)) {
			//echo 'label2: '.$newFname.'<br>';
			if (unlink($fname)) {
				//echo 'label3: '.$newFname.'<br>';
				rename($newFname, $fname);
				file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/local/tools/video.log', date('d.m.Y H:i:s') . ': ' . $fname);
			}
		}
	}
}

exit;
$_SESSION['continue'] = 0;
scan_recursive($_SERVER['DOCUMENT_ROOT'] . '/upload/video/', 'scan_callback');
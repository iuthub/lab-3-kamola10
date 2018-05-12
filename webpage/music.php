<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
 "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Music Viewer</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<link href="viewer.css" type="text/css" rel="stylesheet" />
			
			<?php function filesize_gen($value)
			{
				$filesize = filesize($value);
				$label = " ";
				if ($filesize > 0 && $filesize <= 1024) {
					$label = " b";
				}else if ($filesize > 1024 && $filesize <= 1048576) {
					$label = " kb";
					$filesize /= 1024;
				}else if ($filesize > 1048576 && $filesize <= 1073741824) {
					$label = " mb";
					$filesize /= 1048576;
				}

				$str = '('.round($filesize).')'.$label;

				return $str;
			} 
			?>

	</head>
	<body>
		<div id="header">

			<h1>190M Music Playlist Viewer</h1>
			<h2>Search Through Your Playlists and Music</h2>
		</div>
		
		
		<div id="listarea">
			<ul id="musiclist">
			<?php
			$path = "songs/";
			if (isset($_REQUEST['playlist'])) {
				$playlist = $_REQUEST['playlist'];
				$list = explode("\n",file_get_contents($path.$playlist, FILE_USE_INCLUDE_PATH));
				foreach ($list as $value) {?>
					<li class="mp3item"><a href="<?=$path.$value?>"><?= basename($value)?></a></li>
			<?php 	}	
			} else{
					$list_of_musics = glob($path."*.mp3");
					foreach ($list_of_musics as $value){
						?>
						<li class="mp3item"><a href="<?=$value?>"><?= basename($value)?></a><?=filesize_gen($value)?></li>
				<?php }
					$Playlists = glob($path."*.txt");
					foreach ($Playlists as $value){
						?>
						<li class="playlistitem"><a href="?playlist=<?=basename($value)?>"><?= basename($value)?></a><?=filesize_gen($value)?></li>
				<?php } 
			}
			?>
			</ul>
		</div>
	</body>
</html>
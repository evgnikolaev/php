<?

//  http://test-php/7_download_file/gallery/


function getPictures($pathToDir)
{
	$pictures = [];
	if (file_exists($pathToDir)) {
		$d = opendir($pathToDir);
		while ($file = readdir($d)) {
			if ($file == '.' || $file == '..') {
				continue;
			}
			$pictures[] = $pathToDir . $file;
		}
		closedir($d);
	}
	return $pictures;
}


function showFile($pathToFile)
{
	include 'picture.inc.php';
}

$catalog = (!empty($_GET['catalog'])) ? $_GET['catalog'] : 'superbox';
$pictures = getPictures('img/' . $catalog . '/');
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Superbox, the lightbox, reimagined</title>
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link href="css/style.css" rel="stylesheet">
</head>
<body>
<div class="wrapper">
	<div class="logo">
		<img src="img/logo.png" class="logo-img" alt="Logo">
	</div>

	<? /* Для вывода и записи можно создать файл например routing.txt Где храним русские названия , и этот файл обрабатывать  */ ?>
	<p><a href="index.php?catalog=test">test</a></p>
	<p><a href="index.php?catalog=superbox">superbox </a></p>
	<? /* ---- */ ?>

	<!-- SuperBox -->
	<div class="superbox">
		<?
		foreach ($pictures as $pic) {
			showFile($pic);
		}
		?>
		<div class="superbox-float"></div>
	</div>
	<!-- /SuperBox -->

	<div style="height:300px;"></div>

</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="js/superbox.js"></script>
<script>
	$(function () {

		// Call SuperBox
		$('.superbox').SuperBox();

	});
</script>
</body>
</html>
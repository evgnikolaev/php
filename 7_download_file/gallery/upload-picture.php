<?php

//http://test-php/7_download_file/gallery/upload-picture.php


function uploadPicture($path)
{
	if (!file_exists($path)) {
		mkdir($path, 0777);
	}

	if ($_FILES['picture']['error'] == 0) {
		if (move_uploaded_file($_FILES['picture']['tmp_name'], $path . '/' . time() . '.' . pathinfo($_FILES['picture']['name'])['extension'])) {
			echo 'file was saved';
		} else {
			echo 'not saved file';
		}
	} else {
		echo 'Error - ' . $_FILES['picture']['error'];
	}
}


function getCatalog()
{
	$list = [];
	if (file_exists('img')) {
		$d = opendir('img');
		while ($file = readdir($d)) {
			if ($file == '.' || $file == '..' || is_file('img/' . $file)) {
				continue;
			}
			$list[] = 'img/' . $file;
		}
		closedir($d);
	}
	return $list;
}

$catalog = getCatalog();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	uploadPicture($_POST['dir']);
}


?>
<h2>Загрузка новых фото</h2>
<form action="" method="POST" enctype="multipart/form-data">
	<select name="dir">
		<? foreach ($catalog as $cat) { ?>
			<option value="<?= $cat ?>"><?= $cat ?></option>
		<? } ?>
	</select> <input type="file" name="picture">
	<button>upload</button>
</form>
